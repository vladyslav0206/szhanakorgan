
<header class="bg-dark-blue">
    <div class="container">
        <div class="row">
            <div class="header">
                <div class="navbar-header hidden-lg hidden-md">
                    <button type="button" class="navbar-toggle call-menu">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="logo">
                    <a href="/" class="logo-box">
                        <img src="{{ asset('img/logo/logo.png') }}" alt="logo">
                    </a>
                </div>
                <div class="nav-mobile bg-dark-blue">
                    <div class="nav-mobile-top">
                        <div class="logo visible-xs visible-sm">
                            <a href="index.html" class="logo-box">
                                <img src="{{ asset('img/logo/logo.png') }}" alt="logo">
                            </a>
                        </div>
                        <button class="close-menu btn-plain hidden-md hidden-lg">
                            <img src="" alt="{{ asset('img/icon/close.png') }}">
                        </button>
                    </div>
                    <ul class="m-menu">
                        @foreach($main_menu_list as $key => $item)
                            @if($item['description'] != null)
                                <li style="order:{{$item['position']}};"><a href="/page/{{$item['url']}}/{{$item['id']}}">{{$item['name']}}</a></li>
                            @else
                                <li style="order:{{$item['position']}};"><a href="{{$item['url']}}">{{$item['name']}}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>