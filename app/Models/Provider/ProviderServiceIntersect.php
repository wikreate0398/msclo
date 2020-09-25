<?php

namespace App\Models\Provider;

use Illuminate\Database\Eloquent\Model;
use App\Models\Provider\ProviderService;
use App\Models\User;

class ProviderServiceIntersect extends Model
{
    public $timestamps = false;

    protected $table = 'providers_services_intersect';

    protected $fillable = [
        'provider_id',
        'service_id',
        'value'
    ];

    public function service()
    {
        return $this->hasOne(ProviderService::class, 'id', 'service_id');
    }

    public function optionValue()
    {
        return $this->hasOne(ProviderService::class, 'id', 'value');
    }

    public function provider()
    {
        return $this->hasOne(User::class, 'id', 'provider_id');
    }
}
