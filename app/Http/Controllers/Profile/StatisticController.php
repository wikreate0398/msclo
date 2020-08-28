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
        $orders = $this->providerRepository->getProviderOrders($id)->count();
        // $user = $this->providerRepository->getProvider($id);
        
        $user = User::where('type', 'provider')->where('id', $id)->first();
        return view('profile.statistics', compact('user', 'orders'));
    }
}
