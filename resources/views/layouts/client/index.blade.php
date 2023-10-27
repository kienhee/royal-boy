<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', getEnv('APP_NAME')) | dự án web bán hàng</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('client') }}/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('client') }}/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('client') }}/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('client') }}/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('client') }}/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('client') }}/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('client') }}/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('client') }}/css/style.css" type="text/css">
</head>

<body>

    <!-- Header Section Begin -->
    @include('layouts.client.header')
    <!-- Header Section End -->
    @yield('content')
    <!-- Footer Section Begin -->
    @include('layouts.client.footer')
    <!-- Footer Section End -->
    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form" action="{{ route('client.shop') }}">
                <input type="text" id="search-input" name="keywords" placeholder="Search products here .....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- Modal -->
    <div class="modal fade" id="modalNotice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body d-flex justify-content-between align-items-center flex-column text-center">
                    <img src="/images/yes.png" alt="" class="mb-4 icon-notice" id="icon-yes">
                    <img src="/images/no.png" alt="" class="mb-4 icon-notice" id="icon-no">
                    <h5><strong id="content-notice"></strong></h5>
                </div>

            </div>
        </div>
    </div>
    <!-- Js Plugins -->
    @include('layouts.client.script')
</body>

</html>