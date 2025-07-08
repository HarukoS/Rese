<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function verify(Request $request)
    {
        // メールアドレスを確認済みにマーク
        $request->user()->markEmailAsVerified();

        // メール確認後にログアウト
        Auth::logout();

        // メール確認後にthanksページにリダイレクト
        return redirect('/thanks');
    }
}
