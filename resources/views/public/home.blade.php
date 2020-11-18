@extends('layouts.public')

@section('content')
    <div class="mb-5">
        <div class="bg-img-hero home-slider">
            <div class="min-height-420 overflow-hidden">
                <div class="js-slick-carousel u-slick"
                     data-pagi-classes="text-center position-absolute right-0 bottom-0 left-0 u-slick__pagination u-slick__pagination--long mb-3 mb-md-4 pl-2 pb-1">

                    @foreach($sliders as $key => $slider)
                        <div class="js-slide bg-img-hero-center"
                             style="{{ $slider->link ? 'cursor:pointer;' : '' }} background-image: url(/uploads/slider/{{ $slider->image }})"
                             @if($slider->link) onclick="window.location='{{ $slider->link }}'" @endif
                                {{ $key ? 'data-animation-delay="0"' : '' }}>
{{--                            <img src="/uploads/slider/{{ $slider->image }}" alt="">--}}

                            @if(false)
                                <div class="container">
                                    <div class="row min-height-420 py-7 py-md-0">
                                        <div class="offset-xl-3 col-xl-4 col-6 mt-md-8">
                                            <h1 class="font-size-64 text-lh-57 font-weight-light"
                                                data-scs-animation-in="fadeInUp">
                                                {{ $slider->product["name_$lang"] }}</span>
                                            </h1>
                                            {{--                                        <h6 class="font-size-15 font-weight-bold mb-3"--}}
                                            {{--                                            data-scs-animation-in="fadeInUp"--}}
                                            {{--                                            data-scs-animation-delay="200">UNDER FAVORABLE SMARTWATCHES--}}
                                            {{--                                        </h6>--}}
                                            <div class="mb-4"
                                                 data-scs-animation-in="fadeInUp"
                                                 data-scs-animation-delay="300">
                                                <span class="font-size-13">От</span>
                                                <div class="font-size-50 font-weight-bold text-lh-45">
                                                    <sup class="">{{ RUB }}</sup>{{ priceString($slider->product->price) }}
                                                </div>
                                            </div>
                                            <a href="{{ route('view_product', ['lang' => lang(), 'url' => $slider->product->url]) }}" class="btn btn-primary transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16"
                                               data-scs-animation-in="fadeInUp"
                                               data-scs-animation-delay="400">
                                                Перейти
                                            </a>
                                        </div>

                                        <div class="col-xl-5 col-6  d-flex align-items-center"
                                             data-scs-animation-in="zoomIn"
                                             data-scs-animation-delay="500">
                                            <img class="img-fluid" src="{{ imageThumb($slider->product->images->first()->image, 'uploads/products', 416, 420, 1) }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- End Slider Section -->

    <div class="container">

    @if($banners->count())
        <!-- Banner -->
            <div class="mb-5">
                <div class="row mb-6 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">

                    @foreach($banners as $banner)
                        <div class="col-md-6 mb-4 mb-xl-0 col-xl-4 col-wd-3 flex-shrink-0 flex-xl-shrink-1">
                            <a href="{{ $banner->link }}" class="d-black text-gray-90" {!! !$banner->link ? offLink() : '' !!}>
                                <div class="min-height-132 py-1 d-flex bg-gray-1 align-items-center">
                                    <div class="col-6 col-xl-5 col-wd-6 pr-0">
                                        <img class="img-fluid" src="{{ imageThumb($banner->image, 'uploads/banners', 246, 176, 1) }}" alt="{{ $banner["name_$lang"] }}">
                                    </div>
                                    <div class="col-6 col-xl-7 col-wd-6">
                                        <div class="mb-2 pb-1 font-size-18 font-weight-light text-ls-n1 text-lh-23">
                                            {{ $banner["name_$lang"] }}
                                        </div>

                                        @if($banner->link)
                                            <div class="link text-gray-90 font-weight-bold font-size-15">
                                                Перейти
                                                <span class="link__icon ml-1">
                                                    <span class="link__icon-inner"><i class="ec ec-arrow-right-categproes"></i></span>
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- End Banner -->
        @endif

        <div class="mb-6 row border rounded-lg mx-0 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
            <!-- Feature List -->
            <div class="media col px-6 px-xl-4 px-wd-8 flex-shrink-0 flex-xl-shrink-1 min-width-270-all py-3">
                <div class="u-avatar mr-2">
                    <i class="text-primary ec ec-transport font-size-46"></i>
                </div>
                <div class="media-body text-center">
                    <span class="d-block font-weight-bold text-dark">Бесплатная доставка</span>
                    <div class=" text-secondary">от 3000{{ RUB }}</div>
                </div>
            </div>
            <!-- End Feature List -->

            <!-- Feature List -->
            <div class="media col px-6 px-xl-4 px-wd-8 flex-shrink-0 flex-xl-shrink-1 min-width-270-all border-left py-3">
                <div class="u-avatar mr-2">
                    <i class="text-primary ec ec-tag font-size-46"></i>
                </div>
                <div class="media-body text-center">
                    <span class="d-block font-weight-bold text-dark">Только лучшие</span>
                    <div class=" text-secondary">Брэнды</div>
                </div>
            </div>
            <!-- End Feature List -->

            <!-- Feature List -->
            <div class="media col px-6 px-xl-4 px-wd-8 flex-shrink-0 flex-xl-shrink-1 min-width-270-all border-left py-3">
                <div class="u-avatar mr-2">
                    <i class="text-primary ec ec-returning font-size-46"></i>
                </div>
                <div class="media-body text-center">
                    <span class="d-block font-weight-bold text-dark">30 Дней</span>
                    <div class=" text-secondary">Для возврата</div>
                </div>
            </div>
            <!-- End Feature List -->

            <!-- Feature List -->
            <div class="media col px-6 px-xl-4 px-wd-8 flex-shrink-0 flex-xl-shrink-1 min-width-270-all border-left py-3">
                <div class="u-avatar mr-2">
                    <i class="text-primary ec ec-payment font-size-46"></i>
                </div>
                <div class="media-body text-center">
                    <span class="d-block font-weight-bold text-dark">Оплата</span>
                    <div class=" text-secondary">По безопасной системе</div>
                </div>
            </div>
        </div>
        <!-- Deals-and-tabs -->
        <div class="mb-5 home-tags">
            <div class="row">
                <!-- Deal -->
                <div class="col-md-auto mb-6 mb-md-0">
                    <div class="p-3 bg-white min-width-370">
                        <img src="/img/banner1.jpg" alt="" style="min-width: 100%;">
                    </div>
                </div>
                <!-- End Deal -->
                <!-- Tab Prodcut -->
                <div class="col">
                    <!-- Features Section -->
                    <div class="">
                        <!-- Nav Classic -->
                        <div class="position-relative bg-white text-center z-index-2">
                            <ul class="nav nav-classic nav-tab justify-content-center" id="pills-tab" role="tablist">
                                @foreach($tags as $key => $tag)
                                    <li class="nav-item">
                                        <a class="nav-link {{ !$key ? 'active' : '' }}" id="tag-{{ $tag->id }}" data-toggle="pill" href="#tag-tab-{{ $tag->id }}" role="tab" aria-controls="tag-tab-{{ $tag->id }}-control" aria-selected="true">
                                            <div class="d-md-flex justify-content-md-center align-items-md-center">
                                                {{ $tag["name_$lang"] }}
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- End Nav Classic -->

                        <!-- Tab Content -->
                        <div class="tab-content" id="pills-tabContent">
                            @foreach($tags as $key => $tag)
                                <div class="tab-pane fade pt-2 {{ !$key ? 'show active' : '' }}" id="tag-tab-{{ $tag->id }}" role="tabpanel" aria-labelledby="tag-tab-{{ $tag->id }}-control">
                                    <ul class="row list-unstyled products-group no-gutters">
                                        @foreach($tag->products as $product)
                                            <li class="col-6 col-wd-3 col-md-4 product-item js_list__item d-wd-block remove-divider-wd list-product-{{ $product->id }}">
                                                @include('public.catalog.blocks.product_item', ['product' => $product])
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                        <!-- End Tab Content -->
                    </div>
                    <!-- End Features Section -->
                </div>
                <!-- End Tab Prodcut -->
            </div>
        </div>
        <!-- End Deals-and-tabs -->
    </div>

    @if($cats->count())
        <div class="products-group-4-1-4 space-1 bg-gray-7">
            <h2 class="sr-only">Новый товары</h2>
            <div class="container ">
                <div class="position-relative text-center z-index-2 mb-3">
                    <ul class="nav nav-classic nav-tab nav-tab-sm px-md-3 justify-content-start justify-content-lg-center flex-nowrap flex-lg-wrap overflow-auto overflow-lg-visble border-md-down-bottom-0 pb-1 pb-lg-0 mb-n1 mb-lg-0" id="pills-tab-1" role="tablist">
                        @foreach($cats->take(5) as $key => $cat)
                            <li class="nav-item flex-shrink-0 flex-lg-shrink-1">
                                <a class="nav-link {{ !$key ? 'active' : '' }}"
                                   id="cat-{{ $cat->id }}"
                                   data-toggle="pill"
                                   href="#cat-tab-{{ $cat->id }}"
                                   role="tab"
                                   aria-controls="cat-{{ $cat->id }}"
                                   aria-selected="true">
                                    <div class="d-md-flex justify-content-md-center align-items-md-center">
                                        {{ $cat["name_$lang"] }}
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="tab-content" id="Tpills-tabContent">
                    @foreach($cats->take(5) as $key => $cat)
                        <div class="tab-pane fade pt-2 {{ !$key ? 'show active' : '' }}" id="cat-tab-{{ $cat->id }}" role="tabpanel" aria-labelledby="cat-{{ $cat->id }}">
                            <div class="row no-gutters">
                                <ul class="row list-unstyled products-group no-gutters mb-0 flex-xl-row flex-wd-row" style="width:100%;">
                                    @foreach($cat->products as $product)
                                        <li class="col-xl-3 product-item js_list__item max-width-xl-100 remove-divider list-product-{{ $product->id }}">
                                            <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                                <div class="product-item__inner bg-white p-3">
                                                    <div class="product-item__body pb-xl-2">
                                                        <div class="mb-2">
                                                            <a href="{{ setUri("catalog/{$product->category->url}") }}" class="font-size-12 text-gray-5">{{ $product->category["name_$lang"] }}</a>
                                                        </div>
                                                        <h5 class="mb-1 product-item__title">
                                                            <a href="{{ route('view_product', ['lang' => lang(), 'url' => $product->url]) }}" class="text-blue font-weight-bold">
                                                                {{ $product["name_$lang"] }}
                                                            </a>
                                                        </h5>
                                                        <div class="mb-2">
                                                            <a href="{{ route('view_product', ['lang' => lang(), 'url' => $product->url]) }}" class="d-block text-center">
                                                                <img class="img-fluid product-list-image-v2" src="{{ imageThumb(@$product->images->first()->image, 'uploads/products', 212, 0, '212X0') }}" alt="Image Description">
                                                            </a>
                                                        </div>
                                                        <div class="flex-center-between mb-1">
                                                            <div class="prodcut-price">
                                                                <div class="text-gray-100">{{ RUB }}{{ priceString(@$product->prices->first()->price) }}</div>
                                                            </div>
                                                            <div class="d-none d-xl-block prodcut-add-cart">
                                                                <a href="javascript:;"
                                                                   onclick="showModalCart(this, {{ $product->id }})"
                                                                   class="btn-add-cart btn-primary transition-3d-hover">
                                                                    <i class="ec ec-add-to-cart"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="product-item__footer">
                                                        <div class="border-top pt-2 flex-center-between flex-wrap">
                                                            <a href="javascript:;"
                                                               class="text-gray-6 compare-icon compare-icon-{{ $product->id }} font-size-13 {{ sessArray('compare')->exist($product->id) ? 'active' : '' }}"
                                                               onclick="addToCompare(this, {{ $product->id }}); return false;">
                                                                <i class="ec ec-compare mr-1 font-size-15"></i> Сравнить
                                                            </a>
                                                            <a href="javascript:;"
                                                               class="text-gray-6 fav-icon fav-icon-{{ $product->id }} font-size-13 {{ sessArray('favorites')->exist($product->id) ? 'active' : '' }}"
                                                               onclick="addToFav(this, {{ $product->id }}); return false;">
                                                                <i class="ec ec-favorites mr-1 font-size-15"></i> Избранное
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- End Tab Content -->
            </div>
        </div>
    @endif

    <div class="mb-6">
        <div class="container">
            <div class="row min-height-564 align-items-center">
                <div class="col-12 col-lg-4 col-xl-5 col-wd-6 d-none d-md-block">
                    <img class="img-fluid" src="/img/banner2.jpg" alt="Image Description">
                </div>
                <div class="col-12 col-lg-8 col-xl-7 col-wd-6 pt-6 pt-md-0">
                    <div class=" d-flex border-bottom border-color-1 mr-md-2">
                        <h3 class="section-title section-title__full mb-0 pb-2 font-size-22">Поставщики</h3>
                    </div>
                    <div class="js-slick-carousel position-static u-slick u-slick--gutters-2 u-slick overflow-hidden u-slick-overflow-visble py-5"
                         data-arrows-classes="position-absolute top-0 font-size-17 u-slick__arrow-normal top-10 pt-6 pt-md-0"
                         data-arrow-left-classes="fa fa-angle-left right-2"
                         data-arrow-right-classes="fa fa-angle-right right-1"
                         data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-4">

                        @foreach($providers as $items)
                            <div class="js-slide">
                                <ul class="row list-unstyled products-group no-gutters mb-0 overflow-visible">
                                    @foreach($items as $provider)
                                        <li class="col-md-6 product-item product-item__card mb-2 remove-divider pr-md-2 border-bottom-0"
                                            style="min-height: 148px;">
                                            <div class="product-item__outer h-100 w-100">
                                                <div class="product-item__inner p-md-3 row no-gutters bg-white max-width-334">
                                                    <div class="col col-lg-auto product-media-left">
                                                        <a href="{{ route('view_provider', ['lang' => $lang, 'id' => $provider->id]) }}" class="max-width-120 d-block">
                                                            <img class="img-fluid"
                                                                 src="{{ imageThumb($provider->image, 'uploads/users', 150, 140, '150X140') }}"
                                                                 alt="Поставщик {{ $provider['name'] }}">
                                                        </a>
                                                    </div>
                                                    <div class="col product-item__body pl-2 pl-lg-3 mr-xl-2 mr-wd-1 pr-3 pr-md-0 pt-1 pt-md-0">
                                                        <div class="mb-2" style="min-height: 65px;">
                                                            <h5 class="product-item__title">
                                                                <a href="{{ route('view_provider', ['lang' => $lang, 'id' => $provider->id]) }}"
                                                                   class="text-blue font-weight-bold"
                                                                   style="min-height: auto">
                                                                    {{ $provider['name'] }}
                                                                </a>
                                                            </h5>
                                                            <div class="mb-2">
                                                                @foreach($providersCats[$provider->id]->sortByDesc('countProducts')->take(4) as $provider_cat)
                                                                    <a href="{{ route('view_catalog', ['lang' => $lang, 'url' => $provider_cat['category_data']['url'], 'providers' => $provider->id]) }}"
                                                                       class="font-size-12 text-gray-5 d-block"
                                                                        style="width: 100%">
                                                                        <i class="fa fa-angle-right"></i> {{ $provider_cat['category_data']["name_$lang"] }}
                                                                    </a>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="d-flex mb-2" style="justify-content: flex-end">
                                                            <div class="d-flex prodcut-add-cart">
                                                                <a href="{{ route('view_provider', ['lang' => $lang, 'id' => $provider->id]) }}"
                                                                   class="btn-add-cart btn-primary transition-3d-hover">
                                                                    <i class="fa fa-angle-right"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        @if($brands->count())
            <div class="mb-8 mt-8">
                @include('public/blocks/brands')
            </div>
        @endif
    </div>
    <!--
    <div class="space-1">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>Категории</h3>
                    
                </div>
            </div>
        </div>
    </div>
    -->
    <div class="container">
        <div class="mb-6 row rounded-lg mx-0 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
            <div class="media col px-6 px-xl-4 flex-shrink-0 flex-xl-shrink-1 min-width-270-all py-3">
                <div class="u-avatar mr-2">
                    <i class="text-primary ec ec-transport font-size-46"></i>
                </div>
                <div class="media-body text-center">
                    <span class="d-block font-weight-bold text-dark">Бесплатная доставка</span>
                    <div class=" text-secondary">от 3000{{ RUB }}</div>
                </div>
            </div>
            <div class="media col px-6 px-xl-4 flex-shrink-0 flex-xl-shrink-1 min-width-270-all border-left py-3">
                <div class="u-avatar mr-2">
                    <i class="text-primary ec ec-tag font-size-46"></i>
                </div>
                <div class="media-body text-center">
                    <span class="d-block font-weight-bold text-dark">Только лучшие</span>
                    <div class=" text-secondary">Брэнды</div>
                </div>
            </div>
            <div class="media col px-6 px-xl-4 flex-shrink-0 flex-xl-shrink-1 min-width-270-all border-left py-3">
                <div class="u-avatar mr-2">
                    <i class="text-primary ec ec-returning font-size-46"></i>
                </div>
                <div class="media-body text-center">
                    <span class="d-block font-weight-bold text-dark">30 Дней</span>
                    <div class=" text-secondary">Для возврата</div>
                </div>
            </div>
            <div class="media col px-6 px-xl-4 flex-shrink-0 flex-xl-shrink-1 min-width-270-all border-left py-3">
                <div class="u-avatar mr-2">
                    <i class="text-primary ec ec-payment font-size-46"></i>
                </div>
                <div class="media-body text-center">
                    <span class="d-block font-weight-bold text-dark">Оплата</span>
                    <div class=" text-secondary">По безопасной системе</div>
                </div>
            </div>
        </div>
    </div>

    <div class="space-1 bg-gray-7">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="headerBlock">Товары месяца</h3>
                    <div class="js-slick-carousel u-slick my-1"
                        data-slides-show="5"
                        data-slides-scroll="1"
                        data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-normal u-slick__arrow-centered--y"
                        data-arrow-left-classes="fa fa-angle-left u-slick__arrow-classic-inner--left z-index-9"
                        data-arrow-right-classes="fa fa-angle-right u-slick__arrow-classic-inner--right"
                        data-responsive='[{
                            "breakpoint": 992,
                            "settings": {
                                "slidesToShow": 2
                            }
                        }, {
                            "breakpoint": 768,
                            "settings": {
                                "slidesToShow": 1
                            }
                        }, {
                            "breakpoint": 554,
                            "settings": {
                                "slidesToShow": 1
                            }
                        }]'>
                         @foreach($products as $product)
                            <div class="js-slide homeProductCarusel">
                                <div class="productImage">
                                    <img class="img-fluid product-list-image-v2" src="{{ imageThumb(@$product->images->first()->image, 'uploads/products', 720, 0, '720X0') }}" alt="Image Description">
                                    <a href="javascript:;"
                                        class="productFavorites fav-icon fav-icon-{{ $product->id }} {{ sessArray('favorites')->exist($product->id) ? 'active' : '' }}"
                                        onclick="addToFav(this, {{ $product->id }}); return false;">
                                        <i class="far fa-heart"></i>
                                    </a>
                                    <a href="javascript:;"
                                        onclick="showModalCart(this, {{ $product->id }})"
                                        class="productAddCart">
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </div>
                                <span class="productCode">Код: {{ $product->code }}</span>
                                <a href="{{ route('view_product', ['lang' => lang(), 'url' => $product->url]) }}" class="d-block">
                                    {{ $product["name_$lang"] }}
                                </a>
                                <span class="productPrice">{{ RUB }}{{ priceString(@$product->prices->first()->price) }}</span>
                            </div>
                        @endforeach

                    </div>
                    <!--<a href="#" class="btn btnStore">Все товары</a>-->
                </div>
            </div>
        </div>
    </div>
    <!--
    <div class="space-1">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>Лучшие поставщики</h3>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="space-1 bg-gray-7">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3>Вы поставщик?</h3>
                    Привлекайте новых клиентов 
                    Разместите все свои товары на портале и они мгновенно будут доступны миллионам предпринимателей со всех уголков России: от Калининграда до Владивостока

                    Доступность для каждого 
                    Клиенты легко найдут ваши контакты в любое время. Ваши продажи теперь не зависят от форс-мажоров, погодных условий и карантинов.

                    Не нужно создавать свой сайт 
                    Каждому пользователь может создать свой сайт всего за 30 минут. И сэкономить от 100 тыс. рублей на разработку и рекламу

                    <a href="#">Подробнее</a>
                </div>
                <div class="col-md-6">
                    <h4>Начать продавать</h4>
                    <form>
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Ваше имя*">
                        </div>
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" placeholder="E-mail*">
                        </div>
                        <div class="form-group">
                            <input type="text" name="phone" class="form-control" placeholder="Телефон*">
                        </div>
                        <button type="submit" class="btn btn-primary">Стать поставщиком</button>
                    </form>
                </div>
            </div>
        </div>
    </div>-->
@stop

