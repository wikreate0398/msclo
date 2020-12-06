@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row mb-8">
            <div class="d-none d-xl-block col-xl-3 col-wd-2gdot5">
                <div class="mb-8 border border-width-2 border-color-3 borders-radius-6">
                        <ul id="sidebarNav" class="list-unstyled mb-0 sidebar-navbar">
                            <li>
                                <a class="dropdown-toggle dropdown-toggle-collapse dropdown-title collapsed" href="javascript:;" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="sidebarNav1Collapse" data-target="#sidebarNav1Collapse">
                                    Все категории
                                </a>

                                <div id="sidebarNav1Collapse" class="collapse show" data-parent="#sidebarNav">
                                    <ul id="sidebarNav1" class="list-unstyled dropdown-list">
                                        @foreach(map_tree($categories->toArray()) as $cat)
                                            <li>
                                                <a class="dropdown-item" href="{{ setUri("catalog/{$cat['url']}") }}">
                                                    {{ $cat["name_$lang"] }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                            @if(!empty($moreCats) && $moreCats->count())
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
                </div>

                <input type="hidden" id="page" id="page_num" value="{{ request('page') ?: 1 }}">
                {{-- <input type="hidden" id="cat" value="{{ uri(3) }}"> --}}
                <input type="hidden" id="query" value="{{ request('query') }}">

                @if(!empty($filters) && $filters->count() or (!empty($filterPrices) && $filterPrices['min'] && $filterPrices['max'] && $filterPrices['min'] != $filterPrices['max']))
                    <div class="mb-6">
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Фильтр</h3>
                        </div>
                        @if($providers->count() > 1)
                            <div class="border-bottom pb-4 mb-4">
                                <h4 class="font-size-14 mb-3 font-weight-bold">Поставщики</h4>

                                @foreach($providers as $provider)
                                    <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox"
                                                   value="{{ $provider->id }}"
                                                   class="custom-control-input provider-input"
                                                   onchange="filterCatalog()"
                                                   id="filter-provider-{{ $provider->id }}"
                                                    {{ (request()->providers && in_array($provider->id, explode(',', request()->providers))) ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="filter-provider-{{ $provider->id }}">
                                                {{ $provider->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

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

                        @if($filterPrices['min'] && $filterPrices['max'] && $filterPrices['min'] != $filterPrices['max'])
                            <div class="range-slider">
                                <h4 class="font-size-14 mb-3 font-weight-bold">Цена</h4>
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
                        @endif

                        @if(request('filter'))
                            <a href="{{ setUri("catalog/") }}" class="btn btn-danger">Сбросить</a>
                        @endif
                    </div>
                @endif
            </div>
            <div class="col-xl-9 col-wd-9gdot5">
                <div class="d-block d-md-flex flex-center-between mb-3">
                    <h3 class="font-size-25 mb-2 mb-md-0">Каталог товаров</h3>
                    @if($catalog->count())
                        <p class="font-size-14 text-gray-90 mb-0">
                            Показано 1–25 из {{ $catalog->count() }} результатов
                        </p>
                    @endif
                </div>

                @if($catalog->count())
                    <div class="bg-gray-1 flex-center-between borders-radius-9 py-1" style="justify-content: center">
                        <div class="d-xl-none">
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
                                <select class="js-select selectpicker dropdown-select max-width-200 max-width-160-sm right-dropdown-0 px-2 px-xl-0"
                                        id="sort"
                                        onchange="filterCatalog()"
                                        data-style="btn-sm bg-white font-weight-normal py-2 border text-gray-20 bg-lg-down-transparent border-lg-down-0">
                                    <option value="default" {{ (!request('sort_by') or request('sort_by') == 'default') ? 'selected' : '' }}>Сортировка</option>
                                    <option value="price_asc" {{ (request('sort_by') == 'price_asc') ? 'selected' : '' }}>По цене: сначало дешевые</option>
                                    <option value="price_desc" {{ (request('sort_by') == 'price_desc') ? 'selected' : '' }}>По цене: сначало дорогие</option>
                                </select>
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
                <div class="catalog-product">
                    @if($catalog->count())
                        <ul class="row list-unstyled products-group no-gutters">
                            @foreach($catalog as $item)
                                <li class="col-6 col-md-3 col-wd-2gdot4 product-item">
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

                <nav class="d-md-flex justify-content-center align-items-center border-top pt-3" aria-label="Page navigation example">
                    {{ $catalog->appends(request()->query())->links() }}
                </nav>
            </div>
        </div>

        @if($brands->count())
            <div class="mb-6">
                @include('public/blocks/brands')
            </div>
        @endif
        <script>
            function filterCatalog() {
                olink='{{ setUri('catalog') }}/';
                const page       = $('#page').val();
                //const cat        = $('#cat').val();
                const sort       = $('#sort').val();
                const query      = $('#query').val();
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

                providers='';
                pluser='';
                $.each($('input.provider-input'),function() {
                    if ($(this).is(':checked')) {
                        providers+=pluser+$(this).val();
                        pluser=',';
                    }
                });

                flt='?filter=1';
                if (params!='') flt+=`&params=${params}`;
                if (providers!='') flt+=`&providers=${providers}`;
                if (query != '') flt += `&query=${query}`;
                if (sort) flt+= `&sort_by=${sort}`;
                if (per_page) flt+= `&per_page=${per_page}`;
                if (page) flt+= `&page=${page}`;
                if (price_from) flt+= `&price_from=${price_from}`;
                if (price_to) flt+= `&price_to=${price_to}`;

                window.location.href = `${olink}/${flt}`;
            }
        </script>
    </div>
@stop