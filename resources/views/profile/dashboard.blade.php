@extends('profile.layout')

@section('profile')
<div class="col-lg-12 dashboard-page">
    <div class="row">
        <div class="col-md-12 mb-6 mt-3">
            <div class="custom-card">
                <div class="row align-items-center p-2">
                    <div class="col-sm-12 col-md-1 ml-7 text-center">
                        <div class="profile-photo">
                            <div class="profile__img" style="background-image: url('{{ user()->image ? '/uploads/users/' . user()->image : '/uploads/no-avatar.png' }}');">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-8 ml-3">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="mb-1 ml-3">{{ $provider['full_name'] }}</h5>
                            </div>
                            <div class="col-md-10">
                                <p class="mb-1 description">{!! $provider['description'] !!}</p>
                            </div>
                            <div class="col-md-12">
                                <p class="mb-1">{{ $provider['phone'] }} @if($provider['phone'] != "" && $provider['email'] != "") <span class="ml-3 mr-3"> | </span>@else  @endif {{ $provider['email'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <div class="row">
                            <div class="resizble-block col-md-5 d-none d-xl-block"></div>
                            <div class="col-md-3 col-sm-12 text-center">
                                <a href="{{ route('account', ['lang' => $lang]) }}"><i class="fa fa-cog" aria-hidden="true"></i></a>
                            </div>
                            <div class="text-center align-self-center col-md-2 col-sm-12">
                                <a href="{{ route('logout', compact('lang')) }}" class="px-3 py-2 ">Выйти</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <h4 class="mb-5 font-weight-bold">Недавно добавленные товары</h4>
            <ul class="row mb-4 list-unstyled products-group no-gutters">
                @foreach($products as $product)
                    <li class="col-md-6 h-100 dashboard product_card">
                        <div class="p-5 row">
                            <div class="col-md-5">
                                <a target="_blank" href="{{ route('view_product', ['lang' => lang(), 'url' => $product->url]) }}" class="d-block text-center">
                                    <img class="img-fluid" src="{{ imageThumb($product->images->count() ? $product->images->first()->image : '', 'uploads/products', 50, 50, 'list') }}">
                                </a>
                            </div>
                            <div class="col-md-7 align-self-center">
                                <h5 class="mb-0 mt-2 product-item__title">
                                    <a target="_blank" href="{{ route('view_product', ['lang' => lang(), 'url' => $product->url]) }}">{{ $product["name_$lang"] }}</a>
                                </h5>
                                <span>{{ $product->category->name_ru }}</span>
                                <p class="mt-3 mb-n1">{{ @$product->prices->first()->price . ' ' . RUB }}</p>
                            </div>
                           
                        </div>
                    </li>
                @endforeach
                <li class="col-md-5 mx-5 add_product_block dashboard product_card">
                    <div class="h-100 text-center align-self-center">
                        <a href="{{ route('profile_add_product', compact('lang')) }}"
                        class="pb-10" style="font-size: 45px"><i class="fa fa-plus"></i></a>
                    </div>
                </li>
            </ul>
            <a class="link-blue" href="{{ route('view_profile_product', ['lang' => $lang]) }}">Все добавленные товары</a>
            <h4 class="mt-8 mb-n1 font-weight-bold">Наиболее популярные продажи</h4>
            <div class="row popular_orders">
                <div class="col-lg-12 mb-10">
                    <div class="mt-5 mb-0 cart-table">
                        <table class="table mb-3" cellspacing="0">
                        <thead>
                                <tr>
                                    <th style="width:8%">Фото</th>
                                    <th style="width:32%">Товар</th>
                                    <th style="width:16%">Категория</th>
                                    <th style="width:16%">Стоимость</th>
                                    <th style="width:16%">Поставщик</th>
                                    <th style="width:12%">Продаж</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($getOrders as $order)
                                <tr>
                                    <td>
                                        <img src="{{ imageThumb($order->product['images']->count() ? $order->product['images']->first()['image'] : '', 'uploads/products', 50, 50, 'list') }}" alt="">
                                    </td>
                                    <td>
                                        <p class="mb-n1 text-dark">
                                            <a class="text-dark" href="@if($order->product['deleted_at'] != null) {{ route('view_product', ['lang' => lang(), 'url' => $order->product['url']]) }} @else javascript:; @endif">{{ $order->product['name_ru']}}</a>
                                        </p>
                                        <span>Код: {{ $order->product['code'] }}</span>
                                    </td>
                                    <td>{{ $order->product['category']['name_ru']}}</td>
                                    <td class="custom-green">{{ isset($order->product['prices']) ? priceString($order->product['prices']->first()['price']) . ' ' . RUB : ''}}</td>
                                    <td><a class="link-blue" href="{{ route('view_provider', ['lang' => $lang, 'id' => $order->provider['id']]) }}">{{ $order->provider['name']}}</a></td>
                                    <td><strong>{{ $order->qty}}</strong></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <a class="link-blue" href="javascript:;">Все продажи</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-12">
            <div class="row mb-5">
                <h4 class="col-auto mr-auto font-weight-bold">Статистика</h4>
                @if($labels->count() > 1)
                <select class="col-auto js-select selectpicker dropdown-select custom-search-categories-select" data-style="btn height-40 text-gray-60 font-weight-normal border-0 rounded-0 bg-white" onchange="getChartDays(this.value)">
                    <option data-icon="fa fa-calendar" value="7" selected>за 1 неделю</option>
                    <option data-icon="fa fa-calendar" value="31">за 1 месяц</option>
                    <option data-icon="fa fa-calendar" value="92">за 3 месяца</option>
                    <option data-icon="fa fa-calendar" value="183">за 6 месяцев</option>
                </select>
                @endif
            </div>
            @if($labels->count() > 1)
            <div class="row my-2 mb-4">
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div id="canvas_father">
                                <canvas id="myChart" height="129"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
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
                        <h6>Добавлено товаров</h6>
                        <span>{{ $sumOfProducts }}</span>
                    </div>
                </div>
            </div>
        </div>
    
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script>
    var labels        = {!! json_encode($labels) !!}
    var diagramData   = {!! json_encode($diagramData) !!}
    var chartOrders   = {!! $diagramData->pluck('ordersTotal')->toJson() !!};
    var chartProducts = {!! $diagramData->pluck('qty')->toJson() !!};
    var chartSum      = {!! $diagramData->pluck('sum')->toJson() !!};
</script>


@stop