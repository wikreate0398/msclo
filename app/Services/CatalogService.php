<?php

namespace App\Services;

use App\Models\Catalog\CharProduct;
use App\Models\Catalog\Product;
use App\Models\Catalog\ProductImage;
use App\Models\Catalog\ProductPrice;
use App\Utils\UploadImage;
use Illuminate\Http\Request;

class CatalogService
{
    private $request;

    private $returnDataFields = ['name', 'description', 'text', 'seo_title', 'seo_description', 'seo_keywords'];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function response($status = true, $error = '')
    {
        return (object) [
            'status' => $status,
            'error'  => $error
        ];
    }

    public function create($provider_id)
    {
        \DB::beginTransaction();

        try {
            if (!$this->request->category_id or !$provider_id) {
                throw new \ValidationError('Заполните обязательные поля');
            }

            $transData  = \Language::returnData($this->returnDataFields);

            $insertData = array_merge($transData, [
                'code'        => $this->request->code,
                'category_id' => $this->request->category_id,
                'provider_id' => $provider_id,
            ]);

            $create      = Product::create($insertData);
            $create->url = toUrl($this->request->name['ru']) . '-' . $create->id;
            $create->save();

            $this->saveChars($create->id, $this->request->char);
            $this->savePrices($create->id, $this->request->prices);
            $this->saveImages($create->id);
            \DB::commit();

            return $this->response(true);
        } catch (\ValidationError $e) {
            \DB::rollback();
            return $this->response(false, $e->getMessage());
        }
    }

    public function update($id, $provider_id)
    {
        \DB::beginTransaction();

        try {
            if (!$this->request->category_id or !$provider_id) {
                throw new \ValidationError('Заполните обязательные поля');
            }

            $data = Product::findOrFail($id);

            $insertData = array_merge(\Language::returnData($this->returnDataFields), [
                'code'        => $this->request->code,
                'category_id' => $this->request->category_id,
                'provider_id' => $provider_id,
                'url'         => $data->url ?: toUrl($this->request->name['ru']) . '-' . $id
            ]);

            $data->fill($insertData)->save();

            $this->saveChars($id, $this->request->char);
            $this->savePrices($id, $this->request->prices);
            $this->saveImages($id);
            \DB::commit();

            return $this->response(true);
        } catch (\ValidationError $e) {
            \DB::rollback();
            return $this->response(false, $e->getMessage());
        }
    }

    private function saveImages($id)
    {
        $imageSort   = $this->request->image_sort ? collect(json_decode($this->request->image_sort, true)) : false;
        if (request()->files->count()) {
            $uploadImage = new UploadImage;

            $images      = $uploadImage->setExtensions('jpeg,jpg,png')
                                       ->setSize(12000)
                                       ->sort($imageSort)
                                       ->multipleUpload('files', 'products');

            //exit(print_arr($images));

            foreach ($images as $key => $image) {
                ProductImage::create([
                    'product_id' => $id,
                    'image'      => $image['name'],
                    'page_up'    => @$image['page_up'] ?: 1
                ]);
            }
        }

        if (!empty($imageSort)) {
            foreach ($imageSort as $item) {
                ProductImage::where('image', $item['name'])->update([
                    'page_up' => $item['index']
                ]);
            }
        }
    }

    private function savePrices($id, $prices = [], $insert = [])
    {
        ProductPrice::where('product_id', $id)->delete();
        if (empty($prices)) {
            return;
        }
        foreach (sortValue($prices) as $type => $item) {
            $insert[] = [
                'product_id' => $id,
                'price'      => toFloat($item['price']),
                'quantity'   => toFloat($item['quantity'])
            ];
        }

        if (!empty($insert)) {
            ProductPrice::insert($insert);
        }
    }

    private function saveChars($product_id, $chars = [], $insert = [])
    {
        CharProduct::where('product_id', $product_id)->delete();
        foreach ($chars as $type => $chars) {
            if ($type == 'input') {
                foreach ($chars as $char_id => $value) {
                    $insert[] = [
                        'char_id'    => $char_id,
                        'value'      => $value,
                        'product_id' => $product_id
                    ];
                }
            } else {
                foreach ($chars as $char_id => $values) {
                    foreach ($values as $key => $value_id) {
                        $insert[] = [
                            'char_id'    => $char_id,
                            'value'      => $value_id,
                            'product_id' => $product_id
                        ];
                    }
                }
            }
        }

        if (!empty($insert)) {
            CharProduct::insert($insert);
        }
    }
}
