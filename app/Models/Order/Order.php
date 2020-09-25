<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Order\OrderProduct;

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
        'user_id',
        'total_price'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id')->withTrashed();
    }

    public function products()
    {
        return $this->hasMany(OrderProduct::class, 'order_id', 'id');
    }

    public function scopeGetPurchase($query)
    {
        return $query->where('user_id', user()->id)
                     ->with(['products'])
                     ->get();
    }
}
