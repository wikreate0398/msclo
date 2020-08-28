<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
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

        $sumOfAllSales = $this->getSumOfAllSales($provider->id);

        $sumOfAllSalesFromLastMonth = $this->getSumOfAllSalesFromLastMonth($provider->id);
        
        $numberOfAllSales = $this->providerRepository->getProviderOrders($provider->id)->count();
    
        $sumOfProducts = $this->providerRepository->getProviderProducts($provider->id)->count();
        $sumOfCategories = $this->providerRepository->getProviderFilterCats()->count();

        $orders = $this->providerRepository->getProviderOrders($provider->id);
        return view('profile.statistics', compact(
            'id',
            'provider',
            'numberOfAllSales',
            'sumOfProducts',
            'sumOfAllSales',
            'sumOfAllSalesFromLastMonth',
            'sumOfCategories',
            'orders'
        ));
    }

    public function getProviderProductCategories($id)
    {
    }

    public function getSumOfAllSales($id)
    {
        $orderProduct = OrderProduct::select(DB::raw('sum(qty*price) as total_sum'))->where('id_provider', $id)->get()->toArray();
        foreach ($orderProduct as $k => $value) {
            return $value['total_sum'];
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
