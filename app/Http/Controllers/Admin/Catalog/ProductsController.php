<?php

namespace App\Http\Controllers\Admin\Catalog;

use App\Models\Catalog\Char;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Catalog\Category;
use App\Models\Catalog\Chars;
use App\Models\Catalog\Product;

class ProductsController extends Controller
{
    private $method = 'catalog/products';

    private $folder = 'catalog.products';

    private $redirectRoute = 'admin_products';

    private $returnDataFields = ['name', 'description', 'seo_title', 'seo_description', 'seo_keywords'];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() 
    {
        $this->model  = new Product;
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
            'data'       => $this->model->orderByRaw('page_up asc, id desc')->get(),
            'categories' => Category::orderByPageUp()->get(),
            'providers'  => User::provider()->get(),
            'chars'      => Char::orderByPageUp()->where('parent_id', 0)->with('childs')->get(),
            'table'      => $this->model->getTable(),
            'method'     => $this->method
        ]; 

        return view('admin.'.$this->folder.'.list', $data);
    }  

    public function create(Request $request)
    {
        $transData = \Language::returnData($this->returnDataFields);

        $insertData = array_merge($transData, [
            'code'        => $request->code,
            'id_category' => $request->id_category
        ]);

        $id = $this->model->create($insertData)->id;

        $this->saveChars($id);

        return \App\Utils\JsonResponse::success(['redirect' => route($this->redirectRoute)], trans('admin.save')); 
    }

    private function saveChars($id)
    {

    }

    public function showeditForm($id)
    { 
        return view('admin.'.$this->folder.'.edit', [
            'method'        => $this->method,
            'table'         => $this->model->getTable(),
            'data'          => $this->model->findOrFail($id), 
        ]);
    }

    public function update($id, Request $request)
    {
        $data = $this->model->findOrFail($id);
        $data->fill(\Language::returnData($this->returnDataFields))->save();
        return \App\Utils\JsonResponse::success(['redirect' => route($this->redirectRoute)], trans('admin.save')); 
    }
}
