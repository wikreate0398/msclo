<?php

namespace App\Models\Provider;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\OrderingTrait;
use App\Models\Traits\PermisionTrait;

class ProviderService extends Model
{
	use OrderingTrait, PermisionTrait;
	
	public $timestamps = false;

	protected $table = 'providers_services';

	protected $fillable = [
        'name_ru', 
        'name_en',
        'parent_id',
        'view_filter',
        'view',
        'type'
    ];

	protected $casts = [
	    'view_filter' => 'integer',
        'view'        => 'integer'
    ];

	public function childs()
    {
        return $this->hasMany('App\Models\Provider\ProviderService', 'parent_id', 'id')->orderByPageUp();
    }
}
