@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/verify-email.css') }}">
@endsection

@section('content')
<div class="header__wrap">
    <div class="header__text">
        {{ __('メールアドレス確認のお願い') }}
    </div>
</div>
<div class="body__wrap">
    <p class="body__text">
        {{ __('ご登録いただいたメールアドレスに確認用のリンクをお送りしました。') }}
    </p>
    <p class="body__text">
        {{ __('もし確認用メールが送信されていない場合は、下記をクリックしてください。') }}
    </p>
    <form class="form__item" method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="form__input-button">
            {{ __('確認メールを再送信する') }}
        </button>
    </form>

</div>
@endsection