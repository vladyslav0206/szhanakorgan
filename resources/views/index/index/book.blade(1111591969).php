@extends('index.layout.layout')

@section('content')
    <section class="booking-box book">
        <div id="notify">К сожалению свободных мест нет</div>
        <div class="container">
            <div class="block-cover"><h2 class="block-title-bordered">Бронирование</h2></div><div id="status"></div>
            <form class="booking-cover" action="/book" method="post">
                @if($errors->any())
                    <h2 style="padding: 10px;text-align: center;background: antiquewhite;">{{$errors->first()}}</h2>
                @endif
                <div class="book-form">
                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

                    <div class="book-item">
                        <span>Дата заезда</span>
                        <input type="text" name="date_in" id="date_in" class="datetime-picker" value="01/01/2020">
                    </div>
                    <div class="book-item">
                        <span>Дата выезда</span>
                        <input type="text" name="date_out" id="date_out" class="datetime-picker" value="30/04/2020">
                    </div>
                    <div class="book-item">
                        <span>Количество человек</span>
                        <select name="guest_num" class="select-item" id="guest_num">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="10">Больше</option>

                        </select>
                    </div>
                    <div class="book-item">
                        <span>Категория</span>
                        <select name="room_id" class="select-item" id="room_id">
                            @foreach($categories as $value)
                            <option value="<?=$value['id']?>"><?=$value['name']?></option>
                            @endforeach
                        </select>
                    </div>
            </div>
            {{--<div class="book-cover">--}}
                {{--<div class="table-responsive">--}}
                    {{--<table class="table-book">--}}
                        {{--<thead>--}}
                        {{--<th>Вы выбрали</th>--}}
                        {{--<th>Номер</th>--}}
                        {{--<th>Описание</th>--}}
                        {{--<th>Стоимость</th>--}}
                        {{--</thead>--}}
                        {{--<tbody>--}}
                        {{--<tr>--}}
                            {{--<td>10 дней</td>--}}
                            {{--<td>Люкс</td>--}}
                            {{--<td>--}}
                                {{--<p class="room-desc-list">--}}
                                {{--</p>--}}
                            {{--</td>--}}
                            {{--<td>15 000 тг</td>--}}
                        {{--</tr>--}}
                        {{--</tbody>--}}
                    {{--</table>--}}
                {{--</div>--}}

                <h3>Заполните личные данные</h3>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="info-item">
                                <p>Имя</p>
                                <input type="text" name="name" placeholder="Имя" id="name">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="info-item">
                                <p>Фамилия</p>
                                <input type="text" name="lastname" placeholder="Фамилия" id="lastname">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="info-item">
                                <p>Номер телефона</p>
                                <input type="text" name="phone" placeholder="+7(___)-__-__" id="phone">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="info-item">
                                <p>Email</p>
                                <input type="text" name="email" placeholder=email" id="email">
                            </div>
                        </div>
                    </div>
                    @if($booked_status == '1') 
                    <button disabled class="btn-plain btn-book booked">
                        Забронировать
                    </button>
                    @else
                    <button disabled class="btn-plain btn-book submit3">
                        Забронировать
                    </button>
                    @endif
            </form>
        </div>
    </section>


@endsection

