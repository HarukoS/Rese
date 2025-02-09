@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('search-bar')
<div class="search-bar__content">
    <form class="search-form" action="/search" method="get">
        @csrf
        <select class="search-form__area" name="area_id">
            <option disabled selected>All area</option>
            <option value="">すべて</option>
            @foreach ($areas as $area)
            <option value="{{ $area['id'] }}">{{ $area['area'] }}</option>
            @endforeach
        </select>
        <select class="search-form__genre" name="genre_id">
            <option disabled selected>All genre</option>
            <option value="">すべて</option>
            @foreach ($genres as $genre)
            <option value="{{ $genre['id'] }}">{{ $genre['genre'] }}</option>
            @endforeach
        </select>
        <div class="search-form__button">
            <button class="search-form__button-submit" type="submit"><img src="{{ asset('img/search.jpeg') }}" alt="search"></img></button>
        </div>
        <div class="search-form__item">
            <input class="search-form__text" type="text" name="keyword" value="{{ old('keyword') }}" placeholder="Search ...">
        </div>
    </form>
</div>
@endsection

@section('content')
<div class="shop__list">
    @foreach ($shops as $shop)
    <div class="shop__card">
        <div class="card__img">
            <img src="img/{{$shop['id']}}.jpg" alt="shop_image" />
        </div>
        <div class="card__content">
            <div class="card__title">
                <div class="card__name">{{ $shop['shop_name'] }}</div>
                @if ($shop['average_rate'] === null)
                @else
                <div class="card__rate">{{ number_format($shop->average_rate, 1) }} <span class="star5_rating" data-rate="{{ $shop['average_rate'] }}"></span></div>
                @endif
            </div>
            <div class="card__tag">#{{ $shop->area->area }} #{{ $shop->genre->genre }}</div>
            <div class="card__detail">
                <form action="/detail" method="post">
                    @csrf
                    <div class="card__detail-btn">
                        <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
                        <button class="card__detail-btn-submit" type="submit">詳しく見る</button>
                    </div>
                </form>
                <div class="card__like">
                    @if (Auth::check())
                    @foreach ($likes as $like)
                    @if ($like['shop_id'] === $shop->id)
                    <form action="/delete" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $like['id'] }}">
                        <button class="heart__btn" type="submit"><img class="heart__img" src="img/heart_red.png" alt="お気に入り" /></button>
                    </form>
                    @else
                    @endif
                    @endforeach
                    @if (!in_array($shop->id, $likes->pluck('shop_id')->toArray()))
                    <form action="/like" method="post">
                        @csrf
                        <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
                        <button class="heart__btn" type="submit"><img class="heart__img" src="img/heart.png" alt="お気に入り" /></button>
                    </form>
                    @endif
                    @else
                    <form action="/like" method="post">
                        @csrf
                        <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
                        <button class="heart__btn" type="submit"><img class="heart__img" src="img/heart.png" alt="お気に入り" /></button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection