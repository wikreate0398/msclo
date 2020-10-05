@extends('profile.layout')

@section('profile')
    <div class="col-lg-12 order-lg-1 product-page">
        <div class="pb-7 mb-7">

            <!-- Title -->
            <div class="mb-5">
                <h3 class="mb-0 pb-2 font-size-25" style="font-family: 'Avenir Next Cyr Bold'">Добавить товар</h3>
            </div>
            <!-- End Title -->
            <form action="{{ route('create_product', ['lang' => $lang]) }}" class="ajax__submit">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-card mb-5">
                            <h5 class="col px-5 py-3">Общее</h5>
                            <div class="col-md-12 px-4 pt-3">
                                @include('admin.catalog.products.utils.pc_categories', ['categories' => $categories])
                                <hr>
                            </div>
                            <div class="col-md-12 px-4 pt-2 pb-3">
                                <input type="text" class="product-form-control" name="code" autocomplete="off" placeholder="Артикул*">
                            </div>
                            <div class="col-md-12 px-4 py-3 mb-4">
                                <input type="text" class="product-form-control" name="name[ru]" autocomplete="off" placeholder="Название*">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product-card mb-5">
                            <h5 class="col px-5 py-3">Параметры товара</h5>
                            <div class="col-md-12 pt-3">
                                @foreach($chars as $char)
                                @if($char->type != "input") <label class="col-md-12 mb-3">{{ $char->name_ru }}</label> @endif
                                    @if($char->childs->count())
                                    <div class="col-md-12">
                                        @foreach($char->childs as $child)
                                            <input type="{{ $char->type }}"
                                            name="char[{{ $char->type }}][{{ $char->id }}][]"
                                                    @if($child->parent_id == 8)
                                                        style="--name: '{{ $child->name_ru }}'; --color: #ebebeb; --background: #4F4F4F"
                                                    @elseif($child->parent_id == 3)
                                                        style="--color: {{ $child->color }}; --background: {{ $child->color }}"
                                                    @endif
                                            value="{{ $child->id }}"
                                            class="product-control-input"
                                            id="item-{{ $child->id }}">
                                            @endforeach
                                        </div>
                                            <hr class="mb-4">
                                    @elseif($char->type == 'input')
                                        <div class="col-md-12">
                                            <textarea name="char[{{ $char->type }}][{{ $char->id }}]" class="product-form-control mb-4" placeholder="{{ $char->name_ru }}"></textarea>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mt-n6">
                        <div class="product-card mb-3">
                            <h5 class="col-lg-12 px-5 py-3">Оптовые цены</h5>
                                <div class="col-md-12 mt-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <div class="col-md-6">
                                                    <input type="text" name="prices[price][]" placeholder="Стоимость товара" class="product-form-control number">
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" name="prices[quantity][]" placeholder="Кол-во для опта" class="product-form-control number">
                                                </div>
                                                <div class="col-md-1 align-self-center">
                                                    <a href="javascript:;" onclick="deleteLoadItem(this, '.input-group')" class="btn-delete1 delete_product_btn">
                                                        <i class="fa fa-times"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12" id="product-prices" style="margin-top: 15px; width: 50%;"></div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 ml-3 mb-5 mt-4">
                                            <button class="add_product_price_btn" type="button" onclick="addProductPriceNew()">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                                Добавить цену
                                            </button>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-5 pr-5 product-image-fileuploader">
                            <h5 class="col pt-3 font-weight-bold">Фото товара</h5>
                            <input type="file"
                                   name="files"
                                   class="gallery_media">
                            <input type="hidden" name="image_sort" value="" id="img-sort">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product-card mb-5">
                            <h5 class="col px-5 py-3">Описание товара</h5>
                            <div class="col-md-12">
                                <div class="col mt-3">
                                    <div class="row mb-2 mt-4">
                                        <label class="col">Краткое описание *</label>
                                        <div style="font-family: 'Avenir Next Cyr Thin'; font-size: 12px" class="col-auto float-right"><span id="charNum340">1</span> /340</div>
                                    </div>
                                    <textarea name="description[ru]" class="col-md-12 product-form-control" cols="30" rows="2" onkeyup="countChar(this, 340, 'charNum340')"></textarea>
                                    <hr>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col mb-5">
                                    <div class="row ">
                                        <label class="col">Полное описание</label>
                                        <div style="font-family: 'Avenir Next Cyr Thin'; font-size: 12px" class="col-auto float-right"><span id="charNum1000">1</span> /1000</div>
                                    </div>
                                    <textarea name="text[ru]" class="product-form-control" cols="30" rows="2" onkeyup="countChar(this, 1000, 'charNum1000')"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div style="float: right" class="mb-12">
                    <a class="product-save-btn btn pt-5" href="{{ route('view_profile_product', ['lang' => lang()]) }}">Отмена</a>
                    <button type="submit" class="btn btn-primary-dark-w mt-5 submit-btn product-save-btn">
                        Добавить Товар
                    </button>
                </div>
            </form>

        </div>
    </div>

    <link href="{{ asset('admin_theme/assets/js') }}/fileuploader/dist/font/font-fileuploader.css" media="all" rel="stylesheet">
    <link href="{{ asset('admin_theme/assets/js') }}/fileuploader/dist/jquery.fileuploader.min.css" media="all" rel="stylesheet">
    <link href="{{ asset('admin_theme/assets/js') }}/fileuploader/examples/gallery/css/jquery.fileuploader-theme-gallery.css" media="all" rel="stylesheet">

    <script src="{{ asset('admin_theme/assets/js') }}/fileuploader/dist/jquery.fileuploader.min.js" type="text/javascript"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/19.1.1/decoupled-document/ckeditor.js"></script>
    <script src="/js/ckinit.js" type="text/javascript"></script>
@stop