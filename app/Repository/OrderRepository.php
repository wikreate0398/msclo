<?php

namespace App\Repository;

use App\Models\Catalog\ProductPrice;
use App\Models\Order\Order;
use App\Models\Order\OrderProduct;
use App\Repository\Interfaces\OrderRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderRepositoryInterface
{
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
}
