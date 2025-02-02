@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register-form__content">
    <div class="register-form__heading">
        Registration
    </div>
    <form class="form" action="{{ route('register') }}" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-icon">
                <img src="{{ asset('img/name.jpeg') }}" alt="name"></img>
            </div>
            <div class="form__group-text">
                <div class="form__group-title">
                    <span class="form__label-item">Username</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input-text">
                        <input type="text" name="name" value="{{ old('name') }}" />
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
                        <input type="email" name="email" value="{{ old('email') }}" />
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
@endsection