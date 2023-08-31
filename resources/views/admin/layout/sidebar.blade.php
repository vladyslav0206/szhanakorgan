<ul class="sidebar-menu">
  <li class="header">МЕНЮ</li>
  <li class="treeview @if(isset($menu) && $menu == 'rooms') active @endif" >
    <a href="/admin/rooms">
      <i class="fa fa-list-ul"></i>
      <span>Номера</span>
    </a>
  </li>

  <li class="treeview @if(isset($menu) && $menu == 'specialists') active @endif" >
    <a href="/admin/specialists">
      <i class="fa fa-list-ul"></i>
      <span>Специалисты</span>
    </a>
  </li>

  <li class="treeview @if(isset($menu) && $menu == 'categories') active @endif" >
    <a href="/admin/categories">
      <i class="fa fa-list-ul"></i>
      <span>Категории</span>
    </a>
  </li>

  <li class="treeview @if(isset($menu) && $menu == 'services') active @endif" >
    <a href="/admin/services">
      <i class="fa fa-list-ul"></i>
      <span>Услуги и досуг</span>
    </a>
  </li>

  <li class="treeview @if(isset($menu) && $menu == 'menu') active @endif" >
    <a href="/admin/menu">
      <i class="fa fa-list-ul"></i>
      <span>Меню страниц</span>
    </a>
  </li>

  <li class="treeview @if(isset($menu) && $menu == 'book') active @endif" >
    <a href="/admin/book">
      <i class="fa fa-list-ul"></i>
      <span>Бронирование</span>
    </a>
  </li>
  
  <li class="treeview @if(isset($menu) && $menu == 'statictext') active @endif">
    <a href="/admin/statictext">
      <i class="fa fa-list-ul"></i>
      <span>Статичные тексты</span>
    </a>
  </li>

  <li class="treeview @if(isset($menu) && $menu == 'images') active @endif">
    <a href="/admin/images">
      <i class="fa fa-list-ul"></i>
      <span>Изображения</span>
    </a>
  </li>

  <li class="treeview @if(isset($menu) && $menu == 'feedback') active @endif">
    <a href="/admin/feedback">
      <i class="fa fa-list-ul"></i>
      <span>Отзывы</span>
    </a>
  </li>
  
  <li class="treeview @if(isset($menu) && $menu == 'feedback') active @endif">
    <a href="/admin/contactchange">
      <i class="fa fa-list-ul"></i>
      <span>Контакты</span>
    </a>
  </li>

  <li class="treeview @if(isset($menu) && $menu == 'admin') active @endif">
    <a href="/admin/user">
      <i class="fa fa-user"></i>
      <span>Администратор</span>
    </a>
  </li>
  <li class="@if(isset($menu) && $menu == 'password') active @endif">
    <a href="/admin/password">
      <i class="fa fa-user"></i>
      <span>Сменить пароль</span>
    </a>
  </li>
  <li class="treeview">
    <a href="/logout">
      <i class="fa fa-sign-out"></i>
      <span>Выйти</span>
    </a>
  </li>
  <li class="treeview">
     <form method="post" action="/admin/booked_result" class="booked_form">
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
         <label for="booked">Бронирование</label>
         <input id="booked" name="booked" type="checkbox" value="1" onChange="this.form.submit()" {{ !empty($booked_status) && $booked_status == "1" ? "checked" : "" }}>
    </form>
  </li>
</ul>