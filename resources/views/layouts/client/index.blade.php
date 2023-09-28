<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Male-Fashion | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('client') }}/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('client') }}/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('client') }}/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('client') }}/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('client') }}/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('client') }}/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('client') }}/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('client') }}/css/style.css" type="text/css">
    <script src="https://unpkg.com/ionicons@latest/dist/ionicons.js"></script>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    @include('layouts.client.nav')
    @yield('content')

    @include('layouts.client.footer')


    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- Js Plugins -->
    <script src="{{ asset('client') }}/js/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('client') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('client') }}/js/jquery.nice-select.min.js"></script>
    <script src="{{ asset('client') }}/js/jquery.nicescroll.min.js"></script>
    <script src="{{ asset('client') }}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('client') }}/js/jquery.countdown.min.js"></script>
    <script src="{{ asset('client') }}/js/jquery.slicknav.js"></script>
    <script src="{{ asset('client') }}/js/mixitup.min.js"></script>
    <script src="{{ asset('client') }}/js/owl.carousel.min.js"></script>
    <script src="{{ asset('client') }}/js/main.js"></script>
    <script>
        function addToCart() {
            let urlProduct = $(this).data('url');
            $.ajax({
                type: 'get',
                url: urlProduct,
                dataType: 'json',
                success: function(data) {

                },
                error: function(data) {

                },
            })
        }
        $(function() {
            $('.add-to-cart').on('click', addToCart)
        })
    </script>
</body>

</html>
