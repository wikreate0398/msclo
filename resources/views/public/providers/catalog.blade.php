@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row mb-8">
            <div class="d-none d-xl-block col-xl-3 col-wd-2gdot5">

                @if($filterPrices->count() && $filterPrices['min'] != $filterPrices['max'])
                    <div class="mb-6">
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Фильтр</h3>
                        </div>

                        <input type="hidden" id="page" id="page_num" value="{{ request('page') ?: 1 }}">

                        @if($filterCategories->count() > 1)
                            <div class="border-bottom pb-4 mb-4">
                                <h4 class="font-size-14 mb-3 font-weight-bold">Категории</h4>

                                @foreach($filterCategories as $category)
                                    <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox"
                                                   value="{{ $category->id }}"
                                                   class="custom-control-input cats-input"
                                                   onchange="filterCatalog()"
                                                   id="filter-cat-{{ $category->id }}"
                                                    {{ (request()->cats && in_array($category->id, explode(',', request()->cats))) ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="filter-cat-{{ $category->id }}">
                                                {{ $category["name_$lang"] }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="range-slider">
                            <h4 class="font-size-14 mb-3 font-weight-bold">Цена</h4>
                            <!-- Range Slider -->
                            <input class="js-range-slider" type="text"
                                   data-extra-classes="u-range-slider u-range-slider-indicator u-range-slider-grid"
                                   data-type="double"
                                   data-grid="false"
                                   data-hide-from-to="true"
                                   data-prefix="{{ RUB }}"
                                   data-min="{{ $filterPrices['min'] }}"
                                   data-max="{{ $filterPrices['max'] }}"
                                   data-from="{{ (request('price_from') && request('price_from') >= $filterPrices['min']) ? request('price_from') : $filterPrices['min'] }}"
                                   data-to="{{ (request('price_to') && request('price_to') <= $filterPrices['max']) ? request('price_to') : $filterPrices['max'] }}"
                                   data-result-min="#rangeSliderExample3MinResult"
                                   data-result-max="#rangeSliderExample3MaxResult">

                            <!-- End Range Slider -->
                            <div class="mt-1 text-gray-111 d-flex mb-4">
                                <span class="mr-0dot5">Цена: </span>
                                <span>{{ RUB }}</span>
                                <span id="rangeSliderExample3MinResult" class=""></span>
                                <span class="mx-0dot5"> — </span>
                                <span>{{ RUB }}</span>
                                <span id="rangeSliderExample3MaxResult" class=""></span>
                            </div>

                            <input type="hidden"
                                   id="price_from"
                                   value="{{ (request('price_from') && request('price_from') >= $filterPrices['min']) ? request('price_from') : $filterPrices['min'] }}">
                            <input type="hidden"
                                   id="price_to"
                                   value="{{ (request('price_to') && request('price_to') <= $filterPrices['max']) ? request('price_to') : $filterPrices['max'] }}">
                        </div>

                        @if(request('filter'))
                            <a href="{{ route('view_providers', compact('lang')) }}" class="btn btn-danger">Сбросить</a>
                        @endif
                    </div>
                @endif
            </div>
            <div class="col-xl-9 col-wd-9gdot5">
                <!-- Shop-control-bar Title -->
                <div class="d-block d-md-flex flex-center-between mb-3">
                    <h3 class="font-size-25 mb-2 mb-md-0">{{ $page_data["name_$lang"] }}</h3>
                    @if($providers->count())
                        <p class="font-size-14 text-gray-90 mb-0">
                            Показано 1–25 из {{ $providers->count() }} результатов
                        </p>
                    @endif
                </div>
                <!-- End shop-control-bar Title -->

            @if($providers->count())
                <!-- Shop-control-bar -->
                    <div class="bg-gray-1 flex-center-between borders-radius-9 py-1" style="justify-content: center">
                        <div class="d-xl-none">
                            <!-- Account Sidebar Toggle Button -->
                            <a id="sidebarNavToggler1" class="btn btn-sm py-1 font-weight-normal" href="javascript:;" role="button"
                               aria-controls="sidebarContent1"
                               aria-haspopup="true"
                               aria-expanded="false"
                               data-unfold-event="click"
                               data-unfold-hide-on-scroll="false"
                               data-unfold-target="#sidebarContent1"
                               data-unfold-type="css-animation"
                               data-unfold-animation-in="fadeInLeft"
                               data-unfold-animation-out="fadeOutLeft"
                               data-unfold-duration="500">
                                <i class="fas fa-sliders-h"></i> <span class="ml-1">Фильтры</span>
                            </a>
                            <!-- End Account Sidebar Toggle Button -->
                        </div>
                        <div class="px-3 d-none d-xl-block">
                            <ul class="nav nav-tab-shop d-none" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-one-example1-tab" data-toggle="pill" href="#pills-one-example1" role="tab" aria-controls="pills-one-example1" aria-selected="false">
                                        <div class="d-md-flex justify-content-md-center align-items-md-center">
                                            <i class="fa fa-th"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-two-example1-tab" data-toggle="pill" href="#pills-two-example1" role="tab" aria-controls="pills-two-example1" aria-selected="false">
                                        <div class="d-md-flex justify-content-md-center align-items-md-center">
                                            <i class="fa fa-align-justify"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-three-example1-tab" data-toggle="pill" href="#pills-three-example1" role="tab" aria-controls="pills-three-example1" aria-selected="true">
                                        <div class="d-md-flex justify-content-md-center align-items-md-center">
                                            <i class="fa fa-list"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-four-example1-tab" data-toggle="pill" href="#pills-four-example1" role="tab" aria-controls="pills-four-example1" aria-selected="true">
                                        <div class="d-md-flex justify-content-md-center align-items-md-center">
                                            <i class="fa fa-th-list"></i>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="d-flex">
{{--                            <form method="get">--}}
{{--                                <!-- Select -->--}}
{{--                                <select class="js-select selectpicker dropdown-select max-width-200 max-width-160-sm right-dropdown-0 px-2 px-xl-0"--}}
{{--                                        id="sort"--}}
{{--                                        onchange="filterCatalog()"--}}
{{--                                        data-style="btn-sm bg-white font-weight-normal py-2 border text-gray-20 bg-lg-down-transparent border-lg-down-0">--}}
{{--                                    <option value="default" {{ (!request('sort_by') or request('sort_by') == 'default') ? 'selected' : '' }}>Сортировка</option>--}}
{{--                                    <option value="price_asc" {{ (request('sort_by') == 'price_asc') ? 'selected' : '' }}>По цене: сначало дешевые</option>--}}
{{--                                    <option value="price_desc" {{ (request('sort_by') == 'price_desc') ? 'selected' : '' }}>По цене: сначало дорогие</option>--}}
{{--                                </select>--}}
{{--                                <!-- End Select -->--}}
{{--                            </form>--}}
                            <form method="POST" class="ml-2 d-none d-xl-block">
                                <select class="js-select selectpicker dropdown-select max-width-170"
                                        id="per_page"
                                        onchange="filterCatalog()"
                                        data-style="btn-sm bg-white font-weight-normal py-2 border text-gray-20 bg-lg-down-transparent border-lg-down-0">
                                    <option value="20" {{ (!request('per_page') or request('per_page') == 20) ? 'selected' : '' }}>Показать по 20</option>
                                    <option value="40" {{ (request('per_page') == 40) ? 'selected' : '' }}>Показать по 40</option>
                                </select>
                            </form>
                        </div>
                    </div>
            @endif
            <!-- End Shop-control-bar -->
                <!-- Shop Body -->
                <!-- Tab Content -->
                <div class="catalog-product">
                    @if($providers->count())
                        <ul class="row list-unstyled products-group no-gutters">
                            @foreach($providers as $provider)
                                <li class="col-6 col-md-3 col-wd-2gdot4 product-item js_list__item">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner px-xl-4 p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <h5 class="mb-1 product-item__title">
                                                    <a href="{{ route('view_provider', ['lang' => lang(), 'id' => $provider->id]) }}" class="text-blue font-weight-bold">{{ $provider["name"] }}</a>
                                                </h5>
                                                <div class="mb-2">
                                                    <a href="{{ route('view_provider', ['lang' => lang(), 'id' => $provider->id]) }}" class="d-block text-center">
                                                        <img class="img-fluid" src="{{ imageThumb($provider->image, 'uploads/users', 212, 200, '212X220') }}" alt="Поставщик {{ $provider["name"] }}">
                                                    </a>
                                                </div>

                                                <div class="mb-2">
                                                    @foreach($providersCats[$provider->id]->sortByDesc('countProducts')->take(4) as $provider_cat)
                                                        <a href="{{ route('view_catalog', ['lang' => $lang, 'url' => $provider_cat['category_data']['url'], 'providers' => $provider->id]) }}"
                                                           class="font-size-12 text-gray-5 d-block"
                                                           style="width: 100%">
                                                            <i class="fa fa-angle-right"></i> {{ $provider_cat['category_data']["name_$lang"] }}
                                                        </a>
                                                    @endforeach
                                                </div>

{{--                                                <div class="product-item__footer">--}}
{{--                                                    <div class="border-top pt-2 flex-center-between flex-wrap">--}}
{{--                                                        <a href="javascript:;"--}}
{{--                                                           class="text-gray-6 font-size-13"--}}
{{--                                                           onclick="return false;">--}}
{{--                                                            <i class="ec ec-compare font-size-15"></i> Сравнить--}}
{{--                                                        </a>--}}
{{--                                                        <a href="javascript:;"--}}
{{--                                                           class="text-gray-6 font-size-13"--}}
{{--                                                           onclick="return false;">--}}
{{--                                                            <i class="ec ec-favorites font-size-15"></i> В закладки--}}
{{--                                                        </a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="alert alert-warning" style="margin-top: 50px">
                            Нет товаров
                        </div>
                    @endif
                </div>
                <!-- End Tab Content -->
                <!-- End Shop Body -->
                <!-- Shop Pagination -->
                <nav class="d-md-flex justify-content-center align-items-center border-top pt-3" aria-label="Page navigation example">
                    {{ $providers->appends(request()->query())->links() }}
                </nav>
                <!-- End Shop Pagination -->
            </div>
        </div>
        <!-- Brand Carousel -->

        @if($brands->count())
            <div class="mb-6">
                @include('public/blocks/brands')
            </div>
        @endif
    <!-- End Brand Carousel -->
    </div>

    <script>
        function filterCatalog() {
            olink='{{ route('view_providers', compact('lang')) }}/';
            const page       = $('#page').val();
            //const sort       = $('#sort').val();
            const per_page   = $('#per_page').val();
            const price_from = $('#price_from').val();
            const price_to   = $('#price_to').val();

            cats='';
            pluser='';
            $.each($('input.cats-input'),function() {
                if ($(this).is(':checked')) {
                    cats+=pluser+$(this).val();
                    pluser=',';
                }
            });


            flt='?filter=1';
            if (cats!='') flt+=`&cats=${cats}`;
           // if (sort) flt+= `&sort_by=${sort}`;
            if (per_page) flt+= `&per_page=${per_page}`;
            if (page) flt+= `&page=${page}`;
            if (price_from) flt+= `&price_from=${price_from}`;
            if (price_to) flt+= `&price_to=${price_to}`;

            window.location.href = `${olink}/${flt}`;
        }
    </script>
@stop