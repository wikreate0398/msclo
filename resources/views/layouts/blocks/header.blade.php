<header id="header" class="u-header u-header-left-aligned-nav">
    <div class="u-header__section">
        <div class="u-header-topbar py-2 d-none d-xl-block bg-birch @if(uri(2) == 'profile') dashboard-area @endif">
            <div class="container">
                <div class="d-flex align-items-center">
                    <div class="topbar-left">
                     <nav class="js-mega-menu navbar navbar-expand-md u-header__navbar u-header__navbar--no-space">
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
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="topbar-right ml-auto">
                        <ul class="list-inline mb-0">

                            {{-- <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                <a href="{{ setUri(\Pages::getUriByType('delivery_payment')) }}" class="u-header-topbar__nav-link text-light"><i class="ec ec-transport mr-1"></i> Доставка и оплата</a>
                            </li> --}}
                            <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border menuLoginHeader">
                                @if(!\Auth::check())
                                    <a id="sidebarNavToggler" href="javascript:;"
                                        role="button"
                                        class="u-header-topbar__nav-link btnLogin"
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
                                        data-unfold-duration="500">Зарегистрироваться</a>
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
                                       data-unfold-duration="500"> Войти</a>
                                @else
                                    @if(user()->type == 'provider')
                                        <a href="{{ route('dashboard', compact('lang')) }}" class="u-header-topbar__nav-link text-light">
                                            <i class="ec ec-user mr-1"></i> {{ user()->name }}
                                        </a>
                                    @elseif(user()->type == 'user')
                                        <a href="{{ route('purchases', compact('lang')) }}" class="u-header-topbar__nav-link text-light">
                                            <i class="ec ec-user mr-1"></i> {{ user()->name }}
                                        </a>
                                    @endif
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-2 py-xl-4 bg-primary-down-lg">
            <div class="container my-0dot5 my-xl-0">
                <div class="row align-items-center">


                    <div class="head_image @if(uri(2) == 'profile') col-md-7 @else col-auto @endif">
                        {{-- Моб меню --}}
                        <aside id="sidebarHeader1" class="u-sidebar u-sidebar--left" aria-labelledby="sidebarHeaderInvokerMenu">
                            <div class="u-sidebar__scroller">
                                <div class="u-sidebar__container">
                                    <div class="u-header-sidebar__footer-offset pb-0">
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
                                        <div class="js-scrollbarr u-sidebar__body">
                                            <div id="headerSidebarContent" class="u-sidebar__content u-header-sidebar__content">
                                                <a class="d-flexx ml-0 navbar-brand u-header__navbar-brand u-header__navbar-brand-vertical" href="/" aria-label="Massclo">
                                                    <img src="/img/logo.png" alt="Massclo">
                                                </a>
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

                                                        @foreach(map_tree($categories->toArray()) as $category)

                                                            <li class="u-has-submenu u-header-collapse__submenu">
                                                                <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer"
                                                                   href="javascript:;"
                                                                   data-target="#cat-collapse-{{ $category["id"] }}"
                                                                   role="button" data-toggle="collapse" aria-expanded="false"
                                                                   aria-controls="cat-collapse-{{ $category["id"] }}">
                                                                    {{ $category["name_$lang"] }}
                                                                </a>

                                                                @if(!empty($category['childs']))
                                                                    <div id="cat-collapse-{{ $category["id"] }}" class="collapse" data-parent="#cat-collapse-{{ $category["id"] }}">
                                                                        <ul class="u-header-collapse__nav-list">
                                                                            @foreach($category['childs'] as $child)
                                                                                @if(!empty($child['childs']))
                                                                                    <li><span class="u-header-sidebar__sub-menu-title">{{ $child["name_$lang"] }}</span></li>
                                                                                    @foreach($child['childs'] as $child2)
                                                                                        <li class="">
                                                                                            <a class="u-header-collapse__submenu-nav-link" href="{{ setUri('catalog/' . $child2['url']) }}">{{ $child2["name_$lang"] }}</a>
                                                                                        </li>
                                                                                    @endforeach
                                                                                @else
                                                                                    <li class="">
                                                                                        <a class="u-header-collapse__submenu-nav-link" href="{{ setUri('catalog/' . $child['url']) }}">{{ $child["name_$lang"] }}</a>
                                                                                    </li>
                                                                                @endif
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </aside>

                        <nav class="navbar navbar-expand u-header__navbar py-0 justify-content-xl-between max-width-270 min-width-270">
                            {{-- Вызов моб. меню --}}
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
                            {{-- Лого --}}
                            <a class="order-1 order-xl-0 navbar-brand u-header__navbar-brand u-header__navbar-brand-center" href="/" aria-label="Massclo">
                                <img src="/img/logo.png" class="logo-lg" alt="Massclo">
                                <img src="/img/logo_sm.png" class="logo-sm" alt="Massclo">
                            </a>
                        </nav>
                    </div>
                    
                    @if(uri(2) == 'profile')
                    <div class="head_profile_settings col">
                        <ul class="list-inline mb-0 float-right">
                            <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                <a href="{{ setUri(\Pages::getUriByType('delivery_payment')) }}" class="u-header-topbar__nav-link"><i class="ec ec-transport mr-1"></i> Доставка и оплата</a>
                            </li>
                            <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
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
                                        onclick="showSignup()"
                                        data-unfold-duration="500">
                                    <i class="ec ec-user mr-1"></i> Зарегистрироваться</a>
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
                                         <span class="text-gray-50">или</span> Войти в ЛК</a>
                                @else
                                    <a href="{{ route('dashboard', compact('lang')) }}" class="u-header-topbar__nav-link">
                                        <i class="ec ec-user mr-1"></i> {{ user()->name }}
                                    </a>
                                @endif
                            </li>
                        </ul>
                    </div>
                    @endif
                    <div class="col-auto d-none d-xl-flex align-self-center @if(uri(2) == 'profile') dashboard-area @endif">
                        <div id="basicsAccordion">
                            <div class="card">
                                {{--Кнопка категорий--}}
                                <div class="bg-primary card-collapse border-0" id="basicsHeadingOne">
                                    <button type="button"
                                            class="btn-link btn-remove-focus btn-block d-flex card-btn py-3 text-lh-1 px-4 shadow-none btn-primary border-0 font-weight-bold text-gray-90 collapsed height-40"
                                            data-toggle="collapse"
                                            data-target="#basicsCollapseOne"
                                            aria-expanded="false"
                                            aria-controls="basicsCollapseOne">
                                            <span class="pl-1 text-gray-90"><i class="fas fa-bars fa-lg"></i>  Каталог товаров</span>
                                    </button>
                                </div>
                                {{--Категории--}}
                                <div id="basicsCollapseOne" class="vertical-menu v1 collapse {{ (@$page_data->page_type == 'home') ? '' : '' }}"
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
                                                                    <div class="row u-header__mega-menu-wrapper">

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

                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col search-bar align-self-center @if(uri(2) == 'profile') dashboard-area @endif">
                        <form class="js-focus-state" action="{{ route('search', ['lang' => $lang]) }}">
                            <label class="sr-only" for="searchProduct">Поиск</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <button class="btn btn-dark height-40 py-2 px-3" type="button" id="searchProduct1">
                                        <span class="ec ec-search font-size-24"></span>
                                    </button>
                                </div>
                                <input type="text" value="{{ request('query') }}" class="form-control py-2 pl-5 font-size-15 height-40" name="query" id="searchProduct" placeholder="Найти товар" aria-label="Найти товар" aria-describedby="searchProduct1" required>
                            </div>
                        </form>
                    </div>
                    <div class="col-auto header-icons align-self-center @if(uri(2) == 'profile') dashboard-area @endif">
                        <div class="d-flex">
                            <ul class="d-flex list-unstyled mb-0">
                                {{--Кнопка избранных товаров--}}
                                <li class="col">
                                    <a href="{{ route('fav_list', ['lang' => $lang]) }}" class="text-gray-90" data-toggle="tooltip" data-placement="top" title="Избранное">
                                        <i class="font-size-22 ec ec-favorites"></i>
                                        <span style="left: 25px" class="{{ !sessArray('favorites')->count() ? 'd-none' : '' }} qty_fav width-22 height-22 bg-dark position-absolute flex-content-center text-white rounded-circle left-12 top-8 font-weight-bold font-size-12">{{  sessArray('favorites')->count() }}</span>
                                    </a>
                                </li>
                                {{--Кнопка корзины--}}
                                <li class="col pr-0">
                                    <a href="{{ route('view_cart', compact('lang')) }}"
                                        class="text-gray-90 position-relative d-flex" data-toggle="tooltip" data-placement="top" title="Корзина">
                                        <i class="font-size-22 ec ec-shopping-bag"></i>

                                        <span class="width-22 height-22 bg-dark {{ cart()->has() ? '' : 'd-none' }} position-absolute flex-content-center text-white rounded-circle left-12 top-8 font-weight-bold font-size-12 cart-qty">
                                            {{ cart()->getTotalQty() }}
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @if(uri(2) != 'profilee')
                    <div class="d-xl-none col col-xl-auto text-right text-xl-left pl-0 pl-xl-3 position-static">
                        <div class="d-inline-flex">
                            <ul class="d-flex list-unstyled mb-0 align-items-center">
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
                                    <div id="searchClassic" class="dropdown-menu dropdown-unfold dropdown-menu-right left-0 mx-2" aria-labelledby="searchClassicInvoker">
                                        <form class="js-focus-state input-group px-3">
                                            <input class="form-control" type="search" placeholder="Поиск товара">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary px-3" type="button"><i class="font-size-18 ec ec-search"></i></button>
                                            </div>
                                        </form>
                                    </div>
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
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>