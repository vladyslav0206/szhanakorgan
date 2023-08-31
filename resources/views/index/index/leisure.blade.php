@extends('index.layout.layout')

@section('content')
    <section class="service-inside-box service">
        <div class="container">
            <div class="block-cover"><h2 class="block-title-bordered">Досуг</h2></div>
            <div class="faq">
                @foreach($categories as $item)
                    <div class="item">
                        <div class="ask">
                            <div class="serv-item">
                                <h3>{{$item->name}}</h3>
                            </div>
                        </div>
                        <div class="answer">
                            <div class="row pt40 pb30">
                                @foreach($item->services() as $val)
                                    <div class="col-md-3 col-sm-6">
                                        <a href="service/{{$val->id}}">
                                            <div class="serv-relative">
                                                <div class="serv-item">
                                                    <h3>{{$val->name}}</h3>
                                                </div>
                                                <img src="images/{{$val->image}}" alt="">
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="gallery-all">
                <a href="#">Смотреть все услуги</a>
                <a href="#"><i class="icon i-arrow-big"></i></a>
            </div>
        </div>
    </section>
    <script src="styles/js/libs.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $('.faq .ask').on('click', function () {
                var answer = $(this).next();
                $('.faq .answer').not(answer).slideUp(400);
                answer.slideToggle(400);
            });
        });
    </script>
@endsection