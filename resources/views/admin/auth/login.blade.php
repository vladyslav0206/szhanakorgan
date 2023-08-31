<!DOCTYPE html>
<html class="bg-black">
<head>
    <meta charset="UTF-8">
    <title>{{Lang::get('app.website_name')}}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="/admin/auth/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/admin/auth/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="/admin/auth/css/AdminLTE.css" rel="stylesheet" type="text/css" />
</head>
<body class="bg-black">

<div class="form-box" id="login-box">
    <div class="header">{{Lang::get('app.website_name')}}</div>
    <form method="post" action="/admin/login">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="body bg-gray">
            <p style="color:red">@if(isset($error)){{$error}}@endif</p>
            <div class="form-group">
                <input type="text" name="login" value="@if(isset($login)){{$login}}@endif" class="form-control" placeholder="Логин"/>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Пароль"/>
            </div>
        </div>
        <div class="footer">
            <button type="submit" class="btn bg-olive btn-block">{{Lang::get('app.sign_in')}}</button>
        </div>
    </form>
</div>


</body>
</html>