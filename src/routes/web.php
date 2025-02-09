<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;

Route::get('/', [ShopController::class, 'index']);

Route::get('/search', [ShopController::class, 'search']);
Route::get('/detail', [ShopController::class, 'detail']);

Route::middleware('auth')->group(function () {
    Route::post('/like', [ShopController::class, 'like']);
});
Route::middleware('auth')->group(function () {
    Route::post('/delete', [ShopController::class, 'delete']);
});

//予約
Route::middleware('auth')->group(function () {
    Route::post('/reservation', [ReservationController::class, 'store']);
});
//myPageから予約の削除
Route::middleware('auth')->group(function () {
    Route::post('/reservation/delete', [ReservationController::class, 'deleteReservation']);
});
//myPageから予約の変更
Route::middleware('auth')->group(function () {
    Route::post('/reservation/update', [ReservationController::class, 'updateReservation']);
});

//myPageからレビューの投稿
Route::middleware('auth')->group(function () {
    Route::post('/review', [ReservationController::class, 'storeReview']);
});

Route::middleware('auth')->group(function () {
    Route::get('/mypage', [UserController::class, 'mypage']);
});

Route::middleware('auth')->group(function () {
    Route::post('/deletelike', [ShopController::class, 'deleteLike']);
});

Route::get('/done', function () {
    return view('done');
});