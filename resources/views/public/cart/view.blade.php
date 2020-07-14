@extends('layouts.public')

@section('content')

<div class="container">
    <div class="mb-4">
        <h1 class="text-center">Корзина</h1>
    </div>
    <div class="mb-10 cart-table">
        <form class="mb-4" action="#" method="post">
            <table class="table" cellspacing="0">
                <thead>
                <tr>
                    <th class="product-remove">&nbsp;</th>
                    <th class="product-thumbnail">&nbsp;</th>
                    <th class="product-name">Наиминование</th>
                    <th class="product-price">Цена</th>
                    <th class="product-quantity w-lg-15">Кол-во</th>
                    <th class="product-subtotal">Итог</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr class="cart-item-{{ $product['id'] }}-{{ $product['cart_id'] }}">
                            <td class="text-center">
                                <a href="#" class="text-gray-32 font-size-26">×</a>
                            </td>
                            <td class="d-none d-md-table-cell">
                                <a href="#">
                                    <img class="img-fluid max-width-100 p-1 border border-color-1"
                                         src="{{ $product['image'] }}"
                                         alt="{{ $product['name'] }}">
                                </a>
                            </td>

                            <td data-title="Product">
                                <a href="#" class="text-gray-90">{{ $product['name'] }}</a>
                                @if($product['chars']->count())
                                    <br>
                                    <small>
                                        @php
                                            echo $product['chars']->map(function ($item) {
                                                return $item['name'] . ': ' . $item['value'];
                                            })->implode(', ');
                                        @endphp
                                    </small>
                                @endif
                            </td>

                            <td data-title="Price">
                                <span class="product-price-{{ $product['id'] }}-{{ $product['cart_id'] }}">{{ RUB }} {{ priceString($product['price']) }}</span>
                            </td>

                            <td data-title="Quantity">
                                <span class="sr-only">Кол-во</span>
                                <!-- Quantity -->
                                <div class="border rounded-pill py-1 width-122 w-xl-80 px-3 border-color-1">
                                    <div class="js-quantity row align-items-center">
                                        <div class="col">
                                            <input class="js-result form-control h-auto border-0 rounded p-0 shadow-none"
                                                   type="text"
                                                   value="{{ $product['qty'] }}">
                                        </div>
                                        <div class="col-auto pr-1">
                                            <a class="js-minus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0" href="javascript:;">
                                                <small class="fas fa-minus btn-icon__inner"></small>
                                            </a>
                                            <a class="js-plus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0" href="javascript:;">
                                                <small class="fas fa-plus btn-icon__inner"></small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Quantity -->
                            </td>

                            <td data-title="Total">
                                <span class="total-product-price-{{ $product['id'] }}-{{ $product['cart_id'] }}">
                                    {{ RUB }} {{ priceString($product['price']*$product['qty']) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    </div>
    <div class="mb-8 cart-total">
        <div class="row">
            <div class="col-xl-5 col-lg-6 offset-lg-6 offset-xl-7 col-md-8 offset-md-4">
                <div class="border-bottom border-color-1 mb-3">
                    <h3 class="d-inline-block section-title mb-0 pb-2 font-size-26">Стоимость заказа</h3>
                </div>
                <table class="table mb-3 mb-md-0">
                    <tbody>
{{--                    <tr class="cart-subtotal">--}}
{{--                        <th>Subtotal</th>--}}
{{--                        <td data-title="Subtotal"><span class="amount">$1,785.00</span></td>--}}
{{--                    </tr>--}}
{{--                    <tr class="shipping">--}}
{{--                        <th>Shipping</th>--}}
{{--                        <td data-title="Shipping">--}}
{{--                            Flat Rate: <span class="amount">$300.00</span>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
                    <tr class="order-total">
                        <th>Итог</th>
                        <td data-title="Total">
                            <strong><span class="amount">{{ RUB }} {{ priceString(cart()->getTotalPrice()) }}</span></strong>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <button type="button" class="btn btn-primary-dark-w ml-md-2 px-5 px-md-4 px-lg-5 w-100 w-md-auto d-md-none">Proceed to checkout</button>
            </div>
        </div>
    </div>
</div>
@stop