<?php

namespace App\Models;

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
        'phone', 
        'email', 
        'password',
        'confirm', 
        'confirm_hash', 
        'active',  
        'image', 
        'user_agent', 
        'last_entry',
        'type'
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
    ];
  
    public function scopeFilter($query)
    {
        if(request()->search) {
            $searchQuery = request()->search;
            $query->where('name', 'like', '%'.$searchQuery.'%')
                  ->orWhere('email', 'like', '%'.$searchQuery.'%');
        } 

        if (request()->sort) {
          $sort = request()->sort;
          if ($sort == 'no-active') {
            $query->where('active', '!=', '1');
          } 
          elseif ($sort == 'active') {
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

    public function scopeRegistered($query, $time = false)
    {
      if ($time == 'week') 
      { 
        $query->where('created_at', '>=', \Carbon\Carbon::today()->subDays(7));
      }
      elseif ($time == 'today') 
      {
        $query->where('created_at', '>=', \Carbon\Carbon::today());
      }

      return $query->where('confirm', '1');
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
}
