@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="mb-5">
            <h1 class="text-center">Оформление заказа</h1>
        </div>

        <form class="ajax__submit" action="{{ route('checkout', compact('lang')) }}">
            {{ csrf_field() }}
            <div class="row cart-checkout">
                <div class="col-lg-5 order-lg-2 mb-7 mb-lg-0 col1">
                    <div class="pl-lg-3 ">
                        <div class="bg-gray-1 rounded-lg">
                            <!-- Order Summary -->
                            <div class="p-4 mb-4 checkout-table">
                                <!-- Title -->
                                <div class="border-bottom border-color-1 mb-5">
                                    <h3 class="section-title mb-0 pb-2 font-size-25">Инвойс</h3>
                                </div>
                                <!-- End Title -->

                                <!-- Product Content -->
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="product-name">Товар</th>
                                        <th class="product-total">Цена</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        <tr class="cart_item">
                                            <td>{{ $product['name'] }}&nbsp;<strong class="product-quantity">× {{ $product['qty'] }}</strong></td>
                                            <td>{{ RUB }} {{ priceString($product['qty']*$product['price']) }}</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Итого</th>
                                        <td><strong>{{ RUB }} {{priceString(cart()->getTotalPrice())}}</strong></td>
                                    </tr>
                                    </tfoot>
                                </table>
                                <!-- End Product Content -->
                                <div class="border-top border-width-3 border-color-1 pt-3 mb-3">
                                    <!-- Basics Accordion -->
                                    <div id="basicsAccordion1">
                                        <!-- Card -->
                                        <div class="border-bottom border-color-1 border-dotted-bottom">
                                            <div class="p-3" id="basicsHeadingOne">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" id="stylishRadio1" name="payment_type" value="bank_transfer">
                                                    <label class="custom-control-label form-label" for="stylishRadio1"
                                                           data-toggle="collapse"
                                                           data-target="#basicsCollapseOnee"
                                                           aria-expanded="true"
                                                           aria-controls="basicsCollapseOnee">
                                                        Банковский перевод
                                                    </label>
                                                </div>
                                            </div>
                                            <div id="basicsCollapseOnee" class="collapse border-top border-color-1 border-dotted-top bg-dark-lighter"
                                                 aria-labelledby="basicsHeadingOne"
                                                 data-parent="#basicsAccordion1">
                                                <div class="p-4">
                                                    Описание
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Card -->

                                        <!-- Card -->
                                        <div class="border-bottom border-color-1 border-dotted-bottom">
                                            <div class="p-3" id="basicsHeadingTwo">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" id="secondStylishRadio1" name="payment_type" value="card">
                                                    <label class="custom-control-label form-label" for="secondStylishRadio1"
                                                           data-toggle="collapse"
                                                           data-target="#basicsCollapseTwo"
                                                           aria-expanded="false"
                                                           aria-controls="basicsCollapseTwo">
                                                        Кредитной картой
                                                    </label>
                                                </div>
                                            </div>
                                            <div id="basicsCollapseTwo" class="collapse border-top border-color-1 border-dotted-top bg-dark-lighter"
                                                 aria-labelledby="basicsHeadingTwo"
                                                 data-parent="#basicsAccordion1">
                                                <div class="p-4">
                                                   Описание
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Card -->

                                        <!-- Card -->
                                        <div class="border-bottom border-color-1 border-dotted-bottom">
                                            <div class="p-3" id="basicsHeadingThree">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" id="thirdstylishRadio1" name="payment_type" value="cash">
                                                    <label class="custom-control-label form-label" for="thirdstylishRadio1"
                                                           data-toggle="collapse"
                                                           data-target="#basicsCollapseThree"
                                                           aria-expanded="false"
                                                           aria-controls="basicsCollapseThree">
                                                        Наличными
                                                    </label>
                                                </div>
                                            </div>
                                            <div id="basicsCollapseThree" class="collapse border-top border-color-1 border-dotted-top bg-dark-lighter"
                                                 aria-labelledby="basicsHeadingThree"
                                                 data-parent="#basicsAccordion1">
                                                <div class="p-4">
                                                    Описание
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Card -->

                                    </div>
                                    <!-- End Basics Accordion -->
                                </div>
                                <div class="form-group d-flex align-items-center justify-content-between px-3 mb-5">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="defaultCheck10" name="agree">
                                        <label class="form-check-label form-label" for="defaultCheck10">
                                            Я ознакомился с <a href="#" class="text-blue">условиями и политикой конфиденциальности </a>
                                            сайта
                                            <span class="text-danger">*</span>
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary-dark-w btn-block btn-pill font-size-20 mb-3 py-3 submit-btn">Оформить</button>
                            </div>
                            <!-- End Order Summary -->
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 order-lg-1 col2">
                    <div class="pb-7 mb-7">
                        <!-- Title -->
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title mb-0 pb-2 font-size-25">Контактная информация</h3>
                        </div>
                        <!-- End Title -->

                        <!-- Billing Form -->
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        Имя
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                           class="form-control"
                                           name="name"
                                           placeholder="Имя"
                                           autocomplete="off"
                                           value="{{ user()->name }}">
                                </div>
                                <!-- End Input -->
                            </div>

                            <div class="col-md-6">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        Фамилия
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                           class="form-control"
                                           name="lastname"
                                           placeholder="Фамилия"
                                           autocomplete="off"
                                           
                                           value="">
                                </div>
                                <!-- End Input -->
                            </div>

                            <div class="w-100"></div>

                            <div class="col-md-12">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        Компания
                                    </label>
                                    <input type="text"
                                           class="form-control"
                                           name="company"
                                           placeholder="Компания"
                                           autocomplete="off"
                                           value="">
                                </div>
                                <!-- End Input -->
                            </div>

                            <div class="col-md-4">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        Город
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                           class="form-control"
                                           name="city"
                                           placeholder="Город"
                                           autocomplete="off"
                                           
                                           value="">
                                </div>
                                <!-- End Input -->
                            </div>

                            <div class="col-md-4">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        Улица
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                           class="form-control"
                                           name="street"
                                           placeholder="Улица"
                                           autocomplete="off"
                                           
                                           value="">
                                </div>
                                <!-- End Input -->
                            </div>

                            <div class="col-md-4">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        Номер дома/кв
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                           class="form-control"
                                           name="house"
                                           placeholder="Номер дома/кв"
                                           autocomplete="off"
                                           
                                           value="">
                                </div>
                                <!-- End Input -->
                            </div>

                            <div class="w-100"></div>


                            <div class="col-md-12">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        Телефон
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                           class="form-control"
                                           name="phone"
                                           placeholder="Телефон"
                                           autocomplete="off"
                                           
                                           value="{{ user()->phone }}">
                                </div>
                                <!-- End Input -->
                            </div>

                            <div class="w-100"></div>
                        </div>
                        <!-- End Billing Form -->


                        <!-- Input -->
                        <div class="js-form-message mb-6">
                            <label class="form-label">
                                Комментарий
                            </label>

                            <div class="input-group">
                                <textarea class="form-control p-5" rows="4" name="comment" placeholder="Укажите комментарий к заказу/доставке"></textarea>
                            </div>
                        </div>
                        <!-- End Input -->
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop