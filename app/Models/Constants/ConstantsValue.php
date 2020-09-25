<?php

namespace App\Models\Constants;

use Illuminate\Database\Eloquent\Model;
use App\Models\Constants\Constants;

class ConstantsValue extends Model
{
    public $timestamps = false;

    protected $table = 'constants_value';

    protected $fillable = [
        'lang',
        'constant_id',
        'value'
    ];

    protected $casts = [
        'constant_id' => 'integer',
        'value'    => 'content'
    ];

    public function constant()
    {
        return $this->hasOne(Constants::class, 'id', 'constant_id');
    }
}
