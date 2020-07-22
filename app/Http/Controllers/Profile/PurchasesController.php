<?php

namespace App\Http\Controllers\Profile;
 
use App\Models\Order\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;

class PurchasesController extends Controller
{ 
    public function index()
    {
        $orders = Order::getPurchase();
        return view('profile.purchase', compact('orders'));
    }
}
