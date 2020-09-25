<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProviderFile extends Model
{
    public $timestamps = false;

    protected $table = 'provider_files';

    protected $fillable = [
        'provider_id',
        'name_ru',
        'description_ru',
        'file'
    ];

    public function scopeGetProviderFiles($query, $provider_id)
    {
        return $query->where('provider_id', $provider_id)->get();
    }

    public function provider()
    {
        return $this->hasOne(User::class, 'id', 'provider_id');
    }
}
