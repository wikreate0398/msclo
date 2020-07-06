<?php

namespace App\Http\Controllers\Admin\Catalog;

use App\Models\Catalog\Char;
use App\Models\Catalog\CharProduct;
use App\Models\Catalog\ProductImage;
use App\Models\Catalog\ProductPrice;
use App\Models\User;
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
            'data'       => $this->model->filter()->orderByRaw('page_up asc, id desc')->get(),
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
        \DB::beginTransaction();

        try {
            if (!$request->id_category or !$request->id_provider or !$request->url) {
                throw new \ValidationError('Заполните обязательные поля');
            }

            $transData  = \Language::returnData($this->returnDataFields);
            $insertData = array_merge($transData, [
                'code'        => $request->code,
                'id_category' => $request->id_category,
                'id_provider' => $request->id_provider,
                'url'         => toUrl($request->url ?: $request->name_ru)
            ]);

            $id = $this->model->create($insertData)->id;

            $this->saveChars($id, $request->char);
            $this->savePrices($id, $request->prices);
            $this->saveImages($id);
            \DB::commit();

            return \JsonResponse::success(['redirect' => route($this->redirectRoute)], trans('admin.save'));
        } catch (\ValidationError $e) {
            \DB::rollback();
            return \JsonResponse::error(['messages' => $e->getMessage()]);
        }
    }

    private function saveImages($id)
    {
        if (request()->files->count()) {
            $uploadImage = new UploadImage;
            $images      = $uploadImage->setExtensions('jpeg,jpg,png')
                                       ->setSize(12000)
                                       ->multipleUpload('files', 'products');

            foreach ($images as $key => $image) {
                ProductImage::create([
                    'id_product' => $id,
                    'image'      => $image
                ]);
            }
        }
    }

    private function savePrices($id, $prices = [], $insert = [])
    {
        ProductPrice::where('id_product', $id)->delete();
        if (empty($prices)) return;
        foreach (sortValue($prices) as $type => $item) {
            $insert[] = [
                'id_product' => $id,
                'price'      => toFloat($item['price']),
                'quantity'   => toFloat($item['quantity'])
            ];
        }

        if (!empty($insert)) {
            ProductPrice::insert($insert);
        }
    }

    private function saveChars($id_product, $chars = [], $insert = [])
    {
        CharProduct::where('id_product', $id_product)->delete();
        foreach ($chars as $type => $chars) {
            if ($type == 'input') {
                foreach ( $chars as $id_char => $value) {
                    $insert[] = [
                        'id_char'    => $id_char,
                        'value'      => $value,
                        'id_product' => $id_product
                    ];
                }
            } else {
                foreach ( $chars as $id_char => $values) {
                    foreach ($values as $key => $id_value) {
                        $insert[] = [
                            'id_char'    => $id_char,
                            'value'      => $id_value,
                            'id_product' => $id_product
                        ];
                    }
                }
            }
        }

        if (!empty($insert)) {
            CharProduct::insert($insert);
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
        \DB::beginTransaction();

        try {
            if (!$request->id_category or !$request->id_provider or !$request->url) {
                throw new \ValidationError('Заполните обязательные поля');
            }

            $data = $this->model->findOrFail($id);

            $insertData = array_merge(\Language::returnData($this->returnDataFields), [
                'code'        => $request->code,
                'id_category' => $request->id_category,
                'id_provider' => $request->id_provider,
                'url'         => toUrl($request->url ?: $request->name_ru)
            ]);

            $data->fill($insertData)->save();

            $this->saveChars($id, $request->char);
            $this->savePrices($id, $request->prices);
            $this->saveImages($id);
            \DB::commit();

            return \JsonResponse::success(['redirect' => route($this->redirectRoute)], trans('admin.save'));
        } catch (\ValidationError $e) {
            \DB::rollback();
            return \JsonResponse::error(['messages' => $e->getMessage()]);
        }
    }
}
