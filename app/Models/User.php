<?php

namespace App\Models;

use App\Models\Order\Order;
use App\Models\Order\OrderProduct;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'lastname',
        'phone',
        'email',
        'password',
        'confirm',
        'confirm_hash',
        'active',
        'image',
        'user_agent',
        'last_entry',
        'type',
        'work_from',
        'work_to',
        'phone',
        'phone2',
        'contact_email',
        'feedback_email',
        'site',
        'skype',
        'vk',
        'instagram',
        'office_address',
        'warehouse_address',
        'other_contacts',
        'note',
        'description',
        'text'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
      'password', 'remember_token',
    ];

    protected $casts = [
        'confirm'    => 'integer',
        'active'     => 'integer',
        'last_entry' => 'datetime'
    ];
  
    public function scopeFilter($query)
    {
        if (request()->search) {
            $searchQuery = request()->search;
            $query->where('name', 'like', '%'.$searchQuery.'%')
                  ->orWhere('email', 'like', '%'.$searchQuery.'%');
        }

        if (request()->sort) {
            $sort = request()->sort;
            if ($sort == 'no-active') {
                $query->where('active', '!=', '1');
            } elseif ($sort == 'active') {
                $query->where('active', '1');
            }
        }

        if (in_array(request()->type, ['user', 'provider'])) {
            $query->where('type', request()->type);
        }

        return $query;
    }

    public function typeData()
    {
        return $this->hasOne('App\Models\UserType', 'type', 'type');
    }

    public function provider_options()
    {
        return $this->hasMany('App\Models\Provider\CharProduct', 'id_provider', 'id');
    }

    public function files()
    {
        return $this->hasMany('App\Models\ProviderFile', 'id_provider', 'id');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Catalog\Product', 'id_provider', 'id');
    }

    public function ordersProducts()
    {
        return $this->hasMany(OrderProduct::class, 'id_provider', 'id');
    }

    public function scopeWhereProdsInCats($query, $idsCats)
    {
        return $query->whereHas('products', function ($query) use ($idsCats) {
            return $query->whereIn('id_category', $idsCats);
        });
    }

    public function scopeGetHomeProviders($query)
    {
        return $query->provider()->hasVisibleProducts()->get();
    }

    public function scopeHasVisibleProducts($query)
    {
        return $query->whereHas('products', function ($query) {
            return $query->visible();
        });
    }

    public function scopeOrderProviders($query)
    {
        return $query->withCount('products')->orderBy('products_count', 'desc');
    }

    public function scopeGetProvidersCats($query, $id_provider = false)
    {
        if (!empty($id_provider)) {
            $query->where('id', $id_provider);
        }
        return $query->provider()->hasVisibleProducts()->with(['products' => function ($query) {
            return $query->visible()
                         ->select('id', 'id_provider', 'id_category')
                         ->with('category');
        }])->get();
    }

    public function scopeRegistered($query, $time = false)
    {
        if ($time == 'week') {
            $query->where('created_at', '>=', \Carbon\Carbon::today()->subDays(7));
        } elseif ($time == 'today') {
            $query->where('created_at', '>=', \Carbon\Carbon::today());
        }

        return $query->where('confirm', '1');
    }

    public function scopeFilterProviders($query)
    {
        $query->whereHas('products', function ($query) {
            $priceQuery = '(SELECT price FROM catalog_prices WHERE catalog_prices.id_product = catalog.id ORDER BY price asc LIMIT 1)';

            if (request('price_from') && request('price_to')) {
                $query->whereBetween(\DB::Raw($priceQuery), [request('price_from'), request('price_to')]);
            }

            if (request()->cats) {
                $query->whereIn('id_category', explode(',', request()->cats));
            }
            return $query;
        });


        return $query->orderProviders();
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1)->where('confirm', 1);
    }

    public function scopeClient($query)
    {
        return $query->where('type', 'client')->active();
    }

    public function scopeProvider($query)
    {
        return $query->where('type', 'provider')->active();
    }

    public function getFullNameAttribute()
    {
        return "$this->name $this->lastname";
    }
}
