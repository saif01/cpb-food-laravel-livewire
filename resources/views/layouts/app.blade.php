<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
{{--
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="icon"  href="{{ asset('all-assets/user/images/food_small.png') }}" />
    <title>@yield('title')</title>

    <link href="{{ asset('all-assets/user/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('all-assets/user/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('all-assets/user/css/animsition.min.css') }}" rel="stylesheet">
    <link href="{{ asset('all-assets/user/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('all-assets/user/css/style.css') }}" rel="stylesheet">

    <livewire:styles />
      <livewire:scripts />
        <script src="{{ asset('js/app.js') }}" ></script>

    @stack('styles')

    {{-- Page Css --}}
    @yield('page-css')

    <style>
        .turbolinks-progress-bar {
            height: 5px;
            background-color: yellow;
        }
        .nav_logo {
            height: 100px;
            width: 100px;
            margin-bottom: -70px;
        }
        .navbar-nav .nav-link:hover {
            color: #fdbc56 !important;
        }
        .navbar-dark .navbar-nav .nav-link {
            font-weight: bold;
        }
        .hedader-bg{
            background-image: url("{{ asset('all-assets/user/images/bg/bg-blure.jpg') }}");
            /* background-color: #cccccc; */
            max-height: 150px;
        }
    </style>


</head>
<body >

    <div class="site-wrapper" data-animsition-in="fade-in" data-animsition-out="fade-out">

        <!--header starts-->
        <header id="header" class="header-scroll top-header headrom">
            <!-- .navbar -->
            <nav class="navbar navbar-dark" style="background:#e51937">

                <div class="container">
                    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>

                    <!-- <a class="navbar-brand" href="index"> <img class="img-rounded" src="images/food.png" alt=""> </a> -->
                    <a href="{{ url('/') }}" class="navbar-brand"><img class="img-rounded nav_logo" src="{{ asset('all-assets/user/images/food.ico') }}" alt=""></a>

                    <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                        <ul class="nav navbar-nav">
                            <li class="nav-item"> <a class="nav-link" href="{{ url('/') }}">Home </a> </li>
                            <li class="nav-item"> <a class="nav-link" href="{{ url('/posts') }}">Posts </a> </li>
                            <li class="nav-item"> <a class="nav-link" href="{{ url('/products') }}">Products </a> </li>
                            <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle open" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Outlates</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ url('/outlates/Dhaka') }}">Dhaka</a>
                                    <a class="dropdown-item" href="{{ url('/outlates/Khulna') }}">Khulna</a>
                                    <a class="dropdown-item" href="{{ url('/outlates/Chittagong') }}">Chittagong</a>
                                    <a class="dropdown-item" href="{{ url('/outlates/Rajshahi') }}">Rajshahi</a>
                                    <a class="dropdown-item" href="{{ url('/outlates/Barisal') }}">Barisal</a>
                                    <a class="dropdown-item" href="{{ url('/outlates/Comilla') }}">Comilla</a>
                                    <a class="dropdown-item" href="{{ url('/outlates/Sylhet') }}">Sylhet</a>
                                    <a class="dropdown-item" href="{{ url('/outlates/Rangpur') }}">Rangpur</a>

                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav> <!-- /.navbar -->
        </header>



        <!-- banner part starts -->
        <div>
            @yield('content')
        </div>




        <!-- start: FOOTER -->
        <footer class="footer">
            <div class="container">

                <!-- bottom footer statrs -->
                <div class="bottom-footer">
                    <div class="row">
                        <div class="col-xs-12 col-sm-3 about color-gray">
                            <h5>About Us</h5>
                            <ul>
                                <li><a href="about">About us</a> </li>
                                <li><a href="#">History</a> </li>
                                <li><a href="#">Our Team</a> </li>
                                <li><a href="#">We are hiring</a> </li>
                            </ul>
                        </div>
                        <div class="col-xs-12 col-sm-4 address color-gray">
                            <h5>Address</h5>
                            <p>
                                Holding No E-236,<br>Ward No 007, Chandra, Kaliyakor, Gazipur
                            </p>
                            <h5>Phone: <a href="tel:+88 01707-08 04 01">+88 01707-08 04 01</a></h5>
                        </div>
                        <div class="col-xs-12 col-sm-5 additional-info color-gray">
                            <h5>Addition informations</h5>
                            <p>Join the thousands of other restaurants who benefit from having their menus on TakeOff</p>
                        </div>
                    </div>
                </div>
                <!-- bottom footer ends -->
            </div>
        </footer> <!-- end:Footer -->
    </div>


        {{-- <script src="{{ asset('all-assets/common/bootstrap-4.5/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('all-assets/common/bootstrap-4.5/js/popper.min.js') }}"></script>
    <script src="{{ asset('all-assets/common/bootstrap-4.5/js/bootstrap.min.js') }}"></script> --}}

        <script src="{{ asset('all-assets/user/js/jquery.min.js') }}"></script>
        <script src="{{ asset('all-assets/user/js/tether.min.js') }}"></script>
        <script src="{{ asset('all-assets/user/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('all-assets/user/js/animsition.min.js') }}"></script>
        {{-- <script src="{{ asset('all-assets/user/js/bootstrap-slider.min.js') }}"></script> --}}
        {{-- <script src="{{ asset('all-assets/user/js/jquery.isotope.min.js') }}"></script> --}}
        <script src="{{ asset('all-assets/user/js/headroom.js') }}"></script>
        {{-- <script src="{{ asset('all-assets/user/js/foodpicky.js') }}"></script> --}}
        <script src="{{ asset('all-assets/user/js/navbar-active.js') }}"></script>


        <script>

           // grab an element
            var myElement = document.querySelector('#header');
            // construct an instance of Headroom, passing the element
            var headroom = new Headroom(myElement, {
                // vertical offset in px before element is first unpinned
                offset: 80, // scroll tolerance in px before state changes
                tolerance: 40, // if you need other CSS classes, to apply these options.
                classes: {
                    initial: "animated",
                    pinned: "fadeInDown",
                    unpinned: "fadeOutUp"
                }
            });
            // initialise
            headroom.init();

    headroom.init();

        </script>



        {{-- Custom Script --}}
        @stack('scripts')
</body>
</html>
