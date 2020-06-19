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

            if ($validator->fails())
            {
                return \JsonResponse::error(['messages' => \Constant::get('REQ_FIELDS')]);
            }

            if (Auth::guard('web')->attempt(['email' => $request->input('email'),
                    'password' => $request->input('password'),
                    'active'   => 1,
                    'confirm'  => 1], false) == true)
            {
                User::whereId(\Auth::id())->update([
                    'last_entry' => date('Y-m-d H:i:s'), 
                    'user_agent' => request()->server('HTTP_USER_AGENT')
                ]);

                $route = (\Auth::user()->type == 'agent') ? 'my_referrals' : 'workspace';
                return \JsonResponse::success(['redirect' => route($route, ['lang' => lang()])], false);
            }
            else
            {
                return \JsonResponse::error(['messages' => \Constant::get('AUTH_ERR')]);
            }
        } catch (validationException $e) {
            return \JsonResponse::error(['messages' => \Constant::get('AUTH_ERR')]);
        }
    }

    public function showLogin()
    {
        return view('auth/login');
    }
}
