<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Multikart admin panel">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('dashboard') }}/assets/images/dashboard/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('dashboard') }}/assets/images/dashboard/favicon.png" type="image/x-icon">
    <title>Dashboard | {{ config('app.name') }}</title>

    <!-- Google font-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600;700;800;900&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800;900&display=swap">

    <!-- Vendors css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard') }}/assets/css/vendors/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard') }}/assets/css/vendors/flag-icon.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard') }}/assets/css/vendors/icofont.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard') }}/assets/css/vendors/prism.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard') }}/assets/css/vendors/chartist.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard') }}/assets/css/vendors/bootstrap.css">

    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard') }}/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard') }}/dropify.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/dropify.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/select2.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="{{ app()->getLocale() == 'ar' ? 'rtl' : '' }}">
    <div class="page-wrapper">
        <!-- Page Header Start-->
        <div class="page-main-header">
            <div class="main-header-right row">
                <div class="main-header-left d-lg-none w-auto">
                    <div class="logo-wrapper"></div>
                </div>
                <div class="mobile-sidebar w-auto">
                    <div class="media-body text-end switch-sm">
                        <label class="switch">
                            <a href="javascript:void(0)">
                                <i id="sidebar-toggle" data-feather="align-left"></i>
                            </a>
                        </label>
                    </div>
                </div>
                <div class="nav-right col">
                    <ul class="nav-menus">
                        <li>
                            <form class="form-inline search-form">
                                <div class="form-group">
                                    <input class="form-control-plaintext" type="search" placeholder="Search..">
                                    <span class="d-sm-none mobile-search"><i data-feather="search"></i></span>
                                </div>
                            </form>
                        </li>
                        <li>
                            <a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()">
                                <i data-feather="maximize-2"></i>
                            </a>
                        </li>
                        <li class="onhover-dropdown">
                            <a class="txt-dark" href="javascript:void(0)">
                                <h6>{{ strtoupper(app()->getLocale()) }}</h6>
                            </a>
                            <ul class="language-dropdown onhover-show-div p-20">
                                <li><a href="{{ route('lang.switch', 'en') }}"><i class="flag-icon flag-icon-us"></i> English</a></li>
                                <li><a href="{{ route('lang.switch', 'ar') }}"><i class="flag-icon flag-icon-eg"></i> Arabic</a></li>
                            </ul>
                        </li>
                        <li class="onhover-dropdown">
                            <div class="media align-items-center">
                                <img class="align-self-center pull-right img-50 blur-up lazyloaded" src="{{ asset('dashboard/assets/images/dashboard/user3.jpg') }}" alt="header-user">
                                <div class="dotted-animation">
                                    <span class="animate-circle"></span>
                                    <span class="main-circle"></span>
                                </div>
                            </div>
                            <ul class="profile-dropdown onhover-show-div p-20 profile-dropdown-hover">
                                <li><a href="#"><i data-feather="user"></i>Edit Profile</a></li>
                                <li><a href="#"><i data-feather="settings"></i>Settings</a></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" id="logout-form" class="d-none">@csrf</form>
                                    <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i data-feather="log-out"></i> Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div class="d-lg-none mobile-toggle pull-right">
                        <i data-feather="more-horizontal"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header Ends -->

        <div class="page-body-wrapper">
            @include('dashboard.layout.sidebar')

            <div class="page-body">
                <div class="container-fluid mt-3">
                    <x-alert-admin />
                </div>
                @yield('body')
            </div>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 footer-copyright text-start">
                            <p class="mb-0">Copyright {{ date('Y') }} © Multikart All rights reserved.</p>
                        </div>
                        <div class="col-md-6 pull-right text-end">
                            <p class=" mb-0">Hand crafted & made with <i class="fa fa-heart text-danger"></i></p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- latest jquery-->
    <script src="{{ asset('dashboard') }}/assets/js/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/js/icons/feather-icon/feather-icon.js"></script>
    <script src="{{ asset('dashboard') }}/assets/js/sidebar-menu.js"></script>
    <script src="{{ asset('dashboard') }}/assets/js/chart/chartjs/chart.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/js/lazysizes.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/js/prism/prism.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/js/clipboard/clipboard.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/js/custom-card/custom-card.js"></script>
    <script src="{{ asset('dashboard') }}/assets/js/admin-script.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('dashboard') }}/select2.min.js"></script>
    <script src="{{asset('dashboard/assets/js/dropify.js')}}"></script>
    
    <script>
        $(document).ready(function() {
            if($('.dropify').length) $('.dropify').dropify();
        });
    </script>
    @stack('javascripts')
</body>
</html>
