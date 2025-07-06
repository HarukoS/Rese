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
                        <input type="radio" id="new" name="type" value="new" {{ old('type') == 'new' ? 'checked' : '' }}>
                        <label class="form__label" for="new">新規登録</label>
                    </div>
                    <div class="registration-form__group">
                        <input type="radio" id="update" name="type" value="update" {{ isset($shop) ? 'checked' : '' }}>
                        <label class="form__label" for="update">更新</label>
                            <form class="search-form" action="{{ route('myshop.search') }}" method="get">
                            @csrf
                            <div class="form__input-text">
                                <select class="search-form__shop" name="shop_id">
                                <option disabled selected>選択してください</option>
                                @foreach ($shops as $eachShop)
                                <option value="{{ $eachShop->id }}" {{ (old('shop_id') == $eachShop->id || (isset($shop) && $shop->id == $eachShop->id)) ? 'selected' : '' }}>{{ $eachShop->shop_name }}
                                </option>
                                @endforeach
                                </select>
                            </div>
                            <div class="search-form__button">
                                <button class="search-form__button-submit" type="submit">選 択</button>
                            </div>
                            </form>
                    </div>
                </div>

                <div class="registration__inner1">
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

                <div class="registration__inner2">
                    <form class="registration-form" action="/shopupdate" method="post" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <div class="registration-form__group">
                                <div class="form__group-title">
                                    <span class="form__label">店名</span>
                                </div>
                                <div class="form__input-text">
                                    <input type="text" name="shop_name" value="{{ old('shop_name', $shop->shop_name ?? '') }}">
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
                                        <option value="{{ $area->id }}" {{ old('area_id', $shop->area_id ?? '') == $area->id ? 'selected' : '' }}>{{ $area->area }}</option>
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
                                        <option value="{{ $genre->id }}" {{ old('genre_id', $shop->genre_id ?? '') == $genre->id ? 'selected' : '' }}>{{ $genre->genre }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="registration-form__group">
                                <div class="form__group-title">
                                    <span class="form__label">特徴</span>
                                </div>
                                <div class="form__input-text">
                                    <textarea name="feature">{{ old('feature', $shop->feature ?? '') }}</textarea>
                                </div>
                            </div>

                            <div class="registration-form__group">
                                <div class="form__group-title">
                                    <span class="form__label">画像</span>
                                </div>
                                <div class="form__input-text">
                                    <input type="file" name="image">{{ old('image', $shop->image ?? '') }}
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="shop_id" value="{{ $shop->id ?? '' }}">

                        <div class="search-form__button">
                            <button class="search-form__button-submit" type="submit">更新する</button>
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

                @if (isset($success))
                <div class="alert alert-success">
                {{ $success }}
                </div>
                @endif

            </div>
        </div>
    </div>

    <div class="myshop_reservation">
        <div class="myshop_reservation__heading">
            <h2>{{ $user->name }}さん</h2>
        </div>
        <div class="myshop_reservation__heading">
            <h3>予約情報</h3>
        </div>
        <div class="flex__item">
            <table class="table_inner">
                <tr class="table_row">
                    <th class="table_header">予約ID</th>
                    <th class="table_header">店名</th>
                    <th class="table_header">予約日</th>
                    <th class="table_header">予約時間</th>
                    <th class="table_header">予約者名</th>
                    <th class="table_header">予約人数</th>
                </tr>
                @foreach ($reservations as $reservation)
                <tr class="table_row">
                    <td class="table_item">{{ $reservation['id']}}</td>
                    <td class="table_item">{{ $reservation->shop->shop_name }}</td>
                    <td class="table_item">{{ $reservation['date']}}</td>
                    <td class="table_item">{{ \Carbon\Carbon::parse($reservation['time'])->format('H:i') }}</td>
                    <td class="table_item">{{ $reservation->user->name }}</td>
                    <td class="table_item">{{ $reservation['number']}}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection

<style>
    .registration__inner1,
    .registration__inner2 {
        display: none;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const formNew = document.querySelector('.registration__inner1');
    const formUpdate = document.querySelector('.registration__inner2');
    const radioNew = document.getElementById('new');
    const radioUpdate = document.getElementById('update');

    function toggleForm() {
        if (radioNew.checked) {
            formNew.style.display = 'block';
            formUpdate.style.display = 'none';
        } else if (radioUpdate.checked) {
            formNew.style.display = 'none';
            formUpdate.style.display = 'block';
        }
    }

    // 初期実行
    toggleForm();

    // イベントバインド
    radioNew.addEventListener('change', toggleForm);
    radioUpdate.addEventListener('change', toggleForm);
});
</script>