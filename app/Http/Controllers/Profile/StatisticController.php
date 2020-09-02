<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Mail\ChatCallback;
use App\Models\User;
use App\Repository\Interfaces\ProviderRepositoryInterface;
use App\Utils\Constants;
use App\Utils\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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

        $productPrices   = $this->providerRepository->getMinMaxProductsPrice($provider->id);
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

    public function callback($lang, Request $request)
    {
        if (!$request->text) {
            return JsonResponse::error(['messages' => 'Введите текст']);
        }

        Mail::to(Constants::get('EMAIL'))->send(new ChatCallback($request->text));

        return JsonResponse::success([
            'messages' => 'Ваш тестовый текст отправлен'
        ]);
    }
}
