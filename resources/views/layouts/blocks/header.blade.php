<header id="header" class="u-header u-header-left-aligned-nav">
    <div class="u-header__section">
        <!-- Topbar -->
        <div class="u-header-topbar py-2 d-none d-xl-block">
            <div class="container">
                <div class="d-flex align-items-center">
                    {{--                    <div class="topbar-left">--}}
                        {{--                        <a href="#" class="text-gray-110 font-size-13 u-header-topbar__nav-link">Welcome to Worldwide Electronics Store</a>--}}
                        {{--                    </div>--}}
                    <div class="topbar-right ml-auto">
                        <ul class="list-inline mb-0">

                            <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                <a href="{{ setUri(\Pages::getUriByType('delivery_payment')) }}" class="u-header-topbar__nav-link"><i class="ec ec-transport mr-1"></i> Доставка и оплата</a>
                            </li>
{{--                            <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border u-header-topbar__nav-item-no-border u-header-topbar__nav-item-border-single">--}}
{{--                                <div class="d-flex align-items-center">--}}
{{--                                 --}}
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
{{--                                    </div> --}}
{{--                                </div>--}}
{{--                            </li>--}}
                            <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                <!-- Account Sidebar Toggle Button -->
                                @if(!\Auth::check())
                                    <a id="sidebarNavToggler" href="javascript:;"
                                       role="button"
                                       class="u-header-topbar__nav-link"
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
                                       data-unfold-duration="500">
                                        <i class="ec ec-user mr-1"></i> Зарегистрироваться <span class="text-gray-50">или</span> Войти в ЛК
                                    </a>
                                @else
                                    <a href="{{ route('account', compact('lang')) }}" class="u-header-topbar__nav-link">
                                        <i class="ec ec-user mr-1"></i> {{ user()->name }}
                                    </a>
                                @endif
                                <!-- End Account Sidebar Toggle Button -->
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Topbar -->

        <!-- Logo and Menu -->
        <div class="py-2 py-xl-4 bg-primary-down-lg">
            <div class="container my-0dot5 my-xl-0">
                <div class="row align-items-center">
                    <!-- Logo-offcanvas-menu -->
                    <div class="col-auto">
                        <!-- Nav -->
                        <nav class="navbar navbar-expand u-header__navbar py-0 justify-content-xl-between max-width-270 min-width-270">
                            <!-- Logo -->
                            <a class="order-1 order-xl-0 navbar-brand u-header__navbar-brand u-header__navbar-brand-center" href="/" aria-label="Massclo">
                                <img src="/img/logo.png" alt="">
                            </a>
                            <!-- End Logo -->

                            <!-- Fullscreen Toggle Button -->
                            <button id="sidebarHeaderInvokerMenu" type="button" class="navbar-toggler d-block btn u-hamburger mr-3 mr-xl-0"
                                    aria-controls="sidebarHeader"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    data-unfold-event="click"
                                    data-unfold-hide-on-scroll="false"
                                    data-unfold-target="#sidebarHeader1"
                                    data-unfold-type="css-animation"
                                    data-unfold-animation-in="fadeInLeft"
                                    data-unfold-animation-out="fadeOutLeft"
                                    data-unfold-duration="500">
                                        <span id="hamburgerTriggerMenu" class="u-hamburger__box">
                                            <span class="u-hamburger__inner"></span>
                                        </span>
                            </button>
                            <!-- End Fullscreen Toggle Button -->
                        </nav>
                        <!-- End Nav -->

                        <!-- ========== HEADER SIDEBAR ========== -->
                        <aside id="sidebarHeader1" class="u-sidebar u-sidebar--left" aria-labelledby="sidebarHeaderInvokerMenu">
                            <div class="u-sidebar__scroller">
                                <div class="u-sidebar__container">
                                    <div class="u-header-sidebar__footer-offset pb-0">
                                        <!-- Toggle Button -->
                                        <div class="position-absolute top-0 right-0 z-index-2 pt-4 pr-7">
                                            <button type="button" class="close ml-auto"
                                                    aria-controls="sidebarHeader"
                                                    aria-haspopup="true"
                                                    aria-expanded="false"
                                                    data-unfold-event="click"
                                                    data-unfold-hide-on-scroll="false"
                                                    data-unfold-target="#sidebarHeader1"
                                                    data-unfold-type="css-animation"
                                                    data-unfold-animation-in="fadeInLeft"
                                                    data-unfold-animation-out="fadeOutLeft"
                                                    data-unfold-duration="500">
                                                <span aria-hidden="true"><i class="ec ec-close-remove text-gray-90 font-size-20"></i></span>
                                            </button>
                                        </div>
                                        <!-- End Toggle Button -->

                                        <!-- Content -->
                                        <div class="js-scrollbar u-sidebar__body">
                                            <div id="headerSidebarContent" class="u-sidebar__content u-header-sidebar__content">
                                                <!-- Logo -->
                                                <a class="d-flex ml-0 navbar-brand u-header__navbar-brand u-header__navbar-brand-vertical" href="/" aria-label="Massclo">
                                                    <img src="/img/logo.png" alt="">
                                                </a>
                                                <!-- End Logo -->

                                                <!-- List -->
                                                <ul id="headerSidebarList" class="u-header-collapse__nav">
                                                    @foreach($menu as $item)
                                                        @if($item->view_top)
                                                            <li>
                                                                <a class="u-header-collapse__submenu-nav-link {{ $item->page_type == @$page_data->page_type ? 'text-sale' : '' }}"
                                                                   href="{{ setUri($item->url) }}" aria-haspopup="true" aria-expanded="false" aria-labelledby="pagesSubMenu">
                                                                    {{ $item["name_$lang"] }}
                                                                </a>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                                <!-- End List -->
                                            </div>
                                        </div>
                                        <!-- End Content -->
                                    </div>
                                </div>
                            </div>
                        </aside>
                        <!-- ========== END HEADER SIDEBAR ========== -->
                    </div>
                    <!-- End Logo-offcanvas-menu -->
                    <!-- Primary Menu -->
                    <div class="col d-none d-xl-block">
                        <!-- Nav -->
                        <nav class="js-mega-menu navbar navbar-expand-md u-header__navbar u-header__navbar--no-space">
                            <!-- Navigation -->
                            <div id="navBar" class="collapse navbar-collapse u-header__navbar-collapse">
                                <ul class="navbar-nav u-header__navbar-nav">
                                    @foreach($menu as $item)
                                        @if($item->view_top)
                                            <li class="nav-item u-header__nav-item">
                                                <a class="nav-link u-header__nav-link {{ $item->page_type == @$page_data->page_type ? 'text-sale' : '' }}"
                                                   href="{{ setUri($item->url) }}" aria-haspopup="true" aria-expanded="false" aria-labelledby="pagesSubMenu">
                                                    {{ $item["name_$lang"] }}
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                    @if(!\Auth::check())
                                        <li class="nav-item u-header__nav-last-item">

                                            <a id="sidebarNavToggler" href="javascript:;" role="button" class="btn-round transition-3d-hover"
                                               aria-controls="sidebarContent"
                                               aria-haspopup="true"
                                               aria-expanded="false"
                                               data-unfold-event="click"
                                               data-unfold-hide-on-scroll="false"
                                               data-unfold-target="#sidebarContent"
                                               data-unfold-type="css-animation"
                                               data-unfold-animation-in="fadeInRight"
                                               data-unfold-animation-out="fadeOutRight"
                                               onclick="showSignup()"
                                               data-unfold-duration="500">
                                                <i class="ec ec-user"></i> Стать поставщиком
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <!-- End Navigation -->
                        </nav>
                        <!-- End Nav -->
                    </div>
                    <!-- End Primary Menu -->
                    <!-- Customer Care -->
{{--                    <div class="d-none d-xl-block col-md-auto">--}}
{{--                        <div class="d-flex">--}}
{{--                            <i class="ec ec-support font-size-50 text-primary"></i>--}}
{{--                            <div class="ml-2">--}}
{{--                                <div class="phone">--}}
{{--                                    <strong>Support</strong> <a href="tel:800856800604" class="text-gray-90">(+800) 856 800 604</a>--}}
{{--                                </div>--}}
{{--                                <div class="email">--}}
{{--                                    E-mail: <a href="mailto:info@electro.com?subject=Help Need" class="text-gray-90">info@electro.com</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <!-- End Customer Care -->
                    <!-- Header Icons -->
                    <div class="d-xl-none col col-xl-auto text-right text-xl-left pl-0 pl-xl-3 position-static">
                        <div class="d-inline-flex">
                            <ul class="d-flex list-unstyled mb-0 align-items-center">
                                <!-- Search -->
                                <li class="col d-xl-none px-2 px-sm-3 position-static">
                                    <a id="searchClassicInvoker" class="font-size-22 text-gray-90 text-lh-1 btn-text-secondary" href="javascript:;" role="button"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="Search"
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
                                <li class="col d-none d-xl-block">
                                    <a href="{{ route('compare_list', ['lang' => $lang]) }}" class="text-gray-90" data-toggle="tooltip" data-placement="top" title="Сравнить">
                                        <i class="font-size-22 ec ec-compare"></i>
                                        <span class="qty_compare width-22 height-22 bg-dark position-absolute align-items-center justify-content-center rounded-circle left-12 top-8 font-weight-bold font-size-12 text-white {{ !sessArray('compare')->count() ? 'd-none' : 'd-flex' }}"
                                              style="left: 30px">{{ sessArray('compare')->count() }}</span>
                                    </a>
                                </li>
                                <li class="col d-none d-xl-block">
                                    <a href="{{ route('fav_list', ['lang' => $lang]) }}" class="text-gray-90" data-toggle="tooltip" data-placement="top" title="Избранное">
                                        <i class="font-size-22 ec ec-favorites"></i>
                                        <span class="qty_fav width-22 height-22 bg-dark position-absolute align-items-center justify-content-center rounded-circle left-12 top-8 font-weight-bold font-size-12 text-white {{ !sessArray('favorites')->count() ? 'd-none' : 'd-flex' }}"
                                              style="left: 25px">{{ sessArray('favorites')->count() }}</span>
                                    </a>
                                </li>
                                <li class="col d-xl-none px-2 px-sm-3">
                                    <a href="{{ isAuth() ? route('purchases', compact('lang')) : 'javascript:;' }}"
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
                                       data-unfold-duration="500" @endif
                                       class="text-gray-90">
                                        <i class="font-size-22 ec ec-user"></i>
                                    </a>
                                </li>
                                <li class="col pr-xl-0 px-2 px-sm-3">
                                    <a href="{{ route('view_cart', compact('lang')) }}" class="text-gray-90 position-relative d-flex " data-toggle="tooltip" data-placement="top" title="Корзина">
                                        <i class="font-size-22 ec ec-shopping-bag"></i>
                                        <span class="width-22 height-22 bg-dark position-absolute {{ cart()->has() ? 'd-flex' : 'd-none' }} align-items-center justify-content-center rounded-circle left-12 top-8 font-weight-bold font-size-12 text-white cart-qty">
                                            {{ cart()->getTotalQty() }}
                                        </span>
{{--                                        <span class="d-none d-xl-block font-weight-bold font-size-16 text-gray-90 ml-3">--}}
{{--                                            {{ RUB }} {{ cart()->getTotalPrice() }}--}}
{{--                                        </span>--}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Header Icons -->
                </div>
            </div>
        </div>
        <!-- End Logo and Menu -->

        <!-- Vertical-and-Search-Bar -->
        <div class="d-none d-xl-block bg-primary">
            <div class="container">
                <div class="row align-items-stretch min-height-50">
                    <!-- Vertical Menu -->
                    <div class="col-md-auto d-none d-xl-flex align-items-end">
                        <div class="max-width-270 min-width-270">
                            <!-- Basics Accordion -->
                            <div id="basicsAccordion">
                                <!-- Card -->
                                <div class="card border-0 rounded-0">
                                    <div class="card-header bg-primary rounded-0 card-collapse border-0" id="basicsHeadingOne">
                                        <button type="button" class="btn-link btn-remove-focus btn-block d-flex card-btn py-3 text-lh-1 px-4 shadow-none btn-primary rounded-top-lg border-0 font-weight-bold text-gray-90"
                                                data-toggle="collapse"
                                                data-target="#basicsCollapseOne"
                                                aria-expanded="true"
                                                aria-controls="basicsCollapseOne">
                                            <span class="pl-1 text-gray-90">Категории</span>
                                            <span class="text-gray-90 ml-3">
                                                        <span class="ec ec-arrow-down-search"></span>
                                                    </span>
                                        </button>
                                    </div>
                                    <div id="basicsCollapseOne" class="vertical-menu v1 collapse {{ (@$page_data->page_type == 'home') ? 'show' : '' }}"
                                         aria-labelledby="basicsHeadingOne"
                                         data-parent="#basicsAccordion">
                                        <div class="card-body p-0">
                                            <nav class="js-mega-menu navbar navbar-expand-xl u-header__navbar u-header__navbar--no-space hs-menu-initialized">
                                                <div id="navBar" class="collapse navbar-collapse u-header__navbar-collapse">
                                                    <ul class="navbar-nav u-header__navbar-nav border-primary border-top-0">
                                                        @foreach(map_tree($categories->toArray()) as $category)
                                                            <li class="nav-item {{ !empty($category['childs']) ? 'hs-has-mega-menu' : '' }} u-header__nav-item"
                                                                data-event="hover"
                                                                @if(!empty($category['childs']))
                                                                data-animation-in="slideInUp"
                                                                data-animation-out="fadeOut"
                                                                @endif
                                                                data-position="left">
                                                                <a id="basicMegaCat-{{ $category['id'] }}" class="nav-link u-header__nav-link {{ !empty($category['childs']) ? 'u-header__nav-link-toggle' : '' }}"
                                                                   href="{{ setUri('catalog/' . $category['url']) }}">
                                                                    {{ $category["name_$lang"] }}
                                                                </a>

                                                                @if(!empty($category['childs']))
                                                                    <div class="hs-mega-menu vmm-tfw u-header__sub-menu" aria-labelledby="basicMegaCat-{{ $category['id'] }}">
                                                                        {{--                                                                <div class="vmm-bg">--}}
                                                                        {{--                                                                    <img class="img-fluid" src="/img/500X400/img1.png" alt="Image Description">--}}
                                                                        {{--                                                                </div>--}}
                                                                        <div class="row u-header__mega-menu-wrapper">
                                                                            @foreach($category['childs'] as $child)
                                                                                @if(!empty($child['childs']))
                                                                                    <div class="col mb-3 mb-sm-0">
                                                                                        <a class="u-header__sub-menu-title"
                                                                                           href="{{ setUri('catalog/' . $child['url']) }}">
                                                                                            {{ $child["name_$lang"] }}
                                                                                        </a>

                                                                                        <ul class="u-header__sub-menu-nav-group mb-3">
                                                                                            @foreach($child['childs'] as $child2)
                                                                                                <li>
                                                                                                    <a class="nav-link u-header__sub-menu-nav-link"
                                                                                                       href="{{ setUri('catalog/' . $child2['url']) }}">
                                                                                                        {{ $child2["name_$lang"] }}
                                                                                                        @if($child2['products_count'])
                                                                                                            <span class="text-gray-25 font-size-12 font-weight-normal"> ({{ $child2['products_count'] }})</span>
                                                                                                        @endif
                                                                                                    </a>
                                                                                                </li>
                                                                                            @endforeach
                                                                                        </ul>
                                                                                    </div>
                                                                                @endif
                                                                            @endforeach

                                                                            <div class="col mb-3 mb-sm-0">
                                                                                <ul class="u-header__sub-menu-nav-group mb-3">
                                                                                    @foreach($category['childs'] as $child)
                                                                                        @if(empty($child['childs']))
                                                                                            <li>
                                                                                                <a class="nav-link u-header__sub-menu-nav-link"
                                                                                                   href="{{ setUri('catalog/' . $child['url']) }}">
                                                                                                    {{ $child["name_$lang"] }}
                                                                                                    @if($child['products_count'])
                                                                                                        <span class="text-gray-25 font-size-12 font-weight-normal"> ({{ $child['products_count'] }})</span>
                                                                                                    @endif
                                                                                                </a>
                                                                                            </li>
                                                                                        @endif
                                                                                    @endforeach
                                                                                </ul>
                                                                            </div>
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
                    <!-- Search bar -->
                    <div class="col align-self-center">
                        <!-- Search-Form -->
                        <form class="js-focus-state">
                            <label class="sr-only" for="searchProduct">Поиск</label>
                            <div class="input-group">
                                <input type="email" class="form-control py-2 pl-5 font-size-15 border-0 height-40 rounded-left-pill" name="email" id="searchProduct" placeholder="Найти товар" aria-label="Найти товар" aria-describedby="searchProduct1" required>
                                <div class="input-group-append">
                                    <button class="btn btn-dark height-40 py-2 px-3 rounded-right-pill" type="button" id="searchProduct1">
                                        <span class="ec ec-search font-size-24"></span>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!-- End Search-Form -->
                    </div>
                    <!-- End Search bar -->
                    <!-- Header Icons -->
                    <div class="col-md-auto align-self-center">
                        <div class="d-flex">
                            <ul class="d-flex list-unstyled mb-0">
                                <li class="col">
                                    <a href="{{ route('compare_list', ['lang' => $lang]) }}" class="text-gray-90" data-toggle="tooltip" data-placement="top" title="Сравнить">
                                        <i class="font-size-22 ec ec-compare"></i>
                                        <span style="left: 30px" class="{{ !sessArray('compare')->count() ? 'd-none' : '' }} qty_compare width-22 height-22 bg-dark position-absolute flex-content-center text-white rounded-circle left-12 top-8 font-weight-bold font-size-12">{{  sessArray('compare')->count() }}</span>
                                    </a>
                                </li>
                                <li class="col">
                                    <a href="{{ route('fav_list', ['lang' => $lang]) }}" class="text-gray-90" data-toggle="tooltip" data-placement="top" title="Избранное">
                                        <i class="font-size-22 ec ec-favorites"></i>
                                        <span style="left: 25px" class="{{ !sessArray('favorites')->count() ? 'd-none' : '' }} qty_fav width-22 height-22 bg-dark position-absolute flex-content-center text-white rounded-circle left-12 top-8 font-weight-bold font-size-12">{{  sessArray('favorites')->count() }}</span>
                                    </a>
                                </li>

                                <li class="col pr-0">
                                    <a href="{{ route('view_cart', compact('lang')) }}"
                                       class="text-gray-90 position-relative d-flex" data-toggle="tooltip" data-placement="top" title="Корзина">
                                        <i class="font-size-22 ec ec-shopping-bag"></i>

                                        <span class="width-22 height-22 bg-dark {{ cart()->has() ? '' : 'd-none' }} position-absolute flex-content-center text-white rounded-circle left-12 top-8 font-weight-bold font-size-12 cart-qty">
                                            {{ cart()->getTotalQty() }}
                                        </span>
{{--                                        <span class="font-weight-bold font-size-16 text-gray-90 ml-3">--}}
{{--                                            {{ RUB }} {{ priceString(cart()->getTotalPrice()) }}--}}
{{--                                        </span>--}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Header Icons -->
                </div>
            </div>
        </div>
        <!-- End Vertical-and-secondary-menu -->
    </div>
</header>