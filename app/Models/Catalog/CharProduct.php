<?php

namespace App\Models\Catalog;

use App\Models\Catalog\Char;
use App\Models\Catalog\Product;
use Illuminate\Database\Eloquent\Model;

class CharProduct extends Model
{
    public $timestamps = false;

    protected $table = 'chars_products';

    protected $fillable = [
        'char_id',
        'product_id',
        'value'
    ];

    public function char()
    {
        return $this->hasOne(Char::class, 'id', 'char_id');
    }

    public function optionValue()
    {
        return $this->hasOne(Char::class, 'id', 'value');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
