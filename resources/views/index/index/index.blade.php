@extends('index.layout.layout')

@section('content')

    <section class="main-top">
        <div class="container-fluid">
            <div class="row">
                <div class="bg-main">
                    <img src="{{ asset('/images/%20main_imagebox.jpeg') }}" alt="">
                </div>
            </div>
        </div>
    </section>
   <!-- <section class="booking-box">
        <div id="notify">К сожалению свободных мест нет</div>
        <div class="container">
            <div class="booking-cover">
                <form action="#" class="book-form">
                    <div class="book-item">
                        <span>Дата заезда</span>
                        <input type="text" name="" class="datetime-picker" value="01/01/2020">
                    </div>
                    <div class="book-item">
                        <span>Дата выезда</span>
                        <input type="text" name="" class="datetime-picker" value="30/04/2020">
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
                            @foreach($rooms as $value)
                                <option value="<?=$value['id']?>"><?=$value['name']?></option>
                            @endforeach
                        </select>
                    </div>
                    @if($booked_status === '1')
                    <a href="#" class="btn-plain btn-book booked">Забронировать</a>
                    @else
                     <a href="/book" class="btn-plain btn-book">Забронировать</a>
					<!-- <a href="#" class="btn-plain btn-book">Забронировать</a> --
                    @endif
                </form>
            </div>
        </div>
    </section> -->
	<section class="container">
</section>
    <section class="room-box">
        <div class="container">
            <div id="mixedSlider">
                <div class="MS-content">
                @foreach($rooms as $room)
                <div class="item">

                    <a href="/rooms">
                        <div class="room-item">
                            <div class="room-item-img">
                                <img src="images/{{$room->image}}" alt="">
                            </div>
                            <!-- <div class="room-item-caption">
                                <h2>{{$room->name}}</h2>
                            </div> -->
                        </div>
                    </a>

                </div>
                @endforeach
                </div>
                <div class="MS-controls">
                    <button class="MS-left"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
                    <button class="MS-right"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
                </div>
            </div>
        </div>
    </section>
    <section class="treatment-box hidden">
        <div class="container">
            <div class="block-cover"><h2 class="block-title-bordered">Информация о пользе лечения</h2></div>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="treatment-item treatment-item-big bg-grey">
                        <div class="treatment-item-title">
                            <img src="styles/img/icon/intestines.png" alt="">
                            <h3>@if(!is_null($info1head)) {!! $info1head->description !!} @endif</h3>
                        </div>
                        <div class="treatment-item-caption">
                            <p>@if(!is_null($info1text)) {!! $info1text->description !!} @endif</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="treatment-item bg-grey mb30">
                        <div class="treatment-item-title">
                            <img src="styles/img/icon/brain.png" alt="">
                            <h3>@if(!is_null($info2head)) {!! $info2head->description !!} @endif</h3>
                        </div>
                        <div class="treatment-item-caption">
                            <p>@if(!is_null($info2text)) {!! $info2text->description !!} @endif</p>
                        </div>
                    </div>
                    <div class="treatment-item bg-grey">
                        <div class="treatment-item-title">
                            <img src="styles/img/icon/kidneys.png" alt="">
                            <h3>@if(!is_null($info3head)) {!! $info3head->description !!} @endif</h3>
                        </div>
                        <div class="treatment-item-caption">
                            <p>@if(!is_null($info3text)) {!! $info3text->description !!} @endif</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="about-box">
        <div class="container">
            <div class="block-cover"><h2 class="block-title-bordered">@if(!is_null($info_about_head)) {!! $info_about_head->description !!} @endif</h2></div>
            <iframe width="100%" height="450" src="https://www.youtube.com/embed/6io7dwwMATM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <div class="row">
                <div class="col-md-5 col-sm-5">
                    <div class="about-item">
                        <div class="about-item-caption">
                            <p>@if(!is_null($info_about1)) {!! $info_about1->description !!} @endif</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-sm-7">
                    <div class="about-item">
                        <div class="about-item-img">
                            <img src="styles/img/main/Rectangle%202.png" alt="" class="img-height-400">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row relative-top-40">
                <div class="col-md-6 col-sm-6">
                    <div class="about-item">
                        <div class="about-item-img">
                            <img src="styles/img/main/Rectangle%202.1.png" alt="" class="img-height-384">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="about-item">
                        <div class="about-item-caption pt80">
                            <p>@if(!is_null($info_about2)) {!! $info_about2->description !!} @endif</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="about-item">
                        <div class="about-item-caption">
                            <p>@if(!is_null($info_about3)) {!! $info_about3->description !!} @endif</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="about-item">
                        <div class="about-item-caption">
                            <p>@if(!is_null($info_about4)) {!! $info_about4->description !!} @endif</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="about-item">
                        <div class="about-item-img">
                            <img src="styles/img/main/Rectangle%202.2.png" alt="" class="img-height-566">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <section class="callback-box bg-mustard">
        <div class="container">
            <h2 class="block-title-white">Закажите обратный звонок</h2><div id="status"></div>
            <div class="callback-cover">
                <div  class="callback-form">
                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="lastname" id="lastname" value=" ">
                    <input type="hidden" name="email" id="email" value=" ">
                    <input type="hidden" name="date_in" id="date_in" value=" ">
                    <input type="hidden" name="date_out" id="date_out" value=" ">
                    <input type="hidden" name="guest_num" id="guest_num" value=" ">
                    <input type="text" name="name" id="name" placeholder="Имя" class="bordered-right">
                    <input type="text" name="phone" id="phone" placeholder="Телефон">
                    <button  class="btn-plain btn-blue submit3">Отправить</button>
                </div>
            </div>
        </div>
    </section> --}}
    <section class="spec-box">
        <div class="container">
            <div class="block-cover"><h2 class="block-title-bordered">Специалисты</h2></div>
            <div class="sl-spec">
                @foreach($specialists as $item)
                    <a href="specialist/{{$item->id}}">
                    <div class="room-item spec-item">
                        <div class="room-item-img">
                            <img src="images/{{$item->image}}" alt="">
                        </div>
                        <div class="room-item-caption">
                           <h2>{{$item->name}}</h2> 
                            <span>{{$item->spec}}</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    <section class="gallery-box selector1 gallery">
        <div class="container">
        <div class="gallery-cover" style="width: 97.44%;">

        <a href="https://szhanakorgan.kz/images/WhatsApp%20Image%202022-11-30%20at%2011.54.13.jpeg" class="gall_image">
            <div class="gallery-item gallery-item-type-1 mr30 item" data-src="https://szhanakorgan.kz/images/WhatsApp%20Image%202022-11-30%20at%2011.54.13.jpeg">
                <img src="https://szhanakorgan.kz/images/WhatsApp%20Image%202022-11-30%20at%2011.54.13.jpeg" alt="">
            </div>
        </a>
        <a href="http://szhanakorgan.kz/images/12.jpg" class="gall_image">
            <div class="gallery-item gallery-item-type-2 mr30 item" data-src="http://szhanakorgan.kz/images/12.jpg">
                <img src="http://szhanakorgan.kz/images/12.jpg" alt="">
            </div>
        </a>
        <a href="http://szhanakorgan.kz/images/12.jpg" class="gall_image">
            <div class="gallery-item gallery-item-type-3" data-src="http://szhanakorgan.kz/images/12.jpg">
                <img src="http://szhanakorgan.kz/images/12.jpg" alt="">
            </div>
        </a>
        <a href="http://szhanakorgan.kz/images/100001.png" class="gall_image">
            <div class="gallery-item gallery-item-type-4 mr30 item" data-src="http://szhanakorgan.kz/images/100001.png">
                <img src="http://szhanakorgan.kz/images/100001.png" alt="">
            </div>
        </a>
        <a href="http://szhanakorgan.kz/images/14.jpg" class="gall_image">
            <div class="gallery-item gallery-item-type-5 mr30 item" data-src="http://szhanakorgan.kz/images/14.jpg">
                <img src="http://szhanakorgan.kz/images/14.jpg" alt="">
            </div>
        </a>
        <a href="http://szhanakorgan.kz/images/321456987 (5)-min.JPG" class="gall_image">
            <div class="gallery-item gallery-item-type-6 mr30 item" data-src="http://szhanakorgan.kz/images/321456987 (5)-min.JPG">
                <img src="http://szhanakorgan.kz/images/321456987 (5)-min.JPG" alt="">
            </div>
        </a>
        <a href="http://szhanakorgan.kz/images/19.jpg" class="gall_image">
            <div class="gallery-item gallery-item-type-6 item" data-src="http://szhanakorgan.kz/images/19.jpg" style="float: right;">
                <img src="http://szhanakorgan.kz/images/19.jpg" alt="">
            </div>
        </a>
        <div class="clearfix"></div>
        <div class="gallery-all hidden-md">
            <a href="/gallery">Смотреть все фотографии</a>
            <a href="/gallery"><i class="icon i-arrow-big"></i></a>
        </div>
    </div>
    </div>
</section>
    <section class="review">
        <div class="container">
            <div class="block-cover"><h2 class="block-title-bordered">Отзывы</h2></div>
            <div class="sl-review">
                @foreach($feedback as $item)

                        <div class="review-item">
                            <p>{!! $item->description !!}</p>
                            <span>{{$item->name}}</span>
                        </div>

                @endforeach
            </div>
        </div>
    </section>
    <script src="styles/js/libs.min.js"></script>
    <script src="styles/js/moment.min.js"></script>
    <script src="styles/js/daterangepicker.js"></script>
    <script>
        $('.datetime-picker').daterangepicker({
            singleDatePicker: true,
            "showDropdowns": true,
            showDropdowns: true,
            "locale": {
                "format": "DD/MM/YYYY",
                "daysOfWeek": [
                    "Пн",
                    "Вт",
                    "Ср",
                    "Чт",
                    "Пт",
                    "Сб",
                    "Вс"
                ],
                "separator": "-",
                "monthNames": [
                    "Январь",
                    "Февраль",
                    "Март",
                    "Апрель",
                    "Май",
                    "Июнь",
                    "Июль",
                    "Август",
                    "Сентябрь",
                    "Октябрь",
                    "Ноябрь",
                    "Декабрь"
                ],
                "firstDay": 0
            }
        });
        // $('.datetime-picker').daterangepicker({
        //     singleDatePicker: true,
        //     autoUpdateInput: false,
        //     locale: {
        //         "format": "DD/MM/YYYY",
        //         "separator": " - ",
        //         "applyLabel": "Применить",
        //         "cancelLabel": "Отмена",
        //         "fromLabel": "De",
        //         "toLabel": "RU",
        //         "customRangeLabel": "Custom",
        //         "daysOfWeek": [
        //             "Пн",
        //             "Вт",
        //             "Ср",
        //             "Чт",
        //             "Пт",
        //             "Сб",
        //             "Вс"
        //         ],
        //         "monthNames": [
        //             "Январь",
        //             "Февраль",
        //             "Март",
        //             "Апрель",
        //             "Май",
        //             "Июнь",
        //             "Июль",
        //             "Август",
        //             "Сентябрь",
        //             "Октябрь",
        //             "Ноябрь",
        //             "Декабрь"
        //         ],
        //         "firstDay": 0
        //     }
        // });
    </script>
    <script src="{{ asset('styles/js/common.js') }}" ></script>
    <script src="{{ asset('js/common.js') }}" ></script>

@endsection
