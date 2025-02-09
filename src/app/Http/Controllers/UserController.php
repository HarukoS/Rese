<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Like;
use App\Models\Reservation;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserController extends Controller
{
    public function mypage()
    {
        $now = Carbon::now();
        $user = Auth::user();
        $shops = Shop::with(['area', 'genre'])->get();
        $areas = Area::all();
        $genres = Genre::all();
        $user_id = Auth::user()->id;
        $likes = Like::where('user_id', $user_id)->get();
        $reservations = Reservation::where('user_id', $user_id)
            ->whereRaw('CONCAT(date, " ", time) >= ?', [$now])
            ->get();
        $after_reservations = Reservation::with('review')
            ->where('user_id', $user_id)
            ->whereRaw('CONCAT(date, " ", time) < ?', [$now])
            ->get();

        return view('mypage', compact('user', 'shops', 'areas', 'genres', 'user_id', 'likes', 'reservations', 'after_reservations'));
    }
}
