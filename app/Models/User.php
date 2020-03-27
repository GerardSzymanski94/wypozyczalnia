<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'admin', 'city', 'street', 'zip_code', 'name', 'surname', 'name_invoice',
        'zip_code_invoice', 'city_invoice', 'street_invoice', 'nip_invoice'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function actualOrder()
    {
        return $this->hasOne(Order::class)->where('status', 1);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
