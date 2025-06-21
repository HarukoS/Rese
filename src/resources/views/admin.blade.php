@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')

<div class="heading">
    <h2>店舗代表者管理画面</h2>
</div>

<div class="admin">

<div class="register-form__content">
    <div class="register-form__heading">
        Shop Owner Registration（店舗代表者登録）
    </div>
    <form class="form" action="/owner" method="post">
        @csrf
        <div class="form__group">
            <input type="hidden" name="role" value="2" />
            <div class="form__group-icon">
                <img src="{{ asset('img/name.jpeg') }}" alt="name"></img>
            </div>
            <div class="form__group-text">
                <div class="form__group-title">
                    <span class="form__label-item">Shop Owner Name</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input-text">
                        <input type="text" name="name" />
                    </div>
                </div>
            </div>
        </div>
        <div class="form__error">
            @error('name')
            {{ $message }}
            @enderror
        </div>
        <div class="form__group">
            <div class="form__group-icon">
                <img src="{{ asset('img/email.jpeg') }}" alt="email"></img>
            </div>
            <div class="form__group-text">
                <div class="form__group-title">
                    <span class="form__label-item">Email</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input-text">
                        <input type="email" name="email" />
                    </div>
                </div>
            </div>
        </div>
        <div class="form__error">
            @error('email')
            {{ $message }}
            @enderror
        </div>
        <div class="form__group">
            <div class="form__group-icon">
                <img src="{{ asset('img/pw.jpeg') }}" alt="pw"></img>
            </div>
            <div class="form__group-text">
                <div class="form__group-title">
                    <span class="form__label-item">Password</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input-text">
                        <input type="password" name="password" />
                    </div>
                </div>
            </div>
        </div>
        <div class="form__error">
            @error('password')
            {{ $message }}
            @enderror
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">登録</button>
        </div>
    </form>
</div>

<div class="list">
<div class="heading">
    <h3>店舗代表者登録一覧</h3>
</div>
<div class="owner-table">
    <table class="owner-table__inner">
        <tr class="owner-table__row">
            <th>名前</th>
            <th>メールアドレス</th>
            <th>登録日</th>
            <th></th>
        </tr>
        @foreach ($owners as $owner)
        <tr class="owner-table__row">
            <td>{{ $owner['name'] }}</td>
            <td>{{ $owner['email'] }}</td>
            <td>{{ $owner['created_at']->format('Y-m-d') }}</td>
            <td class="owner-table__item">
                <form class="delete-form" action="/owner/delete" method="post">
                @method('DELETE') @csrf
                    <div class="delete-form__button">
                        <input type="hidden" name="id" value="{{ $owner['id'] }}">
                        <button class="delete-form__button-submit" type="submit">
                        削除
                        </button>
                    </div>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
</div>

</div>
</div>

@endsection