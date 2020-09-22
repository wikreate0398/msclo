@extends('layouts.public')

@section('content')
    <script>
        const deleteProductImageRoute = '{{ route('delete_product_image', compact('lang')) }}';
    </script>

    <div class="bg-primary pt-2 mb-5">
        <div class="container">
            <div class="row vertical-navBar">
                <div class="col-lg-12">
                    <ul class="list-group">

                        @if(user()->type == 'provider')
                            <li>
                                <a href="{{ route('dashboard', compact('lang')) }}"
                                    class="{{ (uri(3) == 'dashboard') ? 'active-navbar' : '' }} px-3 py-2 list-group-item list-group-item-action">
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('statistics', compact('lang')) }}"
                                    class="{{ (uri(3) == 'statistics') ? 'active-navbar' : '' }} px-3 py-2 list-group-item list-group-item-action border-0">
                                    Статистика
                                </a>
                            </li>
                            @endif
                            <li>
                                <a href="{{ route('purchases', compact('lang')) }}"
                                    class="{{ (uri(3) == 'purchases') ? 'active-navbar' : '' }} px-3 py-2 list-group-item list-group-item-action border-right-0 border-left-0">
                                    Покупки
                                </a>
                            </li>
                            @if(user()->type == 'provider')
                            <li>
                                <a href="{{ route('view_profile_product', compact('lang')) }}" class="{{ (uri(3) == 'products') ? 'active-navbar' : '' }} px-3 py-2 list-group-item list-group-item-action border-right-0 border-left-0">
                                    Товары <span class="text-light">({{ $productsNumber }})</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('orders', compact('lang')) }}" class="{{ (uri(3) == 'orders') ? 'active-navbar' : '' }} px-3 py-2 list-group-item list-group-item-action border-right-0 border-left-0">
                                    Заказы <span class="px-1 bg-danger text-light"> {{ $ordersNumber }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('files', compact('lang')) }}"
                                class="{{ (uri(3) == 'files') ? 'active-navbar' : '' }} px-3 py-2 list-group-item list-group-item-action border-right-0 border-left-0">
                                    Файлы
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('services', compact('lang')) }}"
                                class="{{ (uri(3) == 'services') ? 'active-navbar' : '' }} px-3 py-2 list-group-item list-group-item-action border-right-0 border-left-0">
                                    Услуги
                                </a>
                            </li>
                        @endif
                        <li>
                            <a href="{{ route('account', compact('lang')) }}"
                               class="{{ (uri(3) == 'account') ? 'active-navbar' : '' }} px-3 py-2 list-group-item list-group-item-action border-0">
                                Личные данные
                            </a>
                        </li>
                        @if(user()->type == 'user')
                            <li>
                                <a href="{{ route('logout', compact('lang')) }}" class="text-danger px-3 py-2 list-group-item list-group-item-action border-right-0 border-left-0 border-bottom-0">
                                    <i class="mr-2 fas fa-angle-right"></i>
                                    Выйти
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="min-height: 400px;">

        <!-- End Accordion -->

        <div class="row vertical-navBar">
            

            @yield('profile')
        </div>
    </div>
@stop

