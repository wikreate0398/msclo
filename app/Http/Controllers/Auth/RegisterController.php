<?php

namespace App\Http\Controllers\Auth;

use App\Utils\Exceptions\ValidationError;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ConfirmRegistration;

use App\Models\User;
use App\Models\UserType;
use App\Models\LocationUser;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['confirmation', 'finishRegistrationForm', 'finishRegistration']]);
    }

    public function register(Request $request)
    {
        try {
            if (!$request->type or !$request->name or !$request->email  or !$request->password or !$request->password_confirmation) {
                throw new \ValidationError('Заполните все поля');
            }

            if (!in_array($request->type, UserType::select('type')->get()->pluck('type')->toArray())) {
                throw new \ValidationError('Ошибка');
            }

            $this->checkPass($request->password, $request->password_confirmation);


            if (User::where('email', $request->email)->count()) {
                throw new \ValidationError('Пользователь с таким e-mail адоресом уже существует');
            }

            $confirm_hash = md5(microtime());

            $user = User::create([
                'name'             => $request->name,
                'type'             => $request->type,
                'email'            => $request->email,
                'confirm_hash'     => $confirm_hash,
                'password'         => bcrypt($request->password),
                'lang'             => lang(),
                // 'accept_terms'     => $request->accept_terms
            ]);

            $user->notify(new ConfirmRegistration($confirm_hash, lang()));

            return \JsonResponse::success([
                'messages' => 'Мы отправили на Вашу почту письмо с подтверждением регистрации.'
            ]);
        } catch (\ValidationError $e) {
            return \JsonResponse::error(['messages' => $e->getMessage()]);
        }
    }

    private function checkPass($password, $password_confirmation)
    {
        if ($password != $password_confirmation) {
            throw new \ValidationError('Пароль не совпадает');
        }

        if (strlen($password) < 8) {
            throw new \ValidationError('Пароль должен состоять из 8 или более символов');
        }
    }

    public function confirmation($lang, $confirmation_hash)
    {
        $user = User::where('confirm_hash', $confirmation_hash)->firstOrFail();

        if (empty($user->active)) {
            User::where('id', $user->id)
                ->update(['active' => 1, 'confirm' => 1, 'confirm_hash' => '']);

            if (Auth::check()) {
                Auth::guard('web')->logout();
            }
            Auth::guard('web')->login($user);

            session()->put('flash_message', 'Вы успешно активировали свой профиль');
        }
        return redirect()->route('home');
    }
}
