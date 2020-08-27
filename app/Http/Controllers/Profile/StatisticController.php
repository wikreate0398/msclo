<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;

class StatisticController extends Controller
{
    public function index()
    {
        return view('profile.statistics');
    }
}
