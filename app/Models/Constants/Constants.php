<?php

namespace App\Models\Constants;

use Illuminate\Database\Eloquent\Model;
use App\Models\Constants\ConstantsCategory;
use App\Models\Constants\ConstantsValue;

class Constants extends Model
{
    public $timestamps = false;

    protected $table = 'constants';

    protected $fillable = [
        'name',
        'category_id',
        'description',
        'editor'
    ];

    protected $casts = [
        'editor' => 'boolean'
    ];

    public function category()
    {
        return $this->hasOne(ConstantsCategory::class, 'id', 'category_id');
    }

    public function constants_value()
    {
        return $this->hasMany(ConstantsValue::class, 'constant_id', 'id');
    }

    public function scopeFilter($query)
    {
        $searchQuery = request()->q;
        return $query->whereHas('constants_value', function ($query) use ($searchQuery) {
            return $query->where('value', 'like', '%'.$searchQuery.'%');
        });
    }
}
