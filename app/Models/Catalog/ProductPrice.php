<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    public $timestamps = false;

    protected $table = 'product_prices';

    protected $fillable = [
        'product_id',
        'price',
        'quantity'
    ];

    protected $casts = [
      'quantity' => 'integer'
    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
