@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
@foreach ($shop_details as $shop_detail)
<div class="reservation">
    <div class="shop__detail">
        <div class="shop__detail-title">
            <div class="back__button">
                <button class="back__button-submit" type="button" onClick="history.back()">&lt;</button>
            </div>
            <div class="shop__name">{{ $shop_detail['shop_name'] }}</div>
        </div>
        <div class="shop__img">
            <img src="img/{{$shop_detail['id']}}.jpg" alt="shop_img" />
        </div>
        <div class="tag">
            <p class="tag_area">#{{ $shop_detail->area->area }}</p>
            <p class="tag_genre">#{{ $shop_detail->genre->genre }}</p>
        </div>
        <div class="shop__introduction">{{ $shop_detail['feature'] }}</div>
    </div>
    <div class="shop__reservation">
        <div class="reservation-form__heading">
            <h2>予約</h2>
        </div>
        <form class="reservation-form__input" action="/reservation" method="post">
            @csrf
            <div class="form__group">
                <div class="form__group-content">
                    <input type="hidden" name="shop_id" value="{{ $shop_detail['id'] }}">
                    <div class="form__select">
                        <input class="select__date" id="selectDate" type="date" name="date">
                    </div>
                    <div class="form__select">
                        <select class="select__time" id="selectTime" name="time">
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
                    <div class="form__select">
                        <select class="select__number" id="selectNumber" name="number">
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
                    <div class="confirm-table">
                        <table class="confirm-table__inner">
                            <tr class="confirm-table__row">
                                <th class="confirm-table__header">Shop</th>
                                <td class="confirm-table__text">{{ $shop_detail['shop_name'] }}</td>
                            </tr>
                            <tr class="confirm-table__row">
                                <th class="confirm-table__header">Date</th>
                                <td class="confirm-table__text"><span id="outputDate"></span></td>
                            </tr>
                            <tr class="confirm-table__row">
                                <th class="confirm-table__header">Time</th>
                                <td class="confirm-table__text"><span id="outputTime"></span></td>
                            </tr>
                            <tr class="confirm-table__row">
                                <th class="confirm-table__header">Number</th>
                                <td class="confirm-table__text"><span id="outputNumber"></span></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="form__button">
                    <button class="form__button-submit" type="submit">予約する</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('selectDate').addEventListener('change', function() {
        var selectedValue = this.value;

        document.getElementById('outputDate').textContent = selectedValue;
    });

    document.getElementById('selectTime').addEventListener('change', function() {
        var selectedValue = this.value;

        document.getElementById('outputTime').textContent = selectedValue;
    });

    document.getElementById('selectNumber').addEventListener('change', function() {
        var selectedValue = this.value;

        document.getElementById('outputNumber').textContent = selectedValue + '人';
    });
</script>

@endforeach
@endsection