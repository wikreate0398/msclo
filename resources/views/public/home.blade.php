@extends('layouts.public')

@section('content')
    <!-- Slider Section -->

    <?php //exit(print_arr($page_data)) ?>

    <div class="mb-5">
        <div class="bg-img-hero" style="background-image: url(/img/1920X422/img1.jpg);">
            <div class="min-height-420 overflow-hidden">
                <div class="js-slick-carousel u-slick"
                     data-pagi-classes="text-center position-absolute right-0 bottom-0 left-0 u-slick__pagination u-slick__pagination--long mb-3 mb-md-4 pl-2 pb-1">

                    @foreach($sliders as $key => $slider)
                        <div class="js-slide bg-img-hero-center"
                             style="background-image: url('/uploads/slider/{{ $slider->image }}')"
                                {{ $key ? 'data-animation-delay="0"' : '' }}>
                            <div class="container">
                                <div class="row min-height-420 py-7 py-md-0">

                                    @if($slider->product)
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
                                                    <sup class="">{{ RUB }}</sup>{{ $slider->product->price }}
                                                </div>
                                            </div>
                                            <a href="{{ setUri("product/{$slider->product->url}") }}" class="btn btn-primary transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16"
                                               data-scs-animation-in="fadeInUp"
                                               data-scs-animation-delay="400">
                                                Перейти
                                            </a>
                                        </div>

                                        <div class="col-xl-5 col-6  d-flex align-items-center"
                                             data-scs-animation-in="zoomIn"
                                             data-scs-animation-delay="500">
                                            <img class="img-fluid" src="{{ imageThumb($slider->product->image, 'uploads/slider', 416, 420, 1) }}" alt="">
                                        </div>
                                    @endif
                                </div>
                            </div>
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
        <div class="mb-5">
            <div class="row">
                <!-- Deal -->
                <div class="col-md-auto mb-6 mb-md-0">
                    <div class="p-3 border border-width-2 border-primary borders-radius-20 bg-white min-width-370">
                        <div class="d-flex justify-content-between align-items-center m-1 ml-2">
                            <h3 class="font-size-22 mb-0 font-weight-normal text-lh-28 max-width-120">Special Offer</h3>
                            <div class="d-flex align-items-center flex-column justify-content-center bg-primary rounded-pill height-75 width-75 text-lh-1">
                                <span class="font-size-12">Save</span>
                                <div class="font-size-20 font-weight-bold">$120</div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/320X300/img1.jpg" alt="Image Description"></a>
                        </div>
                        <h5 class="mb-2 font-size-14 text-center mx-auto max-width-180 text-lh-18"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Game Console Controller + USB 3.0 Cable</a></h5>
                        <div class="d-flex align-items-center justify-content-center mb-3">
                            <del class="font-size-18 mr-2 text-gray-2">$99,00</del>
                            <ins class="font-size-30 text-red text-decoration-none">$79,00</ins>
                        </div>
                        <div class="mb-3 mx-2">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="">Availavle: <strong>6</strong></span>
                                <span class="">Already Sold: <strong>28</strong></span>
                            </div>
                            <div class="rounded-pill bg-gray-3 height-20 position-relative">
                                <span class="position-absolute left-0 top-0 bottom-0 rounded-pill w-30 bg-primary"></span>
                            </div>
                        </div>
                        <div class="mb-2">
                            <h6 class="font-size-15 text-gray-2 text-center mb-3">Hurry Up! Offer ends in:</h6>
                            <div class="js-countdown d-flex justify-content-center"
                                 data-end-date="2020/11/30"
                                 data-hours-format="%H"
                                 data-minutes-format="%M"
                                 data-seconds-format="%S">
                                <div class="text-lh-1">
                                    <div class="text-gray-2 font-size-30 bg-gray-4 py-2 px-2 rounded-sm mb-2">
                                        <span class="js-cd-hours"></span>
                                    </div>
                                    <div class="text-gray-2 font-size-12 text-center">HOURS</div>
                                </div>
                                <div class="mx-1 pt-1 text-gray-2 font-size-24">:</div>
                                <div class="text-lh-1">
                                    <div class="text-gray-2 font-size-30 bg-gray-4 py-2 px-2 rounded-sm mb-2">
                                        <span class="js-cd-minutes"></span>
                                    </div>
                                    <div class="text-gray-2 font-size-12 text-center">MINS</div>
                                </div>
                                <div class="mx-1 pt-1 text-gray-2 font-size-24">:</div>
                                <div class="text-lh-1">
                                    <div class="text-gray-2 font-size-30 bg-gray-4 py-2 px-2 rounded-sm mb-2">
                                        <span class="js-cd-seconds"></span>
                                    </div>
                                    <div class="text-gray-2 font-size-12 text-center">SECS</div>
                                </div>
                            </div>
                        </div>
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
                                <li class="nav-item">
                                    <a class="nav-link active " id="pills-one-example1-tab" data-toggle="pill" href="#pills-one-example1" role="tab" aria-controls="pills-one-example1" aria-selected="true">
                                        <div class="d-md-flex justify-content-md-center align-items-md-center">
                                            Featured
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " id="pills-two-example1-tab" data-toggle="pill" href="#pills-two-example1" role="tab" aria-controls="pills-two-example1" aria-selected="false">
                                        <div class="d-md-flex justify-content-md-center align-items-md-center">
                                            On Sale
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " id="pills-three-example1-tab" data-toggle="pill" href="#pills-three-example1" role="tab" aria-controls="pills-three-example1" aria-selected="false">
                                        <div class="d-md-flex justify-content-md-center align-items-md-center">
                                            Top Rated
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- End Nav Classic -->

                        <!-- Tab Content -->
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade pt-2 show active" id="pills-one-example1" role="tabpanel" aria-labelledby="pills-one-example1-tab">
                                <ul class="row list-unstyled products-group no-gutters">
                                    <li class="col-6 col-wd-3 col-md-4 product-item">
                                        <div class="product-item__outer h-100">
                                            <div class="product-item__inner px-xl-4 p-3">
                                                <div class="product-item__body pb-xl-2">
                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                    <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                    <div class="mb-2">
                                                        <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="prodcut-price">
                                                            <div class="text-gray-100">$685,00</div>
                                                        </div>
                                                        <div class="d-none d-xl-block prodcut-add-cart">
                                                            <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-item__footer">
                                                    <div class="border-top pt-2 flex-center-between flex-wrap">
                                                        <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                        <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-6 col-wd-3 col-md-4 product-item">
                                        <div class="product-item__outer h-100">
                                            <div class="product-item__inner px-xl-4 p-3">
                                                <div class="product-item__body pb-xl-2">
                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                    <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Tablet White EliteBook Revolve 810 G2</a></h5>
                                                    <div class="mb-2">
                                                        <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img2.jpg" alt="Image Description"></a>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="prodcut-price d-flex align-items-center flex-wrap position-relative">
                                                            <ins class="font-size-20 text-red text-decoration-none mr-2">$1999,00</ins>
                                                            <del class="font-size-12 tex-gray-6 position-absolute bottom-100">$2 299,00</del>
                                                        </div>
                                                        <div class="d-none d-xl-block prodcut-add-cart">
                                                            <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-item__footer">
                                                    <div class="border-top pt-2 flex-center-between flex-wrap">
                                                        <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                        <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-6 col-wd-3 col-md-4 product-item remove-divider-xl">
                                        <div class="product-item__outer h-100">
                                            <div class="product-item__inner px-xl-4 p-3">
                                                <div class="product-item__body pb-xl-2">
                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                    <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Purple Solo 2 Wireless</a></h5>
                                                    <div class="mb-2">
                                                        <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img3.jpg" alt="Image Description"></a>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="prodcut-price">
                                                            <div class="text-gray-100">$685,00</div>
                                                        </div>
                                                        <div class="d-none d-xl-block prodcut-add-cart">
                                                            <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-item__footer">
                                                    <div class="border-top pt-2 flex-center-between flex-wrap">
                                                        <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                        <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-6 col-wd-3 col-md-4 product-item remove-divider-wd">
                                        <div class="product-item__outer h-100">
                                            <div class="product-item__inner px-xl-4 p-3">
                                                <div class="product-item__body pb-xl-2">
                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                    <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Smartphone 6S 32GB LTE</a></h5>
                                                    <div class="mb-2">
                                                        <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img4.jpg" alt="Image Description"></a>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="prodcut-price">
                                                            <div class="text-gray-100">$685,00</div>
                                                        </div>
                                                        <div class="d-none d-xl-block prodcut-add-cart">
                                                            <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-item__footer">
                                                    <div class="border-top pt-2 flex-center-between flex-wrap">
                                                        <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                        <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-6 col-wd-3 col-md-4 product-item">
                                        <div class="product-item__outer h-100">
                                            <div class="product-item__inner px-xl-4 p-3">
                                                <div class="product-item__body pb-xl-2">
                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                    <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Widescreen NX Mini F1 SMART NX</a></h5>
                                                    <div class="mb-2">
                                                        <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img5.jpg" alt="Image Description"></a>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="prodcut-price">
                                                            <div class="text-gray-100">$685,00</div>
                                                        </div>
                                                        <div class="d-none d-xl-block prodcut-add-cart">
                                                            <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-item__footer">
                                                    <div class="border-top pt-2 flex-center-between flex-wrap">
                                                        <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                        <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-6 col-wd-3 col-md-4 product-item remove-divider-xl">
                                        <div class="product-item__outer h-100">
                                            <div class="product-item__inner px-xl-4 p-3">
                                                <div class="product-item__body pb-xl-2">
                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                    <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Full Color LaserJet Pro M452dn</a></h5>
                                                    <div class="mb-2">
                                                        <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img6.jpg" alt="Image Description"></a>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="prodcut-price">
                                                            <div class="text-gray-100">$685,00</div>
                                                        </div>
                                                        <div class="d-none d-xl-block prodcut-add-cart">
                                                            <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-item__footer">
                                                    <div class="border-top pt-2 flex-center-between flex-wrap">
                                                        <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                        <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-6 col-wd-3 col-md-4 product-item d-xl-none d-wd-block remove-divider-xl">
                                        <div class="product-item__outer h-100">
                                            <div class="product-item__inner px-xl-4 p-3">
                                                <div class="product-item__body pb-xl-2">
                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                    <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">GameConsole Destiny  Special Edition</a></h5>
                                                    <div class="mb-2">
                                                        <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img7.jpg" alt="Image Description"></a>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="prodcut-price">
                                                            <div class="text-gray-100">$685,00</div>
                                                        </div>
                                                        <div class="d-none d-xl-block prodcut-add-cart">
                                                            <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-item__footer">
                                                    <div class="border-top pt-2 flex-center-between flex-wrap">
                                                        <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                        <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-6 col-wd-3 col-md-4 product-item d-xl-none d-wd-block remove-divider-wd">
                                        <div class="product-item__outer h-100">
                                            <div class="product-item__inner px-xl-4 p-3">
                                                <div class="product-item__body pb-xl-2">
                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                    <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Camera C430W 4k Waterproof</a></h5>
                                                    <div class="mb-2">
                                                        <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img8.jpg" alt="Image Description"></a>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="prodcut-price">
                                                            <div class="text-gray-100">$685,00</div>
                                                        </div>
                                                        <div class="d-none d-xl-block prodcut-add-cart">
                                                            <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-item__footer">
                                                    <div class="border-top pt-2 flex-center-between flex-wrap">
                                                        <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                        <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-pane fade pt-2" id="pills-two-example1" role="tabpanel" aria-labelledby="pills-two-example1-tab">
                                <ul class="row list-unstyled products-group no-gutters">
                                    <li class="col-6 col-wd-3 col-md-4 product-item">
                                        <div class="product-item__outer h-100">
                                            <div class="product-item__inner px-xl-4 p-3">
                                                <div class="product-item__body pb-xl-2">
                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                    <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Tablet White EliteBook Revolve 810 G2</a></h5>
                                                    <div class="mb-2">
                                                        <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img2.jpg" alt="Image Description"></a>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="prodcut-price">
                                                            <div class="text-gray-100">$685,00</div>
                                                        </div>
                                                        <div class="d-none d-xl-block prodcut-add-cart">
                                                            <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-item__footer">
                                                    <div class="border-top pt-2 flex-center-between flex-wrap">
                                                        <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                        <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-6 col-wd-3 col-md-4 product-item">
                                        <div class="product-item__outer h-100">
                                            <div class="product-item__inner px-xl-4 p-3">
                                                <div class="product-item__body pb-xl-2">
                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                    <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Purple Solo 2 Wireless</a></h5>
                                                    <div class="mb-2">
                                                        <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img3.jpg" alt="Image Description"></a>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="prodcut-price">
                                                            <div class="text-gray-100">$685,00</div>
                                                        </div>
                                                        <div class="d-none d-xl-block prodcut-add-cart">
                                                            <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-item__footer">
                                                    <div class="border-top pt-2 flex-center-between flex-wrap">
                                                        <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                        <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-6 col-wd-3 col-md-4 product-item remove-divider-xl">
                                        <div class="product-item__outer h-100">
                                            <div class="product-item__inner px-xl-4 p-3">
                                                <div class="product-item__body pb-xl-2">
                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                    <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Smartphone 6S 32GB LTE</a></h5>
                                                    <div class="mb-2">
                                                        <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img4.jpg" alt="Image Description"></a>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="prodcut-price">
                                                            <div class="text-gray-100">$685,00</div>
                                                        </div>
                                                        <div class="d-none d-xl-block prodcut-add-cart">
                                                            <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-item__footer">
                                                    <div class="border-top pt-2 flex-center-between flex-wrap">
                                                        <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                        <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-6 col-wd-3 col-md-4 product-item remove-divider-wd">
                                        <div class="product-item__outer h-100">
                                            <div class="product-item__inner px-xl-4 p-3">
                                                <div class="product-item__body pb-xl-2">
                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                    <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Widescreen NX Mini F1 SMART NX</a></h5>
                                                    <div class="mb-2">
                                                        <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img5.jpg" alt="Image Description"></a>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="prodcut-price">
                                                            <div class="text-gray-100">$685,00</div>
                                                        </div>
                                                        <div class="d-none d-xl-block prodcut-add-cart">
                                                            <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-item__footer">
                                                    <div class="border-top pt-2 flex-center-between flex-wrap">
                                                        <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                        <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-6 col-wd-3 col-md-4 product-item">
                                        <div class="product-item__outer h-100">
                                            <div class="product-item__inner px-xl-4 p-3">
                                                <div class="product-item__body pb-xl-2">
                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                    <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                    <div class="mb-2">
                                                        <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="prodcut-price">
                                                            <div class="text-gray-100">$685,00</div>
                                                        </div>
                                                        <div class="d-none d-xl-block prodcut-add-cart">
                                                            <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-item__footer">
                                                    <div class="border-top pt-2 flex-center-between flex-wrap">
                                                        <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                        <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-6 col-wd-3 col-md-4 product-item remove-divider-xl">
                                        <div class="product-item__outer h-100">
                                            <div class="product-item__inner px-xl-4 p-3">
                                                <div class="product-item__body pb-xl-2">
                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                    <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">GameConsole Destiny  Special Edition</a></h5>
                                                    <div class="mb-2">
                                                        <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img7.jpg" alt="Image Description"></a>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="prodcut-price">
                                                            <div class="text-gray-100">$685,00</div>
                                                        </div>
                                                        <div class="d-none d-xl-block prodcut-add-cart">
                                                            <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-item__footer">
                                                    <div class="border-top pt-2 flex-center-between flex-wrap">
                                                        <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                        <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-6 col-wd-3 col-md-4 product-item d-xl-none d-wd-block remove-divider-xl">
                                        <div class="product-item__outer h-100">
                                            <div class="product-item__inner px-xl-4 p-3">
                                                <div class="product-item__body pb-xl-2">
                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                    <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Camera C430W 4k Waterproof</a></h5>
                                                    <div class="mb-2">
                                                        <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img8.jpg" alt="Image Description"></a>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="prodcut-price">
                                                            <div class="text-gray-100">$685,00</div>
                                                        </div>
                                                        <div class="d-none d-xl-block prodcut-add-cart">
                                                            <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-item__footer">
                                                    <div class="border-top pt-2 flex-center-between flex-wrap">
                                                        <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                        <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-6 col-wd-3 col-md-4 product-item d-xl-none d-wd-block remove-divider-wd">
                                        <div class="product-item__outer h-100">
                                            <div class="product-item__inner px-xl-4 p-3">
                                                <div class="product-item__body pb-xl-2">
                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                    <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Full Color LaserJet Pro M452dn</a></h5>
                                                    <div class="mb-2">
                                                        <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img6.jpg" alt="Image Description"></a>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="prodcut-price">
                                                            <div class="text-gray-100">$685,00</div>
                                                        </div>
                                                        <div class="d-none d-xl-block prodcut-add-cart">
                                                            <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-item__footer">
                                                    <div class="border-top pt-2 flex-center-between flex-wrap">
                                                        <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                        <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-pane fade pt-2" id="pills-three-example1" role="tabpanel" aria-labelledby="pills-three-example1-tab">
                                <ul class="row list-unstyled products-group no-gutters">
                                    <li class="col-6 col-wd-3 col-md-4 product-item">
                                        <div class="product-item__outer h-100">
                                            <div class="product-item__inner px-xl-4 p-3">
                                                <div class="product-item__body pb-xl-2">
                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                    <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                    <div class="mb-2">
                                                        <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="prodcut-price">
                                                            <div class="text-gray-100">$685,00</div>
                                                        </div>
                                                        <div class="d-none d-xl-block prodcut-add-cart">
                                                            <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-item__footer">
                                                    <div class="border-top pt-2 flex-center-between flex-wrap">
                                                        <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                        <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-6 col-wd-3 col-md-4 product-item">
                                        <div class="product-item__outer h-100">
                                            <div class="product-item__inner px-xl-4 p-3">
                                                <div class="product-item__body pb-xl-2">
                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                    <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Tablet White EliteBook Revolve 810 G2</a></h5>
                                                    <div class="mb-2">
                                                        <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img2.jpg" alt="Image Description"></a>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="prodcut-price">
                                                            <div class="text-gray-100">$685,00</div>
                                                        </div>
                                                        <div class="d-none d-xl-block prodcut-add-cart">
                                                            <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-item__footer">
                                                    <div class="border-top pt-2 flex-center-between flex-wrap">
                                                        <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                        <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-6 col-wd-3 col-md-4 product-item remove-divider-xl">
                                        <div class="product-item__outer h-100">
                                            <div class="product-item__inner px-xl-4 p-3">
                                                <div class="product-item__body pb-xl-2">
                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                    <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Purple Solo 2 Wireless</a></h5>
                                                    <div class="mb-2">
                                                        <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img3.jpg" alt="Image Description"></a>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="prodcut-price">
                                                            <div class="text-gray-100">$685,00</div>
                                                        </div>
                                                        <div class="d-none d-xl-block prodcut-add-cart">
                                                            <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-item__footer">
                                                    <div class="border-top pt-2 flex-center-between flex-wrap">
                                                        <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                        <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-6 col-wd-3 col-md-4 product-item remove-divider-wd">
                                        <div class="product-item__outer h-100">
                                            <div class="product-item__inner px-xl-4 p-3">
                                                <div class="product-item__body pb-xl-2">
                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                    <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Smartphone 6S 32GB LTE</a></h5>
                                                    <div class="mb-2">
                                                        <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img4.jpg" alt="Image Description"></a>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="prodcut-price">
                                                            <div class="text-gray-100">$685,00</div>
                                                        </div>
                                                        <div class="d-none d-xl-block prodcut-add-cart">
                                                            <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-item__footer">
                                                    <div class="border-top pt-2 flex-center-between flex-wrap">
                                                        <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                        <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-6 col-wd-3 col-md-4 product-item">
                                        <div class="product-item__outer h-100">
                                            <div class="product-item__inner px-xl-4 p-3">
                                                <div class="product-item__body pb-xl-2">
                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                    <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Widescreen NX Mini F1 SMART NX</a></h5>
                                                    <div class="mb-2">
                                                        <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img5.jpg" alt="Image Description"></a>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="prodcut-price">
                                                            <div class="text-gray-100">$685,00</div>
                                                        </div>
                                                        <div class="d-none d-xl-block prodcut-add-cart">
                                                            <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-item__footer">
                                                    <div class="border-top pt-2 flex-center-between flex-wrap">
                                                        <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                        <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-6 col-wd-3 col-md-4 product-item remove-divider-xl">
                                        <div class="product-item__outer h-100">
                                            <div class="product-item__inner px-xl-4 p-3">
                                                <div class="product-item__body pb-xl-2">
                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                    <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Full Color LaserJet Pro M452dn</a></h5>
                                                    <div class="mb-2">
                                                        <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img6.jpg" alt="Image Description"></a>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="prodcut-price">
                                                            <div class="text-gray-100">$685,00</div>
                                                        </div>
                                                        <div class="d-none d-xl-block prodcut-add-cart">
                                                            <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-item__footer">
                                                    <div class="border-top pt-2 flex-center-between flex-wrap">
                                                        <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                        <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-6 col-wd-3 col-md-4 product-item d-xl-none d-wd-block remove-divider-xl">
                                        <div class="product-item__outer h-100">
                                            <div class="product-item__inner px-xl-4 p-3">
                                                <div class="product-item__body pb-xl-2">
                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                    <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">GameConsole Destiny  Special Edition</a></h5>
                                                    <div class="mb-2">
                                                        <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img7.jpg" alt="Image Description"></a>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="prodcut-price">
                                                            <div class="text-gray-100">$685,00</div>
                                                        </div>
                                                        <div class="d-none d-xl-block prodcut-add-cart">
                                                            <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-item__footer">
                                                    <div class="border-top pt-2 flex-center-between flex-wrap">
                                                        <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                        <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-6 col-wd-3 col-md-4 product-item d-xl-none d-wd-block remove-divider-wd">
                                        <div class="product-item__outer h-100">
                                            <div class="product-item__inner px-xl-4 p-3">
                                                <div class="product-item__body pb-xl-2">
                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                    <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Camera C430W 4k Waterproof</a></h5>
                                                    <div class="mb-2">
                                                        <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img8.jpg" alt="Image Description"></a>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="prodcut-price">
                                                            <div class="text-gray-100">$685,00</div>
                                                        </div>
                                                        <div class="d-none d-xl-block prodcut-add-cart">
                                                            <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-item__footer">
                                                    <div class="border-top pt-2 flex-center-between flex-wrap">
                                                        <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                        <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
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
    <!-- Products-4-1-4 -->
    <div class="products-group-4-1-4 space-1 bg-gray-7">
        <h2 class="sr-only">Products Grid</h2>
        <div class="container">
            <!-- Nav Classic -->
            <div class="position-relative text-center z-index-2 mb-3">
                <ul class="nav nav-classic nav-tab nav-tab-sm px-md-3 justify-content-start justify-content-lg-center flex-nowrap flex-lg-wrap overflow-auto overflow-lg-visble border-md-down-bottom-0 pb-1 pb-lg-0 mb-n1 mb-lg-0" id="pills-tab-1" role="tablist">
                    <li class="nav-item flex-shrink-0 flex-lg-shrink-1">
                        <a class="nav-link active " id="Tpills-one-example1-tab" data-toggle="pill" href="#Tpills-one-example1" role="tab" aria-controls="Tpills-one-example1" aria-selected="true">
                            <div class="d-md-flex justify-content-md-center align-items-md-center">
                                Best Deals
                            </div>
                        </a>
                    </li>
                    <li class="nav-item flex-shrink-0 flex-lg-shrink-1">
                        <a class="nav-link " id="Tpills-two-example1-tab" data-toggle="pill" href="#Tpills-two-example1" role="tab" aria-controls="Tpills-two-example1" aria-selected="false">
                            <div class="d-md-flex justify-content-md-center align-items-md-center">
                                TV & Video
                            </div>
                        </a>
                    </li>
                    <li class="nav-item flex-shrink-0 flex-lg-shrink-1">
                        <a class="nav-link " id="Tpills-three-example1-tab" data-toggle="pill" href="#Tpills-three-example1" role="tab" aria-controls="Tpills-three-example1" aria-selected="false">
                            <div class="d-md-flex justify-content-md-center align-items-md-center">
                                Cameras
                            </div>
                        </a>
                    </li>
                    <li class="nav-item flex-shrink-0 flex-lg-shrink-1">
                        <a class="nav-link " id="Tpills-four-example1-tab" data-toggle="pill" href="#Tpills-four-example1" role="tab" aria-controls="Tpills-four-example1" aria-selected="false">
                            <div class="d-md-flex justify-content-md-center align-items-md-center">
                                Audio
                            </div>
                        </a>
                    </li>
                    <li class="nav-item flex-shrink-0 flex-lg-shrink-1">
                        <a class="nav-link " id="Tpills-five-example1-tab" data-toggle="pill" href="#Tpills-five-example1" role="tab" aria-controls="Tpills-five-example1" aria-selected="false">
                            <div class="d-md-flex justify-content-md-center align-items-md-center">
                                Smartphones
                            </div>
                        </a>
                    </li>
                    <li class="nav-item flex-shrink-0 flex-lg-shrink-1">
                        <a class="nav-link " id="Tpills-six-example1-tab" data-toggle="pill" href="#Tpills-six-example1" role="tab" aria-controls="Tpills-six-example1" aria-selected="false">
                            <div class="d-md-flex justify-content-md-center align-items-md-center">
                                GPS & Navi
                            </div>
                        </a>
                    </li>
                    <li class="nav-item flex-shrink-0 flex-lg-shrink-1">
                        <a class="nav-link " id="Tpills-seven-example1-tab" data-toggle="pill" href="#Tpills-seven-example1" role="tab" aria-controls="Tpills-seven-example1" aria-selected="false">
                            <div class="d-md-flex justify-content-md-center align-items-md-center">
                                Computers
                            </div>
                        </a>
                    </li>
                    <li class="nav-item flex-shrink-0 flex-lg-shrink-1">
                        <a class="nav-link " id="Tpills-eight-example1-tab" data-toggle="pill" href="#Tpills-eight-example1" role="tab" aria-controls="Tpills-eight-example1" aria-selected="false">
                            <div class="d-md-flex justify-content-md-center align-items-md-center">
                                Portable Audio
                            </div>
                        </a>
                    </li>
                    <li class="nav-item flex-shrink-0 flex-lg-shrink-1">
                        <a class="nav-link " id="Tpills-nine-example1-tab" data-toggle="pill" href="#Tpills-nine-example1" role="tab" aria-controls="Tpills-nine-example1" aria-selected="false">
                            <div class="d-md-flex justify-content-md-center align-items-md-center">
                                Accessories
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- End Nav Classic -->

            <!-- Tab Content -->
            <div class="tab-content" id="Tpills-tabContent">
                <div class="tab-pane fade pt-2 show active" id="Tpills-one-example1" role="tabpanel" aria-labelledby="Tpills-one-example1-tab">
                    <div class="row no-gutters">
                        <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                            <ul class="row list-unstyled products-group no-gutters mb-0 flex-xl-column flex-wd-row">
                                <li class="col-xl-6 product-item max-width-xl-100 remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Tablet White EliteBook Revolve 810 G2</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img2.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 d-md-none d-wd-block product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 d-md-none d-wd-block product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">GameConsole Destiny  Special Edition</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img7.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6 col-wd-4 products-group-1">
                            <ul class="row list-unstyled products-group no-gutters bg-white h-100 mb-0">
                                <li class="col product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body d-flex flex-column">
                                                <div class="mb-1">
                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Game Consoles</a></div>
                                                    <h5 class="mb-0 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Game Console Controller + USB 3.0 Cable</a></h5>
                                                </div>
                                                <div class="mb-1 min-height-4-1-4">
                                                    <a href="#" class="d-block text-center my-4 mt-lg-6 mb-lg-5 mt-xl-0 mb-xl-0 mt-wd-6 mb-wd-5"><img class="img-fluid" src="/img/564X520/img2.jpg" alt="Image Description"></a>
                                                    <!-- Gallery -->
                                                    <div class="row mx-gutters-2 mb-3">
                                                        <div class="col-auto">
                                                            <!-- Gallery -->
                                                            <a class="js-fancybox max-width-60 u-media-viewer" href="javascript:;"
                                                               data-src="/img/1920X1080/img1.jpg"
                                                               data-fancybox="fancyboxGallery6"
                                                               data-caption="Electro in frames - image #01"
                                                               data-speed="700"
                                                               data-is-infinite="true">
                                                                <img class="img-fluid border" src="/img/100X100/img1.jpg" alt="Image Description">

                                                                <span class="u-media-viewer__container">
                                                                            <span class="u-media-viewer__icon">
                                                                                <span class="fas fa-plus u-media-viewer__icon-inner"></span>
                                                                            </span>
                                                                        </span>
                                                            </a>
                                                            <!-- End Gallery -->
                                                        </div>

                                                        <div class="col-auto">
                                                            <!-- Gallery -->
                                                            <a class="js-fancybox max-width-60 u-media-viewer" href="javascript:;"
                                                               data-src="/img/1920X1080/img2.jpg"
                                                               data-fancybox="fancyboxGallery6"
                                                               data-caption="Electro in frames - image #02"
                                                               data-speed="700"
                                                               data-is-infinite="true">
                                                                <img class="img-fluid border" src="/img/100X100/img2.jpg" alt="Image Description">

                                                                <span class="u-media-viewer__container">
                                                                            <span class="u-media-viewer__icon">
                                                                                <span class="fas fa-plus u-media-viewer__icon-inner"></span>
                                                                            </span>
                                                                        </span>
                                                            </a>
                                                            <!-- End Gallery -->
                                                        </div>

                                                        <div class="col-auto">
                                                            <!-- Gallery -->
                                                            <a class="js-fancybox max-width-60 u-media-viewer" href="javascript:;"
                                                               data-src="/img/1920X1080/img3.jpg"
                                                               data-fancybox="fancyboxGallery6"
                                                               data-caption="Electro in frames - image #03"
                                                               data-speed="700"
                                                               data-is-infinite="true">
                                                                <img class="img-fluid border" src="/img/100X100/img3.jpg" alt="Image Description">

                                                                <span class="u-media-viewer__container">
                                                                            <span class="u-media-viewer__icon">
                                                                                <span class="fas fa-plus u-media-viewer__icon-inner"></span>
                                                                            </span>
                                                                        </span>
                                                            </a>
                                                            <!-- End Gallery -->
                                                        </div>
                                                        <div class="col"></div>
                                                    </div>
                                                    <!-- End Gallery -->
                                                </div>
                                                <div class="flex-center-between">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-add-cart__wide btn-primary transition-3d-hover"><i class="ec ec-add-to-cart mr-2"></i> Add to Cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                            <ul class="row list-unstyled products-group no-gutters mb-0 flex-xl-column flex-wd-row">
                                <li class="col-xl-6 product-item max-width-xl-100 remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Tablet White EliteBook Revolve 810 G2</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img2.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 d-md-none d-wd-block product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 d-md-none d-wd-block product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">GameConsole Destiny  Special Edition</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img7.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade pt-2" id="Tpills-two-example1" role="tabpanel" aria-labelledby="Tpills-two-example1-tab">
                    <div class="row no-gutters">
                        <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                            <ul class="row list-unstyled products-group no-gutters mb-0 flex-xl-column flex-wd-row">
                                <li class="col-xl-6 product-item max-width-xl-100 remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Tablet White EliteBook Revolve 810 G2</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img2.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 d-md-none d-wd-block product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 d-md-none d-wd-block product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">GameConsole Destiny  Special Edition</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img7.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6 col-wd-4 products-group-1">
                            <ul class="row list-unstyled products-group no-gutters bg-white h-100 mb-0">
                                <li class="col product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body d-flex flex-column">
                                                <div class="mb-1">
                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Game Consoles</a></div>
                                                    <h5 class="mb-0 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Game Console Controller + USB 3.0 Cable</a></h5>
                                                </div>
                                                <div class="mb-1 min-height-4-1-4">
                                                    <a href="#" class="d-block text-center my-4 mt-lg-6 mb-lg-5 mt-xl-0 mb-xl-0 mt-wd-6 mb-wd-5"><img class="img-fluid" src="/img/564X520/img2.jpg" alt="Image Description"></a>
                                                    <!-- Gallery -->
                                                    <div class="row mx-gutters-2 mb-3">
                                                        <div class="col-auto">
                                                            <!-- Gallery -->
                                                            <a class="js-fancybox max-width-60 u-media-viewer" href="javascript:;"
                                                               data-src="/img/1920X1080/img1.jpg"
                                                               data-fancybox="fancyboxGallery6"
                                                               data-caption="Electro in frames - image #01"
                                                               data-speed="700"
                                                               data-is-infinite="true">
                                                                <img class="img-fluid border" src="/img/100X100/img1.jpg" alt="Image Description">

                                                                <span class="u-media-viewer__container">
                                                                            <span class="u-media-viewer__icon">
                                                                                <span class="fas fa-plus u-media-viewer__icon-inner"></span>
                                                                            </span>
                                                                        </span>
                                                            </a>
                                                            <!-- End Gallery -->
                                                        </div>

                                                        <div class="col-auto">
                                                            <!-- Gallery -->
                                                            <a class="js-fancybox max-width-60 u-media-viewer" href="javascript:;"
                                                               data-src="/img/1920X1080/img2.jpg"
                                                               data-fancybox="fancyboxGallery6"
                                                               data-caption="Electro in frames - image #02"
                                                               data-speed="700"
                                                               data-is-infinite="true">
                                                                <img class="img-fluid border" src="/img/100X100/img2.jpg" alt="Image Description">

                                                                <span class="u-media-viewer__container">
                                                                            <span class="u-media-viewer__icon">
                                                                                <span class="fas fa-plus u-media-viewer__icon-inner"></span>
                                                                            </span>
                                                                        </span>
                                                            </a>
                                                            <!-- End Gallery -->
                                                        </div>

                                                        <div class="col-auto">
                                                            <!-- Gallery -->
                                                            <a class="js-fancybox max-width-60 u-media-viewer" href="javascript:;"
                                                               data-src="/img/1920X1080/img3.jpg"
                                                               data-fancybox="fancyboxGallery6"
                                                               data-caption="Electro in frames - image #03"
                                                               data-speed="700"
                                                               data-is-infinite="true">
                                                                <img class="img-fluid border" src="/img/100X100/img3.jpg" alt="Image Description">

                                                                <span class="u-media-viewer__container">
                                                                            <span class="u-media-viewer__icon">
                                                                                <span class="fas fa-plus u-media-viewer__icon-inner"></span>
                                                                            </span>
                                                                        </span>
                                                            </a>
                                                            <!-- End Gallery -->
                                                        </div>
                                                        <div class="col"></div>
                                                    </div>
                                                    <!-- End Gallery -->
                                                </div>
                                                <div class="flex-center-between">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-add-cart__wide btn-primary transition-3d-hover"><i class="ec ec-add-to-cart mr-2"></i> Add to Cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                            <ul class="row list-unstyled products-group no-gutters mb-0 flex-xl-column flex-wd-row">
                                <li class="col-xl-6 product-item max-width-xl-100 remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Tablet White EliteBook Revolve 810 G2</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img2.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 d-md-none d-wd-block product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 d-md-none d-wd-block product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">GameConsole Destiny  Special Edition</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img7.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade pt-2" id="Tpills-three-example1" role="tabpanel" aria-labelledby="Tpills-three-example1-tab">
                    <div class="row no-gutters">
                        <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                            <ul class="row list-unstyled products-group no-gutters mb-0 flex-xl-column flex-wd-row">
                                <li class="col-xl-6 product-item max-width-xl-100 remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Tablet White EliteBook Revolve 810 G2</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img2.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 d-md-none d-wd-block product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 d-md-none d-wd-block product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">GameConsole Destiny  Special Edition</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img7.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6 col-wd-4 products-group-1">
                            <ul class="row list-unstyled products-group no-gutters bg-white h-100 mb-0">
                                <li class="col product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body d-flex flex-column">
                                                <div class="mb-1">
                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Game Consoles</a></div>
                                                    <h5 class="mb-0 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Game Console Controller + USB 3.0 Cable</a></h5>
                                                </div>
                                                <div class="mb-1 min-height-4-1-4">
                                                    <a href="#" class="d-block text-center my-4 mt-lg-6 mb-lg-5 mt-xl-0 mb-xl-0 mt-wd-6 mb-wd-5"><img class="img-fluid" src="/img/564X520/img2.jpg" alt="Image Description"></a>
                                                    <!-- Gallery -->
                                                    <div class="row mx-gutters-2 mb-3">
                                                        <div class="col-auto">
                                                            <!-- Gallery -->
                                                            <a class="js-fancybox max-width-60 u-media-viewer" href="javascript:;"
                                                               data-src="/img/1920X1080/img1.jpg"
                                                               data-fancybox="fancyboxGallery6"
                                                               data-caption="Electro in frames - image #01"
                                                               data-speed="700"
                                                               data-is-infinite="true">
                                                                <img class="img-fluid border" src="/img/100X100/img1.jpg" alt="Image Description">

                                                                <span class="u-media-viewer__container">
                                                                            <span class="u-media-viewer__icon">
                                                                                <span class="fas fa-plus u-media-viewer__icon-inner"></span>
                                                                            </span>
                                                                        </span>
                                                            </a>
                                                            <!-- End Gallery -->
                                                        </div>

                                                        <div class="col-auto">
                                                            <!-- Gallery -->
                                                            <a class="js-fancybox max-width-60 u-media-viewer" href="javascript:;"
                                                               data-src="/img/1920X1080/img2.jpg"
                                                               data-fancybox="fancyboxGallery6"
                                                               data-caption="Electro in frames - image #02"
                                                               data-speed="700"
                                                               data-is-infinite="true">
                                                                <img class="img-fluid border" src="/img/100X100/img2.jpg" alt="Image Description">

                                                                <span class="u-media-viewer__container">
                                                                            <span class="u-media-viewer__icon">
                                                                                <span class="fas fa-plus u-media-viewer__icon-inner"></span>
                                                                            </span>
                                                                        </span>
                                                            </a>
                                                            <!-- End Gallery -->
                                                        </div>

                                                        <div class="col-auto">
                                                            <!-- Gallery -->
                                                            <a class="js-fancybox max-width-60 u-media-viewer" href="javascript:;"
                                                               data-src="/img/1920X1080/img3.jpg"
                                                               data-fancybox="fancyboxGallery6"
                                                               data-caption="Electro in frames - image #03"
                                                               data-speed="700"
                                                               data-is-infinite="true">
                                                                <img class="img-fluid border" src="/img/100X100/img3.jpg" alt="Image Description">

                                                                <span class="u-media-viewer__container">
                                                                            <span class="u-media-viewer__icon">
                                                                                <span class="fas fa-plus u-media-viewer__icon-inner"></span>
                                                                            </span>
                                                                        </span>
                                                            </a>
                                                            <!-- End Gallery -->
                                                        </div>
                                                        <div class="col"></div>
                                                    </div>
                                                    <!-- End Gallery -->
                                                </div>
                                                <div class="flex-center-between">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-add-cart__wide btn-primary transition-3d-hover"><i class="ec ec-add-to-cart mr-2"></i> Add to Cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                            <ul class="row list-unstyled products-group no-gutters mb-0 flex-xl-column flex-wd-row">
                                <li class="col-xl-6 product-item max-width-xl-100 remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Tablet White EliteBook Revolve 810 G2</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img2.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 d-md-none d-wd-block product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 d-md-none d-wd-block product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">GameConsole Destiny  Special Edition</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img7.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade pt-2" id="Tpills-four-example1" role="tabpanel" aria-labelledby="Tpills-four-example1-tab">
                    <div class="row no-gutters">
                        <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                            <ul class="row list-unstyled products-group no-gutters mb-0 flex-xl-column flex-wd-row">
                                <li class="col-xl-6 product-item max-width-xl-100 remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Tablet White EliteBook Revolve 810 G2</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img2.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 d-md-none d-wd-block product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 d-md-none d-wd-block product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">GameConsole Destiny  Special Edition</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img7.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6 col-wd-4 products-group-1">
                            <ul class="row list-unstyled products-group no-gutters bg-white h-100 mb-0">
                                <li class="col product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body d-flex flex-column">
                                                <div class="mb-1">
                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Game Consoles</a></div>
                                                    <h5 class="mb-0 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Game Console Controller + USB 3.0 Cable</a></h5>
                                                </div>
                                                <div class="mb-1 min-height-4-1-4">
                                                    <a href="#" class="d-block text-center my-4 mt-lg-6 mb-lg-5 mt-xl-0 mb-xl-0 mt-wd-6 mb-wd-5"><img class="img-fluid" src="/img/564X520/img2.jpg" alt="Image Description"></a>
                                                    <!-- Gallery -->
                                                    <div class="row mx-gutters-2 mb-3">
                                                        <div class="col-auto">
                                                            <!-- Gallery -->
                                                            <a class="js-fancybox max-width-60 u-media-viewer" href="javascript:;"
                                                               data-src="/img/1920X1080/img1.jpg"
                                                               data-fancybox="fancyboxGallery6"
                                                               data-caption="Electro in frames - image #01"
                                                               data-speed="700"
                                                               data-is-infinite="true">
                                                                <img class="img-fluid border" src="/img/100X100/img1.jpg" alt="Image Description">

                                                                <span class="u-media-viewer__container">
                                                                            <span class="u-media-viewer__icon">
                                                                                <span class="fas fa-plus u-media-viewer__icon-inner"></span>
                                                                            </span>
                                                                        </span>
                                                            </a>
                                                            <!-- End Gallery -->
                                                        </div>

                                                        <div class="col-auto">
                                                            <!-- Gallery -->
                                                            <a class="js-fancybox max-width-60 u-media-viewer" href="javascript:;"
                                                               data-src="/img/1920X1080/img2.jpg"
                                                               data-fancybox="fancyboxGallery6"
                                                               data-caption="Electro in frames - image #02"
                                                               data-speed="700"
                                                               data-is-infinite="true">
                                                                <img class="img-fluid border" src="/img/100X100/img2.jpg" alt="Image Description">

                                                                <span class="u-media-viewer__container">
                                                                            <span class="u-media-viewer__icon">
                                                                                <span class="fas fa-plus u-media-viewer__icon-inner"></span>
                                                                            </span>
                                                                        </span>
                                                            </a>
                                                            <!-- End Gallery -->
                                                        </div>

                                                        <div class="col-auto">
                                                            <!-- Gallery -->
                                                            <a class="js-fancybox max-width-60 u-media-viewer" href="javascript:;"
                                                               data-src="/img/1920X1080/img3.jpg"
                                                               data-fancybox="fancyboxGallery6"
                                                               data-caption="Electro in frames - image #03"
                                                               data-speed="700"
                                                               data-is-infinite="true">
                                                                <img class="img-fluid border" src="/img/100X100/img3.jpg" alt="Image Description">

                                                                <span class="u-media-viewer__container">
                                                                            <span class="u-media-viewer__icon">
                                                                                <span class="fas fa-plus u-media-viewer__icon-inner"></span>
                                                                            </span>
                                                                        </span>
                                                            </a>
                                                            <!-- End Gallery -->
                                                        </div>
                                                        <div class="col"></div>
                                                    </div>
                                                    <!-- End Gallery -->
                                                </div>
                                                <div class="flex-center-between">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-add-cart__wide btn-primary transition-3d-hover"><i class="ec ec-add-to-cart mr-2"></i> Add to Cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                            <ul class="row list-unstyled products-group no-gutters mb-0 flex-xl-column flex-wd-row">
                                <li class="col-xl-6 product-item max-width-xl-100 remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Tablet White EliteBook Revolve 810 G2</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img2.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 d-md-none d-wd-block product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 d-md-none d-wd-block product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">GameConsole Destiny  Special Edition</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img7.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade pt-2" id="Tpills-five-example1" role="tabpanel" aria-labelledby="Tpills-five-example1-tab">
                    <div class="row no-gutters">
                        <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                            <ul class="row list-unstyled products-group no-gutters mb-0 flex-xl-column flex-wd-row">
                                <li class="col-xl-6 product-item max-width-xl-100 remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Tablet White EliteBook Revolve 810 G2</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img2.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 d-md-none d-wd-block product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 d-md-none d-wd-block product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">GameConsole Destiny  Special Edition</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img7.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6 col-wd-4 products-group-1">
                            <ul class="row list-unstyled products-group no-gutters bg-white h-100 mb-0">
                                <li class="col product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body d-flex flex-column">
                                                <div class="mb-1">
                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Game Consoles</a></div>
                                                    <h5 class="mb-0 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Game Console Controller + USB 3.0 Cable</a></h5>
                                                </div>
                                                <div class="mb-1 min-height-4-1-4">
                                                    <a href="#" class="d-block text-center my-4 mt-lg-6 mb-lg-5 mt-xl-0 mb-xl-0 mt-wd-6 mb-wd-5"><img class="img-fluid" src="/img/564X520/img2.jpg" alt="Image Description"></a>
                                                    <!-- Gallery -->
                                                    <div class="row mx-gutters-2 mb-3">
                                                        <div class="col-auto">
                                                            <!-- Gallery -->
                                                            <a class="js-fancybox max-width-60 u-media-viewer" href="javascript:;"
                                                               data-src="/img/1920X1080/img1.jpg"
                                                               data-fancybox="fancyboxGallery6"
                                                               data-caption="Electro in frames - image #01"
                                                               data-speed="700"
                                                               data-is-infinite="true">
                                                                <img class="img-fluid border" src="/img/100X100/img1.jpg" alt="Image Description">

                                                                <span class="u-media-viewer__container">
                                                                            <span class="u-media-viewer__icon">
                                                                                <span class="fas fa-plus u-media-viewer__icon-inner"></span>
                                                                            </span>
                                                                        </span>
                                                            </a>
                                                            <!-- End Gallery -->
                                                        </div>

                                                        <div class="col-auto">
                                                            <!-- Gallery -->
                                                            <a class="js-fancybox max-width-60 u-media-viewer" href="javascript:;"
                                                               data-src="/img/1920X1080/img2.jpg"
                                                               data-fancybox="fancyboxGallery6"
                                                               data-caption="Electro in frames - image #02"
                                                               data-speed="700"
                                                               data-is-infinite="true">
                                                                <img class="img-fluid border" src="/img/100X100/img2.jpg" alt="Image Description">

                                                                <span class="u-media-viewer__container">
                                                                            <span class="u-media-viewer__icon">
                                                                                <span class="fas fa-plus u-media-viewer__icon-inner"></span>
                                                                            </span>
                                                                        </span>
                                                            </a>
                                                            <!-- End Gallery -->
                                                        </div>

                                                        <div class="col-auto">
                                                            <!-- Gallery -->
                                                            <a class="js-fancybox max-width-60 u-media-viewer" href="javascript:;"
                                                               data-src="/img/1920X1080/img3.jpg"
                                                               data-fancybox="fancyboxGallery6"
                                                               data-caption="Electro in frames - image #03"
                                                               data-speed="700"
                                                               data-is-infinite="true">
                                                                <img class="img-fluid border" src="/img/100X100/img3.jpg" alt="Image Description">

                                                                <span class="u-media-viewer__container">
                                                                            <span class="u-media-viewer__icon">
                                                                                <span class="fas fa-plus u-media-viewer__icon-inner"></span>
                                                                            </span>
                                                                        </span>
                                                            </a>
                                                            <!-- End Gallery -->
                                                        </div>
                                                        <div class="col"></div>
                                                    </div>
                                                    <!-- End Gallery -->
                                                </div>
                                                <div class="flex-center-between">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-add-cart__wide btn-primary transition-3d-hover"><i class="ec ec-add-to-cart mr-2"></i> Add to Cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                            <ul class="row list-unstyled products-group no-gutters mb-0 flex-xl-column flex-wd-row">
                                <li class="col-xl-6 product-item max-width-xl-100 remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Tablet White EliteBook Revolve 810 G2</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img2.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 d-md-none d-wd-block product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 d-md-none d-wd-block product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">GameConsole Destiny  Special Edition</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img7.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade pt-2" id="Tpills-six-example1" role="tabpanel" aria-labelledby="Tpills-six-example1-tab">
                    <div class="row no-gutters">
                        <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                            <ul class="row list-unstyled products-group no-gutters mb-0 flex-xl-column flex-wd-row">
                                <li class="col-xl-6 product-item max-width-xl-100 remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Tablet White EliteBook Revolve 810 G2</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img2.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 d-md-none d-wd-block product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 d-md-none d-wd-block product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">GameConsole Destiny  Special Edition</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img7.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6 col-wd-4 products-group-1">
                            <ul class="row list-unstyled products-group no-gutters bg-white h-100 mb-0">
                                <li class="col product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body d-flex flex-column">
                                                <div class="mb-1">
                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Game Consoles</a></div>
                                                    <h5 class="mb-0 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Game Console Controller + USB 3.0 Cable</a></h5>
                                                </div>
                                                <div class="mb-1 min-height-4-1-4">
                                                    <a href="#" class="d-block text-center my-4 mt-lg-6 mb-lg-5 mt-xl-0 mb-xl-0 mt-wd-6 mb-wd-5"><img class="img-fluid" src="/img/564X520/img2.jpg" alt="Image Description"></a>
                                                    <!-- Gallery -->
                                                    <div class="row mx-gutters-2 mb-3">
                                                        <div class="col-auto">
                                                            <!-- Gallery -->
                                                            <a class="js-fancybox max-width-60 u-media-viewer" href="javascript:;"
                                                               data-src="/img/1920X1080/img1.jpg"
                                                               data-fancybox="fancyboxGallery6"
                                                               data-caption="Electro in frames - image #01"
                                                               data-speed="700"
                                                               data-is-infinite="true">
                                                                <img class="img-fluid border" src="/img/100X100/img1.jpg" alt="Image Description">

                                                                <span class="u-media-viewer__container">
                                                                            <span class="u-media-viewer__icon">
                                                                                <span class="fas fa-plus u-media-viewer__icon-inner"></span>
                                                                            </span>
                                                                        </span>
                                                            </a>
                                                            <!-- End Gallery -->
                                                        </div>

                                                        <div class="col-auto">
                                                            <!-- Gallery -->
                                                            <a class="js-fancybox max-width-60 u-media-viewer" href="javascript:;"
                                                               data-src="/img/1920X1080/img2.jpg"
                                                               data-fancybox="fancyboxGallery6"
                                                               data-caption="Electro in frames - image #02"
                                                               data-speed="700"
                                                               data-is-infinite="true">
                                                                <img class="img-fluid border" src="/img/100X100/img2.jpg" alt="Image Description">

                                                                <span class="u-media-viewer__container">
                                                                            <span class="u-media-viewer__icon">
                                                                                <span class="fas fa-plus u-media-viewer__icon-inner"></span>
                                                                            </span>
                                                                        </span>
                                                            </a>
                                                            <!-- End Gallery -->
                                                        </div>

                                                        <div class="col-auto">
                                                            <!-- Gallery -->
                                                            <a class="js-fancybox max-width-60 u-media-viewer" href="javascript:;"
                                                               data-src="/img/1920X1080/img3.jpg"
                                                               data-fancybox="fancyboxGallery6"
                                                               data-caption="Electro in frames - image #03"
                                                               data-speed="700"
                                                               data-is-infinite="true">
                                                                <img class="img-fluid border" src="/img/100X100/img3.jpg" alt="Image Description">

                                                                <span class="u-media-viewer__container">
                                                                            <span class="u-media-viewer__icon">
                                                                                <span class="fas fa-plus u-media-viewer__icon-inner"></span>
                                                                            </span>
                                                                        </span>
                                                            </a>
                                                            <!-- End Gallery -->
                                                        </div>
                                                        <div class="col"></div>
                                                    </div>
                                                    <!-- End Gallery -->
                                                </div>
                                                <div class="flex-center-between">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-add-cart__wide btn-primary transition-3d-hover"><i class="ec ec-add-to-cart mr-2"></i> Add to Cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                            <ul class="row list-unstyled products-group no-gutters mb-0 flex-xl-column flex-wd-row">
                                <li class="col-xl-6 product-item max-width-xl-100 remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Tablet White EliteBook Revolve 810 G2</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img2.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 d-md-none d-wd-block product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 d-md-none d-wd-block product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">GameConsole Destiny  Special Edition</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img7.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade pt-2" id="Tpills-seven-example1" role="tabpanel" aria-labelledby="Tpills-seven-example1-tab">
                    <div class="row no-gutters">
                        <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                            <ul class="row list-unstyled products-group no-gutters mb-0 flex-xl-column flex-wd-row">
                                <li class="col-xl-6 product-item max-width-xl-100 remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Tablet White EliteBook Revolve 810 G2</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img2.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 d-md-none d-wd-block product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 d-md-none d-wd-block product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">GameConsole Destiny  Special Edition</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img7.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6 col-wd-4 products-group-1">
                            <ul class="row list-unstyled products-group no-gutters bg-white h-100 mb-0">
                                <li class="col product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body d-flex flex-column">
                                                <div class="mb-1">
                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Game Consoles</a></div>
                                                    <h5 class="mb-0 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Game Console Controller + USB 3.0 Cable</a></h5>
                                                </div>
                                                <div class="mb-1 min-height-4-1-4">
                                                    <a href="#" class="d-block text-center my-4 mt-lg-6 mb-lg-5 mt-xl-0 mb-xl-0 mt-wd-6 mb-wd-5"><img class="img-fluid" src="/img/564X520/img2.jpg" alt="Image Description"></a>
                                                    <!-- Gallery -->
                                                    <div class="row mx-gutters-2 mb-3">
                                                        <div class="col-auto">
                                                            <!-- Gallery -->
                                                            <a class="js-fancybox max-width-60 u-media-viewer" href="javascript:;"
                                                               data-src="/img/1920X1080/img1.jpg"
                                                               data-fancybox="fancyboxGallery6"
                                                               data-caption="Electro in frames - image #01"
                                                               data-speed="700"
                                                               data-is-infinite="true">
                                                                <img class="img-fluid border" src="/img/100X100/img1.jpg" alt="Image Description">

                                                                <span class="u-media-viewer__container">
                                                                            <span class="u-media-viewer__icon">
                                                                                <span class="fas fa-plus u-media-viewer__icon-inner"></span>
                                                                            </span>
                                                                        </span>
                                                            </a>
                                                            <!-- End Gallery -->
                                                        </div>

                                                        <div class="col-auto">
                                                            <!-- Gallery -->
                                                            <a class="js-fancybox max-width-60 u-media-viewer" href="javascript:;"
                                                               data-src="/img/1920X1080/img2.jpg"
                                                               data-fancybox="fancyboxGallery6"
                                                               data-caption="Electro in frames - image #02"
                                                               data-speed="700"
                                                               data-is-infinite="true">
                                                                <img class="img-fluid border" src="/img/100X100/img2.jpg" alt="Image Description">

                                                                <span class="u-media-viewer__container">
                                                                            <span class="u-media-viewer__icon">
                                                                                <span class="fas fa-plus u-media-viewer__icon-inner"></span>
                                                                            </span>
                                                                        </span>
                                                            </a>
                                                            <!-- End Gallery -->
                                                        </div>

                                                        <div class="col-auto">
                                                            <!-- Gallery -->
                                                            <a class="js-fancybox max-width-60 u-media-viewer" href="javascript:;"
                                                               data-src="/img/1920X1080/img3.jpg"
                                                               data-fancybox="fancyboxGallery6"
                                                               data-caption="Electro in frames - image #03"
                                                               data-speed="700"
                                                               data-is-infinite="true">
                                                                <img class="img-fluid border" src="/img/100X100/img3.jpg" alt="Image Description">

                                                                <span class="u-media-viewer__container">
                                                                            <span class="u-media-viewer__icon">
                                                                                <span class="fas fa-plus u-media-viewer__icon-inner"></span>
                                                                            </span>
                                                                        </span>
                                                            </a>
                                                            <!-- End Gallery -->
                                                        </div>
                                                        <div class="col"></div>
                                                    </div>
                                                    <!-- End Gallery -->
                                                </div>
                                                <div class="flex-center-between">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-add-cart__wide btn-primary transition-3d-hover"><i class="ec ec-add-to-cart mr-2"></i> Add to Cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                            <ul class="row list-unstyled products-group no-gutters mb-0 flex-xl-column flex-wd-row">
                                <li class="col-xl-6 product-item max-width-xl-100 remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Tablet White EliteBook Revolve 810 G2</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img2.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 d-md-none d-wd-block product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 d-md-none d-wd-block product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">GameConsole Destiny  Special Edition</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img7.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade pt-2" id="Tpills-eight-example1" role="tabpanel" aria-labelledby="Tpills-eight-example1-tab">
                    <div class="row no-gutters">
                        <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                            <ul class="row list-unstyled products-group no-gutters mb-0 flex-xl-column flex-wd-row">
                                <li class="col-xl-6 product-item max-width-xl-100 remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Tablet White EliteBook Revolve 810 G2</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img2.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 d-md-none d-wd-block product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 d-md-none d-wd-block product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">GameConsole Destiny  Special Edition</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img7.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6 col-wd-4 products-group-1">
                            <ul class="row list-unstyled products-group no-gutters bg-white h-100 mb-0">
                                <li class="col product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body d-flex flex-column">
                                                <div class="mb-1">
                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Game Consoles</a></div>
                                                    <h5 class="mb-0 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Game Console Controller + USB 3.0 Cable</a></h5>
                                                </div>
                                                <div class="mb-1 min-height-4-1-4">
                                                    <a href="#" class="d-block text-center my-4 mt-lg-6 mb-lg-5 mt-xl-0 mb-xl-0 mt-wd-6 mb-wd-5"><img class="img-fluid" src="/img/564X520/img2.jpg" alt="Image Description"></a>
                                                    <!-- Gallery -->
                                                    <div class="row mx-gutters-2 mb-3">
                                                        <div class="col-auto">
                                                            <!-- Gallery -->
                                                            <a class="js-fancybox max-width-60 u-media-viewer" href="javascript:;"
                                                               data-src="/img/1920X1080/img1.jpg"
                                                               data-fancybox="fancyboxGallery6"
                                                               data-caption="Electro in frames - image #01"
                                                               data-speed="700"
                                                               data-is-infinite="true">
                                                                <img class="img-fluid border" src="/img/100X100/img1.jpg" alt="Image Description">

                                                                <span class="u-media-viewer__container">
                                                                            <span class="u-media-viewer__icon">
                                                                                <span class="fas fa-plus u-media-viewer__icon-inner"></span>
                                                                            </span>
                                                                        </span>
                                                            </a>
                                                            <!-- End Gallery -->
                                                        </div>

                                                        <div class="col-auto">
                                                            <!-- Gallery -->
                                                            <a class="js-fancybox max-width-60 u-media-viewer" href="javascript:;"
                                                               data-src="/img/1920X1080/img2.jpg"
                                                               data-fancybox="fancyboxGallery6"
                                                               data-caption="Electro in frames - image #02"
                                                               data-speed="700"
                                                               data-is-infinite="true">
                                                                <img class="img-fluid border" src="/img/100X100/img2.jpg" alt="Image Description">

                                                                <span class="u-media-viewer__container">
                                                                            <span class="u-media-viewer__icon">
                                                                                <span class="fas fa-plus u-media-viewer__icon-inner"></span>
                                                                            </span>
                                                                        </span>
                                                            </a>
                                                            <!-- End Gallery -->
                                                        </div>

                                                        <div class="col-auto">
                                                            <!-- Gallery -->
                                                            <a class="js-fancybox max-width-60 u-media-viewer" href="javascript:;"
                                                               data-src="/img/1920X1080/img3.jpg"
                                                               data-fancybox="fancyboxGallery6"
                                                               data-caption="Electro in frames - image #03"
                                                               data-speed="700"
                                                               data-is-infinite="true">
                                                                <img class="img-fluid border" src="/img/100X100/img3.jpg" alt="Image Description">

                                                                <span class="u-media-viewer__container">
                                                                            <span class="u-media-viewer__icon">
                                                                                <span class="fas fa-plus u-media-viewer__icon-inner"></span>
                                                                            </span>
                                                                        </span>
                                                            </a>
                                                            <!-- End Gallery -->
                                                        </div>
                                                        <div class="col"></div>
                                                    </div>
                                                    <!-- End Gallery -->
                                                </div>
                                                <div class="flex-center-between">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-add-cart__wide btn-primary transition-3d-hover"><i class="ec ec-add-to-cart mr-2"></i> Add to Cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                            <ul class="row list-unstyled products-group no-gutters mb-0 flex-xl-column flex-wd-row">
                                <li class="col-xl-6 product-item max-width-xl-100 remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Tablet White EliteBook Revolve 810 G2</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img2.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 d-md-none d-wd-block product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 d-md-none d-wd-block product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">GameConsole Destiny  Special Edition</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img7.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade pt-2" id="Tpills-nine-example1" role="tabpanel" aria-labelledby="Tpills-nine-example1-tab">
                    <div class="row no-gutters">
                        <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                            <ul class="row list-unstyled products-group no-gutters mb-0 flex-xl-column flex-wd-row">
                                <li class="col-xl-6 product-item max-width-xl-100 remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Tablet White EliteBook Revolve 810 G2</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img2.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 d-md-none d-wd-block product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 d-md-none d-wd-block product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">GameConsole Destiny  Special Edition</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img7.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6 col-wd-4 products-group-1">
                            <ul class="row list-unstyled products-group no-gutters bg-white h-100 mb-0">
                                <li class="col product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body d-flex flex-column">
                                                <div class="mb-1">
                                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Game Consoles</a></div>
                                                    <h5 class="mb-0 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Game Console Controller + USB 3.0 Cable</a></h5>
                                                </div>
                                                <div class="mb-1 min-height-4-1-4">
                                                    <a href="#" class="d-block text-center my-4 mt-lg-6 mb-lg-5 mt-xl-0 mb-xl-0 mt-wd-6 mb-wd-5"><img class="img-fluid" src="/img/564X520/img2.jpg" alt="Image Description"></a>
                                                    <!-- Gallery -->
                                                    <div class="row mx-gutters-2 mb-3">
                                                        <div class="col-auto">
                                                            <!-- Gallery -->
                                                            <a class="js-fancybox max-width-60 u-media-viewer" href="javascript:;"
                                                               data-src="/img/1920X1080/img1.jpg"
                                                               data-fancybox="fancyboxGallery6"
                                                               data-caption="Electro in frames - image #01"
                                                               data-speed="700"
                                                               data-is-infinite="true">
                                                                <img class="img-fluid border" src="/img/100X100/img1.jpg" alt="Image Description">

                                                                <span class="u-media-viewer__container">
                                                                            <span class="u-media-viewer__icon">
                                                                                <span class="fas fa-plus u-media-viewer__icon-inner"></span>
                                                                            </span>
                                                                        </span>
                                                            </a>
                                                            <!-- End Gallery -->
                                                        </div>

                                                        <div class="col-auto">
                                                            <!-- Gallery -->
                                                            <a class="js-fancybox max-width-60 u-media-viewer" href="javascript:;"
                                                               data-src="/img/1920X1080/img2.jpg"
                                                               data-fancybox="fancyboxGallery6"
                                                               data-caption="Electro in frames - image #02"
                                                               data-speed="700"
                                                               data-is-infinite="true">
                                                                <img class="img-fluid border" src="/img/100X100/img2.jpg" alt="Image Description">

                                                                <span class="u-media-viewer__container">
                                                                            <span class="u-media-viewer__icon">
                                                                                <span class="fas fa-plus u-media-viewer__icon-inner"></span>
                                                                            </span>
                                                                        </span>
                                                            </a>
                                                            <!-- End Gallery -->
                                                        </div>

                                                        <div class="col-auto">
                                                            <!-- Gallery -->
                                                            <a class="js-fancybox max-width-60 u-media-viewer" href="javascript:;"
                                                               data-src="/img/1920X1080/img3.jpg"
                                                               data-fancybox="fancyboxGallery6"
                                                               data-caption="Electro in frames - image #03"
                                                               data-speed="700"
                                                               data-is-infinite="true">
                                                                <img class="img-fluid border" src="/img/100X100/img3.jpg" alt="Image Description">

                                                                <span class="u-media-viewer__container">
                                                                            <span class="u-media-viewer__icon">
                                                                                <span class="fas fa-plus u-media-viewer__icon-inner"></span>
                                                                            </span>
                                                                        </span>
                                                            </a>
                                                            <!-- End Gallery -->
                                                        </div>
                                                        <div class="col"></div>
                                                    </div>
                                                    <!-- End Gallery -->
                                                </div>
                                                <div class="flex-center-between">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-add-cart__wide btn-primary transition-3d-hover"><i class="ec ec-add-to-cart mr-2"></i> Add to Cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                            <ul class="row list-unstyled products-group no-gutters mb-0 flex-xl-column flex-wd-row">
                                <li class="col-xl-6 product-item max-width-xl-100 remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Tablet White EliteBook Revolve 810 G2</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img2.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 d-md-none d-wd-block product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-6 product-item max-width-xl-100 d-md-none d-wd-block product-item remove-divider">
                                    <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">GameConsole Destiny  Special Edition</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img7.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Tab Content -->
        </div>

        <!-- Features Section -->
        <div class="container space-2 d-none">
            <!-- Nav Classic -->
            <div class="position-relative text-center z-index-2 mb-3">
                <ul class="nav nav-classic nav-tab nav-tab-sm px-md-3 justify-content-start justify-content-lg-center flex-nowrap flex-lg-wrap overflow-auto overflow-lg-visble border-md-down-bottom-0 pb-1 pb-lg-0 mb-n1 mb-lg-0" id="pills-tab-2" role="tablist">
                    <li class="nav-item flex-shrink-0 flex-lg-shrink-1">
                        <a class="nav-link active " id="Gpills-one-example1-tab" data-toggle="pill" href="#Gpills-one-example1" role="tab" aria-controls="Gpills-one-example1" aria-selected="true">
                            <div class="d-md-flex justify-content-md-center align-items-md-center">
                                Best Deals
                            </div>
                        </a>
                    </li>
                    <li class="nav-item flex-shrink-0 flex-lg-shrink-1">
                        <a class="nav-link " id="Gpills-two-example1-tab" data-toggle="pill" href="#Gpills-two-example1" role="tab" aria-controls="Gpills-two-example1" aria-selected="false">
                            <div class="d-md-flex justify-content-md-center align-items-md-center">
                                TV & Video
                            </div>
                        </a>
                    </li>
                    <li class="nav-item flex-shrink-0 flex-lg-shrink-1">
                        <a class="nav-link " id="Gpills-three-example1-tab" data-toggle="pill" href="#Gpills-three-example1" role="tab" aria-controls="Gpills-three-example1" aria-selected="false">
                            <div class="d-md-flex justify-content-md-center align-items-md-center">
                                Cameras
                            </div>
                        </a>
                    </li>
                    <li class="nav-item flex-shrink-0 flex-lg-shrink-1">
                        <a class="nav-link " id="Gpills-four-example1-tab" data-toggle="pill" href="#Gpills-four-example1" role="tab" aria-controls="Gpills-four-example1" aria-selected="false">
                            <div class="d-md-flex justify-content-md-center align-items-md-center">
                                Audio
                            </div>
                        </a>
                    </li>
                    <li class="nav-item flex-shrink-0 flex-lg-shrink-1">
                        <a class="nav-link " id="Gpills-five-example1-tab" data-toggle="pill" href="#Gpills-five-example1" role="tab" aria-controls="Gpills-five-example1" aria-selected="false">
                            <div class="d-md-flex justify-content-md-center align-items-md-center">
                                Smartphones
                            </div>
                        </a>
                    </li>
                    <li class="nav-item flex-shrink-0 flex-lg-shrink-1">
                        <a class="nav-link " id="Gpills-six-example1-tab" data-toggle="pill" href="#Gpills-six-example1" role="tab" aria-controls="Gpills-six-example1" aria-selected="false">
                            <div class="d-md-flex justify-content-md-center align-items-md-center">
                                GPS & Navi
                            </div>
                        </a>
                    </li>
                    <li class="nav-item flex-shrink-0 flex-lg-shrink-1">
                        <a class="nav-link " id="Gpills-seven-example1-tab" data-toggle="pill" href="#Gpills-seven-example1" role="tab" aria-controls="Gpills-seven-example1" aria-selected="false">
                            <div class="d-md-flex justify-content-md-center align-items-md-center">
                                Computers
                            </div>
                        </a>
                    </li>
                    <li class="nav-item flex-shrink-0 flex-lg-shrink-1">
                        <a class="nav-link " id="Gpills-eight-example1-tab" data-toggle="pill" href="#Gpills-eight-example1" role="tab" aria-controls="Gpills-eight-example1" aria-selected="false">
                            <div class="d-md-flex justify-content-md-center align-items-md-center">
                                Portable Audio
                            </div>
                        </a>
                    </li>
                    <li class="nav-item flex-shrink-0 flex-lg-shrink-1">
                        <a class="nav-link " id="Gpills-nine-example1-tab" data-toggle="pill" href="#Gpills-nine-example1" role="tab" aria-controls="Gpills-nine-example1" aria-selected="false">
                            <div class="d-md-flex justify-content-md-center align-items-md-center">
                                Accessories
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- End Nav Classic -->

            <!-- Tab Content -->
            <div class="tab-content" id="Gpills-tabContent">
                <div class="tab-pane fade pt-2 show active" id="Gpills-one-example1" role="tabpanel" aria-labelledby="Gpills-one-example1-tab">
                    <div class="row no-gutters">
                        <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                            <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                                <li class="col-xl-12 col-wd-6">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6 col-wd-4 products-group-1">
                            <ul class="row list-unstyled products-group no-gutters bg-white h-100 mb-0">
                                <li class="col product-item remove-divider">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="d-flex flex-column">
                                                <div class="mb-1">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-40"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1 w-90"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-450"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <!-- Gallery -->
                                                    <div class="row mx-gutters-2">
                                                        <div class="col-auto">
                                                            <div class="bg-gray-1 width-60 height-60"></div>
                                                        </div>

                                                        <div class="col-auto">
                                                            <div class="bg-gray-1 width-60 height-60"></div>
                                                        </div>

                                                        <div class="col-auto">
                                                            <div class="bg-gray-1 width-60 height-60"></div>
                                                        </div>
                                                        <div class="col"></div>
                                                    </div>
                                                    <!-- End Gallery -->
                                                </div>
                                                <div class="flex-center-between">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-40"></div>
                                                    <div class="bg-gray-1 height-35 width-134 rounded-pill"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                            <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                                <li class="col-xl-12 col-wd-6">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade pt-2" id="Gpills-two-example1" role="tabpanel" aria-labelledby="Gpills-two-example1-tab">
                    <div class="row no-gutters">
                        <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                            <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                                <li class="col-xl-12 col-wd-6">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6 col-wd-4 products-group-1">
                            <ul class="row list-unstyled products-group no-gutters bg-white h-100 mb-0">
                                <li class="col product-item remove-divider">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="d-flex flex-column">
                                                <div class="mb-1">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-40"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1 w-90"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-450"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <!-- Gallery -->
                                                    <div class="row mx-gutters-2">
                                                        <div class="col-auto">
                                                            <div class="bg-gray-1 width-60 height-60"></div>
                                                        </div>

                                                        <div class="col-auto">
                                                            <div class="bg-gray-1 width-60 height-60"></div>
                                                        </div>

                                                        <div class="col-auto">
                                                            <div class="bg-gray-1 width-60 height-60"></div>
                                                        </div>
                                                        <div class="col"></div>
                                                    </div>
                                                    <!-- End Gallery -->
                                                </div>
                                                <div class="flex-center-between">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-40"></div>
                                                    <div class="bg-gray-1 height-35 width-134 rounded-pill"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                            <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                                <li class="col-xl-12 col-wd-6">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade pt-2" id="Gpills-three-example1" role="tabpanel" aria-labelledby="Gpills-three-example1-tab">
                    <div class="row no-gutters">
                        <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                            <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                                <li class="col-xl-12 col-wd-6">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6 col-wd-4 products-group-1">
                            <ul class="row list-unstyled products-group no-gutters bg-white h-100 mb-0">
                                <li class="col product-item remove-divider">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="d-flex flex-column">
                                                <div class="mb-1">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-40"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1 w-90"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-450"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <!-- Gallery -->
                                                    <div class="row mx-gutters-2">
                                                        <div class="col-auto">
                                                            <div class="bg-gray-1 width-60 height-60"></div>
                                                        </div>

                                                        <div class="col-auto">
                                                            <div class="bg-gray-1 width-60 height-60"></div>
                                                        </div>

                                                        <div class="col-auto">
                                                            <div class="bg-gray-1 width-60 height-60"></div>
                                                        </div>
                                                        <div class="col"></div>
                                                    </div>
                                                    <!-- End Gallery -->
                                                </div>
                                                <div class="flex-center-between">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-40"></div>
                                                    <div class="bg-gray-1 height-35 width-134 rounded-pill"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                            <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                                <li class="col-xl-12 col-wd-6">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade pt-2" id="Gpills-four-example1" role="tabpanel" aria-labelledby="Gpills-four-example1-tab">
                    <div class="row no-gutters">
                        <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                            <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                                <li class="col-xl-12 col-wd-6">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6 col-wd-4 products-group-1">
                            <ul class="row list-unstyled products-group no-gutters bg-white h-100 mb-0">
                                <li class="col product-item remove-divider">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="d-flex flex-column">
                                                <div class="mb-1">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-40"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1 w-90"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-450"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <!-- Gallery -->
                                                    <div class="row mx-gutters-2">
                                                        <div class="col-auto">
                                                            <div class="bg-gray-1 width-60 height-60"></div>
                                                        </div>

                                                        <div class="col-auto">
                                                            <div class="bg-gray-1 width-60 height-60"></div>
                                                        </div>

                                                        <div class="col-auto">
                                                            <div class="bg-gray-1 width-60 height-60"></div>
                                                        </div>
                                                        <div class="col"></div>
                                                    </div>
                                                    <!-- End Gallery -->
                                                </div>
                                                <div class="flex-center-between">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-40"></div>
                                                    <div class="bg-gray-1 height-35 width-134 rounded-pill"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                            <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                                <li class="col-xl-12 col-wd-6">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade pt-2" id="Gpills-five-example1" role="tabpanel" aria-labelledby="Gpills-five-example1-tab">
                    <div class="row no-gutters">
                        <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                            <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                                <li class="col-xl-12 col-wd-6">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6 col-wd-4 products-group-1">
                            <ul class="row list-unstyled products-group no-gutters bg-white h-100 mb-0">
                                <li class="col product-item remove-divider">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="d-flex flex-column">
                                                <div class="mb-1">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-40"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1 w-90"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-450"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <!-- Gallery -->
                                                    <div class="row mx-gutters-2">
                                                        <div class="col-auto">
                                                            <div class="bg-gray-1 width-60 height-60"></div>
                                                        </div>

                                                        <div class="col-auto">
                                                            <div class="bg-gray-1 width-60 height-60"></div>
                                                        </div>

                                                        <div class="col-auto">
                                                            <div class="bg-gray-1 width-60 height-60"></div>
                                                        </div>
                                                        <div class="col"></div>
                                                    </div>
                                                    <!-- End Gallery -->
                                                </div>
                                                <div class="flex-center-between">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-40"></div>
                                                    <div class="bg-gray-1 height-35 width-134 rounded-pill"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                            <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                                <li class="col-xl-12 col-wd-6">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade pt-2" id="Gpills-six-example1" role="tabpanel" aria-labelledby="Gpills-six-example1-tab">
                    <div class="row no-gutters">
                        <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                            <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                                <li class="col-xl-12 col-wd-6">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6 col-wd-4 products-group-1">
                            <ul class="row list-unstyled products-group no-gutters bg-white h-100 mb-0">
                                <li class="col product-item remove-divider">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="d-flex flex-column">
                                                <div class="mb-1">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-40"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1 w-90"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-450"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <!-- Gallery -->
                                                    <div class="row mx-gutters-2">
                                                        <div class="col-auto">
                                                            <div class="bg-gray-1 width-60 height-60"></div>
                                                        </div>

                                                        <div class="col-auto">
                                                            <div class="bg-gray-1 width-60 height-60"></div>
                                                        </div>

                                                        <div class="col-auto">
                                                            <div class="bg-gray-1 width-60 height-60"></div>
                                                        </div>
                                                        <div class="col"></div>
                                                    </div>
                                                    <!-- End Gallery -->
                                                </div>
                                                <div class="flex-center-between">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-40"></div>
                                                    <div class="bg-gray-1 height-35 width-134 rounded-pill"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                            <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                                <li class="col-xl-12 col-wd-6">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade pt-2" id="Gpills-seven-example1" role="tabpanel" aria-labelledby="Gpills-seven-example1-tab">
                    <div class="row no-gutters">
                        <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                            <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                                <li class="col-xl-12 col-wd-6">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6 col-wd-4 products-group-1">
                            <ul class="row list-unstyled products-group no-gutters bg-white h-100 mb-0">
                                <li class="col product-item remove-divider">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="d-flex flex-column">
                                                <div class="mb-1">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-40"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1 w-90"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-450"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <!-- Gallery -->
                                                    <div class="row mx-gutters-2">
                                                        <div class="col-auto">
                                                            <div class="bg-gray-1 width-60 height-60"></div>
                                                        </div>

                                                        <div class="col-auto">
                                                            <div class="bg-gray-1 width-60 height-60"></div>
                                                        </div>

                                                        <div class="col-auto">
                                                            <div class="bg-gray-1 width-60 height-60"></div>
                                                        </div>
                                                        <div class="col"></div>
                                                    </div>
                                                    <!-- End Gallery -->
                                                </div>
                                                <div class="flex-center-between">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-40"></div>
                                                    <div class="bg-gray-1 height-35 width-134 rounded-pill"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                            <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                                <li class="col-xl-12 col-wd-6">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade pt-2" id="Gpills-eight-example1" role="tabpanel" aria-labelledby="Gpills-eight-example1-tab">
                    <div class="row no-gutters">
                        <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                            <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                                <li class="col-xl-12 col-wd-6">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6 col-wd-4 products-group-1">
                            <ul class="row list-unstyled products-group no-gutters bg-white h-100 mb-0">
                                <li class="col product-item remove-divider">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="d-flex flex-column">
                                                <div class="mb-1">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-40"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1 w-90"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-450"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <!-- Gallery -->
                                                    <div class="row mx-gutters-2">
                                                        <div class="col-auto">
                                                            <div class="bg-gray-1 width-60 height-60"></div>
                                                        </div>

                                                        <div class="col-auto">
                                                            <div class="bg-gray-1 width-60 height-60"></div>
                                                        </div>

                                                        <div class="col-auto">
                                                            <div class="bg-gray-1 width-60 height-60"></div>
                                                        </div>
                                                        <div class="col"></div>
                                                    </div>
                                                    <!-- End Gallery -->
                                                </div>
                                                <div class="flex-center-between">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-40"></div>
                                                    <div class="bg-gray-1 height-35 width-134 rounded-pill"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                            <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                                <li class="col-xl-12 col-wd-6">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade pt-2" id="Gpills-nine-example1" role="tabpanel" aria-labelledby="Gpills-nine-example1-tab">
                    <div class="row no-gutters">
                        <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                            <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                                <li class="col-xl-12 col-wd-6">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6 col-wd-4 products-group-1">
                            <ul class="row list-unstyled products-group no-gutters bg-white h-100 mb-0">
                                <li class="col product-item remove-divider">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="d-flex flex-column">
                                                <div class="mb-1">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-40"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1 w-90"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-450"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <!-- Gallery -->
                                                    <div class="row mx-gutters-2">
                                                        <div class="col-auto">
                                                            <div class="bg-gray-1 width-60 height-60"></div>
                                                        </div>

                                                        <div class="col-auto">
                                                            <div class="bg-gray-1 width-60 height-60"></div>
                                                        </div>

                                                        <div class="col-auto">
                                                            <div class="bg-gray-1 width-60 height-60"></div>
                                                        </div>
                                                        <div class="col"></div>
                                                    </div>
                                                    <!-- End Gallery -->
                                                </div>
                                                <div class="flex-center-between">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-40"></div>
                                                    <div class="bg-gray-1 height-35 width-134 rounded-pill"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                            <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                                <li class="col-xl-12 col-wd-6">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                    <div class="h-100 w-100 prodcut-box-shadow">
                                        <div class="bg-white p-3">
                                            <div class="pb-xl-2">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="bg-gray-1 height-190"></div>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                    <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Tab Content -->
        </div>
        <!-- End Features Section -->
    </div>
    <!-- End Products-4-1-4 -->
    <div class="container">
    @if(false)
        <!-- Full banner -->
            <div class="mb-6">
                <a href="../shop/shop.html" class="d-block text-gray-90">
                    <div class="" style="background-image: url(/img/1400X206/img1.jpg);">
                        <div class="space-top-2-md p-4 pt-6 pt-md-8 pt-lg-6 pt-xl-8 pb-lg-4 px-xl-8 px-lg-6">
                            <div class="flex-horizontal-center mt-lg-3 mt-xl-0 overflow-auto overflow-md-visble">
                                <h1 class="text-lh-38 font-size-32 font-weight-light mb-0 flex-shrink-0 flex-md-shrink-1">SHOP AND <strong>SAVE BIG</strong> ON HOTTEST TABLETS</h1>
                                <div class="ml-5 flex-content-center flex-shrink-0">
                                    <div class="bg-primary rounded-lg px-6 py-2">
                                        <em class="font-size-14 font-weight-light">STARTING AT</em>
                                        <div class="font-size-30 font-weight-bold text-lh-1">
                                            <sup class="">$</sup>79<sup class="">99</sup>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- End Full banner -->


            <!-- Recently viewed -->
            <div class="mb-6">
                <div class="position-relative">
                    <div class="border-bottom border-color-1 mb-2">
                        <h3 class="section-title mb-0 pb-2 font-size-22">Recently Viewed</h3>
                    </div>
                    <div class="js-slick-carousel u-slick position-static overflow-hidden u-slick-overflow-visble pb-7 pt-2 px-1"
                         data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-3 mt-md-0"
                         data-slides-show="7"
                         data-slides-scroll="1"
                         data-arrows-classes="position-absolute top-0 font-size-17 u-slick__arrow-normal top-10"
                         data-arrow-left-classes="fa fa-angle-left right-1"
                         data-arrow-right-classes="fa fa-angle-right right-0"
                         data-responsive='[{
                                  "breakpoint": 1400,
                                  "settings": {
                                    "slidesToShow": 6
                                  }
                                }, {
                                    "breakpoint": 1200,
                                    "settings": {
                                      "slidesToShow": 4
                                    }
                                }, {
                                  "breakpoint": 992,
                                  "settings": {
                                    "slidesToShow": 3
                                  }
                                }, {
                                  "breakpoint": 768,
                                  "settings": {
                                    "slidesToShow": 2
                                  }
                                }, {
                                  "breakpoint": 554,
                                  "settings": {
                                    "slidesToShow": 2
                                  }
                                }]'>
                        <div class="js-slide products-group">
                            <div class="product-item">
                                <div class="product-item__outer h-100">
                                    <div class="product-item__inner px-wd-4 p-2 p-md-3">
                                        <div class="product-item__body pb-xl-2">
                                            <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                            <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                            <div class="mb-2">
                                                <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/img/212X200/img1.jpg" alt="Image Description"></a>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="prodcut-price">
                                                    <div class="text-gray-100">$685,00</div>
                                                </div>
                                                <div class="d-none d-xl-block prodcut-add-cart">
                                                    <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-item__footer">
                                            <div class="border-top pt-2 flex-center-between flex-wrap">
                                                <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Recently viewed -->
    @endif

    <!-- Brand Carousel -->
        <div class="mb-8 mt-8">
            <div class="py-2 border-top border-bottom">
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
                    <div class="js-slide">
                        <a href="#" class="link-hover__brand">
                            <img class="img-fluid m-auto max-height-50" src="/img/200X60/img1.png" alt="Image Description">
                        </a>
                    </div>
                    <div class="js-slide">
                        <a href="#" class="link-hover__brand">
                            <img class="img-fluid m-auto max-height-50" src="/img/200X60/img2.png" alt="Image Description">
                        </a>
                    </div>
                    <div class="js-slide">
                        <a href="#" class="link-hover__brand">
                            <img class="img-fluid m-auto max-height-50" src="/img/200X60/img3.png" alt="Image Description">
                        </a>
                    </div>
                    <div class="js-slide">
                        <a href="#" class="link-hover__brand">
                            <img class="img-fluid m-auto max-height-50" src="/img/200X60/img4.png" alt="Image Description">
                        </a>
                    </div>
                    <div class="js-slide">
                        <a href="#" class="link-hover__brand">
                            <img class="img-fluid m-auto max-height-50" src="/img/200X60/img5.png" alt="Image Description">
                        </a>
                    </div>
                    <div class="js-slide">
                        <a href="#" class="link-hover__brand">
                            <img class="img-fluid m-auto max-height-50" src="/img/200X60/img6.png" alt="Image Description">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Brand Carousel -->
    </div>
@stop

