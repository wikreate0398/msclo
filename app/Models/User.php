<?php

namespace App\Models;

use App\Models\Order\OrderProduct;
use App\Models\Catalog\Product;
use App\Models\Catalog\CharProduct;
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
        'type_id',
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
        return $this->hasOne(UserType::class, 'type_id', 'id');
    }

    public function provider_options()
    {
        return $this->hasMany(CharProduct::class, 'provider_id', 'id');
    }

    public function files()
    {
        return $this->hasMany(ProviderFile::class, 'provider_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'provider_id', 'id');
    }

    public function ordersProducts()
    {
        return $this->hasMany(OrderProduct::class, 'provider_id', 'id');
    }

    public function scopeWhereProdsInCats($query, $idsCats)
    {
        return $query->whereHas('products', function ($query) use ($idsCats) {
            return $query->whereIn('category_id', $idsCats);
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

    public function scopeGetProvidersCats($query, $provider_id = false)
    {
        if (!empty($provider_id)) {
            $query->where('id', $provider_id);
        }
        return $query->provider()->hasVisibleProducts()->with(['products' => function ($query) {
            return $query->visible()
                         ->select('id', 'provider_id', 'category_id')
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
            $priceQuery = '(SELECT price FROM product_prices WHERE product_prices.product_id = products.id ORDER BY price asc LIMIT 1)';

            if (request('price_from') && request('price_to')) {
                $query->whereBetween(\DB::Raw($priceQuery), [request('price_from'), request('price_to')]);
            }

            if (request()->cats) {
                $query->whereIn('category_id', explode(',', request()->cats));
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
        return $query->where('type_id', 'provider')->active();
    }

    public function getFullNameAttribute()
    {
        return "$this->name $this->lastname";
    }
}
