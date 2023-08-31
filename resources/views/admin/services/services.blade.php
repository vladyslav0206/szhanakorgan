@extends('admin.layout.layout')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <a href="/admin/services/create" style="float: right">
                        <button class="btn btn-primary box-add-btn">Добавить</button>
                    </a>
                    <div class="clear-float"></div>
                </div>
                <div>
                </div>
                <div class="box-body">
                    <table id="news_datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr style="border: 1px">
                                <th style="width: 30px">№</th>

                                <th>Название</th>
                                <th>Описание</th>
                                <th>Категория</th>
                                <th>Картинка</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>

                        @foreach($row as $key => $val)

                            <tr>
                                <td> {{ $key + 1 }}</td>

                                <td>{{ $val['name']}}</td>
                                <td>{{ $val['description']}}</td>
                                <td>{{ $val->category()->name}}</td>
                                <td>
                                    <div class="object-image">
                                        <a class="fancybox" href="/images/{{$val->image}}">
                                            <img src="/images/{{$val->image}}">
                                        </a>
                                    </div>
                                    <div class="clear-float"></div>
                                </td>
                                <td style="text-align: center">
                                    <a href="javascript:void(0)" onclick="delItem(this,'{{ $val->id }}','services')">
                                        <li class="fa fa-trash-o" style="font-size: 20px; color: red;"></li>
                                    </a>
                                </td>
                                <td style="text-align: center">
                                    <a href="/admin/services/{{ $val->id }}/edit">
                                        <li class="fa fa-pencil" style="font-size: 20px;"></li>
                                    </a>
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