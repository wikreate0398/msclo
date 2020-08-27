<!DOCTYPE html>
<html lang="ru">
<head>
    <!-- Title -->
    <title>Massclo - интернет магазин</title>

    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate, private" />
    <meta http-equiv="Pragma" content="no-cache" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="/img/favicon.png">

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
        const changePriceByQtyRoute = '{{ route('change_price', ['lang' => $lang]) }}';
        const showModalCartRoute    = '{{ route('load_cart_modal', ['lang' => $lang]) }}';
        const removeCartRoute       = '{{ route('remove_cart', ['lang' => $lang]) }}';
        const changeCartQtyRoute    = '{{ route('change_qty', ['lang' => $lang]) }}';
        const RUB                   = '{{ RUB }}';
        const editors = {};
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
                    <form class="js-form-message ajax__submit" action="{{ route('callback', compact('lang')) }}">
                        {{ csrf_field() }}
                        <label class="sr-only" for="subscribeSrEmail">Телефон</label>
                        <div class="input-group input-group-pill">
                            <input type="text" class="form-control border-0 height-40" name="phone" id="subscribeSrEmail" placeholder="Телефон" required>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-dark btn-sm-wide height-40 py-2 submit-btn" id="subscribeButton">Отправить</button>
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
                                @php $comma = ''; @endphp
                                @foreach(explode(',', PHONE) as $key => $phone)
                                    {{ $comma }}
                                    <a href="tel:{{ $phone }}" class="font-size-20 text-gray-90">{{ $phone }}</a>
                                    @php $comma = ', '; @endphp
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <h6 class="font-weight-bold">Мы в соц-сетях</h6>
                    <ul class="list-inline mb-0 opacity-7">
                        @if(@FB)
                            <li class="list-inline-item mr-0">
                                <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle"
                                   href="{{ FB }}"
                                   target="_blank">
                                    <span class="fab fa-facebook-f btn-icon__inner"></span>
                                </a>
                            </li>
                        @endif

                        @if(@INSTA)
                            <li class="list-inline-item mr-0">
                                <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle"
                                   href="{{ INSTA }}"
                                   target="_blank">
                                    <span class="fab fa-instagram btn-icon__inner"></span>
                                </a>
                            </li>
                        @endif

                        @if(@YOUTUBE)
                            <li class="list-inline-item mr-0">
                                <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle"
                                   href="{{ YOUTUBE }}"
                                   target="_blank">
                                    <span class="fab fa-youtube btn-icon__inner"></span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="col-lg-7">
                    <div class="row">

                        <div class="col-12 col-md mb-4 mb-md-0">
                            <h6 class="mb-3 font-weight-bold">Компания</h6>
                            <ul class="list-group list-group-flush list-group-borderless mb-0 list-group-transparent">
                                @foreach($menu as $item)
                                    @if($item->view_bottom)
                                        <li>
                                            <a class="list-group-item list-group-item-action" href="{{ setUri($item['url']) }}">
                                                {{ $item["name_$lang"] }}
                                            </a>
                                        </li>
                                    @endif
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
                                <li>
                                    <a class="list-group-item list-group-item-action"
                                       href="{{ isAuth() ? route('account', compact('lang')) : 'javascript:;' }}"
                                       @if(!isAuth())
                                       aria-controls="sidebarContent"
                                       aria-haspopup="true"
                                       aria-expanded="false"
                                       data-unfold-event="click"
                                       data-unfold-hide-on-scroll="false"
                                       data-unfold-target="#sidebarContent"
                                       data-unfold-type="css-animation"
                                       data-unfold-animation-in="fadeInRight"
                                       data-unfold-animation-out="fadeOutRight"
                                       onclick="showLogin()"
                                       data-unfold-duration="500" @endif>Мой профиль</a>
                                </li>
                                <li>
                                    <a class="list-group-item list-group-item-action"
                                       href="{{ isAuth() ? route('purchases', compact('lang')) : 'javascript:;' }}"
                                       @if(!isAuth())
                                       aria-controls="sidebarContent"
                                       aria-haspopup="true"
                                       aria-expanded="false"
                                       data-unfold-event="click"
                                       data-unfold-hide-on-scroll="false"
                                       data-unfold-target="#sidebarContent"
                                       data-unfold-type="css-animation"
                                       data-unfold-animation-in="fadeInRight"
                                       data-unfold-animation-out="fadeOutRight"
                                       onclick="showLogin()"
                                       data-unfold-duration="500" @endif>Мои покупки</a>
                                </li>
                                <li>
                                    <a class="list-group-item list-group-item-action" href="{{ route('fav_list', compact('lang')) }}">Избранное</a>
                                </li>
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

@if(!\Auth::check())
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

                            <!-- Login -->
                            <form action="{{ route('login', compact('lang')) }}" class="ajax__submit">
                                {{ csrf_field() }}
                                <input type="hidden" name="from_cart" value="{{ \Route::currentRouteName() == 'view_cart' ? 1 : 0 }}">
                                <div id="login" data-target-group="idForm">
                                    <!-- Title -->
                                    <header class="text-center mb-7">
                                        <h2 class="h4 mb-0">Войти</h2>
                                        <p>Авторизируйтесь что бы совершать покупки и продавать</p>
                                    </header>
                                    <!-- End Title -->

                                    <!-- Form Group -->
                                    <div class="form-group">
                                        <div class="js-form-message js-focus-state">
                                            <label class="sr-only" for="signinEmail">E-mail</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="signinEmailLabel">
                                                        <span class="fas fa-envelope"></span>
                                                    </span>
                                                </div>
                                                <input type="email"
                                                       class="form-control"
                                                       name="email"
                                                       placeholder="E-mail">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Form Group -->

                                    <!-- Form Group -->
                                    <div class="form-group">
                                        <div class="js-form-message js-focus-state">
                                            <label class="sr-only" for="signinPassword">Пароль</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                        <span class="input-group-text" id="signinPasswordLabel">
                                                            <span class="fas fa-lock"></span>
                                                        </span>
                                                </div>
                                                <input type="password"
                                                       class="form-control"
                                                       name="password"
                                                       placeholder="Пароль">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Form Group -->

                                    <div class="d-flex justify-content-end mb-4">
                                        <a class="js-animation-link small link-muted" href="javascript:;"
                                           data-target="#forgotPassword"
                                           data-link-group="idForm"
                                           data-animation-in="slideInUp">Забыли пароль?</a>
                                    </div>

                                    <div class="mb-2">
                                        <button type="submit" class="btn btn-block btn-sm btn-primary transition-3d-hover submit-btn">Войти</button>
                                    </div>

                                    <div class="text-center mb-4">
                                        <span class="small text-muted">Не имеете личный профиль?</span>
                                        <a class="js-animation-link small text-dark" href="javascript:;"
                                           data-target="#signup"
                                           data-link-group="idForm"
                                           data-animation-in="slideInUp">Зарегистрироваться
                                        </a>
                                    </div>

    {{--                                <div class="text-center">--}}
    {{--                                    <span class="u-divider u-divider--xs u-divider--text mb-4">OR</span>--}}
    {{--                                </div>--}}

                                    <!-- Login Buttons -->
    {{--                                <div class="d-flex">--}}
    {{--                                    <a class="btn btn-block btn-sm btn-soft-facebook transition-3d-hover mr-1" href="#">--}}
    {{--                                        <span class="fab fa-facebook-square mr-1"></span>--}}
    {{--                                        Facebook--}}
    {{--                                    </a>--}}
    {{--                                    <a class="btn btn-block btn-sm btn-soft-google transition-3d-hover ml-1 mt-0" href="#">--}}
    {{--                                        <span class="fab fa-google mr-1"></span>--}}
    {{--                                        Google--}}
    {{--                                    </a>--}}
    {{--                                </div>--}}
                                    <!-- End Login Buttons -->
                                </div>
                            </form>

                            <!-- Signup -->
                            <form action="{{ route('register_user', compact('lang')) }}" class="ajax__submit">
                                {{ csrf_field() }}
                                <div id="signup" style="display: none; opacity: 0;" data-target-group="idForm">
                                    <!-- Title -->
                                    <header class="text-center mb-7">
                                        <h2 class="h4 mb-0">Регистрация</h2>
{{--                                        <p>Fill out the form to get started.</p>--}}
                                    </header>
                                    <!-- End Title -->

                                    <!-- Form Group -->

                                    <div class="custom-control custom-radio d-flex mb-3">
                                        <div>
                                            <input type="radio" class="custom-control-input" id="tclient" name="type" value="user" checked>
                                            <label class="custom-control-label form-label" for="tclient">
                                                Клиент
                                            </label>
                                        </div>

                                        <div style="margin-left: 45px;">
                                            <input type="radio" class="custom-control-input" id="tprovider" name="type" value="provider">
                                            <label class="custom-control-label form-label" for="tprovider">
                                                Поставщик
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="js-form-message js-focus-state">
                                            <label class="sr-only" for="signupEmail">Имя</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <span class="fas fa-user"></span>
                                                    </span>
                                                </div>
                                                <input type="text"
                                                       class="form-control"
                                                       name="name"
                                                       placeholder="Имя">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="js-form-message js-focus-state">
                                            <label class="sr-only" for="signupEmail">E-mail</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                            <span class="input-group-text" id="signupEmailLabel">
                                                                <span class="fas fa-envelope"></span>
                                                            </span>
                                                </div>
                                                <input type="email"
                                                       class="form-control"
                                                       name="email"
                                                       placeholder="Email">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Input -->

                                    <!-- Form Group -->
                                    <div class="form-group">
                                        <div class="js-form-message js-focus-state">
                                            <label class="sr-only" for="signupPassword">Пароль</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                            <span class="input-group-text" id="signupPasswordLabel">
                                                                <span class="fas fa-lock"></span>
                                                            </span>
                                                </div>
                                                <input type="password"
                                                       class="form-control"
                                                       name="password"
                                                       placeholder="Пароль">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Input -->

                                    <!-- Form Group -->
                                    <div class="form-group">
                                        <div class="js-form-message js-focus-state">
                                            <label class="sr-only" for="signupConfirmPassword">Подтвердить пароль</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                        <span class="input-group-text" id="signupConfirmPasswordLabel">
                                                            <span class="fas fa-key"></span>
                                                        </span>
                                                </div>
                                                <input type="password"
                                                       class="form-control"
                                                       name="password_confirmation"
                                                       placeholder="Подтвердить пароль">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Input -->

                                    <div class="mb-2">
                                        <button type="submit" class="btn btn-block btn-sm btn-primary transition-3d-hover submit-btn">Зарегистрироваться</button>
                                    </div>

                                    <div class="text-center mb-4">
                                        <span class="small text-muted">Уже зарегистированы?</span>
                                        <a class="js-animation-link small text-dark" href="javascript:;"
                                           data-target="#login"
                                           data-link-group="idForm"
                                           data-animation-in="slideInUp">Войти
                                        </a>
                                    </div>

{{--                                    <div class="text-center">--}}
{{--                                        <span class="u-divider u-divider--xs u-divider--text mb-4">OR</span>--}}
{{--                                    </div>--}}

                                    <!-- Login Buttons -->
{{--                                    <div class="d-flex">--}}
{{--                                        <a class="btn btn-block btn-sm btn-soft-facebook transition-3d-hover mr-1" href="#">--}}
{{--                                            <span class="fab fa-facebook-square mr-1"></span>--}}
{{--                                            Facebook--}}
{{--                                        </a>--}}
{{--                                        <a class="btn btn-block btn-sm btn-soft-google transition-3d-hover ml-1 mt-0" href="#">--}}
{{--                                            <span class="fab fa-google mr-1"></span>--}}
{{--                                            Google--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
                                    <!-- End Login Buttons -->
                                </div>
                            </form>
                            <!-- End Signup -->

                            <!-- Forgot Password -->
                            <form action="{{ route('send_reset_pass', compact('lang')) }}" class="ajax__submit">
                                {{ csrf_field() }}
                                <div id="forgotPassword" style="display: none; opacity: 0;" data-target-group="idForm">
                                    <!-- Title -->
                                    <header class="text-center mb-7">
                                        <h2 class="h4 mb-0">Восстановить пароль</h2>
                                        <p>Введите e-mail на который будет отправлен новый пароль.</p>
                                    </header>
                                    <!-- End Title -->

                                    <!-- Form Group -->
                                    <div class="form-group">
                                        <div class="js-form-message js-focus-state">
                                            <label class="sr-only" for="recoverEmail">E-mail</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="recoverEmailLabel">
                                                        <span class="fas fa-envelope"></span>
                                                    </span>
                                                </div>
                                                <input type="email"
                                                       class="form-control"
                                                       name="email"
                                                       id="recoverEmail"
                                                       placeholder="E-mail">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Form Group -->

                                    <div class="mb-2">
                                        <button type="submit" class="btn btn-block btn-sm btn-primary transition-3d-hover submit-btn">Отправить</button>
                                    </div>

                                    <div class="text-center mb-4">
                                        <span class="small text-muted">Помните пароль?</span>
                                        <a class="js-animation-link small" href="javascript:;"
                                           data-target="#login"
                                           data-link-group="idForm"
                                           data-animation-in="slideInUp">Войти
                                        </a>
                                    </div>
                                </div>
                            </form>
                            <!-- End Forgot Password -->
                    </div>
                </div>
                <!-- End Content -->
            </div>
        </div>
    </div>
</aside>
<!-- End Account Sidebar Navigation -->
@endif
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
<script src="/js/components/hs.quantity-counter.js"></script>
<script src="https://use.fontawesome.com/7d23dee490.js"></script>

<script src="/js/catalog.js?v={{ time() }}"></script>
<script src="/js/main.js?v={{ time() }}"></script>
<script src="/js/notify.js"></script>
<script src="/js/ajax.js?v={{ time() }}"></script>

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

@if(session()->has('flash_message'))
    <script>
        $(window).load(function () {
            Notify.setStatus('success').setMessage('{{ session()->get('flash_message') }}');
        })
    </script>
    @php session()->forget('flash_message') @endphp
@endif
</body>
</html>
