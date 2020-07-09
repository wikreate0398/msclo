<?php

namespace App\Http\Controllers\Admin;

use App\Utils\UploadImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Advantage;

class AdvantagesController extends Controller
{
    private $method = 'advantages';

    private $folder = 'advantages';

    private $uploadFolder = 'advantages';

    private $redirectRoute = 'admin_advantages';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() 
    {
        $this->model  = new Advantage;
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
            'data'     => $this->model->orderByRaw('page_up asc, id desc')->get(),
            'table'    => $this->model->getTable(),
            'method'   => $this->method
        ];

        return view('admin.'.$this->folder.'.list', $data);
    }  

    public function create(Request $request)
    {
        $insertData = array_merge(\Language::returnData(['name', 'description']), [
            'link'        => $request->link
        ]);

        try {
            $uploadImage = new UploadImage;
            $insertData['image'] = $uploadImage->upload('image', $this->uploadFolder);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        $this->model->create($insertData);
        return \JsonResponse::success(['redirect' => route($this->redirectRoute)], trans('admin.save'));
    }

    public function showeditForm($id)
    { 
        return view('admin.'.$this->folder.'.edit', [
            'method'   => $this->method,
            'table'    => $this->model->getTable(),
            'data'     => $this->model->findOrFail($id),
            'folder'   => $this->uploadFolder
        ]);
    }

    public function update($id, Request $request)
    {
        $data       = $this->model->findOrFail($id);
        $insertData = array_merge(\Language::returnData(['name', 'description']), [
            'link'        => $request->link
        ]);

        try {
            $uploadImage = new UploadImage;
            $insertData['image'] = $uploadImage->upload('image', $this->uploadFolder);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        $data->fill($insertData)->save();
        return \JsonResponse::success(['redirect' => route($this->redirectRoute)], trans('admin.save'));
    }

}
