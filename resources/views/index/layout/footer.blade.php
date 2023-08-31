<footer class="bg-dark-blue">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3">
                <div class="logo">
                    <a href="index.html" class="logo-box">
                        <img src="/img/logo/logo.png" alt="logo">
                    </a>
                </div>
                <h3 class="block-title-md">Мы в социальных сетях</h3>
                <ul class="social-link">
                    <li><a href="https://www.instagram.com/sanatoria_zhanakorgan/"><i class="fab fa-instagram"></i></a>
                    </li>
                    <li><a href="https://vk.com/id368943311"><i class="fab fa-vk"></i></a></li>
                    <li><a href="https://www.facebook.com/profile.php?id=100008388553765"><i
                                    class="fab fa-facebook-f"></i></a></li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-3">
                <h3 class="title-border">МЕНЮ</h3>
                <ul class="footer-menu">
                    <li><a href="#">Галерея</a></li>
                    <li><a href="#"> Номера</a></li>
                    <li><a href="#">О санатории</a></li>
                    <li><a href="#">Услуги</a></li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-3">
                <h3 class="title-border">СВЯЖИТЕСЬ С НАМИ</h3>
                <ul class="footer-menu">
                    <li><a href="#">+7 778 259 06 04</a></li>
                    <li><a href="https://api.whatsapp.com/send?phone=77782590604">+7 778 259 0604 (Whatsapp)</a></li>
                    <li><a href="#">info@zhanakorgan.com</a></li>
                    <li><a href="#">Почта для обратной связи</a></li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-3">
                <div class="copyright">
                    <p>
                        Пользовательское соглашение<br>
                        Политика конфиденциальности<br>
                        2019 Санаторий Жанакорган<br>
                        Сайт разработан и продвигается в <a href="https://minialgo.kz/" target="_blank">Minialgo</a>
                    </p>
                </div>

            </div>
        </div>
    </div>
</footer>
<script src="/styles/js/libs.min.js"></script>
<script src="/styles/slick/slick.js"></script>
<script src="/styles/js/moment.min.js"></script>
<script src="/styles/js/daterangepicker.js"></script>
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
    $('.sl-review').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows: true,
        dots: true,
        customPaging: function (slider, i) {
            var thumb = $(slider.$slides[i]).data();
            if (i < 10) {
                return '<a>' + 0 + (i + 1) + '</a>';
            } else {
                return '<a>' + i + '</a>';
            }

        },
    });
    $('.sl-spec').slick({
        slidesToShow: 4,
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
<script src="/styles/js/lightgallery.min.js"></script>
<script src="/styles/js/lg-fullscreen.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.selector1').lightGallery({
            selector: '.item'
        });
    });
</script>
<script src="/styles/js/common.js"></script>
<script src="/js/common.js"></script>
<script src="js/multislider.js"></script>
<script>

    $(".booked").click(function () {
        $("#notify").show('fast');
        setTimeout(function () {
            $("#notify").hide('fast');
        }, 2000);
    });

    $('#mixedSlider').multislider({
        duration: 750,
        interval: 3000
    });

    $('.gall_image:lt(7)').show();
    var items = 200;
    var shown = 7;
    $('.more').click(function () {
        shown = $('.gall_image:visible').length + 7;
        if (shown < items) {
            $('.gall_image:lt(' + shown + ')').show(300);
        } else {
            $('.gall_image:lt(' + items + ')').show(300);
            $('.more').hide();
        }
    });
</script>