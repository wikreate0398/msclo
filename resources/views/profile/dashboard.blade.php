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
                                <p class="mb-1">{{ $provider->phone }} @if($provider->phone != "" && $provider->email != "") <span class="ml-3 mr-3"> | </span>@else  @endif {{ $provider->email }}</p>
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
            <h4>Недавно добавленные товары</h4>
            <ul class="row list-unstyled products-group no-gutters">
                @foreach($products as $product)
                    <li class="col-md-6 h-100 dashboard product_card">
                        <div class="p-5 row">
                            <div class="col-md-5">
                                <a target="_blank" href="{{ route('view_product', ['lang' => lang(), 'url' => $product->url]) }}" class="d-block text-center">
                                    <img class="img-fluid" src="{{ imageThumb($product->images->first()->image, 'uploads/products', 50, 50, 'list') }}">
                                </a>
                            </div>
                            <div class="col-md-7 align-self-center">
                                <h5 class="mb-0 mt-2 product-item__title">
                                    <a target="_blank" href="{{ route('view_product', ['lang' => lang(), 'url' => $product->url]) }}">{{ $product["name_$lang"] }}</a>
                                </h5>
                                <span>{{ $product->category->name_ru }}</span>
                                <p class="mt-3 mb-n1">{{ $product->prices->first()->price . ' ' . RUB }}</p>
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
                <div class="col-lg-12">
                    <div class="mt-5 mb-10 cart-table">
                        <table class="table" cellspacing="0">
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
                                        @if(isset($order->product['images']))
                                        <img src="{{ imageThumb($order->product['images']->first()['image'], 'uploads/products', 50, 50, 'list') }}" alt="">
                                        @else @endif
                                    </td>
                                    <td>
                                        <p class="mb-n1 text-dark"><a class="text-dark" href="{{ route('view_product', ['lang' => lang(), 'url' => $order->product['url']]) }}">{{ $order->product['name_ru']}}</a></p>
                                        <span>Код: {{ $order->product['code'] }}</span>
                                    </td>
                                    <td>{{ $order->product['category']['name_ru']}}</td>
                                    <td class="custom-green">{{ isset($order->product['prices']) ? $order->product['prices']->first()['price'] . ' ' . RUB : ''}}</td>
                                    <td><a class="link-blue" href="{{ route('view_provider', ['lang' => $lang, 'id' => $order->provider['id']]) }}">{{ $order->provider['name']}}</a></td>
                                    <td><strong>{{ $order->qty}}</strong></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <a class="link-blue" href="javascript:;">Все продажи</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-12">
            <h4>Статистика</h4>
            <div class="row my-2">
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <canvas id="chLine" height="100"></canvas>
                        </div>
                    </div>
                </div>
            </div>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>
    /* chart.js chart examples */
    var products = {!! json_encode($products) !!};
    // chart colors
    var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];

    /* large line chart */
    var chLine = document.getElementById("chLine");
    var chartData = {
        labels: ["S", "M", "T", "W", "T", "F", "S"],
        datasets: [{
            data: [589, 445, 483, 503, 689, 692, 634],
            backgroundColor: 'transparent',
            borderColor: colors[0],
            borderWidth: 4,
            pointBackgroundColor: colors[0]
        },
        {
            data: [639, 465, 493, 478, 589, 632, 674],
            backgroundColor: colors[3],
            borderColor: colors[1],
            borderWidth: 4,
            pointBackgroundColor: colors[1]
        }]
    };

    if (chLine) {
        new Chart(chLine, {
        type: 'line',
        data: chartData,
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: false
                    }
                }]
            },
            legend: {
                display: false
            }
        }});
    }


</script>

@stop