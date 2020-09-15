@extends('profile.layout')

@section('profile')
<div class="col-lg-12 dashboard-page">
    <div class="row">
        <div class="col-md-12 mb-6">
            <div class="custom-card">
                <div class="row align-items-center p-2">
                    <div class="col-xs-12 col-xl-1 ml-7 text-center">
                        <div class="profile-photo">
                            <div class="profile__img" style="background-image: url('{{ user()->image ? '/uploads/users/' . user()->image : '/uploads/no-avatar.png' }}');">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-xl-8 ml-3">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="mb-1 ml-3">{{ $provider->full_name }}</h5>
                            </div>
                            <div class="col-md-12">
                                <p class="mb-1 description">{{ $provider->description }}</p>
                            </div>
                            <div class="col-md-12">
                                <p class="mb-1">{{ $provider->phone }} <span class="ml-3 mr-3">|</span> {{ $provider->email }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-xl-2">
                        <div class="row">
                            <div class="col-md-5 d-none d-xl-block"></div>
                            <div class="col-md-3">
                                <a href="{{ route('account', ['lang' => $lang]) }}"><i class="fa fa-cog" aria-hidden="true"></i></a>
                            </div>
                            <div class="text-center align-self-center col-md-3">
                                <a href="{{ route('logout', compact('lang')) }}" class="px-3 py-2 ">Выйти</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <h4>Недавно добавленные твоары</h4>
        </div>
        <div class="col-md-4 mb-12">
            <h4>Статистика</h4>
            <img class="mb-3" style="max-width: 445px" src="{{ asset('img/dashboard_frame.png') }}">
            <div class="custom-card mb-4">
                <div class="row">
                    <div class="col-md-3 py-3 px-7 text-center">
                        <div class="rounded-icon cart rounded-circle"><i class="fas fa-shopping-cart fa-lg"></i></div>
                    </div>
                    <div class="col-md-7 px-3 align-self-center">
                        <h6>Всего продаж</h6>
                        <span>{{ $quantityOfAllSales }}</span>
                    </div>
                </div>
            </div>
            <div class="custom-card mb-4">
                <div class="row">
                    <div class="col-md-3 py-3 px-7 text-center">
                        <div class="rounded-icon dollar rounded-circle"><i class="fas fa-dollar-sign fa-lg"></i></div>
                    </div>
                    <div class="col-md-7 px-3 align-self-center">
                        <h6>Всего доходов</h6>
                        <span>{{ priceString($sumOfAllSales) }} {{ RUB }}</span>
                    </div>
                </div>
            </div>
            <div class="custom-card mb-4">
                <div class="row">
                    <div class="col-md-3 py-3 px-7 text-center">
                        <div class="rounded-icon box rounded-circle"><i class="fas fa-box fa-lg"></i></div>
                    </div>
                    <div class="col-md-7 px-3 align-self-center">
                        <h6>Всего доходов</h6>
                        <span>{{ $sumOfProducts }}</span>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-md-3">
            <div class="col-12 mb-5">
                <div class="custom-card">
                    <h6 class="text-center mb-4"><strong>Продажи за месяц</strong></h6>
                    <p class="readonly-field"><strong>Кол-во продаж:</strong><span class="float-right">{{ $quantityOfAllSalesFromLastMonth ?? '0' }}</span></p>
                    <p class="readonly-field"><strong>Сумма продаж, {{ RUB }}</strong><span class="float-right">{{ priceString($sumOfAllSalesFromLastMonth)  ?? '0' }}</span></p>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="custom-card">
                    <h6 class="text-center mb-4"><strong>Статистика</strong></h6>
                    <p class="readonly-field"><strong>Кол-во продаж, {{ RUB }}</strong><span class="float-right">{{ $quantityOfAllSales }}</span></p>
                    <p class="readonly-field"><strong>Сумма продаж, {{ RUB }}</strong><span class="float-right">{{ priceString($sumOfAllSales) }}</span></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="custom-card">
                <h6 class="text-center mb-4"><strong>Товары</strong></h6>
                <p class="readonly-field"><strong>Категорий:</strong><span class="float-right">{{ $sumOfCategories }}</span></p>
                <p class="readonly-field"><strong>Товаров:</strong><span class="float-right">{{ $sumOfProducts }}</span></p>
                @if($minProductPrice or $maxProductPrice)
                    <p class="readonly-field"><strong>Цены, {{ RUB }}</strong><span class="float-right">{{ priceString($minProductPrice) }} - {{ priceString($maxProductPrice) }}</span></p>
                @endif
                <div class="text-center">
                    <a href="{{ route('view_provider', ['lang' => $lang, 'id' => $id]) }}" class="btn btn-sm px-5 btn-primary-dark transition-3d-hover">В КАТАЛОГ</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="custom-card">
                <h6 class="text-center"><strong>Служба поддержки</strong></h6>
                <p class="readonly-field text-center" style="border-bottom: none"></p> 
                <div class="text-center">
                    <a href="#chatModal" data-toggle="modal" class="btn btn-sm px-5 btn-primary-dark transition-3d-hover">В ЧАТ</a>
                    @include('profile.chat-modal')
                </div>
            </div>
        </div> 
    </div> --}}

    @if(false)
        <div class="border-bottom border-color-1 mb-2">
            <h3 class="section-title mb-0 pb-2 font-size-25">Последние заказы</h3>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="mt-5 mb-10 cart-table">
                    <table class="table table-bordered" cellspacing="0">
                        <thead>
                            <tr>
                                <th></th>
                                <th>№</th>
                                <th>Имя</th>
                                <th>E-mail</th>
                                <th>Телефон</th>
                                <th>Дата</th>
                                <th>Итог, {{ RUB }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td onclick="showPurchaseProducts(this)" class="purchase-collapse">
                                    <i class="fas fa-angle-right"></i>
                                </td>
                                <td>{{ $order->rand }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->user->email }}</td>
                                <td>{{ $order->user->phone }}</td>
                                <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                                <td>{{ priceString($order->total_price) }}</td>
                            </tr>
                            <tr style="display: none" class="purchase-prod">
                                <td colspan="7">
                                    <table class="table" style="background: #ededed">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Наиминование</th>
                                                <th>Цена</th>
                                                <th>Кол-во</th>
                                                <th>Итог, {{ RUB }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($order->products as $product)
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('view_product', ['lang' => lang(), 'url' => $product->product->url]) }}">
                                                            <img class="img-fluid max-width-100 p-1 border border-color-1"
                                                                 src="{{ imageThumb(@$product->product->images->first()->image, 'uploads/products', 300, 300, '300X300') }}">
                                                        </a>
                                                    </td>
                                                    <td>{{ $product->product["name_$lang"] }}</td>
                                                    <td>{{ priceString($product->price) }}</td>
                                                    <td>{{ $product->qty }}</td>
                                                    <td>{{ priceString($product->price*$product->qty) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
    
</div>



@stop