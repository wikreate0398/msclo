<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    public $timestamps = true;

    protected $table = 'orders';

    protected $fillable = [
        'name',
        'lastname',
        'company',
        'city',
        'street',
        'house',
        'phone',
        'comment',
        'payment_type',
        'rand',
        'id_user',
        'total_price'
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'id_user');
    }
}
