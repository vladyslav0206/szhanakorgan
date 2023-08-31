<head>
  <meta charset="utf-8">
  <title>{{Lang::get('app.website_name')}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="/admin/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/admin/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="/admin/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="/admin/plugins/iCheck/flat/blue.css">
  <link rel="stylesheet" href="/admin/plugins/morris/morris.css">
  <link rel="stylesheet" href="/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <link rel="stylesheet" href="/admin/plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="/admin/plugins/daterangepicker/daterangepicker-bs3.css">
  <link rel="stylesheet" href="/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="/admin/plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="/custom/css/bootstrap-datetimepicker.css">
  <link rel="stylesheet" href="/custom/css/bootstrap-datetimepicker-standalone.min.css">
  <link rel="stylesheet" href="/custom/css/admin-custom.css">
  <link rel="stylesheet" href="/custom/css/bootstrap-select.css">
  <link rel="stylesheet" href="/custom/css/jquery.gritter.css?v=1">
  <script>
UPLOADCARE_PUBLIC_KEY = '8b7864a914d5814b1470';
</script>
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
.booked_form{
    background-color: #fff;
    color: #000;
    padding: 3%;
    display: flex;
    justify-content: center;
    align-items: center;
}
#booked{
    margin:0 0 2px 3%;
}
</style>
</head>