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
    <link rel="stylesheet" href="{{ asset('assets/web/css/lindy-uikit.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>

<body>
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



    <!-- ========================= login-style-2 start ========================= -->
    <section class="login-section login-style-2 mb-50 mt-80">
        <div class="container">
            <div class="login-wrapper img-bg">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-xl-5 offset-xl-1">
                        <div class="login-content-wrapper">
                            <div class="section-title mb-40">
                                <h3 class="mb-20">Log In</h3>
                                <p>Morbi et sagittis dui, sed fermentum ante. Pellentesque <br
                                        class="d-none d-md-block"> molestie sit amet dolor vel euismod.</p>
                            </div>
                            <form action="{{ route('login') }}" method="post" class="login-form">
                                @csrf
                                <div class="single-input">
                                    <label for="login-email">Email</label>
                                    <input type="email" id="login-email" value="{{ old('email') }}" name="email" placeholder="Your Email">
                                    <i class="lni lni-envelope"></i>
                                </div>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="single-input">
                                    <label for="login-password">Password</label>
                                    <input type="password" id="login-password" value="{{ old('password') }}" name="password"
                                        placeholder="Enter password">
                                    <i class="lni lni-lock"></i>

                                </div>
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-footer">
                                    <div class="form-check mb-25">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Remember Me
                                        </label>
                                    </div>
                                    <p class="mb-25"><a href="#0">Forgot Password?</a></p>
                                </div>
                                <div class="signup-button mb-25">
                                    <button class="button button-lg radius-10 btn-block">Log in</button>
                                </div>
                                <p class="mb-25">Don't have an account? <a href="{{ route('register') }}">Sign up</a> </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========================= login-style-2 end ========================= -->



    <!-- ========================= JS here ========================= -->
    <script src="{{ asset('assets/web/js/bootstrap.5.0.0.alpha-2-min.js') }}"></script>
    <script src="{{ asset('assets/web/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('assets/web/js/count-up.min.js') }}"></script>
    <script src="{{ asset('assets/web/js/imagesloaded.min.js') }}"></script>
    <script src="{{ asset('assets/web/js/isotope.min.js') }}"></script>
    <script src="{{ asset('assets/web/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/web/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/web/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>
</body>

</html>
