<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Review;
use App\Http\Requests\ReservationRequest;
use App\Http\Requests\ReviewRequest;

class ReservationController extends Controller
{
    public function store(ReservationRequest $request)
    {
        $reservation = new Reservation;
        $reservation->user_id = Auth::user()->id;
        $reservation->shop_id = $request->shop_id;
        $reservation->date = $request->date;
        $reservation->time = $request->time;
        $reservation->number = $request->number;
        $reservation->save();

        return view('/done');
    }

    public function deleteReservation(Request $request)
    {
        Reservation::find($request->id)->delete();

        return redirect('/mypage');
    }

    public function updateReservation(ReservationRequest $request)
    {
        $reservation = Reservation::find($request->id);
        $reservation->fill($request->input());
        $reservation->save();

        return redirect('/mypage');
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
}
