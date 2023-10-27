@php
$categories = getAllCategories();
$menu = [['name' => 'Home', 'route' => 'client.index', 'children' => ''], ['name' => 'Categories', 'route' => '',
'children' => $categories], ['name' => 'Shop', 'route' => 'client.shop', 'children' => ''], ['name' => 'Blog', 'route'
=> 'client.blog', 'children' => ''], ['name' => 'Contact', 'route' => 'client.contact', 'children' => '']];

@endphp
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>
<!-- Offcanvas Menu Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
    <div class="offcanvas__close">+</div>
    <ul class="offcanvas__widget">
        <li><span class="icon_search search-switch"></span></li>
        <li><a href="#"><span class="icon_heart_alt"></span>
                <div class="tip">2</div>
            </a></li>
        <li><a href="#"><span class="icon_bag_alt"></span>
                <div class="tip">2</div>
            </a></li>
    </ul>
    <div class="offcanvas__logo">
        <a href="./index.html"><img src="{{ asset('client') }}/img/logo.png" alt=""></a>
    </div>
    <div id="mobile-menu-wrap"></div>
    <div class="offcanvas__auth">
        <a href="{{route('client.login')}}">Login</a>
        <a href="{{route('client.register')}}">Register</a>
    </div>
</div>
<!-- Offcanvas Menu End -->
<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-lg-1">
                <div class="header__logo">
                    <a href="/"><img src="{{ asset('client') }}/img/logo.png" alt=""></a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-8">
                <nav class="header__menu">
                    <ul>
                        @foreach ($menu as $item)
                        @if ($item['children'])
                        <li><a href="#">{{ $item['name'] }}</a>
                            <ul class="dropdown">
                                @foreach ($item['children'] as $children)
                                @if ($children->category_id != 0)
                                <li><a href="{{ route('client.shop', ['category' => $children->slug]) }}">{{
                                        $children->name }}</a>
                                </li>
                                @endif
                                @endforeach
                            </ul>
                        </li>
                        @else
                        <li class="{{ url()->current() == route($item['route']) ? 'active' : '' }}"><a
                                href="{{ url()->current() == route($item['route']) ? 'javascript:void(0)' : route($item['route']) }}">{{
                                $item['name'] }}</a>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__right custom__header-right">
                    @if (Auth::check())
                    <div class="header__menu p-0 mr-5">
                        <ul>
                            <li><a href="#" class="text-muted">{{Auth::user()->full_name}}</a>
                                <ul class="dropdown">
                                    <li><a href="">Profile</a>
                                    </li>
                                    <li><a href="">Order history</a>
                                    </li>
                                    <li><a href="{{route('client.logout')}}">Logout</a>
                                    </li>

                                </ul>
                            </li>
                        </ul>
                    </div>
                    @else
                    <div class="header__right__auth">
                        <a href="{{route('client.login')}}">Login</a>
                        <a href="{{route('client.register')}}">Register</a>
                    </div>
                    @endif

                    <ul class="header__right__widget">
                        <li><span class="icon_search search-switch"></span></li>
                        <li><a href="{{route('client.favourite')}}"><span class="icon_heart_alt"></span>
                                <div class="tip" id="favourite-length">0</div>
                            </a></li>
                        <li><a href="{{route('client.shop-cart')}}"><span class="icon_bag_alt"></span>
                                <div class="tip" id="cart-length">0</div>
                            </a></li>
                    </ul>

                </div>
            </div>
        </div>
        <div class="canvas__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>