<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Mail\ChatCallback;
use App\Models\Order\Order;
use App\Models\Order\OrderProduct;
use App\Models\User;
use App\Repository\Interfaces\OrderRepositoryInterface;
use App\Repository\Interfaces\ProviderRepositoryInterface;
use App\Utils\Constants;
use App\Utils\JsonResponse;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class StatisticController extends Controller
{
    private $providerRepository;

    public function __construct(ProviderRepositoryInterface $providerRepository, OrderRepositoryInterface $orderRepository)
    {
        $this->providerRepository = $providerRepository;
        $this->orderRepository = $orderRepository;
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
        $products = $this->providerRepository->getProviderProduct(user()->id, false);
        
        $sumOfCategories = $this->providerRepository->getCatsGroupedByProviders($provider->id);
        $sumOfCategories = $sumOfCategories->first() ? $sumOfCategories->first()->count() : 0;

        $productPrices   = $this->providerRepository->getMinMaxProductsPrice($provider->id);
        $minProductPrice = $productPrices['min'];
        $maxProductPrice = $productPrices['max'];

        $orders = $this->providerRepository->getProviderOrders($provider->id);
        $getOrders = $this->orderRepository->getOrders();

        $from = Carbon::now()->subDays(7);
        $to = Carbon::now();
        $period = CarbonPeriod::create($from, $to);
        $labels = [];
        foreach ($period as $date) {
            $labels[] = $date->format('d.m');
        }
 
        $data = compact(
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
            'orders',
            'getOrders',
            'products',
            'labels'
        );
        if (url()->current() == route('statistics', ['lang' => $lang])) {
            return view('profile.statistics', $data);
        } elseif (url()->current() == route('dashboard', ['lang' => $lang])) {
            return view('profile.dashboard', $data);
        }
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

    public function chartApi()
    {
        $id = Auth::user()->id;
        $provider = User::where('type', 'provider')->where('id', $id)->first();
        
        $orders = OrderProduct::with('orders')
                              ->where('id_provider', $provider->id)->get()->groupBy(function ($item) {
                                  return $item->orders->created_at->format('d.m');
                              });
            
        $totalQty = collect();
        foreach ($orders as $date => $orders) {
            $totalQty->push([
                'date'         => $date,
                'qty'          => $orders->sum('qty'),
                'sum'          => $orders->sum(function ($order) {
                    return $order->qty*$order->price;
                }),
                'ordersTotal'  => $orders->groupBy('id_order')->count()
            ]);
        }

        return response()->json($totalQty);
    }
}
