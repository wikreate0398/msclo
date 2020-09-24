<?php

namespace App\Repository;

use App\Models\Catalog\ProductPrice;
use App\Models\Order\Order;
use App\Models\Order\OrderProduct;
use App\Models\User;
use App\Repository\Interfaces\OrderRepositoryInterface;
use App\Repository\Interfaces\ProviderRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderRepositoryInterface
{
    private $providerRepository;

    public function __construct(ProviderRepositoryInterface $providerRepository)
    {
        $this->providerRepository = $providerRepository;
    }

    public function getOrders()
    {
        $data = OrderProduct::with(['provider', 'product.images'])
                              ->has('product')
                              ->orderBy('qty', 'desc')
                              ->take(5)
                              ->get();
        return $data;
    }
    
    public function getProviderOrders($id_provider)
    {
        return Order::whereHas('products', function ($query) use ($id_provider) {
            return $query->where('id_provider', $id_provider);
        })->with(['products' => function ($query) use ($id_provider) {
            return $query->where('id_provider', $id_provider)->with('product');
        }, 'user'])->get();
    }

    public function getMinMaxProductsPrice($id)
    {
        $prices = ProductPrice::whereHas('product', function ($query) use ($id) {
            $query->whereHas('provider', function ($query) use ($id) {
                return $query->where('id_provider', $id);
            });
            return $query->visible();
        })->orderBy('price', 'asc')->groupBy('id_product')->get();

        return collect([
            'min' => $prices->min('price'),
            'max' => $prices->max('price')
        ]);
    }

    public function getSalesFromLastMonth($id)
    {
        $data = OrderProduct::rightJoin('orders', 'orders_products.id_order', '=', 'orders.id')
                            ->select(DB::raw('sum(qty*price) as total_sum, sum(qty) as total_qty'))
                            ->where('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString())
                            ->where('id_provider', $id)->first();

        return [
            'total_sum' => @$data->total_sum ?: 0,
            'total_qty' => @$data->total_qty ?: 0,
        ];
    }

    public function getSumOfAllSalesAndQuantity($id)
    {
        $data = OrderProduct::selectRaw('sum(qty*price) as total_sum, sum(qty) as total_qty')
                                    ->where('id_provider', $id)
                                    ->first();

        return [
            'total_sum' => @$data->total_sum ?: 0,
            'total_qty' => @$data->total_qty ?: 0,
        ];
    }
    
    public function chartData($value)
    {
        $orders = OrderProduct::with(['orders' => function ($query) use ($value) {
            return $query->where('created_at', '>=', Carbon::now()->subDays($this->getChartDays($value)));
        }])->whereHas('orders', function ($query) use ($value) {
            return $query->where('created_at', '>=', Carbon::now()->subDays($this->getChartDays($value)));
        })->where('id_provider', user()->id)->get();
        
        $labels      = collect();
        $diagramData = collect();
        if ($orders->count()) {
            foreach ($orders->groupBy(function ($item) {
                return $item->orders->created_at->format('d.m');
            }) as $date => $orders) {
                $labels->push($date);

                $diagramData->push([
                    'date'         => $date,
                    'qty'          => $orders->sum('qty'),
                    'sum'          => $orders->sum(function ($order) {
                        return $order->qty*$order->price;
                    }),
                    'ordersTotal'  => $orders->groupBy('id_order')->count()
                ]);
            }
        }

        return [
            'labels' => $labels,
            'diagramData' => $diagramData
        ];
    }

    public function getChartDays($value = 7)
    {
        return $value;
    }

    public function dashboardData()
    {
        $sumOfAllSalesAndQuantity = $this->getSumOfAllSalesAndQuantity(user()->id);
        $salesFromLastMonth = $this->getSalesFromLastMonth(user()->id);

        $chartData = $this->chartData($value = 7);
        $labels = $chartData['labels'];
        $diagramData = $chartData['diagramData'];
        
        $productPrices = $this->getMinMaxProductsPrice(user()->id);
        $sumOfCategories = $this->providerRepository->getCatsGroupedByProviders(user()->id);

        return [
            'id' => Auth::user()->id,
            'provider' => User::where('type', 'provider')->where('id', user()->id)->first(),
            'quantityOfAllSales' => $sumOfAllSalesAndQuantity['total_qty'],
            'sumOfProducts' => $this->providerRepository->getProviderProducts(user()->id)->count(),
            'sumOfAllSales' => $sumOfAllSalesAndQuantity['total_sum'],
            'sumOfAllSalesFromLastMonth' => $salesFromLastMonth['total_sum'],
            'quantityOfAllSalesFromLastMonth' => $salesFromLastMonth['total_qty'],
            'sumOfCategories' => $sumOfCategories->first() ? $sumOfCategories->first()->count() : 0,
            'minProductPrice' => $productPrices['min'],
            'maxProductPrice' => $productPrices['max'],
            'orders' => $this->getProviderOrders(user()->id),
            'getOrders' => $this->getOrders(),
            'products' => $this->providerRepository->getProviderProduct(user()->id, false),
            'labels' => $labels,
            'diagramData' => $diagramData,
        ];
    }
}
