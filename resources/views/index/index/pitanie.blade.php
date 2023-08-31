@extends('index.layout.layout')

@section('content')
    <section class="service-inside-box about">
        <div class="container">
            <div class="block-cover">
                <h2 class="block-title-bordered">{{ $text->name }}</h2>
            </div>
            <div class="about-cover">
                <img src="images/{{ $text->image }}" style="width: 100%;height: 100%;" alt="">
                @if(!is_null($text)) {!! $text->description !!} @endif

            </div>
        </div>
    </section>
    <section class="about-slide">
        <div class="container">
            <div class="sl-about">
                @foreach($row_img as $key => $val)
                    <div class="sl-item">
                        <img src="/images/{{$val->image}}" alt="">
                    </div>
                 @endforeach
            </div>
        </div>
    </section>
    <script src="styles/js/libs.min.js"></script>
    <script src="styles/slick/slick.js"></script>
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
    </script>
@endsection