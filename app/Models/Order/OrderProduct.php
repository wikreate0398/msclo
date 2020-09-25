<?php

namespace App\Models\Order;

use App\Models\Catalog\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    public $timestamps = false;

    protected $table = 'orders_products';

    protected $fillable = [
        'order_id',
        'provider_id',
        'product_id',
        'qty',
        'price'
    ];

    public function provider()
    {
        return $this->hasOne(User::class, 'id', 'provider_id')->withTrashed();
    }

    public function orders()
    {
        return $this->hasOne(Order::class, 'id', 'order_id')->withTrashed();
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id')->with('images', 'category', 'prices')->withTrashed();
    }
}
