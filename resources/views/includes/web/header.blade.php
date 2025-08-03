<!DOCTYPE html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Lindy - Bootstrap 5 UI Kit</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.svg" />
    <!-- Place favicon.ico in the root directory -->

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="{{ asset('assets/web/css/bootstrap-5.0.0-alpha-2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/web/css/LineIcons.2.0.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/web/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/web/css/glightbox.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/web/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/web/css/style.css') }}" />
    <link href="{{ asset('assets/web/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/web/css/lindy-uikit.css') }}" />
    <!-- <link rel="stylesheet" href="https://cdn.lineicons.com/5.0/lineicons.css" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css"
        integrity="sha512-XcIsjKMcuVe0Ucj/xgIXQnytNwBttJbNjltBV18IOnru2lDPe9KRRyvCXw6Y5H415vbBLRm8+q6fmLUU7DfO6Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body style="background: #e5e5e5">
    <!--[if lte IE 9]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

    <!-- ========================= preloader start ========================= -->
    <div class="preloader">
        <div class="loader">
            <div class="spinner">
                <div class="spinner-container">
                    <div class="spinner-rotator">
                        <div class="spinner-left">
                            <div class="spinner-circle"></div>
                        </div>
                        <div class="spinner-right">
                            <div class="spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ========================= preloader end ========================= -->

    <!-- ========================= hero-section-wrapper-4 start ========================= -->
    <section class="hero-section-wrapper-4">
        <!-- ========================= header-3 start ========================= -->
        <header class="header header-3">
            <div class="navbar-area">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <nav class="navbar navbar-expand-lg">
                                <a class="navbar-brand" href="#">
                                    <img src="{{ asset('assets/web/images/logo.png') }}" style="height: 80px" alt="Logo" />
                                    <span class="fw-bold text-primary">Grade Genius</span>
                                </a>
                                <button class="navbar-toggler" type="button" data-toggle="collapse"
                                    data-target="#navbarSupportedContent3" aria-controls="navbarSupportedContent3"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="toggler-icon"></span>
                                    <span class="toggler-icon"></span>
                                    <span class="toggler-icon"></span>
                                </button>

                                <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent3">
                                    <ul id="nav3" class="navbar-nav ml-auto">
                                        <li class="nav-item">
                                            <a class="page-scroll" href="#0">Home</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="page-scroll" href="#0">About Us</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="page-scroll" href="#0">Service</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="page-scroll" href="#0">Feature</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="page-scroll" href="#0">Price</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="page-scroll" href="#0">Contact</a>
                                        </li>
                                    </ul>
                                    <div class="mb-4 d-lg-flex">
                                        <a href="{{ route('login') }}"
                                            class="button button-sm border-button radius-30 mr-20">Log In</a>
                                        <a href="{{ route('register') }}" class="button button-sm radius-30">Sign Up</a>
                                    </div>
                                </div>
                                <!-- navbar collapse -->
                            </nav>
                            <!-- navbar -->
                        </div>
                    </div>
                    <!-- row -->
                </div>
                <!-- container -->
            </div>
            <!-- navbar area -->
        </header>
        <!-- ========================= header-3 end ========================= -->
