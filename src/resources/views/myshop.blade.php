@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/myshop.css') }}">
@endsection

@section('content')
<div class="myshop">
    <div class="myshop_registration">
        <div>
            <div class="myshop_registration__heading">
                <h3>店舗情報の新規登録、更新</h3>
            </div>
            <div class="registration__info">

                <div class="registration__form">
                    <div class="registration-form__group">
                        <input type="radio" id="new" name="type" value="new">
                        <label class="form__label" for="new">新規登録</label>
                    </div>
                    <div class="registration-form__group">
                        <input type="radio" id="update" name="type" value="update">
                        <label class="form__label" for="update">更新</label>
                            <form class="search-form" action="myshop/search" method="get">
                            @csrf
                            <div class="form__input-text">
                                <select class="search-form__shop" name="shop_id">
                                <option disabled selected>選択してください</option>
                                @foreach ($shops as $shop)
                                <option value="{{ $shop['id'] }}">{{ $shop['shop_name'] }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="search-form__button">
                                <button class="search-form__button-submit" type="submit">選 択</button>
                            </div>
                            </form>
                    </div>
                </div>

                <div class="registration__inner">
                    <form class="registration-form" action="/shopregister" method="post" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <div class="registration-form__group">
                                <div class="form__group-title">
                                    <span class="form__label">店名</span>
                                </div>
                                <div class="form__input-text">
                                    <input type="text" name="shop_name" value>
                                </div>
                            </div>

                            <div class="registration-form__group">
                                <div class="form__group-title">
                                    <span class="form__label">エリア</span>
                                </div>
                                <div class="form__input-text">
                                    <select name="area_id">
                                    <option disabled selected>選択してください</option>
                                    @foreach ($areas as $area)
                                        <option value="{{ $area->id }}">{{ $area['area'] }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="registration-form__group">
                                <div class="form__group-title">
                                    <span class="form__label">ジャンル</span>
                                </div>
                                <div class="form__input-text">
                                    <select name="genre_id">
                                    <option disabled selected>選択してください</option>
                                    @foreach ($genres as $genre)
                                        <option value="{{ $genre['id'] }}">{{ $genre['genre'] }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="registration-form__group">
                                <div class="form__group-title">
                                    <span class="form__label">特徴</span>
                                </div>
                                <div class="form__input-text">
                                    <textarea name="feature"></textarea>
                                </div>
                            </div>

                            <div class="registration-form__group">
                                <div class="form__group-title">
                                    <span class="form__label">画像</span>
                                </div>
                                <div class="form__input-text">
                                    <input type="file" name="image">
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="shop_id" value="{{ $shop->id ?? '' }}">

                        <div class="search-form__button">
                            <button class="search-form__button-submit" type="submit">登録する</button>
                        </div>

                    </form>

                </div>

                @if (count($errors) > 0)
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
                @endif

                @if (session('success'))
                <div class="alert-success">
                {{ session('success') }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="myshop_list">
        <div class="my_favorite__heading">
            <h2>{{ $user->name }}さん</h2>
        </div>
        <div class="my_favorite__heading">
            <h3>登録店舗一覧</h3>
        </div>
        <div class="flex__item">
            @foreach ($shops as $shop)
            <div class="shop__card">
                <div class="card__img">
                    <img src="{{ asset('storage/shop_images/' . $shop['id'] . '.jpg') }}" alt="shop_img" />
                </div>
                <div class="card__content">
                    <div class="card__name">{{ $shop['shop_name'] }}</div>
                    <div class="card__tag">#{{ $shop->area->area }} #{{ $shop->genre->genre }}</div>
                    <div class="card__detail">
                        <div class="card__detail-btn">
                            <form action="/detail" method="get">
                                @csrf
                                <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
                                <button class="card__detail-btn-submit" type="submit">詳しく見る</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection