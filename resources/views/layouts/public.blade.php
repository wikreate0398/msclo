<!DOCTYPE html>
<html lang="ru">
<head>
    <!-- Title -->
    <title>Massclo - интернет магазин</title>

    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="/favicon.png">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap" rel="stylesheet">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="/vendor/font-awesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="/css/font-electro.css">

    <link rel="stylesheet" href="/vendor/animate.css/animate.min.css">
    <link rel="stylesheet" href="/vendor/hs-megamenu/src/hs.megamenu.css">
    <link rel="stylesheet" href="/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="/vendor/fancybox/jquery.fancybox.css">
    <link rel="stylesheet" href="/vendor/slick-carousel/slick/slick.css">
    <link rel="stylesheet" href="/vendor/bootstrap-select/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="/vendor/ion-rangeslider/css/ion.rangeSlider.css">

    <!-- CSS Electro Template -->
    <link rel="stylesheet" href="/css/theme.css?v={{ time() }}">
    <link rel="stylesheet" href="/css/loader.css">
    <script src="/vendor/jquery/dist/jquery.min.js"></script>
    <script>
        const CSRF_TOKEN      = $('meta[name="csrf-token"]').attr('content');
        const addToFavUrl     = '{{ route('add_fav', ['lang' => $lang]) }}';
        const _favPage        = false;
        const addToCompareUrl = '{{ route('add_compare', ['lang' => $lang]) }}';
    </script>

</head>

<body>

@include('layouts.blocks.header')
<!-- ========== END HEADER ========== -->

<!-- ========== MAIN CONTENT ========== -->
<main id="content" role="main">
    <div class="bg-gray-13 bg-md-transparent">
        <div class="container">
            <!-- breadcrumb -->
            @if(@$page_data['page_type'] != 'home')
                <div class="my-md-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="/">Главная</a></li>
                            @if(!empty($breads))
                                {!! $breads !!}
                            @else
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">
                                    {{ $page_data["name_$lang"] }}
                                </li>
                            @endif
                        </ol>
                    </nav>
                </div>
            @endif
            <!-- End breadcrumb -->
        </div>
    </div>

    @yield('content')
</main>
<!-- ========== END MAIN CONTENT ========== -->

<!-- ========== FOOTER ========== -->
<footer>

    <!-- Footer-newsletter -->
    <div class="bg-primary py-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 mb-md-3 mb-lg-0">
                    <div class="row align-items-center">
                        <div class="col-auto flex-horizontal-center">
                            <i class="ec ec-phone font-size-40"></i>
                            <h2 class="font-size-20 mb-0 ml-3">Обратный звонок</h2>
                        </div>
                        <div class="col my-4 my-md-0">
                            <h5 class="font-size-15 ml-4 mb-0">Наш менеджер свяжется с вами как можно скорее</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <!-- Subscribe Form -->
                    <form class="js-validate js-form-message">
                        <label class="sr-only" for="subscribeSrEmail">Телевфон</label>
                        <div class="input-group input-group-pill">
                            <input type="email" class="form-control border-0 height-40" name="email" id="subscribeSrEmail" placeholder="Телевфон" aria-label="Телевфон" aria-describedby="subscribeButton" required
                                   data-msg="Please enter a valid email address.">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-dark btn-sm-wide height-40 py-2" id="subscribeButton">Отправить</button>
                            </div>
                        </div>
                    </form>
                    <!-- End Subscribe Form -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer-newsletter -->
    <!-- Footer-bottom-widgets -->
    <div class="pt-8 pb-4 bg-gray-13">
        <div class="container mt-1">
            <div class="row">
                <div class="col-lg-5">
                    <div class="mb-6">
                        <a href="#" class="d-inline-block">
                            <img src="/img/logo.png" style="max-width: 250px;">
                        </a>
                    </div>
                    <div class="mb-4">
                        <div class="row no-gutters">
                            <div class="col-auto">
                                <i class="ec ec-support text-primary font-size-56"></i>
                            </div>
                            <div class="col pl-3">
                                <div class="font-size-13 font-weight-light">Появились вопросы? Мы доступны 24/7!</div>
                                <a href="tel:+80080018588" class="font-size-20 text-gray-90">(800) 8001-8588, </a><a href="tel:+0600874548" class="font-size-20 text-gray-90">(0600) 874 548</a>
                            </div>
                        </div>
                    </div>

                    <h6 class="font-weight-bold">Мы в соц-сетях</h6>
                        <ul class="list-inline mb-0 opacity-7">
                            <li class="list-inline-item mr-0">
                                <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="#">
                                    <span class="fab fa-facebook-f btn-icon__inner"></span>
                                </a>
                            </li>
                            <li class="list-inline-item mr-0">
                                <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="#">
                                    <span class="fab fa-google btn-icon__inner"></span>
                                </a>
                            </li>
                            <li class="list-inline-item mr-0">
                                <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="#">
                                    <span class="fab fa-twitter btn-icon__inner"></span>
                                </a>
                            </li>
                            <li class="list-inline-item mr-0">
                                <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="#">
                                    <span class="fab fa-github btn-icon__inner"></span>
                                </a>
                            </li>
                        </ul>

                </div>
                <div class="col-lg-7">
                    <div class="row">

                        <div class="col-12 col-md mb-4 mb-md-0">
                            <h6 class="mb-3 font-weight-bold">Компания</h6>
                            <ul class="list-group list-group-flush list-group-borderless mb-0 list-group-transparent">
                                @foreach($menu as $item)
                                    <li>
                                        <a class="list-group-item list-group-item-action" href="{{ setUri($item['url']) }}">
                                            {{ $item["name_$lang"] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="col-12 col-md mb-4 mb-md-0">
                            <h6 class="mb-3 font-weight-bold">Категории</h6>
                            <ul class="list-group list-group-flush list-group-borderless mb-0 list-group-transparent">
                                @foreach(map_tree($categories->toArray()) as $category)
                                    <li>
                                        <a class="list-group-item list-group-item-action" href="{{ setUri("catalog/{$category['url']}") }}">
                                            {{ $category["name_$lang"] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="col-12 col-md mb-4 mb-md-0">
                            <h6 class="mb-3 font-weight-bold">Данные клиента</h6>
                            <!-- List Group -->
                            <ul class="list-group list-group-flush list-group-borderless mb-0 list-group-transparent">
                                <li><a class="list-group-item list-group-item-action" href="">Мой профиль</a></li>
                                <li><a class="list-group-item list-group-item-action" href="">Мои заказы</a></li>
                                <li><a class="list-group-item list-group-item-action" href="">Избранное</a></li>
                            </ul>
                            <!-- End List Group -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer-bottom-widgets -->
    <!-- Footer-copy-right -->
    <div class="bg-gray-14 py-2">
        <div class="container">
            <div class="flex-center-between d-block d-md-flex">
                <div class="mb-3 mb-md-0">© <a href="#" class="font-weight-bold text-gray-90">Massclo</a> - Все права защищены</div>
            </div>
        </div>
    </div>
    <!-- End Footer-copy-right -->
</footer>
<!-- ========== END FOOTER ========== -->

<!-- ========== SECONDARY CONTENTS ========== -->
<!-- Account Sidebar Navigation -->
<aside id="sidebarContent" class="u-sidebar u-sidebar__lg" aria-labelledby="sidebarNavToggler">
    <div class="u-sidebar__scroller">
        <div class="u-sidebar__container">
            <div class="js-scrollbar u-header-sidebar__footer-offset pb-3">
                <!-- Toggle Button -->
                <div class="d-flex align-items-center pt-4 px-7">
                    <button type="button" class="close ml-auto"
                            aria-controls="sidebarContent"
                            aria-haspopup="true"
                            aria-expanded="false"
                            data-unfold-event="click"
                            data-unfold-hide-on-scroll="false"
                            data-unfold-target="#sidebarContent"
                            data-unfold-type="css-animation"
                            data-unfold-animation-in="fadeInRight"
                            data-unfold-animation-out="fadeOutRight"
                            data-unfold-duration="500">
                        <i class="ec ec-close-remove"></i>
                    </button>
                </div>
                <!-- End Toggle Button -->

                <!-- Content -->
                <div class="js-scrollbar u-sidebar__body">
                    <div class="u-sidebar__content u-header-sidebar__content">
                        <form class="js-validate">
                            <!-- Login -->
                            <div id="login" data-target-group="idForm">
                                <!-- Title -->
                                <header class="text-center mb-7">
                                    <h2 class="h4 mb-0">Welcome Back!</h2>
                                    <p>Login to manage your account.</p>
                                </header>
                                <!-- End Title -->

                                <!-- Form Group -->
                                <div class="form-group">
                                    <div class="js-form-message js-focus-state">
                                        <label class="sr-only" for="signinEmail">Email</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                        <span class="input-group-text" id="signinEmailLabel">
                                                            <span class="fas fa-user"></span>
                                                        </span>
                                            </div>
                                            <input type="email" class="form-control" name="email" id="signinEmail" placeholder="Email" aria-label="Email" aria-describedby="signinEmailLabel" required
                                                   data-msg="Please enter a valid email address."
                                                   data-error-class="u-has-error"
                                                   data-success-class="u-has-success">
                                        </div>
                                    </div>
                                </div>
                                <!-- End Form Group -->

                                <!-- Form Group -->
                                <div class="form-group">
                                    <div class="js-form-message js-focus-state">
                                        <label class="sr-only" for="signinPassword">Password</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                    <span class="input-group-text" id="signinPasswordLabel">
                                                        <span class="fas fa-lock"></span>
                                                    </span>
                                            </div>
                                            <input type="password" class="form-control" name="password" id="signinPassword" placeholder="Password" aria-label="Password" aria-describedby="signinPasswordLabel" required
                                                   data-msg="Your password is invalid. Please try again."
                                                   data-error-class="u-has-error"
                                                   data-success-class="u-has-success">
                                        </div>
                                    </div>
                                </div>
                                <!-- End Form Group -->

                                <div class="d-flex justify-content-end mb-4">
                                    <a class="js-animation-link small link-muted" href="javascript:;"
                                       data-target="#forgotPassword"
                                       data-link-group="idForm"
                                       data-animation-in="slideInUp">Forgot Password?</a>
                                </div>

                                <div class="mb-2">
                                    <button type="submit" class="btn btn-block btn-sm btn-primary transition-3d-hover">Login</button>
                                </div>

                                <div class="text-center mb-4">
                                    <span class="small text-muted">Do not have an account?</span>
                                    <a class="js-animation-link small text-dark" href="javascript:;"
                                       data-target="#signup"
                                       data-link-group="idForm"
                                       data-animation-in="slideInUp">Signup
                                    </a>
                                </div>

                                <div class="text-center">
                                    <span class="u-divider u-divider--xs u-divider--text mb-4">OR</span>
                                </div>

                                <!-- Login Buttons -->
                                <div class="d-flex">
                                    <a class="btn btn-block btn-sm btn-soft-facebook transition-3d-hover mr-1" href="#">
                                        <span class="fab fa-facebook-square mr-1"></span>
                                        Facebook
                                    </a>
                                    <a class="btn btn-block btn-sm btn-soft-google transition-3d-hover ml-1 mt-0" href="#">
                                        <span class="fab fa-google mr-1"></span>
                                        Google
                                    </a>
                                </div>
                                <!-- End Login Buttons -->
                            </div>

                            <!-- Signup -->
                            <div id="signup" style="display: none; opacity: 0;" data-target-group="idForm">
                                <!-- Title -->
                                <header class="text-center mb-7">
                                    <h2 class="h4 mb-0">Welcome to Electro.</h2>
                                    <p>Fill out the form to get started.</p>
                                </header>
                                <!-- End Title -->

                                <!-- Form Group -->
                                <div class="form-group">
                                    <div class="js-form-message js-focus-state">
                                        <label class="sr-only" for="signupEmail">Email</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                        <span class="input-group-text" id="signupEmailLabel">
                                                            <span class="fas fa-user"></span>
                                                        </span>
                                            </div>
                                            <input type="email" class="form-control" name="email" id="signupEmail" placeholder="Email" aria-label="Email" aria-describedby="signupEmailLabel" required
                                                   data-msg="Please enter a valid email address."
                                                   data-error-class="u-has-error"
                                                   data-success-class="u-has-success">
                                        </div>
                                    </div>
                                </div>
                                <!-- End Input -->

                                <!-- Form Group -->
                                <div class="form-group">
                                    <div class="js-form-message js-focus-state">
                                        <label class="sr-only" for="signupPassword">Password</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                        <span class="input-group-text" id="signupPasswordLabel">
                                                            <span class="fas fa-lock"></span>
                                                        </span>
                                            </div>
                                            <input type="password" class="form-control" name="password" id="signupPassword" placeholder="Password" aria-label="Password" aria-describedby="signupPasswordLabel" required
                                                   data-msg="Your password is invalid. Please try again."
                                                   data-error-class="u-has-error"
                                                   data-success-class="u-has-success">
                                        </div>
                                    </div>
                                </div>
                                <!-- End Input -->

                                <!-- Form Group -->
                                <div class="form-group">
                                    <div class="js-form-message js-focus-state">
                                        <label class="sr-only" for="signupConfirmPassword">Confirm Password</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                    <span class="input-group-text" id="signupConfirmPasswordLabel">
                                                        <span class="fas fa-key"></span>
                                                    </span>
                                            </div>
                                            <input type="password" class="form-control" name="confirmPassword" id="signupConfirmPassword" placeholder="Confirm Password" aria-label="Confirm Password" aria-describedby="signupConfirmPasswordLabel" required
                                                   data-msg="Password does not match the confirm password."
                                                   data-error-class="u-has-error"
                                                   data-success-class="u-has-success">
                                        </div>
                                    </div>
                                </div>
                                <!-- End Input -->

                                <div class="mb-2">
                                    <button type="submit" class="btn btn-block btn-sm btn-primary transition-3d-hover">Get Started</button>
                                </div>

                                <div class="text-center mb-4">
                                    <span class="small text-muted">Already have an account?</span>
                                    <a class="js-animation-link small text-dark" href="javascript:;"
                                       data-target="#login"
                                       data-link-group="idForm"
                                       data-animation-in="slideInUp">Login
                                    </a>
                                </div>

                                <div class="text-center">
                                    <span class="u-divider u-divider--xs u-divider--text mb-4">OR</span>
                                </div>

                                <!-- Login Buttons -->
                                <div class="d-flex">
                                    <a class="btn btn-block btn-sm btn-soft-facebook transition-3d-hover mr-1" href="#">
                                        <span class="fab fa-facebook-square mr-1"></span>
                                        Facebook
                                    </a>
                                    <a class="btn btn-block btn-sm btn-soft-google transition-3d-hover ml-1 mt-0" href="#">
                                        <span class="fab fa-google mr-1"></span>
                                        Google
                                    </a>
                                </div>
                                <!-- End Login Buttons -->
                            </div>
                            <!-- End Signup -->

                            <!-- Forgot Password -->
                            <div id="forgotPassword" style="display: none; opacity: 0;" data-target-group="idForm">
                                <!-- Title -->
                                <header class="text-center mb-7">
                                    <h2 class="h4 mb-0">Recover Password.</h2>
                                    <p>Enter your email address and an email with instructions will be sent to you.</p>
                                </header>
                                <!-- End Title -->

                                <!-- Form Group -->
                                <div class="form-group">
                                    <div class="js-form-message js-focus-state">
                                        <label class="sr-only" for="recoverEmail">Your email</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                        <span class="input-group-text" id="recoverEmailLabel">
                                                            <span class="fas fa-user"></span>
                                                        </span>
                                            </div>
                                            <input type="email" class="form-control" name="email" id="recoverEmail" placeholder="Your email" aria-label="Your email" aria-describedby="recoverEmailLabel" required
                                                   data-msg="Please enter a valid email address."
                                                   data-error-class="u-has-error"
                                                   data-success-class="u-has-success">
                                        </div>
                                    </div>
                                </div>
                                <!-- End Form Group -->

                                <div class="mb-2">
                                    <button type="submit" class="btn btn-block btn-sm btn-primary transition-3d-hover">Recover Password</button>
                                </div>

                                <div class="text-center mb-4">
                                    <span class="small text-muted">Remember your password?</span>
                                    <a class="js-animation-link small" href="javascript:;"
                                       data-target="#login"
                                       data-link-group="idForm"
                                       data-animation-in="slideInUp">Login
                                    </a>
                                </div>
                            </div>
                            <!-- End Forgot Password -->
                        </form>
                    </div>
                </div>
                <!-- End Content -->
            </div>
        </div>
    </div>
</aside>
<!-- End Account Sidebar Navigation -->
<!-- ========== END SECONDARY CONTENTS ========== -->

<!-- Go to Top -->
<a class="js-go-to u-go-to" href="#"
   data-position='{"bottom": 15, "right": 15 }'
   data-type="fixed"
   data-offset-top="400"
   data-compensation="#header"
   data-show-effect="slideInUp"
   data-hide-effect="slideOutDown">
    <span class="fas fa-arrow-up u-go-to__inner"></span>
</a>
<!-- End Go to Top -->

<!-- JS Global Compulsory -->
<script src="/vendor/jquery-migrate/dist/jquery-migrate.min.js"></script>
<script src="/vendor/popper.js/dist/umd/popper.min.js"></script>
<script src="/vendor/bootstrap/bootstrap.min.js"></script>

<!-- JS Implementing Plugins -->
<script src="/vendor/appear.js"></script>
<script src="/vendor/jquery.countdown.min.js"></script>
<script src="/vendor/hs-megamenu/src/hs.megamenu.js"></script>
<script src="/vendor/svg-injector/dist/svg-injector.min.js"></script>
<script src="/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="/vendor/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="/vendor/fancybox/jquery.fancybox.min.js"></script>
<script src="/vendor/typed.js/lib/typed.min.js"></script>
<script src="/vendor/slick-carousel/slick/slick.js"></script>
<script src="/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="/vendor/ion-rangeslider/js/ion.rangeSlider.min.js"></script>

<!-- JS Electro -->
<script src="/js/hs.core.js"></script>
<script src="/js/components/hs.countdown.js"></script>
<script src="/js/components/hs.header.js"></script>
<script src="/js/components/hs.hamburgers.js"></script>
<script src="/js/components/hs.unfold.js"></script>
<script src="/js/components/hs.focus-state.js"></script>
<script src="/js/components/hs.malihu-scrollbar.js"></script>
<script src="/js/components/hs.validation.js"></script>
<script src="/js/components/hs.fancybox.js"></script>
<script src="/js/components/hs.onscroll-animation.js"></script>
<script src="/js/components/hs.slick-carousel.js"></script>
<script src="/js/components/hs.show-animation.js"></script>
<script src="/js/components/hs.svg-injector.js"></script>
<script src="/js/components/hs.go-to.js"></script>
<script src="/js/components/hs.selectpicker.js"></script>
<script src="/js/components/hs.range-slider.js"></script>
<script src="/js/components/hs.quantity-counter.js?v={{ time() }}"></script>

<script src="/js/catalog.js?v={{ time() }}"></script>
<script src="/js/main.js?v={{ time() }}"></script>
<script src="/js/notify.js?v={{ time() }}"></script>

<div class="popup" id="cart-popup" style="display: none">
    <div class="popup-content"></div>
</div>

<div class="popup" id="alert_modal" style="display: none">
    <p></p>
</div>

<!-- JS Plugins Init. -->
<script>
    $(window).on('load', function () {
        // initialization of HSMegaMenu component
        $('.js-mega-menu').HSMegaMenu({
            event: 'hover',
            direction: 'horizontal',
            pageContainer: $('.container'),
            breakpoint: 767.98,
            hideTimeOut: 0
        });

        // initialization of svg injector module
        $.HSCore.components.HSSVGIngector.init('.js-svg-injector');
    });

    $(document).on('ready', function () {
        // initialization of header
        $.HSCore.components.HSHeader.init($('#header'));

        // initialization of animation
        $.HSCore.components.HSOnScrollAnimation.init('[data-animation]');

        // initialization of unfold component
        $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
            afterOpen: function () {
                $(this).find('input[type="search"]').focus();
            }
        });

        // initialization of popups
        $.HSCore.components.HSFancyBox.init('.js-fancybox');

        // initialization of countdowns
        var countdowns = $.HSCore.components.HSCountdown.init('.js-countdown', {
            yearsElSelector: '.js-cd-years',
            monthsElSelector: '.js-cd-months',
            daysElSelector: '.js-cd-days',
            hoursElSelector: '.js-cd-hours',
            minutesElSelector: '.js-cd-minutes',
            secondsElSelector: '.js-cd-seconds'
        });

        // initialization of malihu scrollbar
        $.HSCore.components.HSMalihuScrollBar.init($('.js-scrollbar'));

        // initialization of forms
        $.HSCore.components.HSFocusState.init();

        // initialization of form validation
        $.HSCore.components.HSValidation.init('.js-validate', {
            rules: {
                confirmPassword: {
                    equalTo: '#signupPassword'
                }
            }
        });

        // initialization of forms
        $.HSCore.components.HSRangeSlider.init('.js-range-slider', {
            onFinish: function (data) {
                if(typeof filterCatalog == 'function') {
                    $('#price_from').val(data.from);
                    $('#price_to').val(data.to);
                    filterCatalog();
                }
            }
        })

        // initialization of show animations
        $.HSCore.components.HSShowAnimation.init('.js-animation-link');

        // initialization of fancybox
        $.HSCore.components.HSFancyBox.init('.js-fancybox');

        // initialization of slick carousel
        $.HSCore.components.HSSlickCarousel.init('.js-slick-carousel');

        // initialization of go to
        $.HSCore.components.HSGoTo.init('.js-go-to');

        $.HSCore.components.HSQantityCounter.init('.js-quantity');

        // initialization of hamburgers
        $.HSCore.components.HSHamburgers.init('#hamburgerTrigger');

        // initialization of unfold component
        $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
            beforeClose: function () {
                $('#hamburgerTrigger').removeClass('is-active');
            },
            afterClose: function() {
                $('#headerSidebarList .collapse.show').collapse('hide');
            }
        });

        $('#headerSidebarList [data-toggle="collapse"]').on('click', function (e) {
            e.preventDefault();

            var target = $(this).data('target');

            if($(this).attr('aria-expanded') === "true") {
                $(target).collapse('hide');
            } else {
                $(target).collapse('show');
            }
        });

        // initialization of unfold component
        $.HSCore.components.HSUnfold.init($('[data-unfold-target]'));

        // initialization of select picker
        $.HSCore.components.HSSelectPicker.init('.js-select');
    });
</script>
</body>
</html>
