<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Request as CarRequest;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'name',
        'model',
        'for_rent',
        'buy_price',
        'rent_price',
        'image', // car image path
    ];

    /**
     * Seller (owner) of the car
     */
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    /**
     * Requests related to this car
     */
    public function requests()
    {
        return $this->hasMany(CarRequest::class);
    }
}
