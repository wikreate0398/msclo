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
            $this->validate($id_provider);

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

    private function validate($id_provider)
    {
        if (empty($this->request->name['ru'])) {
            throw new \ValidationError('Укажите название');
        }

        if (!$this->request->id_category or !$id_provider) {
            throw new \ValidationError('Укажите категорию');
        }

        if (is_array($this->request->id_category)) {
            foreach ($this->request->id_category as $key => $value) {
                if (empty($value)) {
                    throw new \ValidationError('Укажите категорию');
                }
            }
            $id_category = $this->request->id_category[count($this->request->id_category)-1];
            $this->request->id_category = $id_category;
        }

        if (!$this->request->code) {
            throw new \ValidationError('Укажите артикул');
        }
     }

    public function update($id, $id_provider)
    {
        \DB::beginTransaction();

        try {
            $this->validate($id_provider);

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
            $images = UploadImage::init('files', 'products')
                                 ->setSize(50)
                                 ->sort($imageSort)
                                 ->multipleUpload();

            foreach ($images as $key => $image) {
                ProductImage::create([
                    'id_product' => $id,
                    'image'      => isset($image['name']) ? $image['name'] : $image,
                    'page_up'    => @$image['page_up'] ?: 1
                ]);
            }
        } elseif (!ProductImage::where('id_product', $id)->count()) {
            throw new \ValidationError('Добавьте изображение');
        }

        if (!empty($imageSort)) {
            $i = $imageSort->count();
            foreach ($imageSort as $item) {
                ProductImage::where('image', $item['name'])->update([
                    'page_up' => $i
                ]);
                $i--;
            }
        }
    }

    private function savePrices($id, $prices = [], $insert = [])
    {
        ProductPrice::where('id_product', $id)->delete();

        $sortValue = array_filter(sortValue($prices), function ($v) {
            return ($v['price'] && $v['quantity']) ? true : false;
        });

        if (empty($prices) || empty($sortValue)) {
            throw new \ValidationError('Укажите цену и кол-во');
        }

        foreach ($sortValue as $type => $item) {
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
