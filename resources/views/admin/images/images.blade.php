@php
    use App\Models\Images;
@endphp
@extends('admin.layout.layout')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <a href="/admin/images/create" style="float: right">
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

                            <th>Название страницы</th>
                            <th>Изоображение</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td>0</td>
                            <td>Галерея</td>
                            <td>
                                @foreach($gallery as $k => $v)
                                    <div class="object-image">
                                        <a class="fancybox" href="/images/{{$v->image}}">
                                            <img src="/images/{{$v->image}}">
                                        </a>
                                    </div>
                                @endforeach
                                <div class="clear-float"></div>
                            </td>
                            <td style="text-align: center">
                                <a href="/admin/images/0/edit">
                                    <li class="fa fa-pencil" style="font-size: 20px;"></li>
                                </a>
                            </td>
                        </tr>

                        @foreach($row as $key => $val)
                            <tr>
                                <td> {{ $key + 1 }}</td>

                                <td>{{ $val['name']}}</td>
                                <td>
                                    @php
                                        $id = $val['id'];
                                        $gallery = Images::where('menu_id', $id)->get();
                                    @endphp
                                    @foreach($gallery as $k => $v)
                                        <div class="object-image">
                                            <a class="fancybox" href="/images/{{$v->image}}">
                                                <img src="/images/{{$v->image}}">
                                            </a>
                                        </div>
                                    @endforeach
                                        <div class="clear-float"></div>
                                </td>

                                <td style="text-align: center">
                                    <a href="/admin/images/{{ $val->id }}/edit">
                                        <li class="fa fa-pencil" style="font-size: 20px;"></li>
                                    </a>
                                </td>
                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>

@endsection