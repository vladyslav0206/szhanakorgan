<!DOCTYPE html>
<html>
<meta name="yandex-verification" content="c95f669c2350f3a9" />
@include('index.layout.app')
<body>

<?php $main_menu_list = \App\Models\Menu::where('is_show',1)->get(); ?>
    @include('index.layout.header')
    @yield('content')
    @include('index.layout.footer')

<!-- RedHelper -->
{{-- <script id="rhlpscrtg" type="text/javascript" charset="utf-8" async="async" 
	src="https://web.redhelper.ru/service/main.js?c=szhanakorgan">
</script>  --}}
<!--/Redhelper -->

<!-- ZERO.kz -->
<span id="_zero_68514">
  <noscript>
    <a href="http://zero.kz/?s=68514" target="_blank">
      <img src="http://c.zero.kz/z.png?u=68514" width="88" height="31" alt="ZERO.kz" />
    </a>
  </noscript>
</span>

<script type="text/javascript"><!--
  var _zero_kz_ = _zero_kz_ || [];
  _zero_kz_.push(["id", 68514]);
  // ÷вет кнопки
  _zero_kz_.push(["type", 1]);
  // ѕровер€ть url каждые 200 мс, при изменении перегружать код счЄтчика
  // _zero_kz_.push(["url_watcher", 200]);

  (function () {
    var a = document.getElementsByTagName("script")[0],
    s = document.createElement("script");
    s.type = "text/javascript";
    s.async = true;
    s.src = (document.location.protocol == "https:" ? "https:" : "http:")
    + "//c.zero.kz/z.js";
    a.parentNode.insertBefore(s, a);
  })(); //-->
</script>
<!-- End ZERO.kz -->

</body>
</html>