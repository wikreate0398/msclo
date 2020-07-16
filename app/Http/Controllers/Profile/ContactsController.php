<?php

namespace App\Http\Controllers\Profile;
 
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;

use App\Models\User;

class ContactsController extends Controller
{ 
    public function index()
    {
        return view('profile.contacts', []);
    }

    public function save(Request $request){
        //exit(print_arr($request->all()));
        $user = User::whereId(\Auth::user()->id)->first();
        $user->fill($request->all())->save();
        return \JsonResponse::success(['messages' => 'Данные успешно изменены', 'reload' => true]);
    }
}
