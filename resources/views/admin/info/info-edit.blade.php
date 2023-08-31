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
                <div class="col-md-8" style="padding-left: 0px">
                    <div class="box box-primary">
                        @if (isset($error))
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endif
                        @if($row->info_id > 0)
                            <form action="/admin/info/{{$row->info_id}}" method="POST">
                                <input type="hidden" name="_method" value="PUT">
                                @else
                                    <form action="/admin/info" method="POST">
                                        @endif

                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input id="info_id" type="hidden" name="info_id" value="{{ $row->info_id }}">
                                        <input type="hidden" class="image-name" id="info_image" name="info_image" value="{{ $row->info_image }}"/>

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
                                                            <label>Заголовок (Рус)</label>
                                                            <input id="info_name_ru" value="{{ $row->info_name_ru }}" type="text" class="form-control" name="info_name_ru" placeholder="Введите">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Текст (Рус)</label>
                                                            <textarea id="info_text_ru" name="info_text_ru" class="form-control text_editor"><?=$row->info_text_ru?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="qaz">
                                                        <div class="form-group">
                                                            <label>Заголовок (Каз)</label>
                                                            <input id="info_name_kz" value="{{ $row->info_name_kz }}" type="text" class="form-control" name="info_name_kz" placeholder="Введите">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Текст (Каз)</label>
                                                            <textarea style="width: 100%" id="info_text_kz" name="info_text_kz" class="form-control text_editor"><?=$row->info_text_kz?></textarea>
                                                        </div>

                                                    </div>
                                                    <div class="tab-pane" id="eng">
                                                        <div class="form-group">
                                                            <label>Заголовок (Англ)</label>
                                                            <input id="info_name_en" value="{{ $row->info_name_en }}" type="text" class="form-control" name="info_name_en" placeholder="Введите">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Текст (Англ)</label>
                                                            <textarea style="width: 100%" id="info_text_en" name="info_text_en" class="form-control text_editor"><?=$row->info_text_en?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
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

