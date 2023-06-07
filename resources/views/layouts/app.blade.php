@php
    $company = \App\Models\Company::first();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link href="{{ asset('assets/images/fav.ico') }}" rel="apple-touch-icon">
    <link href="{{ asset('assets/images/fav.ico') }}" rel="shortcut icon" type="image/png">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>@yield('title') Tara Hura Life</title>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700&amp;amp;subset=latin-ext"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hind:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/fonts/Linearicons/Font/demo-files/demo.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/noUiSlider/nouislider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/owl-carousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/lightGallery/dist/css/lightgallery.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/frontend.css') }}">
    @stack('css')
</head>

<body>

    <header class="header">
        <div class="ps-top-bar">
            <div class="container">
                <div class="top-bar">
                    <div class="top-bar__left">
                    </div>
                    <div class="top-bar__right">
                        <ul class="nav-top">
                            <li class="nav-top-item contact"><a class="nav-top-link" href="tel:970978-6290"> <i
                                        class="icon-telephone"></i><span>Hotline:</span><span
                                        class="text-success font-bold">{{ $company->phone }}</span></a></li>

                            <li class="nav-top-item account">
                                @if (!Auth::check())
                                    <a class="nav-top-link" href="javascript:void(0);">
                                        <i class="icon-user"></i>লগইন / রেজিস্টার</span>
                                    </a>
                                    <div class="account--dropdown">
                                        <div class="account-anchor">
                                            <div class="triangle"></div>
                                        </div>
                                        <div class="account__content">
                                            <ul class="account-list">
                                                <li><a href="{{ route('login') }}">লগইন</a></li>
                                                <li><a href="{{ route('register') }}">রেজিস্টার</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                @else
                                    <a class="nav-top-link" href="javascript:void(0);">
                                        <i class="icon-user"></i>Hi! <span
                                            class="font-bold">{{ Auth::user('auth')->name }}</span>
                                    </a>
                                    <div class="account--dropdown">
                                        <div class="account-anchor">
                                            <div class="triangle"></div>
                                        </div>
                                        <div class="account__content">
                                            <ul class="account-list">
                                                <li class="title-item"><a href="javascript:void(0);">My Account</a></li>
                                                <li><a href="#">Dasdboard</a></li>
                                                <li><a href="#">Account Setting</a></li>
                                                <li><a href="shopping-cart.html">Orders</a></li>
                                                <li><a href="wishlist.html">Wishlist</a></li>
                                                <li><a href="#">Shipping Address</a></li>
                                            </ul>
                                            <hr>
                                            <ul class="account-list">
                                                <li class="title-item"><a href="javascript:void(0);">Vendor Settings</a>
                                                </li>
                                                <li><a href="#">Dasdboard</a></li>
                                                <li><a href="#">Products</a></li>
                                                <li><a href="shopping-cart.html">Orders</a></li>
                                                <li><a href="#">Settings</a></li>
                                                <li><a href="vendor-store.html">View Store</a></li>
                                            </ul>
                                            <hr>
                                            <form action="{{ route('logout') }}" method="post">
                                                @csrf
                                                <a class="account-logout" href="route('logout')"
                                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                                    <i class="icon-exit-left"></i>Log out
                                                </a>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="ps-header--center header--mobile">
            <div class="container">
                <div class="header-inner">
                    <div class="header-inner__left">
                        <button class="navbar-toggler"><i class="icon-menu"></i></button>
                    </div>
                    <div class="header-inner__center"><a class="logo open" href="{{ route('welcome') }}"><img
                                src="{{ asset($company->image) }}" alt="{{ $company->name }}"></a></div>
                    <div class="header-inner__right">
                        <button class="button-icon icon-sm search-mobile"><i class="icon-magnifier"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <section class="ps-header--center header-desktop">
            <div class="container">
                <div class="header-inner">
                    <div class="header-inner__left"><a class="logo" href="{{ route('welcome') }}"><img
                                src="{{ asset($company->image) }}" alt="{{ $company->name }}"></a>
                    </div>
                    @include('layouts.search')
                    <div class="header-inner__right">
                        {{-- <button class="button-icon icon-md">
                            <i class="icon-repeat"></i>
                        </button>
                        <a class="button-icon icon-md" href="wishlist.html">
                            <i class="icon-heart"></i>
                            <span class="badge bg-warning">2</span>
                        </a> --}}
                        @include('layouts.cart')
                    </div>
                </div>
            </div>
        </section>
        @include('sweetalert::alert')
        @include('layouts.navigation')
        @include('layouts.mobile_search')
    </header>

    @yield('content')

    @include('layouts.footer')
    {{-- @include('layouts.mobile_navigation') --}}


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/97c8a3ba7d.js" crossorigin="anonymous"></script>
    {{-- <script src="{{ asset('assets/plugins/jquery.min.js') }}"></script> --}}
    <script src="{{ asset('assets/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery.matchHeight-min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-bar-rating/dist/jquery.barrating.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/slick/slick.js') }}"></script>
    <script src="{{ asset('assets/plugins/lightGallery/dist/js/lightgallery-all.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/noUiSlider/nouislider.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <!-- custom code-->
    <script src="{{ asset('assets/js/frontend.js') }}"></script>
    @stack('js')
</body>

</html>
