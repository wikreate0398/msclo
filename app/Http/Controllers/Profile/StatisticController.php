<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Catalog\ProductPrice;
use App\Models\Order\Order;
use App\Models\Order\OrderProduct;
use App\Models\User;
use App\Repository\Interfaces\ProviderRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    private $providerRepository;

    public function __construct(ProviderRepositoryInterface $providerRepository)
    {
        $this->providerRepository = $providerRepository;
    }

    public function index($lang)
    {
        $id = Auth::user()->id;
        $provider = User::where('type', 'provider')->where('id', $id)->first();

        $sumOfAllSalesAndQuantity = $this->getSumOfAllSalesAndQuantity($provider->id);
        $sumOfAllSales = $sumOfAllSalesAndQuantity['total_sum'];

        $sumOfAllSalesFromLastMonth = $this->getSumOfAllSalesFromLastMonth($provider->id);
        
        $quantityOfAllSales = $sumOfAllSalesAndQuantity['total_qty'];
        
        $sumOfProducts = $this->providerRepository->getProviderProducts($provider->id)->count();
        $sumOfCategories = $this->providerRepository->getProviderFilterCats()->count();

        $minProductPrice = $this->getMinProductsPrice($provider->id);

        $orders = $this->providerRepository->getProviderOrders($provider->id);
        return view('profile.statistics', compact(
            'id',
            'provider',
            'quantityOfAllSales',
            'sumOfProducts',
            'sumOfAllSales',
            'sumOfAllSalesFromLastMonth',
            'sumOfCategories',
            'orders'
        ));
    }

    public function getMinProductsPrice($id)
    {
        // $price = ProductPrice::whereHas('product', function ($query) {
        //     return $query->where('id', 'id_product');
        // })->where('id_provider', $id)->get()  ;
        // dd($price);
    }

    public function getSumOfAllSalesAndQuantity($id)
    {
        $orderProduct = OrderProduct::select(DB::raw('sum(qty*price) as total_sum, sum(qty) as total_qty'))->where('id_provider', $id)->get()->toArray();
        foreach ($orderProduct as $k => $value) {
            return $value;
        }
    }

    public function getSumOfAllSalesFromLastMonth($id)
    {
        $orderProduct = OrderProduct::whereHas('orders', function ($query) {
            return $query->where('created_at', '>=', Carbon::now()->subMonth());
        })->select(DB::raw('sum(qty*price) as total_sum'))->where('id_provider', $id)->get()->toArray();
        foreach ($orderProduct as $k => $value) {
            return $value['total_sum'];
        }
    }
}
