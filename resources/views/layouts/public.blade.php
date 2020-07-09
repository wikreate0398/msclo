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

    <!-- CSS Electro Template -->
    <link rel="stylesheet" href="/css/theme.css?v={{ time() }}">
    <link rel="stylesheet" href="/css/loader.css">

</head>

<body>

<!-- ========== HEADER ========== -->
<header id="header" class="u-header u-header-left-aligned-nav">
    <div class="u-header__section">
        <!-- Topbar -->
        <div class="u-header-topbar py-2 d-none d-xl-block">
            <div class="container">
                <div class="d-flex align-items-center">
{{--                    <div class="topbar-left">--}}
{{--                        <a href="#" class="text-gray-110 font-size-13 hover-on-dark">Добро пожаловать в Mas</a>--}}
{{--                    </div>--}}
                    <div class="topbar-right ml-auto">
                        <ul class="list-inline mb-0">

                            <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                <a href="" class="u-header-topbar__nav-link"><i class="ec ec-transport mr-1"></i> Доставка и оплата</a>
                            </li>
{{--                            <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border u-header-topbar__nav-item-no-border u-header-topbar__nav-item-border-single">--}}
{{--                                <div class="d-flex align-items-center">--}}
{{--                                    <!-- Language -->--}}
{{--                                    <div class="position-relative">--}}
{{--                                        <a id="languageDropdownInvoker" class="dropdown-nav-link dropdown-toggle d-flex align-items-center u-header-topbar__nav-link font-weight-normal" href="javascript:;" role="button"--}}
{{--                                           aria-controls="languageDropdown"--}}
{{--                                           aria-haspopup="true"--}}
{{--                                           aria-expanded="false"--}}
{{--                                           data-unfold-event="hover"--}}
{{--                                           data-unfold-target="#languageDropdown"--}}
{{--                                           data-unfold-type="css-animation"--}}
{{--                                           data-unfold-duration="300"--}}
{{--                                           data-unfold-delay="300"--}}
{{--                                           data-unfold-hide-on-scroll="true"--}}
{{--                                           data-unfold-animation-in="slideInUp"--}}
{{--                                           data-unfold-animation-out="fadeOut">--}}
{{--                                            <span class="d-inline-block d-sm-none">US</span>--}}
{{--                                            <span class="d-none d-sm-inline-flex align-items-center"><i class="ec ec-dollar mr-1"></i> Dollar (US)</span>--}}
{{--                                        </a>--}}

{{--                                        <div id="languageDropdown" class="dropdown-menu dropdown-unfold" aria-labelledby="languageDropdownInvoker">--}}
{{--                                            <a class="dropdown-item active" href="#">English</a>--}}
{{--                                            <a class="dropdown-item" href="#">Deutsch</a>--}}
{{--                                            <a class="dropdown-item" href="#">Español‎</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <!-- End Language -->--}}
{{--                                </div>--}}
{{--                            </li>--}}
                            <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                <!-- Account Sidebar Toggle Button -->
                                <a id="sidebarNavToggler" href="javascript:;" role="button" class="u-header-topbar__nav-link"
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
                                    <i class="ec ec-user mr-1"></i> Зарегистрироваться <span class="text-gray-50">или</span> Войти в Лк
                                </a>
                                <!-- End Account Sidebar Toggle Button -->
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Topbar -->

        <!-- Logo-Search-header-icons -->
        <div class="py-2 py-xl-5 bg-primary-down-lg">
            <div class="container my-0dot5 my-xl-0">
                <div class="row align-items-center">
                    <!-- Logo-offcanvas-menu -->
                    <div class="col-auto">
                        <!-- Nav -->
                        <nav class="navbar navbar-expand u-header__navbar py-0 justify-content-xl-between max-width-270 min-width-270">
                            <!-- Logo -->
                            <a class="order-1 order-xl-0 navbar-brand u-header__navbar-brand u-header__navbar-brand-center" href="/" aria-label="">
                                <img src="/img/logo.png" alt="">
                            </a>
                            <!-- End Logo -->
                        </nav>
                        <!-- End Nav -->
                    </div>
                    <!-- End Logo-offcanvas-menu -->
                    <!-- Search Bar -->
                    <div class="col d-none d-xl-block">
                        <form class="js-focus-state">
                            <label class="sr-only" for="searchproduct">Поиск</label>
                            <div class="input-group">
                                <input type="email" class="form-control py-2 pl-5 font-size-15 border-right-0 height-40 border-width-2 rounded-left-pill border-primary"
                                       name="email"
                                       id="searchproduct-item"
                                       placeholder="Найти товар"
                                       aria-label="Найти товар"
                                       aria-describedby="searchProduct1" required>
                                <div class="input-group-append">
                                    <!-- Select -->
{{--                                    <select class="js-select selectpicker dropdown-select custom-search-categories-select"--}}
{{--                                            data-style="btn height-40 text-gray-60 font-weight-normal border-top border-bottom border-left-0 rounded-0 border-primary border-width-2 pl-0 pr-5 py-2">--}}
{{--                                        <option value="one" selected>All Categories</option>--}}
{{--                                        <option value="two">Two</option>--}}
{{--                                        <option value="three">Three</option>--}}
{{--                                        <option value="four">Four</option>--}}
{{--                                    </select>--}}
                                    <!-- End Select -->
                                    <button class="btn btn-primary height-40 py-2 px-3 rounded-right-pill" type="button" id="searchProduct1">
                                        <span class="ec ec-search font-size-24"></span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- End Search Bar -->
                    <!-- Header Icons -->
                    <div class="col col-xl-auto text-right text-xl-left pl-0 pl-xl-3 position-static">
                        <div class="d-inline-flex">
                            <ul class="d-flex list-unstyled mb-0 align-items-center">
                                <!-- Search -->
                                <li class="col d-xl-none px-2 px-sm-3 position-static">
                                    <a id="searchClassicInvoker" class="font-size-22 text-gray-90 text-lh-1 btn-text-secondary" href="javascript:;" role="button"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="Поиск"
                                       aria-controls="searchClassic"
                                       aria-haspopup="true"
                                       aria-expanded="false"
                                       data-unfold-target="#searchClassic"
                                       data-unfold-type="css-animation"
                                       data-unfold-duration="300"
                                       data-unfold-delay="300"
                                       data-unfold-hide-on-scroll="true"
                                       data-unfold-animation-in="slideInUp"
                                       data-unfold-animation-out="fadeOut">
                                        <span class="ec ec-search"></span>
                                    </a>

                                    <!-- Input -->
                                    <div id="searchClassic" class="dropdown-menu dropdown-unfold dropdown-menu-right left-0 mx-2" aria-labelledby="searchClassicInvoker">
                                        <form class="js-focus-state input-group px-3">
                                            <input class="form-control" type="search" placeholder="Search Product">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary px-3" type="button"><i class="font-size-18 ec ec-search"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- End Input -->
                                </li>
                                <!-- End Search -->
                                <li class="col d-none d-xl-block"><a href="../shop/compare.html" class="text-gray-90" data-toggle="tooltip" data-placement="top" title="Сравнить"><i class="font-size-22 ec ec-compare"></i></a></li>
                                <li class="col d-none d-xl-block"><a href="../shop/wishlist.html" class="text-gray-90" data-toggle="tooltip" data-placement="top" title="Избранное"><i class="font-size-22 ec ec-favorites"></i></a></li>
                                <li class="col d-xl-none px-2 px-sm-3"><a href="../shop/my-account.html" class="text-gray-90" data-toggle="tooltip" data-placement="top" title="Мой профиль"><i class="font-size-22 ec ec-user"></i></a></li>
                                <li class="col pr-xl-0 px-2 px-sm-3 d-xl-none">
                                    <a href="../shop/cart.html" class="text-gray-90 position-relative d-flex " data-toggle="tooltip" data-placement="top" title="Корзина">
                                        <i class="font-size-22 ec ec-shopping-bag"></i>
                                        <span class="bg-lg-down-black width-22 height-22 bg-primary position-absolute d-flex align-items-center justify-content-center rounded-circle left-12 top-8 font-weight-bold font-size-12">2</span>
                                        <span class="d-none d-xl-block font-weight-bold font-size-16 text-gray-90 ml-3">$1785.00</span>
                                    </a>
                                </li>
                                <li class="col pr-xl-0 px-2 px-sm-3 d-none d-xl-block">
                                    <div id="basicDropdownHoverInvoker" class="text-gray-90 position-relative d-flex " data-toggle="tooltip" data-placement="top" title="Корзина"
                                         aria-controls="basicDropdownHover"
                                         aria-haspopup="true"
                                         aria-expanded="false"
                                         data-unfold-event="click"
                                         data-unfold-target="#basicDropdownHover"
                                         data-unfold-type="css-animation"
                                         data-unfold-duration="300"
                                         data-unfold-delay="300"
                                         data-unfold-hide-on-scroll="true"
                                         data-unfold-animation-in="slideInUp"
                                         data-unfold-animation-out="fadeOut">
                                        <i class="font-size-22 ec ec-shopping-bag"></i>
                                        <span class="bg-lg-down-black width-22 height-22 bg-primary position-absolute d-flex align-items-center justify-content-center rounded-circle left-12 top-8 font-weight-bold font-size-12">2</span>
                                        <span class="d-none d-xl-block font-weight-bold font-size-16 text-gray-90 ml-3">$1785.00</span>
                                    </div>
                                    <div id="basicDropdownHover" class="cart-dropdown dropdown-menu dropdown-unfold border-top border-top-primary mt-3 border-width-2 border-left-0 border-right-0 border-bottom-0 left-auto right-0" aria-labelledby="basicDropdownHoverInvoker">
                                        <ul class="list-unstyled px-3 pt-3">
                                            <li class="border-bottom pb-3 mb-3">
                                                <div class="">
                                                    <ul class="list-unstyled row mx-n2">
                                                        <li class="px-2 col-auto">
                                                            <img class="img-fluid" src="/img/75X75/img1.jpg" alt="Image Description">
                                                        </li>
                                                        <li class="px-2 col">
                                                            <h5 class="text-blue font-size-14 font-weight-bold">Ultra Wireless S50 Headphones S50 with Bluetooth</h5>
                                                            <span class="font-size-14">1 × $1,100.00</span>
                                                        </li>
                                                        <li class="px-2 col-auto">
                                                            <a href="#" class="text-gray-90"><i class="ec ec-close-remove"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li class="border-bottom pb-3 mb-3">
                                                <div class="">
                                                    <ul class="list-unstyled row mx-n2">
                                                        <li class="px-2 col-auto">
                                                            <img class="img-fluid" src="/img/75X75/img2.jpg" alt="Image Description">
                                                        </li>
                                                        <li class="px-2 col">
                                                            <h5 class="text-blue font-size-14 font-weight-bold">Widescreen NX Mini F1 SMART NX</h5>
                                                            <span class="font-size-14">1 × $685.00</span>
                                                        </li>
                                                        <li class="px-2 col-auto">
                                                            <a href="#" class="text-gray-90"><i class="ec ec-close-remove"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="flex-center-between px-4 pt-2">
                                            <a href="../shop/cart.html" class="btn btn-soft-secondary mb-3 mb-md-0 font-weight-normal px-5 px-md-4 px-lg-5">View cart</a>
                                            <a href="../shop/checkout.html" class="btn btn-primary-dark-w ml-md-2 px-5 px-md-4 px-lg-5">Checkout</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Header Icons -->
                </div>
            </div>
        </div>
        <!-- End Logo-Search-header-icons -->

        <!-- Vertical-and-secondary-menu -->
        <div class="d-none d-xl-block container">
            <div class="row">
                <!-- Vertical Menu -->
                <div class="col-md-auto d-none d-xl-block">
                    <div class="max-width-270 min-width-270">
                        <!-- Basics Accordion -->
                        <div id="basicsAccordion">
                            <!-- Card -->
                            <div class="card border-0">
                                <div class="card-header card-collapse border-0" id="basicsHeadingOne">
                                    <button type="button" class="btn-link btn-remove-focus btn-block d-flex card-btn py-3 text-lh-1 px-4 shadow-none btn-primary rounded-top-lg border-0 font-weight-bold text-gray-90"
                                            data-toggle="collapse"
                                            data-target="#basicsCollapseOne"
                                            aria-expanded="true"
                                            aria-controls="basicsCollapseOne">
                                                <span class="ml-0 text-gray-90 mr-2">
                                                    <span class="fa fa-list-ul"></span>
                                                </span>
                                        <span class="pl-1 text-gray-90">Категории</span>
                                    </button>
                                </div>
                                <div id="basicsCollapseOne" class="collapse show vertical-menu"
                                     aria-labelledby="basicsHeadingOne"
                                     data-parent="#basicsAccordion">
                                    <div class="card-body p-0">
                                        <nav class="js-mega-menu navbar navbar-expand-xl u-header__navbar u-header__navbar--no-space hs-menu-initialized">
                                            <div id="navBar" class="collapse navbar-collapse u-header__navbar-collapse">
                                                <ul class="navbar-nav u-header__navbar-nav">
                                                    @foreach(map_tree($categories->toArray()) as $category)
                                                        <li class="nav-item {{ !empty($category['childs']) ? 'hs-has-mega-menu' : '' }} u-header__nav-item"
                                                            data-event="hover"
                                                            @if(!empty($category['childs']))
                                                                data-animation-in="slideInUp"
                                                                data-animation-out="fadeOut"
                                                            @endif
                                                            data-position="left">
                                                            <a id="basicMegaMenu" class="nav-link u-header__nav-link {{ !empty($category['childs']) ? 'u-header__nav-link-toggle' : '' }}"
                                                               href="{{ !empty($category['childs']) ? 'javascript:;' : setUri('catalog/' . $category['url']) }}"
                                                               @if(!empty($category['childs']))
                                                               aria-haspopup="true"
                                                               aria-expanded="false"
                                                               @endif >
                                                                {{ $category["name_$lang"] }}
                                                            </a>

                                                            @if(!empty($category['childs']))
                                                            <div class="hs-mega-menu vmm-tfw u-header__sub-menu" aria-labelledby="basicMegaMenu">
{{--                                                                <div class="vmm-bg">--}}
{{--                                                                    <img class="img-fluid" src="/img/500X400/img1.png" alt="Image Description">--}}
{{--                                                                </div>--}}
                                                                <div class="row u-header__mega-menu-wrapper">
                                                                    @foreach($category['childs'] as $child)
                                                                        @if(!empty($child['childs']))
                                                                            <div class="col mb-3 mb-sm-0">
                                                                                <span class="u-header__sub-menu-title">{{ $child["name_$lang"] }}</span>
                                                                                <ul class="u-header__sub-menu-nav-group mb-3">
                                                                                    @foreach($child['childs'] as $child2)
                                                                                        <li>
                                                                                            <a class="nav-link u-header__sub-menu-nav-link"
                                                                                               href="{{ setUri('catalog/' . $child2['url']) }}">
                                                                                                {{ $child2["name_$lang"] }}
                                                                                            </a>
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            @endif
                                                        </li>
                                                        <!-- End Nav Item MegaMenu-->
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <!-- End Card -->
                        </div>
                        <!-- End Basics Accordion -->
                    </div>
                </div>
                <!-- End Vertical Menu -->
                <!-- Secondary Menu -->
                <div class="col">
                    <!-- Nav -->
                    <nav class="js-mega-menu navbar navbar-expand-md u-header__navbar u-header__navbar--no-space">
                        <!-- Navigation -->
                        <div id="navBar" class="collapse navbar-collapse u-header__navbar-collapse">
                            <ul class="navbar-nav u-header__navbar-nav">

                                @foreach($menu as $item)
                                    <li class="nav-item u-header__nav-item">
                                        <a class="nav-link u-header__nav-link {{ $item->page_type == @$page_data->page_type ? 'text-sale' : '' }}"
                                           href="{{ setUri($item->url) }}" aria-haspopup="true" aria-expanded="false" aria-labelledby="pagesSubMenu">
                                            {{ $item["name_$lang"] }}
                                        </a>
                                    </li>
                                @endforeach

                                <!-- Button -->
                                <li class="nav-item u-header__nav-last-item">
                                    <a class="btn-round transition-3d-hover" href="#" target="_blank">
                                        Стать поставщиком
                                    </a>
                                </li>
                                <!-- End Button -->
                            </ul>
                        </div>
                        <!-- End Navigation -->
                    </nav>
                    <!-- End Nav -->
                </div>
                <!-- End Secondary Menu -->
            </div>
        </div>
        <!-- End Vertical-and-secondary-menu -->
    </div>
</header>
<!-- ========== END HEADER ========== -->

<!-- ========== MAIN CONTENT ========== -->
<main id="content" role="main">
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
{{--                <div class="text-md-right">--}}
{{--                            <span class="d-inline-block bg-white border rounded p-1">--}}
{{--                                <img class="max-width-5" src="/img/100X60/img1.jpg" alt="Image Description">--}}
{{--                            </span>--}}
{{--                    <span class="d-inline-block bg-white border rounded p-1">--}}
{{--                                <img class="max-width-5" src="/img/100X60/img2.jpg" alt="Image Description">--}}
{{--                            </span>--}}
{{--                    <span class="d-inline-block bg-white border rounded p-1">--}}
{{--                                <img class="max-width-5" src="/img/100X60/img3.jpg" alt="Image Description">--}}
{{--                            </span>--}}
{{--                    <span class="d-inline-block bg-white border rounded p-1">--}}
{{--                                <img class="max-width-5" src="/img/100X60/img4.jpg" alt="Image Description">--}}
{{--                            </span>--}}
{{--                    <span class="d-inline-block bg-white border rounded p-1">--}}
{{--                                <img class="max-width-5" src="/img/100X60/img5.jpg" alt="Image Description">--}}
{{--                            </span>--}}
{{--                </div>--}}
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
<script src="/vendor/jquery/dist/jquery.min.js"></script>
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

        // initialization of show animations
        $.HSCore.components.HSShowAnimation.init('.js-animation-link');

        // initialization of fancybox
        $.HSCore.components.HSFancyBox.init('.js-fancybox');

        // initialization of slick carousel
        $.HSCore.components.HSSlickCarousel.init('.js-slick-carousel');

        // initialization of go to
        $.HSCore.components.HSGoTo.init('.js-go-to');

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
