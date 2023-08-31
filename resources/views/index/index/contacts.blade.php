@extends('index.layout.layout')

@section('content')
<section class="service-inside-box contact">
    <div class="container">
        <div class="block-cover"><h2 class="block-title-bordered">Контакты</h2></div>
        <div class="row">
            <div class="col-md-4 col-sm-4 pr0">
                <div class="contact-caption">
                    <span>Адрес:</span>
                    <p>{{$contact->address}}</p>
                    <span>Регистрация:</span>
                    <p>{{$contact->reg}}</p>
                    <p></p><a href="https://api.whatsapp.com/send?phone=77782590604">+7 778 259 0604 (Whatsapp)</a></p>
                    <span> Принимаем звонки</span>
                    <p>{{$contact->tel_time}}</p>
                    <p>Воскресенье: выходной</p>
                    <span> E-mail:</span>
                    <p>{{$contact->email}}</p>
                    <span>Бенефициар:</span>
                    <p>{{$contact->beneficiar}}</p>
                </div>
            </div>
            <div class="col-md-8 col-sm-8 pl0">
                <div class="contact-map">
                    <div id="map" style="width: 100%; height: 100%"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="js/libs.min.js"></script>
<script src="https://api-maps.yandex.ru/2.1/?apikey=<ваш API-ключ>&lang=ru_RU" type="text/javascript"></script>
<script type="text/javascript">
    // Функция ymaps.ready() будет вызвана, когда
    // загрузятся все компоненты API, а также когда будет готово DOM-дерево.
    ymaps.ready(init);

    function init() {
        // Создание карты.
        var myMap = new ymaps.Map("map", {
            // Координаты центра карты.
            // Порядок по умолчанию: «широта, долгота».
            // Чтобы не определять координаты центра карты вручную,
            // воспользуйтесь инструментом Определение координат.
            center: [43.905797, 67.242322],
            controls: ['zoomControl', 'geolocationControl'],
            // Уровень масштабирования. Допустимые значения:
            // от 0 (весь мир) до 19.
            zoom: 15
        });
        // Создаем геообъект с типом геометрии "Точка".
        myGeoObject = new ymaps.GeoObject({
            // Описание геометрии.
            geometry: {
                type: "Point",
                coordinates: [43.905797, 67.242322]
            },
            // Свойства.
            properties: {
                // Контент метки.
                iconContent: '',
                hintContent: ''
            }
        }, {
            // Опции.
            // Иконка метки будет растягиваться под размер ее содержимого.
            preset: 'islands#blackStretchyIcon',
            // Метку можно перемещать.
            draggable: true
        }),
            myPieChart = new ymaps.Placemark([
                55.847, 37.6
            ], {
                // Данные для построения диаграммы.
                data: [
                    {weight: 8, color: '#0E4779'},
                    {weight: 6, color: '#1E98FF'},
                    {weight: 4, color: '#82CDFF'}
                ],
                iconCaption: "Диаграмма"
            }, {
                // Зададим произвольный макет метки.
                iconLayout: 'default#pieChart',
                // Радиус диаграммы в пикселях.
                iconPieChartRadius: 30,
                // Радиус центральной части макета.
                iconPieChartCoreRadius: 10,
                // Стиль заливки центральной части.
                iconPieChartCoreFillStyle: '#ffffff',
                // Cтиль линий-разделителей секторов и внешней обводки диаграммы.
                iconPieChartStrokeStyle: '#ffffff',
                // Ширина линий-разделителей секторов и внешней обводки диаграммы.
                iconPieChartStrokeWidth: 3,
                // Максимальная ширина подписи метки.
                iconPieChartCaptionMaxWidth: 200
            });
        myMap.geoObjects
            .add(myGeoObject)
            .add(myPieChart)
            .add(new ymaps.Placemark([43.905797, 67.242322], {
                balloonContent: 'цвет <strong>носика Гены</strong>',
                iconCaption:
                    'пос. Жанакорган'
            }, {
                preset: 'islands#greenDotIconWithCaption'
            }));


    }
</script>
<script src="js/common.js"></script>
@endsection