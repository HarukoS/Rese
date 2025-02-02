@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('content')
<div class="reserved">
    <div class="reserved__message">
        ご予約ありがとうございます
    </div>
    <div class="back__button">
        <a class="back__button-submit" href="/">戻る</a>
    </div>
</div>
@endsection