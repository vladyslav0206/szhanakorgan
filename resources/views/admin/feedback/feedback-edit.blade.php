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
                            <form action="/admin/feedback/{{$row->id}}" method="POST"  enctype="multipart/form-data">
                                <input type="hidden" name="_method" value="PUT">
                                @else
                                    <form action="/admin/feedback" method="POST" enctype="multipart/form-data">
                                        @endif

                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <div class="box-body">

                                            <div class="nav-tabs-custom">
                                                <div class="tab-content">
                                                    <div class="active tab-pane" id="rus">
                                                        <div class="form-group">
                                                            <label>Имя</label>
                                                            <input id="name" value="{{ $row->name }}" type="text" class="form-control" name="name" placeholder="Введите">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Отзыв</label>
                                                            <input id="name" value="{{ $row->description }}" type="text" class="form-control" name="description" placeholder="Введите">
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

