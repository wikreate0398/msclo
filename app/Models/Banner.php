<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\OrderingTrait;
use App\Models\Traits\PermisionTrait;

class Banner extends Model
{
	use OrderingTrait, PermisionTrait;
	
	public $timestamps = false;

	protected $table = 'banners';

	protected $fillable = [
        'name_ru',
        'name_en',
        'image',
        'link'
    ];

	public function scopeGetAll($query)
    {
        return $query->visible()->orderByPageUp()->get();
    }
}
