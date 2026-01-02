<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Car;
use App\Models\Request as CarRequest;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Cars added by the seller
     */
    public function cars()
    {
        return $this->hasMany(Car::class, 'seller_id');
    }

    /**
     * Requests made by the user
     */
    public function requests()
    {
        return $this->hasMany(CarRequest::class);
    }
}
