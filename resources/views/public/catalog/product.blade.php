@extends('layouts.public')

@section('content')
<div class="container">
    <!-- Single Product Body -->
    <div class="mb-xl-14 mb-6">
        <div class="row">
            <div class="col-md-5 mb-4 mb-md-0">

                <div id="sliderSyncingNav" class="js-slick-carousel u-slick mb-2"
                     data-infinite="true"
                     data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-classic u-slick__arrow-centered--y rounded-circle"
                     data-arrow-left-classes="fas fa-arrow-left u-slick__arrow-classic-inner u-slick__arrow-classic-inner--left ml-lg-2 ml-xl-4"
                     data-arrow-right-classes="fas fa-arrow-right u-slick__arrow-classic-inner u-slick__arrow-classic-inner--right mr-lg-2 mr-xl-4"
                     data-nav-for="#sliderSyncingThumb">
                    @foreach($product->images as $image)
                        <div class="js-slide">
                            <img class="img-fluid" src="{{ imageThumb($image->image, 'uploads/products', 720, 660, '720X660') }}" style="width: 100%" alt="">
                        </div>
                    @endforeach
                </div>

                @if($product->images->count() > 1)
                    <div id="sliderSyncingThumb" class="js-slick-carousel u-slick u-slick--slider-syncing u-slick--slider-syncing-size u-slick--gutters-1 u-slick--transform-off"
                         data-infinite="true"
                         data-slides-show="5"
                         data-is-thumbs="true"
                         data-nav-for="#sliderSyncingNav">
                        @foreach($product->images as $image)
                            <div class="js-slide">
                                <img class="img-fluid" src="{{ imageThumb($image->image, 'uploads/products', 720, 660, '720X660') }}" style="width: 100%" alt="">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="col-md-7 mb-md-6 mb-lg-0">
                <div class="mb-2">
                    <div class="border-bottom mb-3 pb-md-1 pb-3">
                        <a href="{{ setUri("catalog/{$product->category->url}") }}" class="font-size-12 text-gray-5 mb-2 d-inline-block">
                            {{ $product->category["name_$lang"] }}
                        </a>
                        <h2 class="font-size-25 text-lh-1dot2">{{ $product["name_$lang"] }}</h2>
{{--                        <div class="mb-2">--}}
{{--                            <a class="d-inline-flex align-items-center small font-size-15 text-lh-1" href="#">--}}
{{--                                <div class="text-warning mr-2">--}}
{{--                                    <small class="fas fa-star"></small>--}}
{{--                                    <small class="fas fa-star"></small>--}}
{{--                                    <small class="fas fa-star"></small>--}}
{{--                                    <small class="fas fa-star"></small>--}}
{{--                                    <small class="far fa-star text-muted"></small>--}}
{{--                                </div>--}}
{{--                                <span class="text-secondary font-size-13">(3 customer reviews)</span>--}}
{{--                            </a>--}}
{{--                        </div>--}}
                        <div class="d-md-flex align-items-center">
{{--                            <a href="#" class="max-width-150 ml-n2 mb-2 mb-md-0 d-block"><img class="img-fluid" src="/img/200X60/img1.png" alt="Image Description"></a>--}}
                            <div class="mml-md-3 text-gray-9 font-size-14">
                                @if($product->prices->count())
                                    В наличии:
                                    <span class="text-green font-weight-bold">{{ $product->prices->max('quantity') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex-horizontal-center flex-wrap mb-4">
                        <a href="javascript:;"
                           class="text-gray-6 compare-icon compare-icon-{{ $product->id }} font-size-13 mr-2 {{ sessArray('compare')->exist($product->id) ? 'active' : '' }}"
                           onclick="addToCompare(this, {{ $product->id }}); return false;">
                            <i class="ec ec-compare font-size-15"></i> Сравнить
                        </a>
                        <a href="javascript:;"
                           class="text-gray-6 fav-icon fav-icon-{{ $product->id }} font-size-13 mr-2 {{ sessArray('favorites')->exist($product->id) ? 'active' : '' }}"
                           onclick="addToFav(this, {{ $product->id }}); return false;">
                            <i class="ec ec-favorites font-size-15"></i> Избранное
                        </a>
                    </div>
{{--                    <div class="mb-2">--}}
{{--                        <ul class="font-size-14 pl-3 ml-1 text-gray-110">--}}
{{--                            <li>4.5 inch HD Touch Screen (1280 x 720)</li>--}}
{{--                            <li>Android 4.4 KitKat OS</li>--}}
{{--                            <li>1.4 GHz Quad Core™ Processor</li>--}}
{{--                            <li>20 MP Electro and 28 megapixel CMOS rear camera</li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
                    <p>{{ $product["description_$lang"] }}</p>
                    @if($product["code"])
                        <p class="mb-2"><strong>Код</strong>: {{ $product["code"] }}</p>
                    @endif
                    @if(isset($product->provider))
                        <p class="mb-2"><strong>Поставщик</strong>: <a href="{{ route('view_provider', ['lang' => $lang, 'id' => $product->id_provider]) }}">{{ $product->provider->name }}</a></p>
                    @endif
                    <form action="{{ route('add_to_cart', ['lang' => $lang]) }}"
                          onsubmit="addToCart(this); return false;"
                          class="add-cart-form">

                        <div class="mb-4">
                            <div class="d-flex align-items-baseline">
                                @php
                                    $price        = $product->prices->sortBy('quantity')->first()['price'];
                                    $minPriceData = $product->prices->sortBy('price')->first();
                                @endphp
                                <ins class="font-size-36 text-decoration-none">
                                    {{ RUB }}
                                    <span class="product-price-{{ $product->id }}">
                                        {{ priceString($price) }}
                                    </span>
                                </ins>
    {{--                            <del class="font-size-20 ml-2 text-gray-6">$2,299.00</del>--}}
                            </div>
                            @if($price > $minPriceData->price)
                                <span class="font-size-16 text-gray-6">
                                    от {{ $minPriceData->quantity }}шт -
                                    {{ RUB }}
                                    {{ priceString($minPriceData->price) }}
                                </span>
                            @endif
                        </div>


                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <div class="border-top border-bottom py-3 mb-4 d-flex">
                            @foreach($charsCart as $item)
                                @if($item['value']->count())
                                    <div class="d-flex align-items-center" style="margin-right: 15px;">
                                        <h6 class="font-size-14 mb-0">{{ $item['name'] }} <span class="text-danger">*</span></h6>
                                        <!-- Select -->
                                        <select class="js-select selectpicker dropdown-select ml-3"
                                                data-style="btn-sm bg-white font-weight-normal py-2 border"
                                                name="char[{{ $item['id'] }}]">
                                            <option value="0">Выбрать</option>
                                            @foreach($item['value'] as $value)
                                                <option {{ ($item['value']->count() == 1) ? 'selected' : '' }} value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                                            @endforeach
                                        </select>
                                        <!-- End Select -->
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <div class="d-md-flex align-items-end mb-3">
                            <div class="max-width-150 mb-4 mb-md-0">
                                <h6 class="font-size-14">Кол-во</h6>
                                <!-- Quantity -->
                                <div class="border rounded-pill py-2 px-3 border-color-1">
                                    <div class="js-quantity row align-items-center">
                                        <div class="col">
                                            <input class="js-result bg-white form-control h-auto border-0 rounded p-0 shadow-none"
                                                   type="text"
                                                   onkeyup="this.value=this.value.replace(/[^\d]/,'')"
                                                   value="1"
                                                   name="qty"
                                                   onchange="changePriceByQty(this, {{ $product->id }})">
                                        </div>
                                        <div class="col-auto pr-1">
                                            <a class="btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0"
                                               href="javascript:;"
                                               id="dec"
                                               >
                                                <small class="fas fa-minus btn-icon__inner"></small>
                                            </a>
                                            <a class="btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0"
                                               href="javascript:;"
                                               id="inc"
                                               >
                                                <small class="fas fa-plus btn-icon__inner"></small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Quantity -->
                            </div>
                            <div class="ml-md-3">
                                <a href="javascript:;"
                                   class="btn px-5 btn-primary-dark transition-3d-hover"
                                   onclick="$(this).closest('form').submit();">
                                    <i class="ec ec-add-to-cart mr-2 font-size-20"></i> В корзину
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Single Product Body -->
    <!-- Single Product Tab -->
    <script>
        $(document).ready(function () {
            $('.nav-classic li:first a').click();
        });
    </script>

    @if($product["text_$lang"] || $chars->count())
        <div class="mb-8">
            <div class="position-relative position-md-static px-md-6">
                <ul class="nav nav-classic nav-tab nav-tab-lg justify-content-xl-center flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble border-0 pb-1 pb-xl-0 mb-n1 mb-xl-0" id="pills-tab-8" role="tablist">

                    @if($product["text_$lang"])
                        <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                            <a class="nav-link active" id="Jpills-two-example1-tab" data-toggle="pill" href="#Jpills-two-example1" role="tab" aria-controls="Jpills-two-example1" aria-selected="true">Описание</a>
                        </li>
                    @endif

                    @if($chars->count())
                        <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                            <a class="nav-link" id="Jpills-three-example1-tab" data-toggle="pill" href="#Jpills-three-example1" role="tab" aria-controls="Jpills-three-example1" aria-selected="false">Характеристики</a>
                        </li>
                    @endif
    {{--                <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">--}}
    {{--                    <a class="nav-link" id="Jpills-four-example1-tab" data-toggle="pill" href="#Jpills-four-example1" role="tab" aria-controls="Jpills-four-example1" aria-selected="false">Отзывы</a>--}}
    {{--                </li>--}}
                </ul>
            </div>
            <!-- Tab Content -->
            <div class="borders-radius-17 border p-4 mt-4 mt-md-0 px-lg-10 py-lg-9">
                <div class="tab-content" id="Jpills-tabContent">

                    <div class="tab-pane fade active show" id="Jpills-two-example1" role="tabpanel" aria-labelledby="Jpills-two-example1-tab">
                        {!! $product["text_$lang"] !!}
                    </div>
                    <div class="tab-pane fade" id="Jpills-three-example1" role="tabpanel" aria-labelledby="Jpills-three-example1-tab">
                        <div class="mx-md-5 pt-1">
                            <div class="table-responsive mb-4">
                                <table class="table table-hover">
                                    <tbody>
                                        @foreach($chars as $key => $char)
                                            <tr>
                                                <th class="px-4 px-xl-5 {{ !$key ? 'border-top-0' : '' }}">{{ $char['name'] }}</th>
                                                <td class="{{ !$key ? 'border-top-0' : '' }}">
                                                    {{ ($char['type'] == 'input') ? $char['value'] : $char['value']->pluck('name')->implode(', ') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="Jpills-four-example1" role="tabpanel" aria-labelledby="Jpills-four-example1-tab">
                        <div class="row mb-8">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <h3 class="font-size-18 mb-6">Based on 3 reviews</h3>
                                    <h2 class="font-size-30 font-weight-bold text-lh-1 mb-0">4.3</h2>
                                    <div class="text-lh-1">overall</div>
                                </div>

                                <!-- Ratings -->
                                <ul class="list-unstyled">
                                    <li class="py-1">
                                        <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                            <div class="col-auto mb-2 mb-md-0">
                                                <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                    <small class="fas fa-star"></small>
                                                    <small class="fas fa-star"></small>
                                                    <small class="fas fa-star"></small>
                                                    <small class="fas fa-star"></small>
                                                    <small class="far fa-star text-muted"></small>
                                                </div>
                                            </div>
                                            <div class="col-auto mb-2 mb-md-0">
                                                <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-auto text-right">
                                                <span class="text-gray-90">205</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="py-1">
                                        <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                            <div class="col-auto mb-2 mb-md-0">
                                                <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                    <small class="fas fa-star"></small>
                                                    <small class="fas fa-star"></small>
                                                    <small class="fas fa-star"></small>
                                                    <small class="far fa-star text-muted"></small>
                                                    <small class="far fa-star text-muted"></small>
                                                </div>
                                            </div>
                                            <div class="col-auto mb-2 mb-md-0">
                                                <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 53%;" aria-valuenow="53" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-auto text-right">
                                                <span class="text-gray-90">55</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="py-1">
                                        <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                            <div class="col-auto mb-2 mb-md-0">
                                                <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                    <small class="fas fa-star"></small>
                                                    <small class="fas fa-star"></small>
                                                    <small class="far fa-star text-muted"></small>
                                                    <small class="far fa-star text-muted"></small>
                                                    <small class="far fa-star text-muted"></small>
                                                </div>
                                            </div>
                                            <div class="col-auto mb-2 mb-md-0">
                                                <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-auto text-right">
                                                <span class="text-gray-90">23</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="py-1">
                                        <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                            <div class="col-auto mb-2 mb-md-0">
                                                <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                    <small class="fas fa-star"></small>
                                                    <small class="far fa-star text-muted"></small>
                                                    <small class="far fa-star text-muted"></small>
                                                    <small class="far fa-star text-muted"></small>
                                                    <small class="far fa-star text-muted"></small>
                                                </div>
                                            </div>
                                            <div class="col-auto mb-2 mb-md-0">
                                                <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-auto text-right">
                                                <span class="text-muted">0</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="py-1">
                                        <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                            <div class="col-auto mb-2 mb-md-0">
                                                <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                    <small class="fas fa-star"></small>
                                                    <small class="far fa-star text-muted"></small>
                                                    <small class="far fa-star text-muted"></small>
                                                    <small class="far fa-star text-muted"></small>
                                                    <small class="far fa-star text-muted"></small>
                                                </div>
                                            </div>
                                            <div class="col-auto mb-2 mb-md-0">
                                                <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 1%;" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-auto text-right">
                                                <span class="text-gray-90">4</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                                <!-- End Ratings -->
                            </div>
                            <div class="col-md-6">
                                <h3 class="font-size-18 mb-5">Add a review</h3>
                                <!-- Form -->
                                <form class="js-validate">
                                    <div class="row align-items-center mb-4">
                                        <div class="col-md-4 col-lg-3">
                                            <label for="rating" class="form-label mb-0">Your Review</label>
                                        </div>
                                        <div class="col-md-8 col-lg-9">
                                            <a href="#" class="d-block">
                                                <div class="text-warning text-ls-n2 font-size-16">
                                                    <small class="far fa-star text-muted"></small>
                                                    <small class="far fa-star text-muted"></small>
                                                    <small class="far fa-star text-muted"></small>
                                                    <small class="far fa-star text-muted"></small>
                                                    <small class="far fa-star text-muted"></small>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="js-form-message form-group mb-3 row">
                                        <div class="col-md-4 col-lg-3">
                                            <label for="descriptionTextarea" class="form-label">Your Review</label>
                                        </div>
                                        <div class="col-md-8 col-lg-9">
                                                        <textarea class="form-control" rows="3" id="descriptionTextarea"
                                                                  data-msg="Please enter your message."
                                                                  data-error-class="u-has-error"
                                                                  data-success-class="u-has-success"></textarea>
                                        </div>
                                    </div>
                                    <div class="js-form-message form-group mb-3 row">
                                        <div class="col-md-4 col-lg-3">
                                            <label for="inputName" class="form-label">Name <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" class="form-control" name="name" id="inputName" aria-label="Alex Hecker" required
                                                   data-msg="Please enter your name."
                                                   data-error-class="u-has-error"
                                                   data-success-class="u-has-success">
                                        </div>
                                    </div>
                                    <div class="js-form-message form-group mb-3 row">
                                        <div class="col-md-4 col-lg-3">
                                            <label for="emailAddress" class="form-label">Email <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="email" class="form-control" name="emailAddress" id="emailAddress" aria-label="alexhecker@pixeel.com" required
                                                   data-msg="Please enter a valid email address."
                                                   data-error-class="u-has-error"
                                                   data-success-class="u-has-success">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="offset-md-4 offset-lg-3 col-auto">
                                            <button type="submit" class="btn btn-primary-dark btn-wide transition-3d-hover submit-btn">Add Review</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- End Form -->
                            </div>
                        </div>
                        <!-- Review -->
                        <div class="border-bottom border-color-1 pb-4 mb-4">
                            <!-- Review Rating -->
                            <div class="d-flex justify-content-between align-items-center text-secondary font-size-1 mb-2">
                                <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                    <small class="fas fa-star"></small>
                                    <small class="fas fa-star"></small>
                                    <small class="fas fa-star"></small>
                                    <small class="far fa-star text-muted"></small>
                                    <small class="far fa-star text-muted"></small>
                                </div>
                            </div>
                            <!-- End Review Rating -->

                            <p class="text-gray-90">Fusce vitae nibh mi. Integer posuere, libero et ullamcorper facilisis, enim eros tincidunt orci, eget vestibulum sapien nisi ut leo. Cras finibus vel est ut mollis. Donec luctus condimentum ante et euismod.</p>

                            <!-- Reviewer -->
                            <div class="mb-2">
                                <strong>John Doe</strong>
                                <span class="font-size-13 text-gray-23">- April 3, 2019</span>
                            </div>
                            <!-- End Reviewer -->
                        </div>
                        <!-- End Review -->
                        <!-- Review -->
                        <div class="border-bottom border-color-1 pb-4 mb-4">
                            <!-- Review Rating -->
                            <div class="d-flex justify-content-between align-items-center text-secondary font-size-1 mb-2">
                                <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                    <small class="fas fa-star"></small>
                                    <small class="fas fa-star"></small>
                                    <small class="fas fa-star"></small>
                                    <small class="fas fa-star"></small>
                                    <small class="fas fa-star"></small>
                                </div>
                            </div>
                            <!-- End Review Rating -->

                            <p class="text-gray-90">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse eget facilisis odio. Duis sodales augue eu tincidunt faucibus. Etiam justo ligula, placerat ac augue id, volutpat porta dui.</p>

                            <!-- Reviewer -->
                            <div class="mb-2">
                                <strong>Anna Kowalsky</strong>
                                <span class="font-size-13 text-gray-23">- April 3, 2019</span>
                            </div>
                            <!-- End Reviewer -->
                        </div>
                        <!-- End Review -->
                        <!-- Review -->
                        <div class="pb-4">
                            <!-- Review Rating -->
                            <div class="d-flex justify-content-between align-items-center text-secondary font-size-1 mb-2">
                                <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                    <small class="fas fa-star"></small>
                                    <small class="fas fa-star"></small>
                                    <small class="fas fa-star"></small>
                                    <small class="fas fa-star"></small>
                                    <small class="far fa-star text-muted"></small>
                                </div>
                            </div>
                            <!-- End Review Rating -->

                            <p class="text-gray-90">Sed id tincidunt sapien. Pellentesque cursus accumsan tellus, nec ultricies nulla sollicitudin eget. Donec feugiat orci vestibulum porttitor sagittis.</p>

                            <!-- Reviewer -->
                            <div class="mb-2">
                                <strong>Peter Wargner</strong>
                                <span class="font-size-13 text-gray-23">- April 3, 2019</span>
                            </div>
                            <!-- End Reviewer -->
                        </div>
                        <!-- End Review -->
                    </div>
                </div>
            </div>
            <!-- End Tab Content -->
        </div>
    @endif
    <!-- End Single Product Tab -->

    @if($sameProducts->count())
        <div class="mb-6">
            <div class="d-flex justify-content-between align-items-center border-bottom border-color-1 flex-lg-nowrap flex-wrap mb-4">
                <h3 class="section-title mb-0 pb-2 font-size-22">Похожие товары товары</h3>
            </div>
            <ul class="row list-unstyled products-group products-list no-gutters">
                @foreach($sameProducts as $item)
                    <li class="col-6 col-md-3 col-xl-2gdot4-only col-wd-2 product-item js_list__item">
                        @include('public.catalog.blocks.product_item', ['product' => $item])
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

@if($brands->count())
        <div class="mb-8">
            @include('public/blocks/brands')
        </div>
    @endif
</div>
@stop