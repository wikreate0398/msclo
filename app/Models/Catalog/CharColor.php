<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class CharColor extends Model
{
    public $timestamps = false;

    protected $table = 'chars_color';

    protected $fillable = [
        'char_id',
        'color'
    ];

    public function char()
    {
        return $this->hasOne(Char::class, 'id', 'char_id');
    }
}
