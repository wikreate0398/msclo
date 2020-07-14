@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row mb-8">
            <div class="d-none d-xl-block col-xl-3 col-wd-2gdot5">
                <div class="mb-8 border border-width-2 border-color-3 borders-radius-6">
                    <!-- List -->
                    <!-- List -->
                        <ul id="sidebarNav" class="list-unstyled mb-0 sidebar-navbar">
                            <li>
                                <a class="dropdown-toggle dropdown-toggle-collapse dropdown-title" href="javascript:;" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="sidebarNav1Collapse" data-target="#sidebarNav1Collapse">
                                    Все категории
                                </a>

                                <div id="sidebarNav1Collapse" class="collapse" data-parent="#sidebarNav">
                                    <ul id="sidebarNav1" class="list-unstyled dropdown-list">
                                        <!-- Menu List -->
                                        @foreach(map_tree($categories->toArray()) as $cat)
                                            <li>
                                                <a class="dropdown-item" href="{{ setUri("catalog/{$cat['url']}") }}">
                                                    {{ $cat["name_$lang"] }}
{{--                                                    <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>--}}
                                                </a>
                                            </li>
                                        @endforeach
                                        <!-- End Menu List -->
                                    </ul>
                                </div>
                            </li>
                            @if($moreCats->count())
                                <li>

                                    <a class="dropdown-current active" href="javascript:;">
                                        @if($category->childs->count())
                                            {{ $category["name_$lang"] }}
                                        @else
                                            Другие категории
                                        @endif
{{--                                            <span class="text-gray-25 font-size-12 font-weight-normal"> (50)</span>--}}
                                    </a>

                                    <ul class="list-unstyled dropdown-list">
                                        @foreach($moreCats as $cat)
                                            <li>
                                                <a class="dropdown-item {{ (uri(3) == $cat->url) ? 'active' : '' }}"
                                                   href="{{ setUri("catalog/{$cat->url}") }}">
                                                    {{ $cat["name_$lang"] }}
                                                    @if($cat->products_count)
                                                        <span class="text-gray-25 font-size-12 font-weight-normal"> ({{ $cat->products_count }})</span>
                                                    @endif
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    <!-- End List -->
                </div>

                @if($catalog->count())
                    <div class="mb-6">
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Фильтр</h3>
                        </div>

                        <input type="hidden" id="page" id="page_num" value="{{ request('page') ?: 1 }}">
                        <input type="hidden" id="cat" value="{{ uri(3) }}">

                        @foreach($filters as $char)
                            @if($char->childs->count())
                                <div class="border-bottom pb-4 mb-4">
                                    <h4 class="font-size-14 mb-3 font-weight-bold">{{ $char["name_$lang"] }}</h4>

                                    @foreach($char->childs as $child)
                                        @if($child->values_products_count)
                                            <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="{{ $char->type }}"
                                                           name="char[{{ $char->type }}][{{ $char->id }}][]"
                                                           value="{{ $child->id }}"
                                                           class="custom-control-input filter-input"
                                                           onchange="filterCatalog()"
                                                           id="filter-{{ $child->id }}"
                                                           {{ (request()->params && in_array($child->id, explode(',', request()->params))) ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="filter-{{ $child->id }}">
                                                        {{ $child->name_ru }}
                                                        <span class="text-gray-25 font-size-12 font-weight-normal">
                                                            ({{ $child->values_products_count }})
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        @endforeach

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
                            <a href="{{ setUri("catalog/{$category->url}") }}" class="btn btn-danger">Сбросить</a>
                        @endif
                    </div>
                @endif
{{--                <div class="mb-8">--}}
{{--                    <div class="border-bottom border-color-1 mb-5">--}}
{{--                        <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Latest Products</h3>--}}
{{--                    </div>--}}
{{--                    <ul class="list-unstyled">--}}
{{--                        <li class="mb-4">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-auto">--}}
{{--                                    <a href="../shop/single-product-fullwidth.html" class="d-block width-75">--}}
{{--                                        <img class="img-fluid" src="/img/300X300/img1.jpg" alt="Image Description">--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <div class="col">--}}
{{--                                    <h3 class="text-lh-1dot2 font-size-14 mb-0"><a href="../shop/single-product-fullwidth.html">Notebook Black Spire V Nitro VN7-591G</a></h3>--}}
{{--                                    <div class="text-warning text-ls-n2 font-size-16 mb-1" style="width: 80px;">--}}
{{--                                        <small class="fas fa-star"></small>--}}
{{--                                        <small class="fas fa-star"></small>--}}
{{--                                        <small class="fas fa-star"></small>--}}
{{--                                        <small class="fas fa-star"></small>--}}
{{--                                        <small class="far fa-star text-muted"></small>--}}
{{--                                    </div>--}}
{{--                                    <div class="font-weight-bold">--}}
{{--                                        <del class="font-size-11 text-gray-9 d-block">$2299.00</del>--}}
{{--                                        <ins class="font-size-15 text-red text-decoration-none d-block">$1999.00</ins>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                        <li class="mb-4">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-auto">--}}
{{--                                    <a href="../shop/single-product-fullwidth.html" class="d-block width-75">--}}
{{--                                        <img class="img-fluid" src="/img/300X300/img3.jpg" alt="Image Description">--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <div class="col">--}}
{{--                                    <h3 class="text-lh-1dot2 font-size-14 mb-0"><a href="../shop/single-product-fullwidth.html">Notebook Black Spire V Nitro VN7-591G</a></h3>--}}
{{--                                    <div class="text-warning text-ls-n2 font-size-16 mb-1" style="width: 80px;">--}}
{{--                                        <small class="fas fa-star"></small>--}}
{{--                                        <small class="fas fa-star"></small>--}}
{{--                                        <small class="fas fa-star"></small>--}}
{{--                                        <small class="fas fa-star"></small>--}}
{{--                                        <small class="far fa-star text-muted"></small>--}}
{{--                                    </div>--}}
{{--                                    <div class="font-weight-bold font-size-15">--}}
{{--                                        $499.00--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                        <li class="mb-4">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-auto">--}}
{{--                                    <a href="../shop/single-product-fullwidth.html" class="d-block width-75">--}}
{{--                                        <img class="img-fluid" src="/img/300X300/img5.jpg" alt="Image Description">--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <div class="col">--}}
{{--                                    <h3 class="text-lh-1dot2 font-size-14 mb-0"><a href="../shop/single-product-fullwidth.html">Tablet Thin EliteBook Revolve 810 G6</a></h3>--}}
{{--                                    <div class="text-warning text-ls-n2 font-size-16 mb-1" style="width: 80px;">--}}
{{--                                        <small class="fas fa-star"></small>--}}
{{--                                        <small class="fas fa-star"></small>--}}
{{--                                        <small class="fas fa-star"></small>--}}
{{--                                        <small class="fas fa-star"></small>--}}
{{--                                        <small class="far fa-star text-muted"></small>--}}
{{--                                    </div>--}}
{{--                                    <div class="font-weight-bold font-size-15">--}}
{{--                                        $100.00--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                        <li class="mb-4">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-auto">--}}
{{--                                    <a href="../shop/single-product-fullwidth.html" class="d-block width-75">--}}
{{--                                        <img class="img-fluid" src="/img/300X300/img6.jpg" alt="Image Description">--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <div class="col">--}}
{{--                                    <h3 class="text-lh-1dot2 font-size-14 mb-0"><a href="../shop/single-product-fullwidth.html">Notebook Purple G952VX-T7008T</a></h3>--}}
{{--                                    <div class="text-warning text-ls-n2 font-size-16 mb-1" style="width: 80px;">--}}
{{--                                        <small class="fas fa-star"></small>--}}
{{--                                        <small class="fas fa-star"></small>--}}
{{--                                        <small class="fas fa-star"></small>--}}
{{--                                        <small class="fas fa-star"></small>--}}
{{--                                        <small class="far fa-star text-muted"></small>--}}
{{--                                    </div>--}}
{{--                                    <div class="font-weight-bold">--}}
{{--                                        <del class="font-size-11 text-gray-9 d-block">$2299.00</del>--}}
{{--                                        <ins class="font-size-15 text-red text-decoration-none d-block">$1999.00</ins>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                        <li class="mb-4">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-auto">--}}
{{--                                    <a href="../shop/single-product-fullwidth.html" class="d-block width-75">--}}
{{--                                        <img class="img-fluid" src="/img/300X300/img10.png" alt="Image Description">--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <div class="col">--}}
{{--                                    <h3 class="text-lh-1dot2 font-size-14 mb-0"><a href="../shop/single-product-fullwidth.html">Laptop Yoga 21 80JH0035GE W8.1</a></h3>--}}
{{--                                    <div class="text-warning text-ls-n2 font-size-16 mb-1" style="width: 80px;">--}}
{{--                                        <small class="fas fa-star"></small>--}}
{{--                                        <small class="fas fa-star"></small>--}}
{{--                                        <small class="fas fa-star"></small>--}}
{{--                                        <small class="fas fa-star"></small>--}}
{{--                                        <small class="far fa-star text-muted"></small>--}}
{{--                                    </div>--}}
{{--                                    <div class="font-weight-bold font-size-15">--}}
{{--                                        $1200.00--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
            </div>
            <div class="col-xl-9 col-wd-9gdot5">
                <!-- Shop-control-bar Title -->
                <div class="d-block d-md-flex flex-center-between mb-3">
                    <h3 class="font-size-25 mb-2 mb-md-0">{{ $category["name_$lang"] }}</h3>
                    @if($catalog->count())
                        <p class="font-size-14 text-gray-90 mb-0">
                            Показано 1–25 из {{ $catalog->count() }} результатов
                        </p>
                    @endif
                </div>
                <!-- End shop-control-bar Title -->

                @if($catalog->count())
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
                            <form method="get">
                                <!-- Select -->
                                <select class="js-select selectpicker dropdown-select max-width-200 max-width-160-sm right-dropdown-0 px-2 px-xl-0"
                                        id="sort"
                                        onchange="filterCatalog()"
                                        data-style="btn-sm bg-white font-weight-normal py-2 border text-gray-20 bg-lg-down-transparent border-lg-down-0">
                                    <option value="default" {{ (!request('sort_by') or request('sort_by') == 'default') ? 'selected' : '' }}>Сортировка</option>
                                    <option value="price_asc" {{ (request('sort_by') == 'price_asc') ? 'selected' : '' }}>По цене: сначало дешевые</option>
                                    <option value="price_desc" {{ (request('sort_by') == 'price_desc') ? 'selected' : '' }}>По цене: сначало дорогие</option>
                                </select>
                                <!-- End Select -->
                            </form>
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
                    @if($catalog->count())
                        <ul class="row list-unstyled products-group no-gutters">
                            @foreach($catalog as $item)
                                <li class="col-6 col-md-3 col-wd-2gdot4 product-item js_list__item">
                                    @include('public.catalog.blocks.product_item', ['product' => $item])
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
                    {{ $catalog->appends(request()->query())->links() }}
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
            olink='{{ setUri('catalog') }}/';
            const page       = $('#page').val();
            const cat        = $('#cat').val();
            const sort       = $('#sort').val();
            const per_page   = $('#per_page').val();
            const price_from = $('#price_from').val();
            const price_to   = $('#price_to').val();

            params='';
            pluser='';
            $.each($('input.filter-input'),function() {
                if ($(this).is(':checked')) {
                    params+=pluser+$(this).val();
                    pluser=',';
                }
            });

            flt='?filter=1';
            if (params!='') flt+=`&params=${params}`;
            if (sort) flt+= `&sort_by=${sort}`;
            if (per_page) flt+= `&per_page=${per_page}`;
            if (page) flt+= `&page=${page}`;
            if (price_from) flt+= `&price_from=${price_from}`;
            if (price_to) flt+= `&price_to=${price_to}`;

            window.location.href = `${olink}/${cat}/${flt}`;
        }
    </script>
@stop