@extends('admin.layout.layout')

@section('content')

    <section class="content-header">
        <h1>
            {{ $title }}
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-10" style="padding-left: 0px">
                    <div class="box box-primary">
                        @if (isset($error))
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endif
                        @if($row->page_id > 0)
                            <form action="/admin/page/{{$row->page_id}}" method="POST">
                                <input type="hidden" name="_method" value="PUT">
                                @else
                                    <form action="/admin/page" method="POST">
                                        @endif
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="page_id" value="{{ $row->page_id }}">

                                        <div class="box-body">

                                            <div class="nav-tabs-custom">
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a href="#rus" data-toggle="tab">Русский</a>
                                                    </li>
                                                    <li>
                                                        <a href="#qaz" data-toggle="tab">Қазақша</a>
                                                    </li>
                                                    <li>
                                                        <a href="#eng" data-toggle="tab">Английский</a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="active tab-pane" id="rus">
                                                        <div class="form-group">
                                                            <label>Название (ru)</label>
                                                            <input onchange="changeUrl(this,'page_url_ru')" value="{{ $row->page_name_ru }}" type="text" class="form-control" name="page_name_ru" placeholder="Введите">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>URL (ru)</label>
                                                            <input id="page_url_ru" value="{{ $row->page_url_ru }}" type="text" class="form-control" name="page_url_ru" placeholder="Введите">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Текст (ru)</label>
                                                            <textarea name="page_text_ru" class="form-control text_editor"><?=$row->page_text_ru?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Meta SEO title (ru)</label>
                                                            <input value="{{ $row->page_meta_title_ru }}" type="text" class="form-control" name="page_meta_title_ru" placeholder="Введите">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Meta SEO description (ru)</label>
                                                            <input value="{{ $row->page_meta_description_ru }}" type="text" class="form-control" name="page_meta_description_ru" placeholder="Введите">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Meta SEO keywords (ru)</label>
                                                            <input value="{{ $row->page_meta_keywords_ru }}" type="text" class="form-control" name="page_meta_keywords_ru" placeholder="Введите">
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="qaz">
                                                        <div class="form-group">
                                                            <label>Название (kz)</label>
                                                            <input onchange="changeUrl(this,'page_url_kz')" value="{{ $row->page_name_kz }}" type="text" class="form-control" name="page_name_kz" placeholder="Введите">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>URL (kz)</label>
                                                            <input id="page_url_kz" value="{{ $row->page_url_kz }}" type="text" class="form-control" name="page_url_kz" placeholder="Введите">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Текст (kz)</label>
                                                            <textarea style="width: 100%" name="page_text_kz" class="form-control text_editor"><?=$row->page_text_kz?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Meta SEO title (kz)</label>
                                                            <input value="{{ $row->page_meta_title_kz }}" type="text" class="form-control" name="page_meta_title_kz" placeholder="Введите">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Meta SEO description (kz)</label>
                                                            <input value="{{ $row->page_meta_description_kz }}" type="text" class="form-control" name="page_meta_description_kz" placeholder="Введите">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Meta SEO keywords (kz)</label>
                                                            <input value="{{ $row->page_meta_keywords_kz }}" type="text" class="form-control" name="page_meta_keywords_kz" placeholder="Введите">
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="eng">
                                                        <div class="form-group">
                                                            <label>Название (en)</label>
                                                            <input onchange="changeUrl(this,'page_url_en')" value="{{ $row->page_name_en }}" type="text" class="form-control" name="page_name_en" placeholder="Введите">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>URL (en)</label>
                                                            <input id="page_url_en" value="{{ $row->page_url_en }}" type="text" class="form-control" name="page_url_en" placeholder="Введите">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Текст (en)</label>
                                                            <textarea style="width: 100%" name="page_text_en" class="form-control text_editor"><?=$row->page_text_en?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Meta SEO title (en)</label>
                                                            <input value="{{ $row->page_meta_title_en }}" type="text" class="form-control" name="page_meta_title_en" placeholder="Введите">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Meta SEO description (en)</label>
                                                            <input value="{{ $row->page_meta_description_en }}" type="text" class="form-control" name="page_meta_description_en" placeholder="Введите">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Meta SEO keywords (en)</label>
                                                            <input value="{{ $row->page_meta_keywords_en }}" type="text" class="form-control" name="page_meta_keywords_en" placeholder="Введите">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Отображать в меню</label>
                                                <select name="is_show_menu" data-placeholder="Выберите" class="form-control">
                                                    <option @if($row->is_show_menu == 0) selected @endif value="0">Нет</option>
                                                    <option @if($row->is_show_menu == 1) selected @endif value="1">Да</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Порядковый номер сортировки</label>
                                                <input value="{{ $row->sort_num }}" type="text" class="form-control" name="sort_num" placeholder="Введите">
                                            </div>
                                        </div>
                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-primary">Сохранить</button>
                                        </div>
                                    </form>

                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

