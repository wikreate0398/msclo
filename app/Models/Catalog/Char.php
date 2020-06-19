<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\OrderingTrait;
use App\Models\Traits\PermisionTrait;

class Char extends Model
{
	use OrderingTrait, PermisionTrait;
	
	public $timestamps = false;

	protected $table = 'chars';

	protected $fillable = [
        'name_ru', 
        'name_en',
        'parent_id',
        'view_filter',
        'view',
        'type'
    ];

	public function childs()
    {
        return $this->hasMany('App\Models\Catalog\Char', 'parent_id', 'id')->orderByPageUp();
    }
}
