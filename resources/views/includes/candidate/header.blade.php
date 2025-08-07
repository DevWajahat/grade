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
    <link rel="stylesheet" href="{{ asset('assets/candidate/css/bootstrap-5.0.0-alpha-2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/candidate/css/LineIcons.2.0.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/candidate/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/candidate/css/glightbox.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/candidate/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/candidate/css/style.css') }}" />
    <link href="{{ asset('assets/candidate/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/candidate/css/lindy-uikit.css') }}" />
    <!-- <link rel="stylesheet" href="https://cdn.lineicons.com/5.0/lineicons.css" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css"
        integrity="sha512-XcIsjKMcuVe0Ucj/xgIXQnytNwBttJbNjltBV18IOnru2lDPe9KRRyvCXw6Y5H415vbBLRm8+q6fmLUU7DfO6Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>


    <!-- ================================= header start ============================================= -->
    <header class="container-fluid d-flex justify-content-between align-items-center app-bar">
        <div class="right-side">
            <h6 class="text-primary mb-0">Grade Genius</h6>
        </div>
        <div class="left-side">
            <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                aria-controls="offcanvasExample">
                <i class="ri-menu-line"></i>
            </button>
        </div>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
            aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href="#"
                                class="text-decoration-none text-dark">Dashboard</a></li>
                        <li class="list-group-item"><a href="#"
                                class="text-decoration-none text-dark">Settings</a></li>
                        <li class="list-group-item"><a href="#" class="text-decoration-none text-dark">Help</a>
                        </li>
                        <li class="list-group-item"><a href="{{ route('logout') }} " class="text-decoration-none text-dark">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <!-- ================================= header ends ============================================= -->
