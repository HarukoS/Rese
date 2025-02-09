<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index()
    {
        if (Auth::check()) {

            $areas = Area::all();
            $genres = Genre::all();
            $user_id = Auth::user()->id;
            $likes = Like::where('user_id', $user_id)->get();
            $shops = Shop::with('reviews')->get()->map(function ($shop) {
                $reviews = $shop->reviews;
                $averageRate = $reviews->avg('rate');
                $shop->setAttribute('average_rate', $averageRate);
                return $shop;
            });
            return view('index', compact('shops', 'areas', 'genres', 'user_id', 'likes'));
        } else {

            $areas = Area::all();
            $genres = Genre::all();
            $shops = Shop::with('reviews')->get()->map(function ($shop) {
                $reviews = $shop->reviews;
                $averageRate = $reviews->avg('rate');
                $shop->setAttribute('average_rate', $averageRate);
                return $shop;
            });
            return view('index', compact('shops', 'areas', 'genres'));
        }
    }

    public function search(Request $request)
    {
        if (Auth::check()) {

            $shops = Shop::with(['area', 'genre'])->AreaSearch($request->area_id)
                ->GenreSearch($request->genre_id)->KeywordSearch($request->keyword)->get();
            $areas = Area::all();
            $genres = Genre::all();
            $user_id = Auth::user()->id;
            $likes = Like::where('user_id', $user_id)->get();

            return view('index', compact('shops', 'areas', 'genres', 'user_id', 'likes'));
        } else {
            $shops = Shop::with(['area', 'genre'])->AreaSearch($request->area_id)
                ->GenreSearch($request->genre_id)->KeywordSearch($request->keyword)->get();
            $areas = Area::all();
            $genres = Genre::all();

            return view('index', compact('shops', 'areas', 'genres'));
        }
    }

    public function detail(Request $request)
    {
        $request_shops = $request->all();
        $shop_details = Shop::with(['area', 'genre'])->ShopSearch($request->shop_id)->get();
        $shop_reviews = Shop::with('reviews')->find($request->shop_id);
        return view('detail', compact('request_shops', 'shop_details', 'shop_reviews'));
    }

    public function like(Request $request)
    {
        $like = new Like;
        $like->user_id = Auth::user()->id;
        $like->shop_id = $request->shop_id;
        $like->save();

        return redirect('/');
    }

    public function delete(Request $request)
    {
        Like::find($request->id)->delete();

        return redirect('/');
    }

    public function deleteLike(Request $request)
    {
        Like::find($request->id)->delete();

        return redirect('/mypage');
    }
}
