<?php

namespace App\Http\Controllers\Profile;
 
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;
use App\Notifications\UploadVerificationFile;
use App\Notifications\ChangeInvitationStatus; 

use App\Utils\UploadImage;
use App\Utils\QrCodeGenerator;

use App\Models\User;
use App\Models\IdentificationFiles;
use App\Models\AdminUser;
use App\Models\ProfileMenu;
use App\Models\LocationUser;
use App\Models\QrCode;

class AccountController extends Controller
{ 
    public function index()
    {
        return view('profile.account', []);
    }

    public function edit(Request $request){
    	if(!$request->name or !$request->email) {
            return \JsonResponse::error(['messages' => 'Заполните все поля']);
        }

        if(User::whereEmail($request->email)->where('id', '<>', \Auth::user()->id)->count()) {
            return \JsonResponse::error(['messages' =>  'Пользователь с таким адресом почты уже существует']);
        }

        User::whereId(\Auth::user()->id)->update([
        	'name'  => $request->name,
        	'phone' => $request->phone,
        	'email' => $request->email
        ]);

        return \JsonResponse::success(['messages' => 'Данные успешно изменены', 'reload' => true]);
    }

    public function changePassword(Request $request)
    {
        if(!$request->old_password or !$request->new_password or !$request->repeat_password) {
            return \JsonResponse::error(['messages' => 'Заполните все поля']);
        }

        if (!\Hash::check($request->old_password, \Auth::user()->password)) {
        	return \JsonResponse::error(['messages' => 'Старый пароль не верный']);
        }

        if($request->new_password != $request->repeat_password) {
            return \JsonResponse::error(['messages' => 'Пароли не совпадают']);
        }

        if(strlen($request->new_password) < 8) {
            return \JsonResponse::error(['messages' => 'Пароль должен состоять из 8 или более символов']);
        }

        User::whereId(\Auth::user()->id)->update([
            'password' => bcrypt($request->new_password),
        ]);

        return \JsonResponse::success(['messages' => 'Пароль успешно изменен', 'reload' => true]);
    }

    public function saveAvatar(Request $request) {
        if (empty($request->avatar)) 
        {
            return \JsonResponse::error(['messages' => 'Изображение не выбрано']);
        }

        $filename = 'user-' . \Auth::user()->id . '-' . md5(microtime()) . '.png';
        $avatarImagePath = public_path() . '/uploads/users/' . $filename;
        uploadBase64($request->avatar, $avatarImagePath); 
        
        User::where('id', \Auth::user()->id)->
          update([ 
            'image'  => $filename 
        ]); 

        return \JsonResponse::success();
    }

    public function uploadVerificationFile($lang, Request $request) {
        try {
            $uploadImage = new UploadImage;
            $files       = $uploadImage->setExtensions('jpeg,jpg,png')
                                       ->setSize(10000)
                                       ->multipleUpload('files', 'clients');

            if (in_array(\Auth::user()->verification_status, ['confirm', 'pending'])) 
            {
                throw new \Exception("Ошибка"); 
            }

            foreach ($files as $key => $file) 
            {
                IdentificationFiles::create([
                    'id_user' => \Auth::id(),
                    'file'    => $file
                ]);
            }

            User::where('id', \Auth::id())->
              update([  
                'verification_status' => 'pending'
            ]); 
     
            AdminUser::where('active', 1)->each(function($user){
                $user->notify(new UploadVerificationFile(User::whereId(\Auth::user()->id)->first()));
            });

            return \JsonResponse::success(['reload' => true, 'messages' => 'Выши документ успешно сохранился. В скором времени наш менеджер приступит к его обработки']);
        } catch (\Exception $e) { 
            return \JsonResponse::error(['messages' => $e->getMessage()]);
        }  
    }
}
