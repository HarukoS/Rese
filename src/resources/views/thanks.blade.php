@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="registered">
    <div class="registered__message">
        会員登録ありがとうございます
    </div>
    <div class="login__button">
        <a class="login__button-submit" href="/login">ログインする</a>
    </div>
</div>
@endsection