@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="mypage">
    <div class="my_reservation">
        <div class="my_reservation__heading">
            <h3>予約状況</h3>
        </div>
        @foreach ($reservations as $key => $reservation)
        <div class="reservation-info">
            <div class="reservation-info__heading">
                <img class="img" src="img/clock.png" alt="clock">
                <div class="reservation_number">予約{{$key+1}}</div>
                <input type="radio" id="modal1Toggle" name="modalToggle" class="modal-toggle">
                <a href="#modal1&{{$reservation->id}}" class="open-modal__button"><img class="img" src="img/cancel.png" alt="cancel"></a>
            </div>
            <table class="reservation-table__inner">
                <tr class="reservation-table__row">
                    <th class="reservation-table__header">Shop</th>
                    <td class="reservation-table__text">{{ $reservation->shop->shop_name }}</td>
                </tr>
                <tr class="reservation-table__row">
                    <th class="reservation-table__header">Date</th>
                    <td class="reservation-table__text">{{ $reservation['date'] }}</td>
                </tr>
                <tr class="reservation-table__row">
                    <th class="reservation-table__header">Time</th>
                    <td class="reservation-table__text">{{ \Carbon\Carbon::parse($reservation['time'])->format('H:i') }}</td>
                </tr>
                <tr class="reservation-table__row">
                    <th class="reservation-table__header">Number</th>
                    <td class="reservation-table__text">{{ $reservation['number'] }}人</td>
                </tr>
            </table>
            <div class="update__button">
                <input type="radio" id="modal2Toggle" name="modalToggle" class="modal-toggle">
                <a href="#modal2&{{$reservation->id}}" class="open-update__button">予約変更</a>
            </div>
        </div>

        <div class="modal" id="modal1&{{$reservation->id}}">
            <a href="#" class="modal__close-btn-submit"><img class="img_close-btn" src="img/close.png" alt="close"></a>
            <div class="modal__message">予約をキャンセルしますか？</div>
            <div class="modal__inner">
                <form class="modal__detail-form" action="/reservation/delete" method="post">
                    @csrf
                    <div class="modal__content">
                        <div class="modal-form__group">
                            <label class="modal-form__label" for="">Shop</label>
                            <p>{{ $reservation->shop->shop_name }}</p>
                        </div>

                        <div class="modal-form__group">
                            <label class="modal-form__label" for="">Date</label>
                            <p>{{ $reservation['date'] }}</p>
                        </div>

                        <div class="modal-form__group">
                            <label class="modal-form__label" for="">Time</label>
                            <p>{{ \Carbon\Carbon::parse($reservation['time'])->format('H:i') }}</p>
                        </div>

                        <div class="modal-form__group">
                            <label class="modal-form__label" for="">Number</label>
                            <p>{{ $reservation['number'] }}人</p>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="{{ $reservation->id }}">
                    <input class="modal-form__btn" type="submit" value="キャンセルする">
                </form>
            </div>
        </div>

        <div class="modal" id="modal2&{{$reservation->id}}">
            <a href="#" class="modal__close-btn-submit"><img class="img_close-btn" src="img/close.png" alt="close"></a>
            <div class="modal__message">予約を変更しますか？</div>
            <div class="modal__inner">
                <form class="modal__detail-form" action="/reservation/update" method="post">
                    @csrf
                    <div class="modal__content">
                        <div class="modal-form__group">
                            <label class="modal-form__label" for="">Shop</label>
                            <p>{{ $reservation->shop->shop_name }}</p>
                        </div>

                        <div class="modal-form__group">
                            <label class="modal-form__label" for="">Date</label>
                            <input class="select__date" id="selectDate" type="date" name="date" value="{{ $reservation['date'] }}">
                        </div>

                        <div class="modal-form__group">
                            <label class="modal-form__label" for="">Time</label>
                            <select class="select__time" id="selectTime" name="time">
                                <option value="{{ $reservation['time'] }}" selected>{{ \Carbon\Carbon::parse($reservation['time'])->format('H:i') }}</option>
                                <option value="00:00">00:00</option>
                                <option value="00:30">00:30</option>
                                <option value="01:00">01:00</option>
                                <option value="01:30">01:30</option>
                                <option value="02:00">02:00</option>
                                <option value="02:30">02:30</option>
                                <option value="03:00">03:00</option>
                                <option value="03:30">03:30</option>
                                <option value="04:00">04:00</option>
                                <option value="04:30">04:30</option>
                                <option value="05:00">05:00</option>
                                <option value="05:30">05:30</option>
                                <option value="06:00">06:00</option>
                                <option value="06:30">06:30</option>
                                <option value="07:00">07:00</option>
                                <option value="07:30">07:30</option>
                                <option value="08:00">08:00</option>
                                <option value="08:30">08:30</option>
                                <option value="09:00">09:00</option>
                                <option value="09:30">09:30</option>
                                <option value="10:00">10:00</option>
                                <option value="10:30">10:30</option>
                                <option value="11:00">11:00</option>
                                <option value="11:30">11:30</option>
                                <option value="12:00">12:00</option>
                                <option value="12:30">12:30</option>
                                <option value="13:00">13:00</option>
                                <option value="13:30">13:30</option>
                                <option value="14:00">14:00</option>
                                <option value="14:30">14:30</option>
                                <option value="15:00">15:00</option>
                                <option value="15:30">15:30</option>
                                <option value="16:00">16:00</option>
                                <option value="16:30">16:30</option>
                                <option value="17:00">17:00</option>
                                <option value="17:30">17:30</option>
                                <option value="18:00">18:00</option>
                                <option value="18:30">18:30</option>
                                <option value="19:00">19:00</option>
                                <option value="19:30">19:30</option>
                                <option value="20:00">20:00</option>
                                <option value="20:30">20:30</option>
                                <option value="21:00">21:00</option>
                                <option value="21:30">21:30</option>
                                <option value="22:00">22:00</option>
                                <option value="22:30">22:30</option>
                                <option value="23:00">23:00</option>
                                <option value="23:30">23:30</option>
                            </select>
                        </div>

                        <div class="modal-form__group">
                            <label class="modal-form__label" for="">Number</label>
                            <select class="select__number" id="selectNumber" name="number">
                                <option value="{{ $reservation['number'] }}" selected>{{ $reservation['number'] }}</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="{{ $reservation->id }}">
                    <input class="modal-form__btn" type="submit" value="変更する">
                </form>
            </div>
        </div>

        @endforeach
    </div>

    <div class="my_favorite">
        <div class="my_favorite__heading">
            <h2>{{ $user->name }}さん</h2>
        </div>
        <div class="my_favorite__heading">
            <h3>お気に入り店舗</h3>
        </div>
        <div class="flex__item">
            @foreach ($likes as $like)
            <div class="shop__card">
                <div class="card__img">
                    <img src="img/{{$like['shop_id']}}.jpg" alt="shop_img" />
                </div>
                <div class="card__content">
                    <div class="card__name">{{ $like->shop->shop_name }}</div>
                    <div class="card__tag">#{{ $like->shop->area->area }} #{{ $like->shop->genre->genre }}</div>
                    <div class="card__detail">
                        <div class="card__detail-btn">
                            <form action="/detail" method="post">
                                @csrf
                                <input type="hidden" name="shop_id" value="{{ $like->shop->id }}">
                                <button class="card__detail-btn-submit" type="submit">詳しく見る</button>
                            </form>
                        </div>
                        <div class="card__like">
                            <form action="/deletelike" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $like['id'] }}">
                                <button class="heart__btn" type="submit"><img class="heart__img" src="img/heart_red.png" alt="お気に入り" /></button>
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