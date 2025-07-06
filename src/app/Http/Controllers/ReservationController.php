<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Review;
use App\Http\Requests\ReservationRequest;
use App\Http\Requests\ReviewRequest;
use Endroid\QrCode\Builder\Builder;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\ReservationConfirmed;

class ReservationController extends Controller
{
    public function store(ReservationRequest $request)
    {
        // 1. 予約を保存
        $reservation = new Reservation;
        $reservation->user_id = Auth::user()->id;
        $reservation->shop_id = $request->shop_id;
        $reservation->date = $request->date;
        $reservation->time = $request->time;
        $reservation->number = $request->number;
        $reservation->save();

        // 2. QRコード生成（例: 予約ID を含む URL にする）
        $qrData = route('reservation.show', ['id' => $reservation->id]);

        $result = Builder::create()
            ->data($qrData)
            ->size(300)
            ->margin(10)
            ->build();

        // 3. ストレージに保存
        $filename = 'qrcode_' . $reservation->id . '.png';
        Storage::disk('public')->put('qrcodes/' . $filename, $result->getString());
        $qrCodeUrl = Storage::disk('public')->url('qrcodes/' . $filename);

        // 4. メール送信
        $user = Auth::user();
        Mail::to($user->email)->send(new ReservationConfirmed($user, $qrCodeUrl));

        // 5. 役割をビューに渡す
        $user_role = $user->role;

        return view('/done', compact('user_role'));
    }

    public function deleteReservation(Request $request)
    {
        Reservation::find($request->id)->delete();

        return redirect('/mypage');
    }

    public function updateReservation(ReservationRequest $request)
    {
        $reservation = Reservation::find($request->id);
        $reservation->fill($request->only(['date', 'time', 'number']));
        $reservation->save();

        // QRコード作成し直し
        $qrData = route('reservation.show', ['id' => $reservation->id]);

        $result = Builder::create()
            ->data($qrData)
            ->size(300)
            ->margin(10)
            ->build();

        $filename = 'qrcode_' . $reservation->id . '.png';
        Storage::disk('public')->put('qrcodes/' . $filename, $result->getString());
        $qrCodeUrl = Storage::disk('public')->url('qrcodes/' . $filename);

        // 4. メール送信
        $user = Auth::user();
        Mail::to($user->email)->send(new ReservationConfirmed($user, $qrCodeUrl));

        // 5. 役割をビューに渡す
        $user_role = $user->role;

        return view('/done', compact('user_role'));
    }

    public function storeReview(ReviewRequest $request)
    {
        $review = new Review;
        $review->reservation_id = $request->reservation_id;
        $review->handle = $request->handle;
        $review->rate = $request->rate;
        $review->comment = $request->comment;
        $review->save();

        return redirect('/mypage');
    }

    //お店側がQRコードを読み取って予約情報を確認
    public function show($id)
    {
        $reservation = Reservation::with(['user', 'shop'])->findOrFail($id);
        return view('show-reservation', compact('reservation'));
    }
}
