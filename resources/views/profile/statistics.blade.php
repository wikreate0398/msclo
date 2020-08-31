@extends('profile.layout')

@section('profile')
<div class="col-lg-12 statistic-page">
    <!-- Title -->
    <div class="border-bottom border-color-1 mb-5">
        <h3 class="section-title mb-0 pb-2 font-size-25">Статистика</h3>
    </div>
    <!-- End Title -->
    <div class="row">
        <div class="col-md-3">
            <div class="custom-card">
                <div class="col-md-12">
                    <div class="profile-photo">
                        <div class="profile__img" style="background-image: url('{{ user()->image ? '/uploads/users/' . user()->image : '/uploads/no-avatar.png' }}');">
                            <div class="actions__upload_photo" >
                                <span class="btn-file">
                                    <i class="fa fa-image" aria-hidden="true"></i>
                                </span>
                                <input type="file" class="avatar__fileimage" name="image" onchange="profilePhoto(this)">
                                <input type="hidden" name="avatar" id="avatar">
                            </div>
                            <div class="preloader__image_content" style="display: none;">
                                <div class="loader-inner ball-pulse">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h4>{{ $provider->full_name }}</h4>
                <p class="mb-0"><i class="fas fa-phone mr-1"></i>{{ $provider->phone }}7</p>
                <p class="mb-0"><i class="fas fa-envelope mr-1"> </i>{{ $provider->email }}</p>
                <p class="mb-0"><i class="fab fa-internet-explorer mr-1"> </i>{{ $provider->site }}</p>
                <p class="mb-3"><i class="fab fa-skype mr-1"> </i>{{ $provider->skype }}</p>
                <a class="custom-button" href="{{ route('account', ['lang' => $lang]) }}">РЕДАКТИРОВАТЬ</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="col-12 mb-5">
                <div class="custom-card">
                    <h6 class="text-center"><strong>Продажи за месяц</strong></h6>
                    <section class=readonly-box">
                        <p class="readonly-field"><strong>Кол-во продаж:</strong><span class="float-right">{{ $quantityOfAllSalesFromLastMonth ?? '0' }}</span></p>
                    </section>
                    <section class="readonly-box">
                        <p class="readonly-field mb-1"><strong>Сумма продаж:</strong><span class="float-right">{{ $sumOfAllSalesFromLastMonth  ?? '0' }}</span></p>
                    </section>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="custom-card">
                    <h6 class="text-center"><strong>Статистика</strong></h6>
                    <section class=readonly-box">
                        <p class="readonly-field"><strong>Кол-во продаж:</strong><span class="float-right">{{ $quantityOfAllSales }}</span></p>
                    </section>
                    <section class="readonly-box">
                        <p class="readonly-field mb-1"><strong>Сумма продаж:</strong><span class="float-right">{{ $sumOfAllSales }}</span></p>
                    </section>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="custom-card">
                <h6 class="text-center"><strong>Товары</strong></h6>
                <section class=readonly-box">
                    <p class="readonly-field"><strong>Категорий:</strong><span class="float-right">{{ $sumOfCategories }}</span></p>
                </section>
                <section class="readonly-box">
                    <p class="readonly-field"><strong>Товаров:</strong><span class="float-right">{{ $sumOfProducts }}</span></p>
                </section>
                <section class="readonly-box">
                    <p class="readonly-field"><strong>Цены:</strong><span class="float-right">{{ $minProductPrice }} - {{ $maxProductPrice }}</span></p>
                </section>
                <a class="custom-button" href="{{ route('view_provider', ['lang' => $lang, 'id' => $id]) }}">В КАТАЛОГ</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="custom-card">
                <h6 class="text-center"><strong>Служба поддержки</strong></h6>
                <section class="readonly-box">
                    <p class="readonly-field"><span> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore alias a incidunt. Ea, provident et dolor deserunt quibusdam quae. Tenetur commodi cum modi amet voluptatum praesentium quam magni fuga deserunt!</span></p>
                </section>
                <a class="custom-button" href="">В ЧАТ</a>
            </div>
        </div>
    </div>

    <h2 class="mt-3">Последние заказы</h2>
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
    
</div>



@stop