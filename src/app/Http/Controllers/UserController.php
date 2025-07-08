<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Like;
use App\Models\Reservation;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

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
        $user_role = Auth::user()->role;
        $likes = Like::where('user_id', $user_id)->get();
        $reservations = Reservation::where('user_id', $user_id)
            ->whereRaw('CONCAT(date, " ", time) >= ?', [$now])
            ->get();
        $after_reservations = Reservation::with('review')
            ->where('user_id', $user_id)
            ->whereRaw('CONCAT(date, " ", time) < ?', [$now])
            ->get();

        return view('mypage', compact('user', 'shops', 'areas', 'genres', 'user_id', 'user_role', 'likes', 'reservations', 'after_reservations'))
            ->with(['user' => $user]);
    }

    public function admin()
    {
        $owners = User::where('role', '2')->get();
        $user_role = Auth::user()->role;

        return view('admin', compact('owners', 'user_role'));
    }

    public function shopOwner(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => $validatedData['role'],
        ]);

        event(new Registered($user));

        return redirect('/admin');
    }

    public function deleteOwner(Request $request)
    {
        User::find($request->id)->delete();
        return redirect('/admin');
    }

    public function editEmail()
    {
        $user_role = Auth::user()->role;

        return view('sendmail', compact('user_role'));
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message_content' => 'required|string',
            'attachment' => 'nullable|file|max:20480',
        ]);

        $subject = $request->input('subject');
        $messageContent = $request->input('message_content');
        $attachment = $request->file('attachment');

        $users = User::all();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new SendMail($subject, $messageContent, $attachment));
        }

        return back()->with('success', 'メールが送信されました。');
    }
}
