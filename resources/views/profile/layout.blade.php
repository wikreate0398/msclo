@extends('layouts.public')

@section('content')
    <div class="container" style="min-height: 400px;">

        <!-- End Accordion -->

        <div class="row">
            <div class="col-lg-3">
                <div class="border-bottom border-color-1 mb-5">
                    <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">
                        Мой профиль
                    </h3>
                </div>

                <ul class="list-group mb-10 sidebar-navbar account-navbar" id="sidebarNav">
                    <li>
                        <a href="{{ route('account', compact('lang')) }}"
                           class="{{ (uri(3) == 'account') ? 'font-weight-bold' : '' }} font-bold-on-hover px-3 py-2 list-group-item list-group-item-action border-0">
                            <i class="mr-2 fas fa-angle-right"></i>
                            Личные данные
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('purchases', compact('lang')) }}"
                           class="{{ (uri(3) == 'purchases') ? 'font-weight-bold' : '' }} font-bold-on-hover px-3 py-2 list-group-item list-group-item-action border-right-0 border-left-0 border-bottom-0">
                            <i class="mr-2 fas fa-angle-right"></i>
                            Покупки
                        </a>
                    </li>

                    @if(user()->type == 'provider')
                        <li>
                            <a href=""
                               class="dropdown-toggle dropdown-toggle-collapse dropdown-title collapsed font-bold-on-hover px-3 py-2 list-group-item list-group-item-action border-right-0 border-left-0 border-bottom-0"
                               data-toggle="collapse"
                               aria-expanded="{{ (uri(3) == 'products') ? 'true' : 'false' }}"
                               aria-controls="prodSidebar"
                               data-target="#prodSidebar">
                                <i class="mr-2 fas fa-angle-right"></i>
                                Товары
                            </a>
                            <ul id="prodSidebar"
                                class="list-unstyled dropdown-list {{ (uri(3) == 'products') ? 'show' : '' }} collapse"
                                data-parent="#sidebarNav">
                                <li>
                                    <a href="{{ route('view_profile_product', compact('lang')) }}"
                                       class="{{ (uri(3) == 'products') ? 'font-weight-bold' : '' }} dropdown-item">
                                        Каталог
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="{{ route('orders', compact('lang')) }}" class="{{ (uri(3) == 'orders') ? 'font-weight-bold' : '' }} font-bold-on-hover px-3 py-2 list-group-item list-group-item-action border-right-0 border-left-0 border-bottom-0">
                                <i class="mr-2 fas fa-angle-right"></i>
                                Заказы
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('services', compact('lang')) }}"
                               class="{{ (uri(3) == 'services') ? 'font-weight-bold' : '' }} font-bold-on-hover px-3 py-2 list-group-item list-group-item-action border-right-0 border-left-0 border-bottom-0">
                                <i class="mr-2 fas fa-angle-right"></i>
                                Услуги
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('files', compact('lang')) }}"
                               class="{{ (uri(3) == 'files') ? 'font-weight-bold' : '' }} font-bold-on-hover px-3 py-2 list-group-item list-group-item-action border-right-0 border-left-0 border-bottom-0">
                                <i class="mr-2 fas fa-angle-right"></i>
                                Файлы
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('provider_contacts', compact('lang')) }}"
                               class="{{ (uri(3) == 'contacts') ? 'font-weight-bold' : '' }} font-bold-on-hover px-3 py-2 list-group-item list-group-item-action border-right-0 border-left-0 border-bottom-0">
                                <i class="mr-2 fas fa-angle-right"></i>
                                Контакты
                            </a>
                        </li>
                    @endif

                    <li>
                        <a href="{{ route('logout', compact('lang')) }}" class="font-bold-on-hover text-danger px-3 py-2 list-group-item list-group-item-action border-right-0 border-left-0 border-bottom-0">
                            <i class="mr-2 fas fa-angle-right"></i>
                            Выйти
                        </a>
                    </li>
                </ul>
            </div>

            @yield('profile')
        </div>
    </div>
@stop

