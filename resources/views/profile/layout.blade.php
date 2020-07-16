@extends('layouts.public')

@section('content')
    <div class="container">

        <!-- End Accordion -->

        <div class="row">
            <div class="col-lg-3">
                <div class="border-bottom border-color-1 mb-5">
                    <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">
                        Мой профиль
                    </h3>
                </div>
                <div class="list-group">
                    <a href="{{ route('account', compact('lang')) }}"
                       class="{{ (uri(3) == 'account') ? 'font-weight-bold' : '' }} font-bold-on-hover px-3 py-2 list-group-item list-group-item-action border-0">
                        <i class="mr-2 fas fa-angle-right"></i>
                        Личные данные
                    </a>

                    @if(user()->type == 'user')
                        <a href="" class="font-bold-on-hover px-3 py-2 list-group-item list-group-item-action border-right-0 border-left-0 border-bottom-0">
                            <i class="mr-2 fas fa-angle-right"></i>
                            Заказы
                        </a>
                    @else
                        <a href="{{ route('provider_contacts', compact('lang')) }}"
                           class="{{ (uri(3) == 'contacts') ? 'font-weight-bold' : '' }} font-bold-on-hover px-3 py-2 list-group-item list-group-item-action border-right-0 border-left-0 border-bottom-0">
                            <i class="mr-2 fas fa-angle-right"></i>
                            Контакты
                        </a>
                    @endif

                    <a href="{{ route('logout', compact('lang')) }}" class="font-bold-on-hover text-danger px-3 py-2 list-group-item list-group-item-action border-right-0 border-left-0 border-bottom-0">
                        <i class="mr-2 fas fa-angle-right"></i>
                        Выйти
                    </a>
                </div>
            </div>

            @yield('profile')
        </div>
    </div>
@stop

