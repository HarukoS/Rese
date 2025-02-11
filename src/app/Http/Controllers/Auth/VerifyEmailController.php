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
        // 認証済みのユーザーのみがアクセスできるようにする
        $this->middleware('auth');
    }

    /**
     * メールアドレスを確認する
     */
    public function verify(Request $request)
    {
        // すでに確認済みの場合はリダイレクト
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('home');  // 適切なリダイレクト先に変更
        }

        // メールアドレスを確認済みにマーク
        $request->user()->markEmailAsVerified();

        // メール確認後にログアウト
        Auth::logout();

        // メール確認後にthanksページにリダイレクト
        return redirect('/thanks');
    }
}
