<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Auth\VerifyEmailController;

Route::get('/', [ShopController::class, 'index']);

Route::get('/search', [ShopController::class, 'search']);
Route::get('/detail', [ShopController::class, 'detail']);

Route::middleware('auth', 'verified')->group(function () {
    Route::post('/like', [ShopController::class, 'like']);
});
Route::middleware('auth', 'verified')->group(function () {
    Route::post('/delete', [ShopController::class, 'delete']);
});

//予約
Route::middleware('auth', 'verified')->group(function () {
    Route::post('/reservation', [ReservationController::class, 'store']);
});
//myPageから予約の削除
Route::middleware('auth', 'verified')->group(function () {
    Route::post('/reservation/delete', [ReservationController::class, 'deleteReservation']);
});
//myPageから予約の変更
Route::middleware('auth', 'verified')->group(function () {
    Route::post('/reservation/update', [ReservationController::class, 'updateReservation']);
});

//myPageからレビューの投稿
Route::middleware('auth', 'verified')->group(function () {
    Route::post('/review', [ReservationController::class, 'storeReview']);
});

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/mypage', [UserController::class, 'mypage']);
});

Route::middleware('auth', 'verified')->group(function () {
    Route::post('/deletelike', [ShopController::class, 'deleteLike']);
});

Route::get('/done', function () {
    return view('done');
});

Route::get('/thanks', [AuthController::class, 'thanks']);

//メール認証
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, 'verify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');