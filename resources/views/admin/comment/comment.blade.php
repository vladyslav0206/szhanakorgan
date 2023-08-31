@extends('admin.layout.layout')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title box-title-first">
                        <a href="/admin/comment" class="menu-tab @if(!isset($request->active) || $request->active == '1') active-page @endif">Опубликованные</a>
                    </h3>
                    <h3 class="box-title box-title-second" >
                        <a href="/admin/comment?active=0" class="menu-tab @if($request->active == '0') active-page @endif">Неопубликованные</a>
                    </h3>
                    <div class="clear-float"></div>
                </div>
                <div>
                    <div style="text-align: left" class="form-group col-md-6" >

                        @if($request->active == '0')

                            <h4 class="box-title box-edit-click">
                                <a href="javascript:void(0)" onclick="isShowEnabledAll('comment')">Опубликовать</a>
                            </h4>

                        @else

                            <h4 class="box-title box-edit-click">
                                <a href="javascript:void(0)" onclick="isShowDisabledAll('comment')">Не опубликовать</a>
                            </h4>

                        @endif


                    </div>
                    <div style="text-align: right" class="form-group col-md-6" >
                        <h4 class="box-title box-delete-click">
                            <a href="javascript:void(0)" onclick="deleteAll('comment')">Удалить отмеченные</a>
                        </h4>
                    </div>
                </div>
                <div class="box-body">
                    <table id="order_datatable" class="table table-bordered table-striped">
                        <thead>
                        <tr style="border: 1px">
                            <th style="width: 30px">№</th>
                            <th>Пользователь</th>
                            <th>Почта</th>
                            <th>Коммент</th>
                            <th>Новости</th>
                            <th>Дата</th>
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
                                    <input value="{{$request->name}}" type="text" class="form-control" name="name" placeholder="Поиск">
                                    <input value="{{$request->news_name}}" type="hidden" class="form-control" name="news_name" placeholder="Поиск">
                                    <input value="{{$request->email}}" type="hidden" class="form-control" name="email" placeholder="Поиск">
                                    <input value="{{$request->message}}" type="hidden" class="form-control" name="message" placeholder="Поиск">
                                    <input type="hidden" value="@if(!isset($request->active)){{'1'}}@else{{$request->active}}@endif" name="active"/>
                                </form>
                            </td>
                            <td>
                                <form>
                                    <input value="{{$request->name}}" type="hidden" class="form-control" name="name" placeholder="Поиск">
                                    <input value="{{$request->news_name}}" type="hidden" class="form-control" name="news_name" placeholder="Поиск">
                                    <input value="{{$request->email}}" type="text" class="form-control" name="email" placeholder="Поиск">
                                    <input value="{{$request->message}}" type="hidden" class="form-control" name="message" placeholder="Поиск">
                                    <input type="hidden" value="@if(!isset($request->active)){{'1'}}@else{{$request->active}}@endif" name="active"/>
                                </form>
                            </td>
                            <td>
                                <form>
                                    <input value="{{$request->name}}" type="hidden" class="form-control" name="name" placeholder="Поиск">
                                    <input value="{{$request->news_name}}" type="hidden" class="form-control" name="news_name" placeholder="Поиск">
                                    <input value="{{$request->email}}" type="hidden" class="form-control" name="email" placeholder="Поиск">
                                    <input value="{{$request->message}}" type="text" class="form-control" name="message" placeholder="Поиск">
                                    <input type="hidden" value="@if(!isset($request->active)){{'1'}}@else{{$request->active}}@endif" name="active"/>
                                </form>
                            </td>
                            <td>
                                <form>
                                    <input value="{{$request->name}}" type="hidden" class="form-control" name="name" placeholder="Поиск">
                                    <input value="{{$request->news_name}}" type="text" class="form-control" name="news_name" placeholder="Поиск">
                                    <input value="{{$request->email}}" type="hidden" class="form-control" name="email" placeholder="Поиск">
                                    <input value="{{$request->message}}" type="hidden" class="form-control" name="message" placeholder="Поиск">
                                    <input type="hidden" value="@if(!isset($request->active)){{'1'}}@else{{$request->active}}@endif" name="active"/>
                                </form>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        @foreach($row as $key => $val)

                            <tr>
                                <td> {{ $key + 1 }}</td>
                                <td>
                                    {{ $val['comment_user_name']}}
                                </td>
                                <td>
                                    {{ $val['email']}}
                                </td>
                                <td>
                                    {{ $val['message']}}
                                </td>
                                <td>
                                    <a href="/{{$val->news_id}}-{{\App\Http\Helpers::getTranslatedSlugRu($val->news_name_ru)}}">
                                        {{ $val['news_name_ru']}}
                                    </a>
                                </td>
                                <td>
                                    {{ $val['date']}}
                                </td>
                                <td style="text-align: center">
                                    <a href="javascript:void(0)" onclick="delItem(this,'{{ $val->comment_id }}','comment')">
                                        <li class="fa fa-trash-o" style="font-size: 20px; color: red;"></li>
                                    </a>
                                </td>
                                <td style="text-align: center;">
                                    <input class="select-all" style="font-size: 15px" type="checkbox" value="{{$val->comment_id}}"/>
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