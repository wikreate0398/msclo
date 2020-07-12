<?php

namespace App\Http\Controllers\Admin\Catalog;

use App\Models\Catalog\Product;
use App\Models\Catalog\ProductTag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Catalog\Tag;

class TagsController extends Controller
{
    private $method = 'catalog/tags';

    private $folder = 'tags';

    private $redirectRoute = 'admin_tags';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() 
    {
        $this->model  = new Tag;
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
            'method'   => $this->method,
            'products' => Product::orderByPageUp()->get(),
        ];

        return view('admin.'.$this->folder.'.list', $data);
    }  

    public function create(Request $request)
    {
        $id = $this->model->create(\Language::returnData(['name']))->id;
        $this->saveProducts($id, $request->products);
        return \JsonResponse::success(['redirect' => route($this->redirectRoute)], trans('admin.save'));
    }

    public function showeditForm($id)
    { 
        return view('admin.'.$this->folder.'.edit', [
            'method'   => $this->method,
            'table'    => $this->model->getTable(),
            'data'     => $this->model->with('products')->findOrFail($id),
            'products' => Product::orderByPageUp()->get()
        ]);
    }

    public function update($id, Request $request)
    {
        $data = $this->model->findOrFail($id);
        $data->fill(\Language::returnData(['name']))->save();
        $this->saveProducts($id, $request->products);
        return \JsonResponse::success(['redirect' => route($this->redirectRoute)], trans('admin.save'));
    }

    private function saveProducts($id, $products)
    {
        ProductTag::where('id_tag', $id)->delete();
        if (!empty($products)) {
            foreach ($products as $key => $id_product) {
                ProductTag::insert([
                    'id_tag'     => $id,
                    'id_product' => $id_product
                ]);
            }
        }
    }
}
