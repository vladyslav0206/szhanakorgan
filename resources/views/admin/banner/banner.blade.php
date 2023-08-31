@extends('admin.layout.layout')

@section('content')

<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title box-title-first">
            <a href="/admin/banner" class="menu-tab @if(!isset($request->active) || $request->active == '1') active-page @endif">Активные баннера</a>
          </h3>
          <h3 class="box-title box-title-second" >
            <a href="/admin/banner?active=0" class="menu-tab @if($request->active == '0') active-page @endif">Неактивные баннера</a>
          </h3>
          <a href="/admin/banner/create" style="float: right">
             <button class="btn btn-primary box-add-btn">Добавить новый баннер</button>
          </a>
          <div class="clear-float"></div>
           <div class="form-group col-md-3" >
              <label>Поиск</label>
              <input id="search_word" value="{{$request->search}}" type="text" class="form-control" name="search_word" placeholder="Введите">
           </div>
            <div class="form-group col-md-3 search-btn" >
                <a href="javascript:void(0)" onclick="searchBySort()">
                    <button type="button" class="btn btn-block btn-success">Поиск</button>
                </a>
            </div>
        </div>
        <div>
            <div style="text-align: left" class="form-group col-md-6" >

                @if($request->active == '0')

                    <h4 class="box-title box-edit-click">
                        <a href="javascript:void(0)" onclick="isShowEnabledAll('banner')">Сделать активным отмеченные</a>
                    </h4>

                @else

                    <h4 class="box-title box-edit-click">
                        <a href="javascript:void(0)" onclick="isShowDisabledAll('banner')">Сделать неактивным отмеченные</a>
                    </h4>

                @endif


            </div>
            <div style="text-align: right" class="form-group col-md-6" >
                <h4 class="box-title box-delete-click">
                    <a href="javascript:void(0)" onclick="deleteAll('banner')">Удалить отмеченные</a>
                </h4>
            </div>
        </div>
        <div class="box-body">
          <table id="banner_datatable" class="table table-bordered table-striped">
            <thead>
              <tr style="border: 1px">
                <th style="width: 30px">№</th>
                <th>Баннер</th>
                <th>Название</th>
                <th>Ссылка на сайт</th>
                <th>Секция</th>
                <th style="width: 15px"></th>
                <th style="width: 15px"></th>
                <th class="no-sort" style="width: 0px; text-align: center; padding-right: 16px; padding-left: 14px;" >
                    <input onclick="selectAllCheckbox(this)" style="font-size: 15px" type="checkbox" value="1"/>
                </th>
              </tr>
            </thead>

            <tbody>

                  @foreach($row as $key => $val)

                     <tr>
                        <td> {{ $key + 1 }}</td>
                        <td>
                            <div class="object-image">
                                <a class="fancybox" href="{{$val->image}}">
                                    <img src="{{$val->image}}">
                                </a>
                            </div>
                            <div class="clear-float"></div>
                        </td>
                        <td>
                             {{ $val['banner_name']}}
                        </td>
                         <td>
                             <a href="{{ $val->website }}" target="_blank">
                                 {{ $val->banner_name }}
                             </a>
                         </td>
                         <td>
                             {{ $val->section_name }}
                        </td>
                        <td style="text-align: center">
                            <a href="javascript:void(0)" onclick="delItem(this,'{{ $val->banner_id }}','banner')">
                                <li class="fa fa-trash-o" style="font-size: 20px; color: red;"></li>
                            </a>
                        </td>
                        <td style="text-align: center">
                            <a href="/admin/banner/{{ $val->banner_id }}/edit">
                                <li class="fa fa-pencil" style="font-size: 20px;"></li>
                            </a>
                        </td>
                        <td style="text-align: center;">
                            <input class="select-all" style="font-size: 15px" type="checkbox" value="{{$val->banner_id}}"/>
                        </td>
                     </tr>

                  @endforeach

            </tbody>

          </table>

            <div style="text-align: center">
                {{ $row->appends(\Illuminate\Support\Facades\Input::except('page'))->links() }}
            </div>

        </div>
      </div>
    </div>
    </div>

@endsection