<?php

namespace App\Http\Controllers;

use App\Utils\ArraySess;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    public function add(Request $request)
    {
        $arraySess = ArraySess::init('compare');
        if ($arraySess->exist($request->idProduct)) {
            $arraySess->detach($request->idProduct);
        } else {
            $arraySess->attach($request->idProduct);
        }
        return \JsonResponse::success(['totalCompare' => $arraySess->count()]);
    }

    public function list()
    { 

    }
}
