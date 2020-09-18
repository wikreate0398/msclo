<?php

namespace App\Models\Order;

use App\Models\Catalog\Product;
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

    public function orders()
    {
        return $this->hasOne(Order::class, 'id', 'id_provider')->withTrashed();
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'id_product')->with('images', 'category', 'prices')->withTrashed();
    }
}
