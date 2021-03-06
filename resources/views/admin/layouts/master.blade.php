<!DOCTYPE html>
<html lang="en" class="loading">
<!-- BEGIN : Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('admin.layouts.icon')
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900|Montserrat:300,400,500,600,700,800,900" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('all-assets/admin/app-assets/fonts/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('all-assets/admin/app-assets/vendors/css/perfect-scrollbar.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('all-assets/admin/app-assets/vendors/css/prism.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('all-assets/admin/app-assets/css/modified.app.css') }}">
    <!-- END APEX CSS-->


    <!-- Page CSS-->
    @yield("page-css")



    <!-- BEGIN : Body-->

<body data-col="2-columns" class=" 2-columns ">
    <!-- ////////////////////////////////////////////////////////////////////////////   -->
    <div class="wrapper">


        <!-- main menu-->

        <div data-active-color="white" data-background-color="man-of-steel" data-image="{{ asset('all-assets/admin/app-assets/img/sidebar-bg/01.jpg') }}" class="app-sidebar">
            <!-- main menu header-->
            <!-- Sidebar Header starts-->
            <div class="sidebar-header">
                <div class="logo clearfix"><a href="{{ route('admin.dashboard') }}" class="logo-text float-left tex-normal">
                        <div class="logo-img"><img src="{{ asset('all-assets/common/logo/cpbit.png') }}" class="rotate logoImg" /></div><span class="text align-middle h5">Food</span>
                    </a>
                    <a id="sidebarToggle" href="javascript:;" class="nav-toggle d-none d-sm-none d-md-none d-lg-block"><i data-toggle="expanded" class="toggle-icon ft-toggle-right"></i></a><a id="sidebarClose" href="javascript:;" class="nav-close d-block d-md-block d-lg-none d-xl-none"><i class="ft-x"></i></a></div>
            </div>
            <!-- Sidebar Header Ends-->
            <!-- / main menu header-->
            <!-- main menu content-->
            <div class="sidebar-content">
                <div class="nav-container">
                    <ul id="main-menu-navigation" data-menu="menu-navigation" data-scroll-to-active="true" class="navigation navigation-main">

                        <li class="nav-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-tachometer" ></i><span class="menu-title">Dashboard</span></a></li>

                        <div class="dropdown-divider"></div>
                        @can('manageUser')

                            <li class="nav-item"><a href="{{ route('role.all') }}"><i class="fa fa-grav red" ></i><span class="menu-title">All Roles</span></a></li>
                            <li class="nav-item"><a href="{{ route('user.all') }}"><i class="fa fa-users green"></i><span class="menu-title">All Users</span></a></li>
                            <div class="dropdown-divider"></div>

                        @endcan

                        @can('post')

                            <li class="nav-item"><a href="{{ route('post.all') }}"><i class="fa fa-file-text-o" ></i>
                                <span class="menu-title">Post</span></a></li>

                        @endcan

                        @can('product')

                            <li class="nav-item"><a href="{{ route('product.all') }}"><i class="fa fa-file-text-o blue" ></i>
                                <span class="menu-title">Product</span></a></li>

                        @endcan

                        @can('promotion')

                            <li class="nav-item"><a href="{{ route('promotion.all') }}"><i class="fa fa-file-text-o green"></i>
                                <span class="menu-title">Promotion</span></a></li>

                        @endcan

                        @can('about')

                            <li class="nav-item"><a href="{{ route('about.all') }}"><i class="fa fa-file-text-o yellow"></i>
                                <span class="menu-title">About</span></a></li>

                        @endcan

                        @can('contact')

                            <li class="nav-item"><a href="{{ route('contact.all') }}"><i class="fa fa-file-text-o yellow"></i>
                                <span class="menu-title">Contact</span></a></li>

                        @endcan

                        @can('contact')

                            <li class="nav-item"><a href="{{ route('outlate.all') }}"><i class="fa fa-file-text-o yellow"></i>
                            <span class="menu-title">Outlate</span></a></li>

                        @endcan

                        @can('contact')

                            <li class="nav-item"><a href="{{ route('slider.all') }}"><i class="fa fa-file-text-o yellow"></i>
                            <span class="menu-title">Slider</span></a></li>

                        @endcan

                        <li class="nav-item">

                        <a  href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                             <i class="fa fa-sign-out red"></i> <span class="menu-title">Logout</span>
                         </a>

                         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                             @csrf
                         </form>

                        </li>

                    </ul>
                </div>
            </div>


            <!-- main menu content-->
            <div class="sidebar-background"></div>
            <!-- main menu footer-->

        </div>
        <!-- / main menu-->


        <!-- Navbar (Header) Starts-->
        <nav class="navbar navbar-expand-lg navbar-light bg-faded header-navbar">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" data-toggle="collapse" class="navbar-toggle d-lg-none float-left"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><span class="d-lg-none navbar-right navbar-collapse-toggle"><a aria-controls="navbarSupportedContent" href="javascript:;" class="open-navbar-container black"><i class="ft-more-vertical"></i></a></span>
                    <span class="badge gradient-crystal-clear white">{{ session()->get('user.name') }}</span>

                    {{-- @if (session()->get('admin.super') == 1)
                    <span class="badge gradient-pomegranate white ml-1">Act as a Super Admin</span>
                    @endif --}}

                </div>
                <div class="navbar-container">
                    <div id="navbarSupportedContent" class="collapse navbar-collapse">
                        <a href="{{ route('admin.dashboard') }}"><button class="btn btn-raised gradient-pomegranate white big-shadow mr-3">Home</button></a>
                        <ul class="navbar-nav">
                            <li class="nav-item mr-2 d-none d-lg-block"><a id="navbar-fullscreen" href="javascript:;" class="nav-link apptogglefullscreen"><i class="ft-maximize font-medium-3 blue-grey darken-4"></i>
                                    <p class="d-none">fullscreen</p>
                                </a></li>

                            <li class="dropdown nav-item"><a id="dropdownBasic3" href="#" data-toggle="dropdown"
                                    class="nav-link position-relative dropdown-toggle">
                                    <img src="{{ (!empty( Auth::user()->image_small ))?asset( Auth::user()->image_small ):asset('all-assets/common/default-img/user.png') }}" alt="Admin-img" class="admin-img">
                                </a>
                                <div ngbdropdownmenu="" aria-labelledby="dropdownBasic3" class="dropdown-menu text-left dropdown-menu-right">

                                    <!-- <div class="dropdown-divider"></div> -->
                                    <a class="dropdown-item"  href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out red"></i> <span class="menu-title">Logout</span>
                                    </a>

                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Navbar (Header) Ends-->

        <div class="main-panel">
            <!-- BEGIN : Main Content-->
            <div class="main-content">
                <div class="content-wrapper">
                    <!-- Zero configuration table -->

                    @yield('content')


                </div>
            </div>
            <!-- END : End Main Content-->



            <!-- BEGIN : Footer-->
            <footer class="footer footer-static footer-light">
               <p class="clearfix text-muted text-sm-center px-2"><span>Copyright &copy; All rights reserved in CPB-IT.
                    </span></p>
            </footer>
            <!-- End : Footer-->

        </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <!-- END Notification Sidebar-->



    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('all-assets/admin/app-assets/vendors/js/core/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('all-assets/admin/app-assets/vendors/js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('all-assets/admin/app-assets/vendors/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('all-assets/admin/app-assets/vendors/js/perfect-scrollbar.jquery.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('all-assets/admin/app-assets/vendors/js/prism.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('all-assets/admin/app-assets/vendors/js/jquery.matchHeight-min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('all-assets/admin/app-assets/vendors/js/screenfull.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('all-assets/admin/app-assets/vendors/js/pace/pace.min.js') }}" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->

    <!-- BEGIN APEX JS-->
    <script src="{{ asset('all-assets/admin/app-assets/js/app-sidebar.js') }}" type="text/javascript"></script>
    {{-- Tostar + Sweetalert 2 --}}
    <script src="{{ asset('all-assets/common/sweet-alert-2/sw-alert.js') }}" type="text/javascript"></script>



     {{-- Toastar Alert --}}
     <script type="text/javascript">

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })


        @if(Session::has('messege'))

            Toast.fire({
                icon: "{{ Session::get('alert-type') }}",
                title: "{{ Session::get('messege') }}"
            })

         {{ Session::forget('messege') }}
         @endif
    </script>


   {{-- Page Js  --}}
   @yield("page-js")


</body>
<!-- END : Body-->

</html>
