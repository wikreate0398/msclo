<div class="product-item__outer h-100">
    <div class="product-item__inner px-xl-4 p-3">
        <div class="product-item__body pb-xl-2">
            <div class="mb-2"><a href="{{ setUri("catalog/{$product->category->url}") }}" class="font-size-12 text-gray-5">{{ $product->category["name_$lang"] }}</a></div>
            <h5 class="mb-1 product-item__title">
                <a href="{{ route('view_product', ['lang' => lang(), 'url' => $product->url]) }}" class="text-blue font-weight-bold">{{ $product["name_$lang"] }}</a>
            </h5>
            <div class="mb-2">
                <a href="{{ route('view_product', ['lang' => lang(), 'url' => $product->url]) }}" class="d-block text-center">
                    <img class="product-list-image" class="img-fluid" src="{{ imageThumb(@$product->images->first()->image, 'uploads/products', 212, 0, '212X0') }}" alt="{{ $product["name_$lang"] }}">
                </a>
            </div>
            <div class="flex-center-between mb-1">
                <div class="prodcut-price">
                    <div class="text-gray-100">{{ priceString(@$product->prices->first()->price) }} Р</div>
                    {{-- {{ RUB }} --}}
                </div>
                <div class="d-none d-xl-block prodcut-add-cart">
                    <a href="javascript:;"
                       onclick="showModalCart(this, {{ $product->id }})"
                       class="btn-add-cart btn-primary transition-3d-hover">
                        <i class="ec ec-add-to-cart"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="product-item__footer">
            <div class="border-top pt-2 flex-center-between flex-wrap">
{{--                <a href="javascript:;"--}}
{{--                   class="text-gray-6 compare-icon compare-icon-{{ $product->id }} font-size-13 {{ sessArray('compare')->exist($product->id) ? 'active' : '' }}"--}}
{{--                   onclick="addToCompare(this, {{ $product->id }}); return false;">--}}
{{--                    <i class="ec ec-compare font-size-15"></i> Сравнить--}}
{{--                </a>--}}
                <a href="javascript:;"
                   class="text-gray-6 fav-icon fav-icon-{{ $product->id }} font-size-13 {{ sessArray('favorites')->exist($product->id) ? 'active' : '' }}"
                   onclick="addToFav(this, {{ $product->id }}); return false;">
                    <i class="ec ec-favorites font-size-15"></i> Избранное
                </a>
            </div>
        </div>
    </div>
</div>