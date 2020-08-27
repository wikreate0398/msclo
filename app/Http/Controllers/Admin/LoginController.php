<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\AdminUser;
use Illuminate\Validation\ValidationException;

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
    protected $redirectTo = '/cp/';

    protected $guard = 'admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('layouts.admin_login');
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                $this->username() => 'required|string',
                'password' => 'required|string',
            ]);

            if ($validator->fails()) {
                return \App\Utils\JsonResponse::error(['messages' => trans('admin.req_fields')]);
            }

            $remember = $request->has('remember') ? true : false;

            if (Auth::guard($this->guard)->attempt([
                'email'    => $request->input('email'),
                'password' => $request->input('password'),
                'active'   => '1'], $remember) == true) {
                $user = AdminUser::whereEmail($request->email)->first();
                $redirect = ($user->type == 'manager') ? 'admin_clients' : 'admin_menu';
                return \App\Utils\JsonResponse::success(['redirect' => route($redirect)], trans('admin.welcome'));
            } else {
                return self::errorLogin();
            }
        } catch (ValidationException $e) {
            return self::errorLogin();
        }
    }

    public function logout(Request $request)
    {
        Auth::guard($this->guard)->logout();
        return  redirect()->route('admin_login');
    }

    private static function errorLogin()
    {
        return \App\Utils\JsonResponse::error(['messages' => trans('admin.error_login')]);
    }
}
