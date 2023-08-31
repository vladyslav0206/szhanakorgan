/**
 * Created by Arman-PC on 21.12.2016.
 */


function showError(message){
    $.gritter.add({
        title: 'Ошибка',
        text: message
    });
    return false;
}

function showMessage(message){
    $.gritter.add({
        title: 'Успех',
        text: message,
        class_name: 'success-gritter'
    });
    return false;
}


KindEditor.ready(function(K) {
    K.create('.text_editor', {

        cssPath : [''],
        autoHeightMode : true, // это автоматическая высота блока
        afterCreate : function() {
            this.loadPlugin('autoheight');
        },
        allowFileManager : true,
        items : [// Вот здесь задаем те кнопки которые хотим видеть
            'source', '|', 'undo', 'redo', '|', 'preview', 'print', 'template', 'code', 'cut', 'copy', 'paste',
            'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
            'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
            'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
            'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
            'italic', 'underline','strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
            'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons','deliverybreak',
            'anchor', 'link',  'unlink','map', '|', 'about'
        ]
    });
    //Ниже инициализируем доп. например выбор цвета или загрузка файла
    var colorpicker;
    K('#colorpicker').bind('click', function(e) {
        e.stopPropagation();
        if (colorpicker) {
            colorpicker.remove();
            colorpicker = null;
            return;
        }
        var colorpickerPos = K('#colorpicker').pos();
        colorpicker = K.colorpicker({
            x : colorpickerPos.x,
            y : colorpickerPos.y + K('#colorpicker').height(),
            z : 19811214,
            selectedColor : 'default',
            noColor : 'Очистить',
            click : function(color) {
                K('#color').val(color);
                colorpicker.remove();
                colorpicker = null;
            }
        });
    });
    K(document).click(function() {
        if (colorpicker) {
            colorpicker.remove();
            colorpicker = null;
        }
    });

    var editor = K.editor({
        allowFileManager : true
    });
});

$('.datetimepicker-input').datetimepicker({
    format: 'DD.MM.YYYY HH:mm'
});

$('.datetimepicker-input').on('dp.show', function () { // Hack datepicker position
    var datepicker = $(this).siblings('.bootstrap-datetimepicker-widget');
    if (datepicker.hasClass('top')) {
        var top = $(this).offset().top - datepicker.height() - 130;
        datepicker.css({'top': top + 'px', 'bottom': 'auto'});
    }
});

$("#image_form").submit(function(event) {
    event.preventDefault();
    var formData = new FormData($(this)[0]);
    $.ajax({
        url:'/image/upload',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            $('.ajax-loader').css('display','none');
            if(data.success == 0){
                showError(data.error);
                return;
            }
            $('.image-name').val(data.file_name);
            $('.image-src').attr('src',data.file_name);

        }
    });
});

function uploadImage(){
    $('.ajax-loader').css('display','block');
    $("#image_form").submit();
}

function searchBySort() {
    href = '?search=' + $('#search_word').val();
    window.location.href = href;
}

$( "#search_word" ).keyup(function(event) {
    if (!event.ctrlKey && event.which == 13) {
        searchBySort();
    }
});

function isShowDisabledAll(model) {
    if(confirm('Действительно хотите сделать неактивным?')){
        $('.ajax-loader').fadeIn(100);
        $('.select-all').each(function(){
            if ($(this).is(':checked')) {
                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data :{
                        is_show: 0,
                        id: $(this).val()
                    },
                    url: "/admin/" + model + "/is_show",
                    success: function(data){
                        if(model == 'comment' || model == 'contact'){
                            getNewOrderCount();
                        }
                    }
                });
                $(this).closest('tr').remove();
            }
        });
        $('.ajax-loader').fadeOut(100);
    }
}

function isShowEnabledAll(model) {
    if(confirm('Действительно хотите сделать активным?')){
        $('.ajax-loader').fadeIn(100);
        $('.select-all').each(function(){
            if ($(this).is(':checked')) {
                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data :{
                        is_show: 1,
                        id: $(this).val()
                    },
                    url: "/admin/" + model + "/is_show",
                    success: function(data){
                        if(model == 'comment' || model == 'contact'){
                            getNewOrderCount();
                        }
                    }
                });
                $(this).closest('tr').remove();
            }
        });
        $('.ajax-loader').fadeOut(100);
    }
}

function deleteAll(model) {
    if(confirm('Действительно хотите удалить?')){
        $('.ajax-loader').fadeIn(100);
        $('.select-all').each(function(){
            if ($(this).is(':checked')) {
                $.ajax({
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/admin/" + model + "/" + $(this).val(),
                    success: function(){
                        if(model == 'comment' || model == 'contact'){
                            getNewOrderCount();
                        }
                    }
                });
                $(this).closest('tr').remove();
            }
        });
        $('.ajax-loader').fadeOut(100);
    }
}

function selectAllCheckbox(ob) {
    if ($(ob).is(':checked')) {
        $('.select-all').prop('checked', true);
    }
    else {
        $('.select-all').prop('checked', false);
    }
}

function delItem(ob,id,model){
    if(confirm('Действительно хотите удалить?')){
        $(ob).closest('tr').remove();
        $.ajax({
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/admin/" + model + "/" + id,
            success: function(data){
            }
        });
    }
}

function isShow(ob,id,model){
    var is_show = 0;
    if($(ob).is(':checked')) {
        is_show = 1;
    }
    $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data :{
            is_show: is_show,
            id: id
        },
        url: "/admin/" + model + "/is_show",
        success: function(data){

        }
    });
}

var cw = $('#avatar_img').width();
$('#avatar_img').css('height',cw);

$('.news-lang').change(function () {
    $('.lang-item').fadeOut(100);
    $('.add-lang-item').fadeIn(100);
    $('#lang_' + this.value).fadeIn(100);
    $('#add_lang_' + this.value).fadeOut(100);
    $('.ke-container').css('width','100%');
});

function showLang(lang) {
    $('#add_lang_' + lang).fadeOut(100);
    $('#lang_' + lang).fadeIn(100);
    $('.ke-container').css('width','100%');
}

$('a.fancybox').fancybox({
    padding: 10
});

$(function() {
    $(".phone-mask").mask("+7(999)999-99-99");
});

$('.date-mask').datetimepicker({
    format: 'DD.MM.YYYY'
});


function changeUrl(ob,id) {
    $.ajax({
        type: 'GET',
        url: "/admin/url",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data :{
            word: $(ob).val()
        },
        success: function(data){
            $('#' + id).val(data.result);
        }
    });
}

function uploadAudio(lang){
 
}

function getNewOrderCount(){
    $.ajax({
        type: 'GET',
        url: "/admin/count",
        success: function(data){
            if(data.comment_count > 0) {
                $('#comment_count').css('display','block');
                $('#comment_count').html(data.comment_count);
            }
            else $('#comment_count').css('display','none');

            if(data.contact_count > 0) {
                $('#contact_count').css('display','block');
                $('#contact_count').html(data.contact_count);
            }
            else $('#contact_count').css('display','none');
        }
    });
}