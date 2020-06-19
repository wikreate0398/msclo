<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\OrderingTrait;
use App\Models\Traits\PermisionTrait;

class Product extends Model
{
	use OrderingTrait, PermisionTrait;
	
	public $timestamps = false;

	protected $table = 'catalog';

	protected $fillable = [
	    'id_provider',
	    'id_category',
        'name_ru', 
        'name_en',
        'description_ru',
        'description_en',
        'quantity',
        'price',
        'is_new'
    ];

	protected $casts = [
	  'is_new' => 'integer'
    ];
}
