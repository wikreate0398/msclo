<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Mail\ChatCallback;
use App\Repository\Interfaces\OrderRepositoryInterface;
use App\Utils\Constants;
use App\Utils\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    private $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index($lang)
    {
        $dashboardData = $this->orderRepository->dashboardData();

        return view('profile.dashboard', compact('dashboardData'));
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
    
    public function getChartDays($value = 7)
    {
        return $this->orderRepository->getChartDays($value);
    }
}
