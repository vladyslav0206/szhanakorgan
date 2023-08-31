$(document).ready(function(){

    $('.call-menu').on('click', function () {
        $('.nav-mobile').addClass('nav-showed');
    });

    $('.close-menu').on('click', function () {
        $('.nav-mobile').removeClass('nav-showed');
    });

});
$(function () {
    $('.call-answer').on('click', function () {
        var answer = $(this).next();
        $(this).closest('.answer-item').not(answer).slideUp(400);
        answer.slideToggle(400);
    });

});




