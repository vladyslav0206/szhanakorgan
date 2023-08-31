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
                           @if($row->banner_id > 0)
                               <form action="/admin/banner/{{$row->banner_id}}" method="POST">
                                   <input type="hidden" name="_method" value="PUT">
                           @else
                               <form action="/admin/banner" method="POST">
                           @endif
                                   <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                   <input type="hidden" name="banner_id" value="{{ $row->banner_id }}">
                                   <input type="hidden" class="image-name" name="image" value="{{ $row->image }}"/>

                                   <div class="box-body">
                                       <div class="form-group">
                                           <label>Название</label>
                                           <input value="{{ $row->banner_name }}" type="text" class="form-control" name="banner_name" placeholder="Введите">
                                       </div>
                                       <div class="form-group">
                                           <label>Сайт</label>
                                           <input value="{{ $row->website }}" type="text" class="form-control" name="website" placeholder="Введите">
                                       </div>
                                     {{--  <div class="form-group">
                                           <label>Позиция на сайте</label>
                                           <select class="form-control" name="position">

                                               <option value="1" @if($row->position == '1') {{ ' selected ' }} @endif>Правая</option>
                                               <option value="2" @if($row->position == '2') {{ ' selected ' }} @endif>Середине</option>
                                               <option value="3" @if($row->position == '3') {{ ' selected ' }} @endif>Внизу</option>
                                               <option value="4" @if($row->position == '4') {{ ' selected ' }} @endif>Верхняя позиция</option>
                                               <option value="5" @if($row->position == '5') {{ ' selected ' }} @endif>Задний фон</option>

                                           </select>
                                       </div>--}}
                                       <div class="form-group">
                                           <label>Размещение на сайте</label>
                                           <select class="form-control" name="section_id">

                                               @foreach($section as $value)

                                                <option value="<?=$value['section_id']?>" @if($value['section_id'] == $row->section_id) selected="selected" @endif ><?=$value['section_name']?></option>

                                               @endforeach

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
                    <div class="col-md-4">
                        <div class="box box-primary" style="padding: 30px; text-align: center">
                            <div style="padding: 20px; border: 1px solid #c2e2f0">
                                <img class="image-src" src="{{ $row->image }}" style="width: 100%; "/>
                            </div>
                            <div style="background-color: #c2e2f0;height: 40px;margin: 0 auto;width: 2px;"></div>
                            <form id="image_form" enctype="multipart/form-data" method="post" class="image-form">
                                <i class="fa fa-plus"></i>
                                <input id="avatar-file" type="file" onchange="uploadImage()" name="image"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

@endsection

