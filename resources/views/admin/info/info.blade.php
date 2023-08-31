@extends('admin.layout.layout')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title box-title-first">
                        <a href="/admin/info" class="menu-tab @if(!isset($request->active) || $request->active == '1') active-page @endif">Активные тексты</a>
                    </h3>
                    <h3 class="box-title box-title-second" >
                        <a href="/admin/info?active=0" class="menu-tab @if($request->active == '0') active-page @endif">Неактивные тексты</a>
                    </h3>
                    <a href="/admin/info/create" style="float: right">
                        <button class="btn btn-primary box-add-btn">Добавить текст</button>
                    </a>
                    <div class="clear-float"></div>
                </div>
                <div>
                    <div style="text-align: left" class="form-group col-md-6" >

                        @if($request->active == '0')

                            <h4 class="box-title box-edit-click">
                                <a href="javascript:void(0)" onclick="isShowEnabledAll('info')">Сделать активным отмеченные</a>
                            </h4>

                        @else

                            <h4 class="box-title box-edit-click">
                                <a href="javascript:void(0)" onclick="isShowDisabledAll('info')">Сделать неактивным отмеченные</a>
                            </h4>

                        @endif


                    </div>
                    <div style="text-align: right" class="form-group col-md-6" >
                        <h4 class="box-title box-delete-click">
                            <a href="javascript:void(0)" onclick="deleteAll('info')">Удалить отмеченные</a>
                        </h4>
                    </div>
                </div>
                <div class="box-body">
                    <table id="info_datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr style="border: 1px">
                                <th style="width: 30px">№</th>
                                <th>Название (ru)</th>
                                <th>Название (kz)</th>
                                <th style="width: 15px"></th>
                                <th style="width: 15px"></th>
                                <th class="no-sort" style="width: 0px; text-align: center; padding-right: 16px; padding-left: 14px;" >
                                    <input onclick="selectAllCheckbox(this)" style="font-size: 15px" type="checkbox" value="1"/>
                                </th>
                            </tr>
                        </thead>

                        <tbody>

                        <tr>
                            <td></td>
                            <td>
                                <form>
                                    <input value="{{$request->info_name}}" type="text" class="form-control" name="info_name" placeholder="Поиск">
                                    <input type="hidden" value="@if(!isset($request->active)){{'1'}}@else{{$request->active}}@endif" name="active"/>
                                </form>
                            </td>
                            <td>

                            </td>
                            <td>
                                <form>
                                    <input value="{{$request->info_name}}" type="hidden" class="form-control" name="info_name" placeholder="Поиск">
                                    <input type="hidden" value="@if(!isset($request->active)){{'1'}}@else{{$request->active}}@endif" name="active"/>
                                </form>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>

                        @foreach($row as $key => $val)

                            <tr>
                                <td> {{ $val['info_id'] }}</td>

                                <td>
                                    {{ $val['info_name_ru']}}
                                </td>
                                <td>
                                    {{ $val['info_name_kz']}}
                                </td>
                                <td style="text-align: center">
                                    <a href="javascript:void(0)" onclick="delItem(this,'{{ $val->info_id }}','info')">
                                        <li class="fa fa-trash-o" style="font-size: 20px; color: red;"></li>
                                    </a>
                                </td>
                                <td style="text-align: center">
                                    <a href="/admin/info/{{ $val->info_id }}/edit">
                                        <li class="fa fa-pencil" style="font-size: 20px;"></li>
                                    </a>
                                </td>
                                <td style="text-align: center;">
                                    <input class="select-all" style="font-size: 15px" type="checkbox" value="{{$val->info_id}}"/>
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