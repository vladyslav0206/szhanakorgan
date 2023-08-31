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
                        @if($row->id > 0)
                            <form action="/admin/rooms/{{$row->id}}" method="POST"  enctype="multipart/form-data">
                                <input type="hidden" name="_method" value="PUT">
                                @else
                                    <form action="/admin/rooms" method="POST" enctype="multipart/form-data">
                                        @endif

                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input id="news_id" type="hidden" name="news_id" value="{{ $row->id }}">
                                        <input type="hidden" class="image-name" id="news_image" name="news_image" value="{{ $row->image }}"/>

                                        <div class="box-body">

                                            <div class="nav-tabs-custom">
                                                <div class="tab-content">
                                                    <div class="active tab-pane" id="rus">
                                                        <div class="form-group">
                                                            <label>Название</label>
                                                            <input id="name" value="{{ $row->name }}" type="text" class="form-control" name="name" placeholder="Введите">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>description</label>
                                                            <textarea id="description" name="description" class="ckeditor form-control text_editor"><?=$row->description?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Цена</label>
                                                            <input id="price" value="{{ $row->price }}" type="text" class="form-control" name="price" placeholder="Введите">
                                                        </div>

                                                        <div class="box box-primary" style="padding: 30px; text-align: center">
                                                                <input type="file"  name="image">
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

