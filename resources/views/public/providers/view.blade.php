@extends('layouts.public')

@section('content')
    <div class="container">
        <!-- Single Product Body -->
        <div class="mb-xl-14 mb-6">
            <div class="row">
                <div class="col-md-3 mb-4 mb-md-0">

                    <div id="sliderSyncingNav" class="js-slick-carousel u-slick mb-2"
                         data-infinite="true"
                         data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-classic u-slick__arrow-centered--y rounded-circle"
                         data-arrow-left-classes="fas fa-arrow-left u-slick__arrow-classic-inner u-slick__arrow-classic-inner--left ml-lg-2 ml-xl-4"
                         data-arrow-right-classes="fas fa-arrow-right u-slick__arrow-classic-inner u-slick__arrow-classic-inner--right mr-lg-2 mr-xl-4"
                         data-nav-for="#sliderSyncingThumb">
                        <div class="js-slide">
                            <img class="img-fluid" src="{{ imageThumb($provider->image, 'uploads/users', 720, 660, '720X660') }}" style="width: 100%" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-9 mb-md-6 mb-lg-0">
                    <div class="mb-2">
                        <div class="border-bottom mb-3 pb-md-1 pb-3">
                            <h2 class="font-size-25 text-lh-1dot2">{{ $provider["name"] }}</h2>
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

                            </div>
                        </div>

                        @if($provider->description)
                            <p>{{ $provider["description"] }}</p>
                            <hr>
                        @endif
                        <div class="mb-2">

                            @foreach($providersCats[$provider->id]->sortByDesc('countProducts')->take(4) as $provider_cat)
                                <a href="{{ route('view_catalog', ['lang' => $lang, 'url' => $provider_cat['category_data']['url'], 'providers' => $provider->id]) }}"
                                   class="font-size-14 text-blue d-block"
                                   style="width: 100%; margin-bottom: 4px;">
                                    <i class="fa fa-angle-right"></i> &nbsp;
                                    {{ $provider_cat['category_data']["name_$lang"] }}
                                </a>
                            @endforeach

                        </div>


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


            <div class="mb-8">
                <div class="position-relative position-md-static px-md-6">
                    <ul class="nav nav-classic nav-tab nav-tab-lg justify-content-xl-center flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble border-0 pb-1 pb-xl-0 mb-n1 mb-xl-0" id="pills-tab-8" role="tablist">
                        @if($services->count())
                            <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                                <a class="nav-link active" data-toggle="pill" href="#serv-tab" role="tab" aria-controls="serv-tab" aria-selected="true">
                                    Услуги
                                </a>
                            </li>
                        @endif

                        @if($provider->files->count())
                            <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                                <a class="nav-link"  data-toggle="pill" href="#file-tab" role="tab" aria-controls="file-tab" aria-selected="false">
                                    Файлы
                                </a>
                            </li>
                        @endif

                        @if($provider->text)
                            <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                                <a class="nav-link"  data-toggle="pill" href="#info-tab" role="tab" aria-controls="info-tab" aria-selected="false">
                                    Информация
                                </a>
                            </li>
                        @endif

                        <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                            <a class="nav-link"  data-toggle="pill" href="#contacts-tab" role="tab" aria-controls="contacts-tab" aria-selected="false">
                                Контакты
                            </a>
                        </li>

                    </ul>
                </div>
                <!-- Tab Content -->
                <div class="borders-radius-17 border p-4 mt-4 mt-md-0 px-lg-10 py-lg-9">
                    <div class="tab-content" id="Jpills-tabContent">

                        <div class="tab-pane fade active show" id="serv-tab" role="tabpanel" aria-labelledby="serv-tab">
                            <div class="row">
                                @foreach($services as $key => $char)
                                    <div class="col-md-3 provider-serv">
                                        <h6 class="font-weight-bold">{{ $char['name'] }}</h6>

                                        @if($char['type'] == 'input')
                                            <p><i class="mr-2 fas fa-angle-right"></i> {{ $char['value'] }}</p>
                                        @else
                                            @foreach($char['value'] as $item)
                                                <p><i class="mr-2 fas fa-angle-right"></i> {{ $item['name'] }}</p>
                                            @endforeach
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="file-tab" role="tabpanel" aria-labelledby="file-tab">
                            <div class="mx-md-5 pt-1">
                                @foreach($provider->files as $file)
                                    <div class="row">
                                        <div class="col-md-2 d-flex align-items-center justify-content-center">
                                            <a class="file-icon" href="{{ route('provider_dwn_file', ['lang' => $lang, 'id' => $file->id]) }}">
                                                {{ explode('.', $file->file)[1] }}
                                                &nbsp;
                                                <i class="fa fa-download" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                        <div class="col-md-10">
                                            <h5 class="font-weight-bold">
                                                {{ $file->name_ru }}
                                            </h5>
                                            <p>
                                                {{ nl2br($file->description_ru) }}
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                @endforeach
                            </div>
                        </div>

                        <div class="tab-pane fade" id="info-tab" role="tabpanel" aria-labelledby="info-tab">
                            <div class="mx-md-5 pt-1">
                                <div>
                                    {!! $provider->text !!}
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="contacts-tab" role="tabpanel" aria-labelledby="contacts-tab">
                            <div class="mx-md-5 pt-1">
                                <div class="row justify-content-center">

                                    @if($provider->office_address || $provider->warehouse_address)
                                        <div class="col-md-3 provider-serv">
                                            @if($provider->office_address)
                                                <h6 class="font-weight-bold">Офис</h6>
                                                <p>{{ $provider->office_address }}</p>
                                            @endif

                                            @if($provider->warehouse_address)
                                                <h6 class="font-weight-bold mt-4">Склад</h6>
                                                <p>{{ $provider->warehouse_address }}</p>
                                            @endif
                                        </div>
                                    @endif

                                    <div class="col-md-3 provider-serv">
                                        @if($provider->work_from && $provider->work_to)
                                            <h6 class="font-weight-bold">
                                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                                                {{ $provider->work_from }} - {{ $provider->work_to }}
                                            </h6>
                                        @endif

                                        @if($provider->phone1)
                                            <p>
                                                <i class="fa fa-phone" aria-hidden="true"></i>
                                                {{ $provider->phone1 }}
                                            </p>
                                        @endif

                                        @if($provider->phone2)
                                            <p>
                                                <i class="fa fa-phone" aria-hidden="true"></i>
                                                {{ $provider->phone2 }}
                                            </p>
                                        @endif

                                        @if($provider->contact_email || $provider->feedback_email)
                                            <p>
                                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                                {!! $provider->contact_email ? '<a href="mailto:'.$provider->contact_email.'">'.$provider->contact_email.'</a>' : '' !!}
                                                {!! $provider->feedback_email ? '<a href="mailto:'.$provider->feedback_email.'">'.$provider->feedback_email.'</a>' : '' !!}
                                            </p>
                                        @endif

                                        @if($provider->site)
                                            <p>
                                                <i class="fa fa-globe" aria-hidden="true"></i>
                                                {{ $provider->site }}
                                            </p>
                                        @endif

                                        @if($provider->skype)
                                            <p>
                                                <i class="fa fa-skype" aria-hidden="true"></i>
                                                {{ $provider->skype }}
                                            </p>
                                        @endif
                                    </div>

                                    @if($provider->other_contacts)
                                        <div class="col-md-3 provider-serv">
                                            <h6 class="font-weight-bold">Другие контакты</h6>
                                            <p>{{ $provider->other_contacts }}</p>
                                        </div>
                                    @endif

                                    @if($provider->info)
                                        <div class="col-md-3 provider-serv">
                                            <h6 class="font-weight-bold">Информация</h6>
                                            <p>{{ $provider->info }}</p>
                                        </div>
                                    @endif
                                </div>

                                <div class="border-bottom border-color-1 mb-5 mt-10">
                                    <h3 class="section-title mb-0 pb-2 font-size-25">Связаться</h3>
                                </div>
                                <!-- End Title -->

                                <!-- Billing Form -->
                                <form action="{{ route('provider_send_contact', ['lang' => $lang, 'id' => $provider->id]) }}"
                                      class="ajax__submit" onsubmit="return false">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- Input -->
                                            <div class="js-form-message mb-6">
                                                <label class="form-label">
                                                    Имя
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" name="name" value="" autocomplete="off">
                                            </div>
                                            <!-- End Input -->
                                        </div>

                                        <div class="col-md-6">
                                            <!-- Input -->
                                            <div class="js-form-message mb-6">
                                                <label class="form-label">
                                                    E-mail
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="email" class="form-control" name="email" value="" autocomplete="off">
                                            </div>
                                            <!-- End Input -->
                                        </div>

                                        <div class="col-md-6">
                                            <!-- Input -->
                                            <div class="js-form-message mb-6">
                                                <label class="form-label">
                                                    Телефон
                                                </label>
                                                <input type="text" class="form-control" name="phone" value="" autocomplete="off">
                                            </div>
                                            <!-- End Input -->
                                        </div>

                                        <div class="w-100"></div>

                                        <div class="col-md-12 mb-5">
                                            <label class="form-label">
                                                Сообщение
                                            </label>
                                            <textarea name="message" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary-dark-w mt-5 submit-btn">
                                        Отправить
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- End Tab Content -->
            </div>

        <style>
            .file-icon {
                background: #f23c0f;
                width: 50px;
                height: 50px;
                display: flex;
                border-radius: 10px;
                justify-content: center;
                align-items: center;
                color: #fff !important;
            }

            .file-icon:hover {
                background: #c7330e;
                cursor: pointer;
                color: #ededed;
            }
        </style>

    <!-- End Single Product Tab -->

        @if($products->count())
            <div class="mb-6">
                <div class="d-flex justify-content-between align-items-center border-bottom border-color-1 flex-lg-nowrap flex-wrap mb-4">
                    <h3 class="section-title mb-0 pb-2 font-size-22">Популярные товары</h3>
                </div>
                <ul class="row list-unstyled products-group no-gutters">
                    @foreach($products as $item)
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