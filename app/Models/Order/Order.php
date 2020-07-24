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
        return $this->hasOne('App\Models\User', 'id', 'id_user')->withTrashed();
    }

    public function products()
    {
        return $this->hasMany('App\Models\Order\OrderProduct', 'id_order', 'id');
    }

    public function scopeGetPurchase($query)
    {
        return $query->where('id_user', user()->id)
                     ->with(['products'])
                     ->get();
    }
}
