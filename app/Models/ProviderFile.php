<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProviderFile extends Model
{
	public $timestamps = false;

	protected $table = 'providers_files';

	protected $fillable = [
	    'id_provider',
        'name_ru',
        'description_ru',
        'file'
    ];

	public function scopeGetProviderFiles($query, $id_provider)
    {
        return $query->where('id_provider', $id_provider)->get();
    }

    public function provider()
    {
        return $this->hasOne('App\Models\User', 'id', 'id_provider');
    }
}
