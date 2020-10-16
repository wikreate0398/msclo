<?php

namespace App\Http\Controllers\Admin;

use App\Utils\UploadImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;

class BannersController extends Controller
{
    private $method = 'banners';

    private $folder = 'banners';

    private $uploadFolder = 'banners';

    private $redirectRoute = 'admin_banners';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() 
    {
        $this->model  = new Banner;
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
        $insertData = array_merge(\Language::returnData(['name']), [
            'link'        => $request->link
        ]);

        try {
            $insertData['image'] = UploadImage::init('image', $this->uploadFolder)
                ->upload()
                ->getUploadedFileName();
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
        $insertData = array_merge(\Language::returnData(['name']), [
            'link'        => $request->link
        ]);
        $data->fill($insertData)->save();

        try {
            UploadImage::init('image', $this->uploadFolder)
                ->upload()
                ->update($this->model, $id, 'image');
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return \JsonResponse::success(['redirect' => route($this->redirectRoute)], trans('admin.save'));
    }

}
