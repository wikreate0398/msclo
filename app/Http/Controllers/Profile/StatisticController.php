<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repository\Interfaces\ProviderRepositoryInterface;
use Illuminate\Support\Facades\Auth;

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

        $sumOfAllSalesAndQuantity = $this->providerRepository->getSumOfAllSalesAndQuantity($provider->id);
        $sumOfAllSales = $sumOfAllSalesAndQuantity['total_sum'];

        $salesFromLastMonth = $this->providerRepository->getSalesFromLastMonth($provider->id);
        $sumOfAllSalesFromLastMonth = $salesFromLastMonth['total_sum'];
        $quantityOfAllSalesFromLastMonth = $salesFromLastMonth['total_qty'];
        
        $quantityOfAllSales = $sumOfAllSalesAndQuantity['total_qty'];
        
        $sumOfProducts = $this->providerRepository->getProviderProducts($provider->id)->count();
        
        $sumOfCategories = $this->providerRepository->getCatsGroupedByProviders($provider->id)->toArray();
        foreach ($sumOfCategories as $sumOfCategory) {
            $sumOfCategories = count($sumOfCategory);
        }

        $productPrices = $this->providerRepository->getMinMaxProductsPrice($provider->id);
        $minProductPrice = $productPrices['min'];
        $maxProductPrice = $productPrices['max'];

        $orders = $this->providerRepository->getProviderOrders($provider->id);
        return view('profile.statistics', compact(
            'id',
            'provider',
            'quantityOfAllSales',
            'sumOfProducts',
            'sumOfAllSales',
            'sumOfAllSalesFromLastMonth',
            'quantityOfAllSalesFromLastMonth',
            'sumOfCategories',
            'minProductPrice',
            'maxProductPrice',
            'orders'
        ));
    }
}
