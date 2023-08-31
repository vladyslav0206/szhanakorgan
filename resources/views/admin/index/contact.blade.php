@extends('admin.layout.layout')

@section('content')

    <section class="content-header">
        <h1>
            Контакты
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
                                    <form action="/admin/contactchange/change" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <div class="box-body">

                                            <div class="nav-tabs-custom">
                                                <div class="tab-content">
                                                    <div class="active tab-pane" id="rus">
                                                        <div class="form-group">
                                                            <label>Адрес:</label>
                                                            <input id="name" type="text" value="{{$contact->address}}" class="form-control" name="address" placeholder="Введите">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Регистрация:</label>
                                                            <input id="name" type="text" value="{{$contact->reg}}" class="form-control" name="reg" placeholder="Введите">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Принимаем звонки:</label>
                                                            <input id="name" type="text" value="{{$contact->tel_time}}" class="form-control" name="tel_time" placeholder="Введите">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>E-mail:</label>
                                                            <input id="name" type="text" value="{{$contact->email}}" class="form-control" name="email" placeholder="Введите">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Бенефициар:</label>
                                                            <textarea id="description" name="beneficiar" class="ckeditor form-control text_editor">{{$contact->beneficiar}}</textarea>
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

