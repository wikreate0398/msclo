@extends('profile.layout')

@section('profile')
    <div class="col-lg-12 order-lg-1">
        <div class="pb-7 mb-7">

            <!-- Title -->
            <div class="border-bottom border-color-1 mb-5">
                <h3 class="section-title mb-0 pb-2 font-size-25">Редактировать Товары</h3>
            </div>
            <!-- End Title -->

            <form action="{{ route('create_product', ['lang' => $lang, 'id' => $data->id]) }}" class="ajax__submit">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-card mb-5">
                            <h5 class="col px-5 py-3">Общее</h5>
                            <div class="col-md-12 px-4 pt-3">
                                @include('admin.catalog.products.utils.pc_categories', ['categories' => $categories, 'selected_category' => $data->id_category])
                                <hr>
                            </div>
                            <div class="col-md-12 px-4 pt-2 pb-3">
                                <input type="text" class="product-form-control" value="{{ $data->code }}" name="code" autocomplete="off" placeholder="Артикул*">
                            </div>
                            <div class="col-md-12 px-4 py-3 mb-4">
                                <input type="text" class="product-form-control" value="{{ $data->name_ru }}" name="name[ru]" autocomplete="off" placeholder="Название*">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product-card mb-5">
                            <h5 class="col px-5 py-3">Параметры товара</h5>
                            <div class="col-md-12">
                                @php
                                    $productChars = $data->chars ? $data->chars->groupBy('id_char') : collect();
                                @endphp
                                @foreach($chars as $char)
                                @if($char->type != "input") <label class="col-md-12">{{ $char->name_ru }}</label> @endif
                                    @if($char->childs->count())
                                    <div class="col-md-12">
                                        @foreach($char->childs as $child)
                                            <input type="{{ $char->type }}"
                                            name="char[{{ $char->type }}][{{ $char->id }}][]"
                                                @if($child->parent_id == 8)
                                                style="--name: '{{ $child->name_ru }}'"
                                                @endif
                                            value="{{ $child->id }}"
                                            {{ (@$productChars[$char->id] && in_array($child->id, $productChars[$char->id]->pluck('value')->toArray())) ? 'checked' : '' }}
                                            class="product-control-input"
                                            id="item-{{ $child->id }}">
                                            @endforeach
                                        </div>
                                            <hr>
                                    @elseif($char->type == 'input')
                                        <div class="col-md-12">
                                            <textarea name="char[{{ $char->type }}][{{ $char->id }}]" class="product-form-control mb-4" placeholder="{{ $char->name_ru }}">{{ @$productChars[$char->id][0]['value'] }}</textarea>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mt-n3">
                        <div class="product-card mb-5">
                            <h5 class="col-lg-12 px-5 py-3">Оптовые цены</h5>
                                <div class="col-md-12 mt-6">
                                    <div class="row">
                                        @foreach($data->prices as $item)
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <div class="col-md-6">
                                                    <input type="text" name="prices[price][]" value="{{ $item->price }}" placeholder="Стоимость товара" class="product-form-control number">
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" name="prices[quantity][]" value="{{ $item->quantity }}" placeholder="Кол-во для опта" class="product-form-control number">
                                                </div>
                                                <div class="col-md-1 align-self-center">
                                                    <a href="javascript:;" onclick="deleteLoadItem(this, '.input-group')" class="btn-delete1 delete_product_btn">
                                                        <i class="fa fa-times"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
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
                            <h5 class="col py-3 font-weight-bold">Фото товара</h5>
                            @php
                                $imgData = [];
                                if($data->images->count()){
                                foreach($data->images as $image){
                                    $realPath = public_path('uploads/products') . '/' . $image->image;
                                    $fag = file_exists($realPath);
                                    $imgData[] = [
                                    'name' => $image->image,
                                    'size' => $fag ? filesize($realPath) : '',
                                    'file' => '/uploads/products/' . $image->image,
                                    'type' => $fag ? mime_content_type($realPath) : '',
                                    'data' => [
                                        'thumbnail' => imageThumb($image->image, 'uploads/products', 500, 500, 1)
                                    ]
                                    ];
                                }
                                }
                            @endphp
                            <input type="file"
                                name="files"
                                class="gallery_media"
                                data-fileuploader-theme="gallery"
                                data-json='{"table": "catalog_images", "field": "image"}'
                                data-fileuploader-files='<?=json_encode($imgData)?>'>
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
                                    <textarea name="description[ru]" class="col-md-12 product-form-control" cols="30" rows="2" onkeyup="countChar(this, 340, 'charNum340')">{{ $data->description_ru }}</textarea>
                                    <hr>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col mb-5">
                                    <div class="row ">
                                        <label class="col">Полное описание</label>
                                        <div style="font-family: 'Avenir Next Cyr Thin'; font-size: 12px" class="col-auto float-right"><span id="charNum1000">1</span> /1000</div>
                                    </div>
                                    <textarea name="text[ru]" class="product-form-control" cols="30" rows="2" onkeyup="countChar(this, 1000, 'charNum1000')">{{ $data->text_ru }}</textarea>
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