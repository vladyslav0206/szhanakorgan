@php
    use App\Models\Images;
@endphp
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
                        <div style="text-align: right" class="form-group col-md-6" >
                          <h4 class="box-title box-delete-click">
                              <a href="javascript:void(0)" onclick="deleteAll('images')">Удалить отмеченные</a>
                          </h4>
                        </div>
                        @if (isset($error))
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endif
                        @if(!is_null($row) and $row->id > 0)
                                <table id="news_datatable" class="table table-bordered table-striped">
                                    <thead>
                                    <tr style="border: 1px">
                                        <th>Изоображение</th>
                                        <th></th>
                                        <th class="no-sort" style="width: 0px; text-align: center; padding-right: 16px; padding-left: 14px;" >
                                          <input onclick="selectAllCheckbox(this)" style="font-size: 15px" type="checkbox" value="1"/>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $id = $row['id'];
                                        $gallery = Images::where('menu_id', $id)->get();
                                    @endphp
                                    @foreach($gallery as $v)
                                        <tr>
                                            <td>
                                                <div class="object-image">
                                                    <a class="fancybox" href="/images/{{$v->image}}">
                                                        <img src="/images/{{$v->image}}">
                                                    </a>
                                                </div>
                                                <div class="clear-float"></div>
                                            </td>
                                            <td style="text-align: center">
                                                <a href="javascript:void(0)" onclick="delItem(this,'{{ $v->id }}','images')">
                                                    <li class="fa fa-trash-o" style="font-size: 20px; color: red;"></li>
                                                </a>
                                            </td>
                                            <td style="text-align: center;">
                                                 <input class="select-all" style="font-size: 15px" type="checkbox" value="{{$v->id}}"/>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @elseif (is_null($row))
                                <table id="news_datatable" class="table table-bordered table-striped">
                                    <thead>
                                    <tr style="border: 1px">
                                        <th>Изоображение</th>
                                        <th></th>
                                        <th class="no-sort" style="width: 0px; text-align: center; padding-right: 16px; padding-left: 14px;" >
                                          <input onclick="selectAllCheckbox(this)" style="font-size: 15px" type="checkbox" value="1"/>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gallery as $v)
                                        <tr>
                                            <td>
                                                <div class="object-image">
                                                    <a class="fancybox" href="/images/{{$v->image}}">
                                                        <img src="/images/{{$v->image}}">
                                                    </a>
                                                </div>
                                                <div class="clear-float"></div>
                                            </td>
                                            <td style="text-align: center">
                                                <a href="javascript:void(0)" onclick="delItem(this,'{{ $v->id }}','images')">
                                                    <li class="fa fa-trash-o" style="font-size: 20px; color: red;"></li>
                                                </a>
                                            </td>
                                            <td style="text-align: center;">
                                                 <input class="select-all" style="font-size: 15px" type="checkbox" value="{{$v->id}}"/>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                    <form action="/admin/images" method="POST" enctype="multipart/form-data">


                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="box-body">

                                            <div class="nav-tabs-custom">
                                                <div class="tab-content">
                                                    <div class="active tab-pane" id="rus">

                                                        <div class="form-group">
                                                            <label>Страницы</label>
                                                            <select class="form-control" name="menu_id">
                                                                <option value="0" >Галерея</option>
                                                                @foreach($menus as $value)
                                                                    <option value="<?=$value['id']?>" ><?=$value['name']?></option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="box box-primary" style="padding: 30px; text-align: center">
                                                            <input type="file"  name="image[]" multiple>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-primary">Сохранить</button>
                                        </div>
                                    </form>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

