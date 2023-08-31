var menu = document.getElementById('nav-menu');
var btnburger = document.getElementById('btn-burger');
function opennav() {
    menu.style.zIndex = '12';
   menu.style.opacity = '1';
}
function closenav() {
    menu.style.opacity = '0';
    menu.style.zIndex = '-1';

}

$('.slid-banners').slick({
    autoplay:true,
    autoplaySpped:10000,
    dots:false,
    arrows:false,
    fade:true
});

// button back-top
$(document).ready(function () {
    $(document).scroll(function () {
        if ($(document).scrollTop() > 20) {
            $('.back-top').css('display', 'block');
        } else {
            $('.back-top').css('display', 'none');
        }
    });

    $('.back-top').click(function (e) {
        e.preventDefault();
        $(document).scrollTop(0);
    })
});