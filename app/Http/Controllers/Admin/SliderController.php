<?php

namespace App\Http\Controllers\Admin;

use App\Models\Catalog\Product;
use App\Utils\UploadImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;

class SliderController extends Controller
{
    private $method = 'slider';

    private $folder = 'slider';

    private $uploadFolder = 'slider';

    private $redirectRoute = 'admin_slider';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() 
    {
        $this->model  = new Slider;
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
            'products' => Product::orderByPageUp()->get(),
            'method'   => $this->method
        ];

        return view('admin.'.$this->folder.'.list', $data);
    }  

    public function create(Request $request)
    {
        $insertData = $request->all();
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
            'folder'   => $this->uploadFolder,
            'products' => Product::orderByPageUp()->get(),
        ]);
    }

    public function update($id, Request $request)
    {
        $data       = $this->model->findOrFail($id);
        $insertData = $request->all();
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
