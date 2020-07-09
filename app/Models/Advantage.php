<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\OrderingTrait;
use App\Models\Traits\PermisionTrait;

class Advantage extends Model
{
	use OrderingTrait, PermisionTrait;
	
	public $timestamps = false;

	protected $table = 'advantages';

	protected $fillable = [
        'name_ru',
        'name_en',
        'description_ru',
        'description_en',
        'image'
    ];

	public function scopeGetAll($query)
    {
        return $query->visible()->orderByPageUp()->get();
    }
}
