<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Like;
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

        return view('myshop')
            ->with('shops', $shops)
            ->with('areas', $areas)
            ->with('genres', $genres)
            ->with(['user' => $user]);
    }

    public function shopRegister(ShopRegisterRequest $request)
    {
    // 店舗情報を作成
    $shop = Shop::create([
        'shop_name' => $request->shop_name,
        'area_id' => $request->area_id,
        'genre_id' => $request->genre_id,
        'feature' => $request->feature,
        'opening_time' => "00:00:00",
        'closing_time' => "23:59:59",
        'user_id' => Auth::user()->id
    ]);

    // 画像がアップロードされていれば保存
    if ($request->hasFile('image')) {
        $file = $request->file('image');

        // shop_idを使ってファイル名を作成
        $filename = $shop->id . '.' . $file->getClientOriginalExtension();

        // 画像を保存（storage/app/public/shop_images/）
        $path = $file->storeAs('shop_images', $filename, 'public');

        // shopテーブルの image カラムを更新
        $shop->update(['image' => $path]);
    }

        return view('myshop')->with('success', '店舗登録が完了しました');
    }

    public function shopSearch(Request $request)
    {
        $shop_id = $request->input('shop_id');
        $shop = Shop::find($shop_id); // 選択されたshop

        $shops = Shop::all();
        $areas = Area::all();
        $genres = Genre::all();

        return view('myshop', compact('shop', 'shops', 'areas', 'genres'));
    }
}
