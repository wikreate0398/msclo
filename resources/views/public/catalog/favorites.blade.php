@extends('layouts.public')

@section('content')
    <div class="container in-wrapper" style="min-height: 400px;">
        <div class="my-6">
            <h1 class="text-center">Избранное</h1>
        </div>

        @if($products->count())
            <div class="mb-16 wishlist-table">
                <div class="table-responsive">
                    <table class="table" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="product-remove">&nbsp;</th>
                                <th class="product-thumbnail">&nbsp;</th>
                                <th class="product-name">Наиминование</th>
                                <th class="product-price">Цена</th>
                                <th class="product-Stock w-lg-15">Статус</th>
                                <th class="product-subtotal min-width-200-md-lg">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($products as $product)
                            <tr>
                                <td class="text-center">
                                    <a href="javascript:;" onclick="addToFav(this, {{ $product->id }}, true); return false;" class="text-gray-32 font-size-26 active">×</a>
                                </td>
                                <td class="d-none d-md-table-cell">
                                    <a href="{{ setUri("product/{$product->url}") }}">
                                        <img class="img-fluid max-width-100 p-1 border border-color-1"
                                             src="{{ imageThumb(@$product->images->first()->image, 'uploads/products', 300, 0, '300X0') }}">
                                    </a>
                                </td>

                                <td data-title="Product">
                                    <a href="{{ setUri("product/{$product->url}") }}" class="text-gray-90">{{ $product["name_$lang"] }}</a>
                                </td>

                                <td data-title="Unit Price">
                                    @if($product->prices->count())
                                        <span class="">{{ RUB }}{{ priceString($product->prices->first()->price) }}</span>
                                    @else
                                        -
                                    @endif
                                </td>

                                <td data-title="Stock Status">

                                    @if($product->prices->count())
                                        <span>В наличии</span>
                                    @else
                                        <span>Нет в наличии</span>
                                    @endif
                                </td>

                                <td>
                                    <button type="button"
                                            class="btn btn-soft-secondary mb-3 mb-md-0 font-weight-normal px-5 px-md-4 px-lg-5 w-100 w-md-auto"
                                            onclick="showModalCart(this, {{ $product->id }})">
                                        Добавить в корзину
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="alert alert-warning">
                Нет товаров
            </div>
        @endif
    </div>
@stop