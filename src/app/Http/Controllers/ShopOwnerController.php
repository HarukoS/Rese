<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Like;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Requests\ShopRegisterRequest;

class ShopOwnerController extends Controller
{
    public function myshop(Request $request)
    {
        $user_id = Auth::user()->id;
        $shops = Shop::where('user_id', $user_id)->get();
        $areas = Area::all();
        $genres = Genre::all();
        $user = Auth::user();
        $reservations = Reservation::whereHas('shop', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
            })->get();

        return view('myshop', compact('shops', 'areas', 'genres', 'user', 'reservations'));
    }

    public function shopRegister(ShopRegisterRequest $request)
    {
        $user_id = Auth::id();

        $shop = Shop::create([
            'shop_name' => $request->shop_name,
            'area_id' => $request->area_id,
            'genre_id' => $request->genre_id,
            'feature' => $request->feature,
            'opening_time' => "00:00:00",
            'closing_time' => "23:59:59",
            'user_id' => $user_id
        ]);

        // 画像がアップロードされていれば保存
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // shop_idを使ってファイル名を作成
            $filename = $shop->id . '.' . $file->getClientOriginalExtension();

            // 画像を保存（storage/app/public/shop_images/）
            $path = $file->storeAs('shop_images', $filename, 'public');

            $shop->update(['image' => $path]);
        }

        $reservations = Reservation::whereHas('shop', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })->get();

        $shops = Shop::where('user_id', $user_id)->get();
        $areas = Area::all();
        $genres = Genre::all();
        $user = Auth::user();

        return view('myshop', compact('shops', 'areas', 'genres', 'user', 'reservations'))
            ->with('success', '店舗登録が完了しました');
    }

    public function shopSearch(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $shop_id = $request->input('shop_id');

        $shop = Shop::where('user_id', $user_id)->where('id', $shop_id)->first();
        $shops = Shop::where('user_id', $user_id)->get();
        $areas = Area::all();
        $genres = Genre::all();
        $reservations = Reservation::whereHas('shop', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
            })->get();

        return view('myshop', compact('shop', 'shops', 'areas', 'genres', 'user', 'reservations'));
    }

    public function shopUpdate(ShopRegisterRequest $request)
    {
        $shopupdate = Shop::find($request->shop_id);

        $shopupdate->fill($request->only(['shop_name', 'area_id', 'genre_id', 'feature']));
        $shopupdate->save();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $shopupdate->id . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('shop_images', $filename, 'public');
            $shopupdate->update(['image' => $path]);
        }

        $user_id = Auth::id();

        $shops = Shop::where('user_id', $user_id)->get();
        $areas = Area::all();
        $genres = Genre::all();
        $user = Auth::user();

        $reservations = Reservation::whereHas('shop', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })->get();

        return view('myshop', [
            'shop' => $shopupdate,
            'shops' => $shops,
            'areas' => $areas,
            'genres' => $genres,
            'user' => $user,
            'reservations' => $reservations,
        ]);
    }
}
