<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderProduct extends Model
{
    public $timestamps = false;

    protected $table = 'orders_products';

    protected $fillable = [
        'id_order',
        'id_provider',
        'id_product',
        'qty',
        'price'
    ];

    public function provider()
    {
        return $this->hasOne('App\Models\User', 'id', 'id_provider')->withTrashed();
    }

    public function product()
    {
        return $this->hasOne('App\Models\Catalog\Product', 'id', 'id_product')->with('images')->withTrashed();
    }
}
