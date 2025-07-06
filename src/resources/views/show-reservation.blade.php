@extends('layouts.app')

@section('content')

    <h1>予約詳細</h1>
    <p>予約ID: {{ $reservation->id }}</p>
    <p>お名前: {{ $reservation->user->name }}</p>
    <p>店舗名： {{ $reservation->shop->shop_name }}</p>
    <p>予約日時： {{ $reservation->date }} {{ $reservation->time }}</p>
    <p>予約人数: {{ $reservation->number }} 名</p>

@endsection