<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="author" content="Md.Syful Islam">
<link rel="icon"  href="{{ asset('all-assets/user/images/food_small.png') }}" />
@yield('og')
<title>@yield('title')</title>    <!-- Bootstrap core CSS -->
<link href="{{ asset('all-assets/user/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('all-assets/user/css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ asset('all-assets/user/css/animsition.min.css') }}" rel="stylesheet">
<link href="{{ asset('all-assets/user/css/animate.css') }}" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="{{ asset('all-assets/user/css/style.css') }}" rel="stylesheet">

{{-- Page Css --}}
@yield('page-css')
</head>

<body class="home">
    <div class="site-wrapper animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
        <!--header starts-->
        <header id="header" class="header-scroll top-header headrom">
            <!-- .navbar -->
            <nav class="navbar navbar-dark" style="background:#e51937">
    <style>
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
    </style>
    <div class="container">
        <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>

        <!-- <a class="navbar-brand" href="index"> <img class="img-rounded" src="images/food.png" alt=""> </a> -->
        <a href="{{ url('/') }}" class="navbar-brand"><img class="img-rounded nav_logo" src="{{ asset('user/images/food.ico') }}" alt=""></a>

        <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
            <ul class="nav navbar-nav">
                <li class="nav-item"> <a class="nav-link" href="{{ url('/') }}">Home </a> </li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('/about') }}">About </a> </li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('/products') }}">Products </a> </li>



                <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">Outlates</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ url('/outlate2/Dhaka') }}">Dhaka</a>
                        <a class="dropdown-item" href="{{ url('/outlate2/Khulna') }}">Khulna</a>
                        <a class="dropdown-item" href="{{ url('/outlate2/Chittagong') }}">Chittagong</a>
                        <a class="dropdown-item" href="{{ url('/outlate2/Rajshahi') }}">Rajshahi</a>
                        <a class="dropdown-item" href="{{ url('/outlate2/Barisal') }}">Barisal</a>
                        <a class="dropdown-item" href="{{ url('/outlate2/Comilla') }}">Comilla</a>
                        <a class="dropdown-item" href="{{ url('/outlate2/Sylhet') }}">Sylhet</a>
                        <a class="dropdown-item" href="{{ url('/outlate2/Rangpur') }}">Rangpur</a>
                        {{-- <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="checkout.html">Checkout</a> --}}
                    </div>
                </li>

                <li class="nav-item"> <a class="nav-link" href="{{ url('/posts') }}">Posts </a> </li>



            </ul>
        </div>
    </div>
</nav>            <!-- /.navbar -->
</header>

 <!-- banner part starts -->

 @yield('content')



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
                     <p><p>Holding No E-236,<br>Ward No 007, Chandra, Kaliyakor, Gazipur<br></p></p>
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
 </footer>        <!-- end:Footer -->
    </div>
    <!--/end:Site wrapper -->



<!-- Bootstrap core JavaScript================================================== -->
<script src="{{ asset('all-assets/user/js/jquery.min.js') }}"></script>
<script src="{{ asset('all-assets/user/js/tether.min.js') }}"></script>
<script src="{{ asset('all-assets/user/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('all-assets/user/js/animsition.min.js') }}"></script>
<script src="{{ asset('all-assets/user/js/bootstrap-slider.min.js') }}"></script>
<script src="{{ asset('all-assets/user/js/jquery.isotope.min.js') }}"></script>
<script src="{{ asset('all-assets/user/js/headroom.js') }}"></script>
<script src="{{ asset('all-assets/user/js/foodpicky.min.js') }}"></script>
<script src="{{ asset('all-assets/user/js/navbar-active.js') }}"></script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5d70ee6656c8eee5"></script>
{{-- Page Js --}}
@yield('page-js')
</body>

</html>
