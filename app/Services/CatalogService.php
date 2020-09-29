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

    public function create($id_provider)
    {
        \DB::beginTransaction();

        try {
            if (!$this->request->id_category or !$id_provider) {
                throw new \ValidationError('Заполните обязательные поля');
            }

            $transData  = \Language::returnData($this->returnDataFields);

            $insertData = array_merge($transData, [
                'code'        => $this->request->code,
                'id_category' => $this->request->id_category,
                'id_provider' => $id_provider,
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

    public function update($id, $id_provider)
    {
        \DB::beginTransaction();

        try {
            if (!$this->request->id_category or !$id_provider) {
                throw new \ValidationError('Заполните обязательные поля');
            }

            $data = Product::findOrFail($id);

            $insertData = array_merge(\Language::returnData($this->returnDataFields), [
                'code'        => $this->request->code,
                'id_category' => $this->request->id_category,
                'id_provider' => $id_provider,
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
                                       ->setSize(525000)
                                       ->sort($imageSort)
                                       ->multipleUpload('files', 'products');

            //exit(print_arr($images));

            foreach ($images as $key => $image) {
                ProductImage::create([
                    'id_product' => $id,
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
        ProductPrice::where('id_product', $id)->delete();
        if (empty($prices)) {
            return;
        }
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
                foreach ($chars as $id_char => $value) {
                    $insert[] = [
                        'id_char'    => $id_char,
                        'value'      => $value,
                        'id_product' => $id_product
                    ];
                }
            } else {
                foreach ($chars as $id_char => $values) {
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
}
