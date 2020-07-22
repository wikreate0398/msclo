<?php

namespace App\Models\Provider;

use Illuminate\Database\Eloquent\Model;

class ProviderServiceIntersect extends Model
{
	public $timestamps = false;

	protected $table = 'providers_services_intersect';

	protected $fillable = [
        'id_provider',
        'id_service',
        'value'
    ];

    public function service()
    {
        return $this->hasOne('App\Models\Provider\ProviderService', 'id', 'id_service');
    }

    public function optionValue()
    {
        return $this->hasOne('App\Models\Provider\ProviderService', 'id', 'value');
    }

    public function provider()
    {
        return $this->hasOne('App\Models\User', 'id', 'id_provider');
    }
}
