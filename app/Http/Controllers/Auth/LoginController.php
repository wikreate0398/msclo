<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:web')->except('logout');
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                $this->username() => 'required|string',
                'password' => 'required|string',
            ]);

            if ($validator->fails()) {
                return \JsonResponse::error(['messages' => 'Заполните все поля']);
            }

            if (Auth::guard('web')->attempt(['email' => $request->input('email'),
                    'password' => $request->input('password'),
                    'active'   => 1,
                    'confirm'  => 1], false) == true) {

                User::whereId(\Auth::id())->update([
                    'last_entry' => date('Y-m-d H:i:s'), 
                    'user_agent' => request()->server('HTTP_USER_AGENT')
                ]);

                $route = $request->from_cart ? route('view_cart', ['lang' => lang()]) : route('home');

                return \JsonResponse::success(['redirect' => $route], false);
            }
            else {
                return \JsonResponse::error(['messages' => 'Ошибка авторизации']);
            }
        } catch (validationException $e) {
            return \JsonResponse::error(['messages' => 'Ошибка авторизации']);
        }
    }
}
