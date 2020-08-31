@extends('profile.layout')

@section('profile')
    <div class="col-lg-12 order-lg-1">
        <div class="pb-7 mb-7">
            <div class="catalog-product">
                <div style="margin-bottom: 10px;">
                    <a href="{{ route('profile_add_product', compact('lang')) }}"
                       class="btn btn-primary btn-xs"><i class="fa fa-plus" aria-hidden="true"></i>
                         Добавить
                    </a>
                </div>

                @if($products->count())
                    <ul class="row list-unstyled products-group no-gutters">
                        @foreach($products as $product)
                            <li class="col-6 col-md-3 col-wd-2gdot4 product-item js_list__item">
                                <div class="product-item__outer h-100">
                                    <div class="product-item__inner px-xl-4 p-3">
                                        <div class="product-item__body pb-xl-2">
                                            <div class="mb-2"><a target="_blank" href="{{ setUri("catalog/{$product->category->url}") }}" class="font-size-12 text-gray-5">{{ $product->category["name_$lang"] }}</a></div>
                                            <h5 class="mb-1 product-item__title">
                                                <a target="_blank" href="{{ route('view_product', ['lang' => lang(), 'url' => $product->url]) }}" class="text-blue font-weight-bold">{{ $product["name_$lang"] }}</a>
                                            </h5>
                                            <div class="mb-2">
                                                <a target="_blank" href="{{ route('view_product', ['lang' => lang(), 'url' => $product->url]) }}" class="d-block text-center">
                                                    <img class="img-fluid" src="{{ imageThumb(@$product->images->first()->image, 'uploads/products', 212, 200, 'list') }}" alt="{{ $product["name_$lang"] }}">
                                                </a>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="prodcut-price">
                                                    <div class="text-gray-100">
                                                        <small>От</small>
                                                        {{ RUB }}{{ priceString(@$product->prices->first()->price) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-item__footer">
                                            <div class="border-top pt-2 flex-center-between flex-wrap">
                                                <a href="{{ route('view_edit_product', ['lang' => $lang, 'id' => $product->id]) }}" class="text-gray-6 font-size-13">
                                                    <i class="fa fa-pencil font-size-15" aria-hidden="true"></i>
                                                    Изменить
                                                </a>

                                                <a href="{{ route('delete_product', ['lang' => $lang, 'id' => $product->id]) }}"
                                                   data-confirm="Вы действительно хотите удалить?"
                                                   class="text-gray-6 font-size-13 confirm_link">
                                                    <i class="fa fa-trash-o font-size-15" aria-hidden="true"></i>
                                                    Удалить
                                                </a>

                                            </div>
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
        </div>
    </div>

@stop