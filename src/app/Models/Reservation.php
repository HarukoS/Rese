<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class, 'reservation_id');
    }

    protected $fillable = ['user_id', 'shop_id', 'date', 'time', 'number'];
}
