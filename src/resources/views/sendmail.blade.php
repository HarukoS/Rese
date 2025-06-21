@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sendmail.css') }}">
@endsection

@section('content')

<div class="send-form">
    <div class="send-form__heading"><h2>メールの送信</h2></div>
        <div class="send-form__content">
            <form class="form" action="{{ route('send.email') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="form__group">
                    <div class="form__group-title">
                        <label for="subject">件名</label>
                    </div>
                    <div class="form__group-content">
                        <input type="text" name="subject" id="subject" required>
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__group-title">
                        <label for="message_content">メッセージ内容</label>
                    </div>
                    <div class="form__group-content">
                        <textarea name="message_content" id="message_content" required></textarea>
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__group-title">
                        <label for="attachment">添付ファイル</label>
                    </div>
                    <div class="form__group-content">
                        <input class="attachment" type="file" name="attachment" id="attachment">
                    </div>
                </div>

                <div class="form__button">
                    <button class="form__button-submit" type="submit">送信</button>
                </div>

            </form>
        </div>
    </div>
    @if (session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
    @endif
</div>
@endsection
