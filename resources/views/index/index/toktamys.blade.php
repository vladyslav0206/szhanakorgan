@extends('index.layout.layout')

@section('content')
<style>
    .sl-spec .slick-slide {
        min-height: 809px;
    }
</style>

 <section class="room-box room">
        <div class="container">
            <div class="block-cover"><h2 class="block-title-bordered">Номера</h2></div>
                <div class="sl-spec">
                    @foreach($rooms as $key => $item)
                        <div class="col-md-4 col-sm-4">
                            <div class="room-item">
                                <div class="room-item-img">
                                    <img src="images/{{$item->image}}" alt="">
                                </div>
                                <div class="room-item-caption">
                                    <h2>{{$item->name}}</h2>
                                </div>
                            </div>
                            <div class="room-detail">
                                {!!$item->description  !!}
                                <p>{{$item->price}}</p>
                                <a class="styles/btn-plain btn-book" href="/book">Забронировать</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
    </section>
    <section class="room-info bg-grey">
        <div class="container">
            <div class="block-cover"><h2 class="block-title-bordered">Курс лечения</h2></div>
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="room-info-item">
                        10
                        <span>дней</span>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="room-info-item">
                        14
                        <span>дней</span>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="room-info-item">
                        20
                        <span>дней</span>
                    </div>
                </div>
            </div>
            <div class="block-cover"><h2 class="block-title-bordered">В стоимость входит</h2></div>
            <div class="row row-flex">
                <div class="col-md-4 col-sm-4">
                    <div class="room-info-item">
                        <i class="icon i-bed"></i>
                        <p>Проживание</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="room-info-item">
                        <i class="icon i-fork"></i>
                        <p>Питание</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="room-info-item">
                        <i class="icon i-medical"></i>
                        <p>Лечение</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="room-info">
        <div class="container">
            <div class="block-cover"><h2 class="block-title-bordered">Правила проживания</h2></div>
            <div class="room-rules">
                <ul class="room-rules-list">
                    {!!$room_rules->description  !!}
                </ul>
                <span>Приобретая путевку, вы соглашаетесь с правилами Санатория АО «Жанакорган»</span>
            </div>
        </div>
    </section>
<section class="about-slide">
    <div class="container">
        <div class="sl-about">
            @foreach($images as $v)
                <div class="sl-item">
                    <img src="/images/{{$v->image}}">
                </div>
            @endforeach
        </div>
    </div>
</section>
    <script src="/styles/js/libs.min.js"></script>
    <script src="/styles/slick/slick.js"></script>
    <script>
        //  SLIDER
        $('.sl-about').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            arrows: true,
            centerMode: false,
            responsive: [
                {
                    breakpoint: 1190,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        centerMode: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        centerMode: true,
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
        
        $('.sl-spec').slick({
        slidesToShow: 3});
        
    </script>
    <script src="styles/js/libs.min.js"></script>
    <script src="styles/js/moment.min.js"></script>
    <script src="styles/js/daterangepicker.js"></script>
    <script src="{{ asset('styles/js/common.js') }}" ></script>
    <script src="{{ asset('js/common.js') }}" ></script>
    </body>
    </html>

@endsection