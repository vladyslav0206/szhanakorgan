@extends('index.layout.layout')
@section('content')
    <section class="service-inside-box">
        <div class="container">
            <div class="block-cover"><h2 class="block-title-bordered">{{$specialist->name}}</h2></div>
            <div class="row">
                <div class="col-md-5 col-sm-5">
                    <div class="service-inside">
                        <div class="service-inside-img">
                            <img src="/images/{{$specialist->image}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-sm-7">
                    <div class="service-inside">
                        <div class="service-inside-caption">
                            @if(!is_null($specialist)) {!! $specialist->description !!} @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <section class="callback-box bg-mustard">
        <div class="container">
            <h2 class="block-title-white">Закажите обратный звонок</h2>
            <div class="callback-cover">
                <form action="#" class="callback-form">
                    <input type="text" placeholder="Имя" class="bordered-right">
                    <input type="text" placeholder="Телефон">
                    <button class="btn-plain btn-blue">Отправить</button>
                </form>
            </div>
        </div>
    </section> --}}
@endsection