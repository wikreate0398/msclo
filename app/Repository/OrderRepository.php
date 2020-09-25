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
    
    public function getProviderOrders($provider_id)
    {
        return Order::whereHas('products', function ($query) use ($provider_id) {
            return $query->where('provider_id', $provider_id);
        })->with(['products' => function ($query) use ($provider_id) {
            return $query->where('provider_id', $provider_id)->with('product');
        }, 'user'])->get();
    }

    public function getMinMaxProductsPrice($id)
    {
        $prices = ProductPrice::whereHas('product', function ($query) use ($id) {
            $query->whereHas('provider', function ($query) use ($id) {
                return $query->where('provider_id', $id);
            });
            return $query->visible();
        })->orderBy('price', 'asc')->groupBy('product_id')->get();

        return collect([
            'min' => $prices->min('price'),
            'max' => $prices->max('price')
        ]);
    }

    public function getSalesFromLastMonth($id)
    {
        $data = OrderProduct::rightJoin('orders', 'orders_products.order_id', '=', 'orders.id')
                            ->select(DB::raw('sum(qty*price) as total_sum, sum(qty) as total_qty'))
                            ->where('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString())
                            ->where('provider_id', $id)->first();

        return [
            'total_sum' => @$data->total_sum ?: 0,
            'total_qty' => @$data->total_qty ?: 0,
        ];
    }

    public function getSumOfAllSalesAndQuantity($id)
    {
        $data = OrderProduct::selectRaw('sum(qty*price) as total_sum, sum(qty) as total_qty')
                                    ->where('provider_id', $id)
                                    ->first();

        return [
            'total_sum' => @$data->total_sum ?: 0,
            'total_qty' => @$data->total_qty ?: 0,
        ];
    }
    
    public function chartData($value)
    {
        $orders = OrderProduct::with(['orders' => function ($query) use ($value) {
            return $query->where('created_at', '>=', Carbon::now()->subDays($value));
        }])->whereHas('orders', function ($query) use ($value) {
            return $query->where('created_at', '>=', Carbon::now()->subDays($value));
        })->where('provider_id', user()->id)->get();
        
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
                    'ordersTotal'  => $orders->groupBy('order_id')->count()
                ]);
            }
        }

        return [
            'labels' => $labels,
            'diagramData' => $diagramData
        ];
    }

    public function dashboardData()
    {
        $sumOfAllSalesAndQuantity = $this->getSumOfAllSalesAndQuantity(user()->id);
        $salesFromLastMonth = $this->getSalesFromLastMonth(user()->id);

        $chartData   = $this->chartData($value = 7);
        $labels      = $chartData['labels'];
        $diagramData = $chartData['diagramData'];
        
        $productPrices = $this->getMinMaxProductsPrice(user()->id);
        $sumOfCategories = $this->providerRepository->getCatsGroupedByProviders(user()->id);

        return [
            'id'                              => Auth::user()->id,
            'provider'                        => User::where('type', 'provider')->where('id', user()->id)->first(),
            'quantityOfAllSales'              => $sumOfAllSalesAndQuantity['total_qty'],
            'sumOfProducts'                   => $this->providerRepository->getProviderProducts(user()->id)->count(),
            'sumOfAllSales'                   => $sumOfAllSalesAndQuantity['total_sum'],
            'sumOfAllSalesFromLastMonth'      => $salesFromLastMonth['total_sum'],
            'quantityOfAllSalesFromLastMonth' => $salesFromLastMonth['total_qty'],
            'sumOfCategories'                 => $sumOfCategories->first() ? $sumOfCategories->first()->count() : 0,
            'minProductPrice'                 => $productPrices['min'],
            'maxProductPrice'                 => $productPrices['max'],
            'orders'                          => $this->getProviderOrders(user()->id),
            'getOrders'                       => $this->getOrders(),
            'products'                        => $this->providerRepository->getProviderProduct(user()->id, false),
            'labels'                          => $labels,
            'diagramData'                     => $diagramData,
        ];
    }
}
