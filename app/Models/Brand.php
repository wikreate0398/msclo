<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\OrderingTrait;
use App\Models\Traits\PermisionTrait;

class Brand extends Model
{
	use OrderingTrait, PermisionTrait;
	
	public $timestamps = false;

	protected $table = 'brands';

	protected $fillable = [
        'name',
        'image'
    ];

	public function scopeGetAll($query)
    {
        return $query->visible()->orderByPageUp()->get();
    }
}
