<?php

namespace App\Http\Controllers\Admin;

use App\Utils\UploadImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;

class BrandsController extends Controller
{
    private $method = 'brands';

    private $folder = 'brands';

    private $uploadFolder = 'brands';

    private $redirectRoute = 'admin_brands';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() 
    {
        $this->model  = new Brand;
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
        $insertData = [
            'name' => $request->name
        ];

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
        $insertData = [
            'name' => $request->name
        ];


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
