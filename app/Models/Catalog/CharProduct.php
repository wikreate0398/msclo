<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class CharProduct extends Model
{
    public $timestamps = false;

    protected $table = 'chars_catalog';

    protected $fillable = [
        'id_product',
        'id_char',
        'value'
    ];

    public function char()
    {
        return $this->hasOne('App\Models\Catalog\Char', 'id', 'id_char');
    }

    public function optionValue()
    {
        return $this->hasOne('App\Models\Catalog\Char', 'id', 'value');
    }

    public function product()
    {
        return $this->hasOne('App\Models\Catalog\Product', 'id', 'id_product');
    }
}
