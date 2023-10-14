@php
    $menu = [
        [
            'name' => 'Home',
            'route' => 'client.index',
            'children' => [],
        ],
        [
            'name' => 'Shop',
            'route' => 'client.shop',
            'children' => [],
        ],
        [
            'name' => 'Blog',
            'route' => 'client.blog',
            'children' => [],
        ],
        [
            'name' => 'About us',
            'route' => 'client.about-us',
            'children' => [],
        ],
        [
            'name' => 'contact',
            'route' => 'client.contact',
            'children' => [],
        ],
        // [
        // 'name' => 'Bộ sưu tập',
        // 'route' => '#',
        // 'children' => [['name' => 'Thêm mới bộ sưu tập', 'route' => 'dashboard.category.add'], ['name' => 'Danh sách bộ sưu tập', 'route' => 'dashboard.category.index']],
        // ],
    ];

@endphp
<!-- Offcanvas Menu Begin -->
{{-- <marquee behavior="scroll" direction="left">Chào mừng bạn đến với ví dụ về Marquee!</marquee> --}}
<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">

    <ul class="offcanvas__nav__option">
        <li> <a href="#" class="search-switch">
                <ion-icon name="search-outline"></ion-icon>
            </a></li>

        <li class="bag__icon"> <a href="{{ route('client.shopping-cart') }}">
                <ion-icon name="bag-handle-outline"></ion-icon>
            </a><span>0</span></li>



    </ul>
    <div id="mobile-menu-wrap"></div>
    <div class="offcanvas__text">
        <p>Free shipping, 30-day return or refund guarantee.</p>
    </div>
</div>
<!-- Offcanvas Menu End -->

<!-- Header Section Begin -->
<header class="header sticky-top">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="header__top__left">
                        <p class="text-center">Free shipping, 30-day return or refund guarantee.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="container">
        <div class="d-flex justify-content-between">
            <div class="header__logo">
                <a href="{{ route('client.index') }}"><img src="{{ asset('client') }}/img/logo.png" alt=""></a>
            </div>
            <nav class="header__menu mobile-menu">
                <ul>
                    @foreach ($menu as $item)
                        <li class="{{ url()->current() == route($item['route']) ? 'active' : '' }}"><a
                                href="{{ url()->current() == route($item['route']) ? 'javascript:void(0)' : route($item['route']) }}">{{ $item['name'] }}</a>
                        </li>
                    @endforeach
                    {{-- <li><a href="#">bộ sưu tập</a>
                        <ul class="dropdown">
                            <li><a href="{{ route('client.product-detail') }}">Shop Details</a></li>
                            <li><a href="{{ route('client.shopping-cart') }}">Shopping Cart</a></li>
                            <li><a href="{{ route('client.checkout') }}">Check Out</a></li>
                            <li><a href="{{ route('client.blog-detail') }}">Blog Details</a></li>
                        </ul>
                    </li> --}}
                </ul>
            </nav>
            <ul class="header__nav__option">
                <li> <a href="#" class="search-switch">
                        <ion-icon name="search-outline"></ion-icon>
                    </a></li>

                <li class="bag__icon"> <a href="{{ route('client.shopping-cart') }}">
                        <ion-icon name="bag-handle-outline"></ion-icon>
                    </a><span id="lengthCart">0</span></li>



            </ul>
        </div>
        <div class="canvas__open"><i class="fa fa-bars"></i></div>
    </div>
</header>
<!-- Header Section End -->
