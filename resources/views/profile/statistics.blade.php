@extends('profile.layout')

@section('profile')
<div class="col-lg-12 statistic-page">
    <div class="row">
        <div class="col-md-3">
            <div class="custom-card">
                <div class="col-md-12">
                    <div class="profile-photo">
                        <div class="profile__img" style="background-image: url('{{ user()->image ? '/uploads/users/' . user()->image : '/uploads/no-avatar.png' }}');">
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <h5 class="mb-3">{{ $provider->full_name }}</h5>
                    <p class="mb-2"><i class="fas fa-phone mr-1"></i>{{ $provider->phone }}7</p>
                    <p class="mb-2"><i class="fas fa-envelope mr-1"> </i>{{ $provider->email }}</p>
                    @if($provider->site)
                        <p class="mb-2"><i class="fab fa-internet-explorer mr-1"> </i>{{ $provider->site }}</p>
                    @endif

                    @if($provider->skype)
                        <p class="mb-3"><i class="fab fa-skype mr-1"> </i>{{ $provider->skype }}</p>
                    @endif
                </div>
                <div class="text-center">
                    <a href="{{ route('account', ['lang' => $lang]) }}" class="btn btn-sm px-5 btn-primary-dark transition-3d-hover">РЕДАКТИРОВАТЬ</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
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
                <p class="readonly-field text-center" style="border-bottom: none">{{ SUPPORT_DESC }}</p>
                <div class="text-center">
                    <a href="#chatModal" data-toggle="modal" class="btn btn-sm px-5 btn-primary-dark transition-3d-hover">В ЧАТ</a>
                    @include('profile.chat-modal')
                </div>
            </div>
        </div>
    </div>

    @if($orders)
        <div class="border-bottom border-color-1 mt-7 mb-2">
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