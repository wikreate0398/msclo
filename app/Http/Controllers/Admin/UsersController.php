<?php

namespace App\Http\Controllers\Admin;

use App\Notifications\SendBill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Utils\Payments\PaymentCenterService\VisaPayment;
use App\Utils\UploadImage;  
use App\Utils\Encryption;
use App\Utils\Order;
use App\Notifications\SendLetter;
use App\Notifications\ChangeVerificationStatus;
use App\Models\User;
use App\Models\UserType;
use App\Models\EnrollmentPercents;
use App\Models\QrCode;

class UsersController extends Controller
{
    private $method = 'users';

    private $folder = 'users';

    private $uploadFolder = 'users';

    private $redirectRoute = 'admin_users';

    private $requiredFields = ['name', 'email'];

    private $input;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() 
    {
        $this->model  = new User;
        $this->method = config('admin.path') . '/' . $this->method;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {  
        $data = [
            'data'      => $this->model->orderByRaw('id desc')->with('typeData')->filter()->get()->sortBy('typeData.page_up'),
            'table'     => $this->model->getTable(),
            'method'    => $this->method,
            'today_reg' => $this->model->registered('today')->count(),
            'week_reg'  => $this->model->registered('week')->count(),
            'total_reg' => $this->model->registered()->count(),
            'userTypes' => UserType::all()
        ]; 

        return view('admin.'.$this->folder.'.list', $data);
    } 

    public function showAddForm()
    {  
        return view('admin.'.$this->folder.'.add', [
            'method'        => $this->method
        ]);
    }

    public function create(Request $request)
    {
        $this->input = $this->prepareData(false, $request->all());

        if(!is_array($this->input))
        {
            return \JsonResponse::error(['messages' => $this->input]);
        }

        if (User::whereEmail($request->email)->count()) 
        {
            return \JsonResponse::error(['messages' => 'Пользователь с таким имейлом уже существует']);
        }

        $this->input['active']  = 1;
        $this->input['confirm'] = 1;
        $this->input['type']    = $request->type;

        $this->model->create($this->input)->id; 

        return \JsonResponse::success(['redirect' => route($this->redirectRoute)], trans('admin.save'));
    }

    public function showeditForm($id)
    {
        $user = $this->model->findOrFail($id);

        return view('admin.'.$this->folder.'.edit', [
            'method'            => $this->method,
            'table'             => $this->model->getTable(),
            'data'              => $user,
        ]);
    }

    public function autologin($id)
    {
        $client = User::findOrFail($id);
        \Auth::guard('web')->login($client);

        $route = ($client->type == 'agent') ? 'my_referrals' : 'workspace';

        return redirect()->route($route, ['lang' => 'ru']);
    }

    public function update($id, Request $request)
    {
        $data        = $this->model->findOrFail($id);
        $this->input = $this->prepareData($data, $request->all());
 
        if(!is_array($this->input))
        {
            return \JsonResponse::error(['messages' => $this->input]);
        }

        $data->fill($this->input)->save();
        return \JsonResponse::success(['redirect' => route($this->redirectRoute)], trans('admin.save'));
    }

    public function sendLetter($id, Request $request)
    { 
        $user = $this->model->findOrFail($id);
        $user->notify(new SendLetter($request->theme, $request->message));
        return \App\Utils\JsonResponse::success(['reload' => true], 'Сообщение успешно отправлено'); 
    }

    private function validation($input)
    {
        foreach($this->requiredFields as $key => $field)
        {
            if(empty($input[$field])) return false;
        }
        return true;
    }

    private function prepareData($data = false, $input)
    {
        if($this->validation($input) != true)
        {
            return trans('admin.req_fields');
        } 

        if(!empty($input['password']) or !empty($input['repeat_password']))
        {
            if($input['password'] != $input['repeat_password'])
            {
                return 'Пароль не совпадает';
            }

            $input['password'] = bcrypt($input['password']);
        }

        $uploadImage = new UploadImage;
        $image       = $uploadImage->upload('image', $this->uploadFolder);

        if (!empty($image)) {
            $input['image'] = $image;
        } 

        return $input;
    }
}
