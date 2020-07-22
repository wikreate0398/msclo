<?php

namespace App\Utils\Facades\Catalog;

use App\Models\Catalog\CharProduct;
use App\Models\Catalog\Product;
use App\Models\Catalog\ProductImage;
use App\Models\Catalog\ProductPrice;
use App\Utils\UploadImage;

class CatalogCrud
{
    private $request;

    private $id_provider;

    private $returnDataFields = ['name', 'description', 'text', 'seo_title', 'seo_description', 'seo_keywords'];

    public function __construct($id_provider, $request)
    {
        $this->request     = $request;
        $this->id_provider = $id_provider;
    }

    public function response($status = true, $error = '')
    {
        return (object) [
            'status' => $status,
            'error'  => $error
        ];
    }

    public function create()
    {
        \DB::beginTransaction();

        try {
            if (!$this->request->id_category or !$this->id_provider or !$this->request->url) {
                throw new \ValidationError('Заполните обязательные поля');
            }

            $transData  = \Language::returnData($this->returnDataFields);

            $insertData = array_merge($transData, [
                'code'        => $this->request->code,
                'id_category' => $this->request->id_category,
                'id_provider' => $this->id_provider,
                'url'         => toUrl($this->request->url ?: $this->request->name_ru)
            ]);

            $id = Product::create($insertData)->id;

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
    
    public function update($id)
    {
        \DB::beginTransaction();

        try {
            if (!$this->request->id_category or !$this->id_provider or !$this->request->url) {
                throw new \ValidationError('Заполните обязательные поля');
            }

            $data = Product::findOrFail($id);

            $insertData = array_merge(\Language::returnData($this->returnDataFields), [
                'code'        => $this->request->code,
                'id_category' => $this->request->id_category,
                'id_provider' => $this->id_provider,
                'url'         => toUrl($this->request->url ?: $this->request->name_ru)
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
                    exit(print_arr($values));
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