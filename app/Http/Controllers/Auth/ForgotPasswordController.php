<?php

namespace App\Http\Controllers\Auth;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Notifications\ResetPassword;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function sendResetPassword(Request $request)
    { 
        if (empty($request->email)) {
            return \JsonResponse::error(['messages' => 'Введите e-mail']);
        }

        $user = User::whereEmail($request->email)->first();
        if (empty($user))
        {
            return \JsonResponse::error(['messages' => 'Мы не можем найти пользователя с таким адресом']);
        }

        $newPassword    = random_str(8);
        $user->password = bcrypt($newPassword);
        $user->save();

        $user->notify(new ResetPassword($newPassword));

        return \JsonResponse::success(['messages' => 'Новый пароль отправлен на почту']);
    }
}
