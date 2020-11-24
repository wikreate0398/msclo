<?php

namespace App\Http\Controllers\Admin\Catalog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Catalog\Category;
use App\Utils\UploadImage;

class CategoriesController extends Controller
{
    private $method = 'catalog/categories';

    private $folder = 'catalog.categories';

    private $uploadFolder = 'categories';

    private $redirectRoute = 'admin_categories';

    private $returnDataFields = ['name'];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() 
    {
        $this->model  = new Category;
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
            'data'   => $this->model->orderByRaw('page_up asc, id desc')->get(),
            'table'  => $this->model->getTable(),
            'method' => $this->method
        ]; 

        return view('admin.'.$this->folder.'.list', $data);
    }  

    public function create(Request $request)
    {
        $create      = $this->model->create(\Language::returnData($this->returnDataFields));
        $create->url = toUrl($request->name['ru']) . '-' . $create->id;
        $create->save();

        return \App\Utils\JsonResponse::success(['redirect' => route($this->redirectRoute)], trans('admin.save')); 
    }

    public function showeditForm($id)
    { 
        return view('admin.'.$this->folder.'.edit', [
            'method'        => $this->method,
            'table'         => $this->model->getTable(),
            'data'          => $this->model->findOrFail($id),
            'folder'        => $this->uploadFolder,
        ]);
    }

    public function update($id, Request $request)
    {
        $data = $this->model->findOrFail($id);

        $insertData = array_merge(\Language::returnData($this->returnDataFields), [
            'url' => $data->url ?: toUrl($request->name['ru']) . '-' . $data->id
        ]);

        $data->fill($insertData)->save();

        try {
            UploadImage::init('image', $this->folder)
                        ->upload()
                        ->update($this->model, $id, 'image');
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return \App\Utils\JsonResponse::success(['redirect' => route($this->redirectRoute)], trans('admin.save')); 
    }
}
