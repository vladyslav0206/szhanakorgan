@extends('index.layout.layout')

@section('content')
    <section class="gallery-box selector1 gallery">
        <div class="container">
        <div class="block-cover"><h2 class="block-title-bordered">Галерея</h2></div>
        <div class="gallery-cover">
            <?php $cnt = 0;?>
            @foreach($row as $key => $val)
                <?php $cnt++; ?>
                @if($cnt <= 6)
                    <a href="#" class="gall_image">
                        <div class="gallery-item gallery-item-type-{{$cnt}} mr30 item" data-src="/images/{{$val->image}}">
                            <img src="/images/{{$val->image}}" alt="">
                        </div>
                    </a>
                @elseif($cnt == 7)
                     <a href="#"  class="gall_image">
                        <div class="gallery-item gallery-item-type-6 mr30 item" data-src="/images/{{$val->image}}">
                            <img src="/images/{{$val->image}}" alt="">
                        </div>
                    </a>
                @else
                <?php $cnt = 1; ?>
                    <a href="#"  class="gall_image">
                        <div class="gallery-item gallery-item-type-{{$cnt}} mr30 item" data-src="/images/{{$val->image}}">
                            <img src="/images/{{$val->image}}" alt="">
                        </div>
                    </a>
                @endif
            @endforeach
        </div>
        <div class="clearfix"></div>
        <div class="gallery-all">
            <a class="more">Смотреть все фотографии</a>
            <a class="more"><i class="icon i-arrow-big"></i></a>
        </div>
    </div>


    </section>


@endsection