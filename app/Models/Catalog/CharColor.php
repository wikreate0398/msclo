<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class CharColor extends Model
{
    protected $fillable = [
        'product_id',
        'color_id'
    ];
}
