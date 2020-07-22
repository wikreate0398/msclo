<?php

namespace App\Http\Controllers\Admin\Catalog;

use App\Models\Catalog\Char;
use App\Models\Catalog\CharProduct;
use App\Models\Catalog\ProductImage;
use App\Models\Catalog\ProductPrice;
use App\Models\User;
use App\Utils\Facades\Catalog\CatalogCrud;
use App\Utils\UploadImage;
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

    private $returnDataFields = ['name', 'description', 'text', 'seo_title', 'seo_description', 'seo_keywords'];

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
            'data'       => $this->model->select('catalog.*')->filter()->orderByRaw('page_up asc, id desc')->get(),
            'categories' => Category::orderByPageUp()->get(),
            'providers'  => User::provider()->get(),
            'chars'      => Char::orderByPageUp()->where('parent_id', 0)->with('childs')->get(),
            'table'      => $this->model->getTable(),
            'method'     => $this->method,
            'filters'    => Char::filters()->get()
        ];

        return view('admin.'.$this->folder.'.list', $data);
    }  

    public function create(Request $request)
    {
        $response = (new CatalogCrud($request->id_provider, $request))->create();
        if ($response->status) {
            return \JsonResponse::success(['redirect' => route($this->redirectRoute)], trans('admin.save'));
        } else {
            return \JsonResponse::error(['messages' => $response->error]);
        }
    }

    public function showeditForm($id)
    { 
        return view('admin.'.$this->folder.'.edit', [
            'method'     => $this->method,
            'table'      => $this->model->getTable(),
            'data'       => $this->model->with(['chars', 'prices', 'images'])->findOrFail($id),
            'categories' => Category::orderByPageUp()->get(),
            'providers'  => User::provider()->get(),
            'chars'      => Char::orderByPageUp()->where('parent_id', 0)->with('childs')->get(),
        ]);
    }

    public function update($id, Request $request)
    {
        $response = (new CatalogCrud($request->id_provider, $request))->update($id);
        if ($response->status) {
            return \JsonResponse::success(['redirect' => route($this->redirectRoute)], trans('admin.save'));
        } else {
            return \JsonResponse::error(['messages' => $response->error]);
        }
    }
}
