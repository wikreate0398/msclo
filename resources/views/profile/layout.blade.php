@extends('layouts.public')

@section('content')
    <script>
        const deleteProductImageRoute = '{{ route('delete_product_image', compact('lang')) }}';
    </script>
    <div class="container" style="min-height: 400px;">

        <!-- End Accordion -->

        <div class="row vertical-navBar">
            <div class="col-lg-12">
                <div class="border-bottom border-color-1 mb-5">
                    <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">
                        Мой профиль
                    </h3>
                </div>

                <ul class="list-group mb-4 sidebar-navbar account-navbar" id="sidebarNav">
                    <li>
                        <a href="{{ route('account', compact('lang')) }}"
                           class="{{ (uri(3) == 'account') ? 'font-weight-bold' : '' }} px-3 py-2 list-group-item list-group-item-action border-0">
                            <i class="mr-2 fas fa-angle-right"></i>
                            Личные данные
                        </a>
                    </li>

                    @if(user()->type == 'provider')
                    <li>
                        <a href="{{ route('statistics', compact('lang')) }}"
                            class="{{ (uri(3) == 'statistics') ? 'font-weight-bold' : '' }} px-3 py-2 list-group-item list-group-item-action border-0">
                            <i class="mr-2 fas fa-angle-right"></i>
                            Статистика
                        </a>
                    </li>
                    @endif
                    
                    <li>
                        <a href="{{ route('purchases', compact('lang')) }}"
                           class="{{ (uri(3) == 'purchases') ? 'font-weight-bold' : '' }} px-3 py-2 list-group-item list-group-item-action border-right-0 border-left-0 border-bottom-0">
                            <i class="mr-2 fas fa-angle-right"></i>
                            Покупки
                        </a>
                    </li>
                    @if(user()->type == 'provider')
                        <li>
                            <a href="{{ route('view_profile_product', compact('lang')) }}" class="{{ (uri(3) == 'products') ? 'font-weight-bold' : '' }} px-3 py-2 list-group-item list-group-item-action border-right-0 border-left-0 border-bottom-0">
                                <i class="mr-2 fas fa-angle-right"></i>
                                Товары
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('orders', compact('lang')) }}" class="{{ (uri(3) == 'orders') ? 'font-weight-bold' : '' }} px-3 py-2 list-group-item list-group-item-action border-right-0 border-left-0 border-bottom-0">
                                <i class="mr-2 fas fa-angle-right"></i>
                                Заказы
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('services', compact('lang')) }}"
                               class="{{ (uri(3) == 'services') ? 'font-weight-bold' : '' }} px-3 py-2 list-group-item list-group-item-action border-right-0 border-left-0 border-bottom-0">
                                <i class="mr-2 fas fa-angle-right"></i>
                                Услуги
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('files', compact('lang')) }}"
                               class="{{ (uri(3) == 'files') ? 'font-weight-bold' : '' }} px-3 py-2 list-group-item list-group-item-action border-right-0 border-left-0 border-bottom-0">
                                <i class="mr-2 fas fa-angle-right"></i>
                                Файлы
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('provider_contacts', compact('lang')) }}"
                               class="{{ (uri(3) == 'contacts') ? 'font-weight-bold' : '' }} px-3 py-2 list-group-item list-group-item-action border-right-0 border-left-0 border-bottom-0">
                                <i class="mr-2 fas fa-angle-right"></i>
                                Контакты
                            </a>
                        </li>
                    @endif

                    <li>
                        <a href="{{ route('logout', compact('lang')) }}" class="text-danger px-3 py-2 list-group-item list-group-item-action border-right-0 border-left-0 border-bottom-0">
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

