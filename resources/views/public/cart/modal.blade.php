<div class="cart-modal-wrapper d-flex">
    <div class="cart-modal-thumb">
        <a href="{{ route('view_product', ['lang' => $lang, 'url' => $product->url]) }}">
            <img src="{{ imageThumb(@$product->images->first()->image, 'uploads/products', 212, 0, '212X0') }}" alt="">
        </a>
    </div>
    <div class="cart-modal-info">
        <h2 class="font-size-25 text-lh-1dot2">
            {{ $product["name_$lang"] }}
        </h2>
        <p style="margin: 0">{{ $product["description_$lang"] }}</p>

        <form action="{{ route('add_to_cart', ['lang' => $lang]) }}"
              onsubmit="addToCart(this); return false;"
              class="add-cart-form">

            <div class="mb-4">
                <div class="d-flex align-items-baseline">
                    @php
                        $price        = $product->prices->sortBy('quantity')->first()['price'];
                        $minPriceData = $product->prices->sortBy('price')->first();
                    @endphp
                    <ins class="font-size-25 text-decoration-none">
                        {{-- {{ RUB }} --}}
                        <span class="product-price-{{ $product->id }}">
                            {{ priceString($price) }}
                        </span>
                        Р
                    </ins>
                </div>
                @if($price > $minPriceData->price)
                    <span class="font-size-14 text-gray-6">
                        от {{ $minPriceData->quantity }}шт -
                        {{-- {{ RUB }} --}}
                        {{ priceString($minPriceData->price) }}
                    </span>
                    Р
                @endif
            </div>


            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{ $product->id }}">
            <div class="border-top border-bottom py-3 mb-4 d-flex">
                @foreach($charsCart as $item)
                    @if($item['value']->count())
                        <div class="d-flex align-items-center" style="margin-right: 15px;">
                            <!-- Select -->
                            <select class="js-select selectpicker dropdown-select ml-3"
                                    data-style="btn-sm bg-white font-weight-normal py-2 border"
                                    name="char[{{ $item['id'] }}]">
                                <option value="0">{{ $item['name'] }} *</option>
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
                                <input class="js-result cart-input-{{ $product->id }}-1 bg-white form-control h-auto border-0 rounded p-0 shadow-none"
                                       type="text"
                                       onkeyup="this.value=this.value.replace(/[^\d]/,'')"
                                       min="1"
                                       value="1"
                                       name="qty"
                                       onchange="changePriceByQty(this, {{ $product->id }})">
                            </div>
                            <div class="col-auto pr-1">
                                <a class="btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0"
                                   href="javascript:;"
                                   onclick="changeQuantityValue('down', {{ $product->id }},'1')"
                                   >
                                    <small class="fas fa-minus btn-icon__inner"></small>
                                </a>
                                <a class="btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0"
                                   href="javascript:;"
                                   onclick="changeQuantityValue('up', {{ $product->id }},'1')"
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
