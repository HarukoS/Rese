<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Review;

class Shop extends Model
{
    use HasFactory;

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function scopeAreaSearch($query, $area_id)
    {
        if (!empty($area_id)) {
            $query->where('area_id', $area_id);
        }
    }

    public function scopeGenreSearch($query, $genre_id)
    {
        if (!empty($genre_id)) {
            $query->where('genre_id', $genre_id);
        }
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
            $query->where('feature', 'like', '%' . $keyword . '%');
        }
    }

    public function scopeShopSearch($query, $shop_id)
    {
        if (!empty($shop_id)) {
            $query->where('id', $shop_id);
        }
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // Reservation経由でReviewを取得
    public function reviews()
    {
        return $this->hasManyThrough(Review::class, Reservation::class);
    }
}
