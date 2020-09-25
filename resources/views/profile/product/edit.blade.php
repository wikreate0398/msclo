@extends('profile.layout')

@section('profile')
    <div class="col-lg-12 order-lg-1">
        <div class="pb-7 mb-7">

            <!-- Title -->
            <div class="border-bottom border-color-1 mb-5">
                <h3 class="section-title mb-0 pb-2 font-size-25">Редактировать Товары</h3>
            </div>
            <!-- End Title -->

            <form action="{{ route('update_product', ['lang' => $lang, 'id' => $data->id]) }}"
                  class="ajax__submit">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <label class="form-label">
                            Название
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" name="name[ru]" value="{{ $data->name_ru }}" autocomplete="off">
                    </div>

                    <div class="w-100" style="margin-bottom: 15px;"></div>

{{--                    <div class="col-md-6">--}}
{{--                        <label class="form-label">--}}
{{--                            Ссылка--}}
{{--                            <span class="text-danger">*</span>--}}
{{--                        </label>--}}
{{--                        <input type="text" class="form-control" name="url" value="{{ $data->url }}" autocomplete="off">--}}
{{--                    </div>--}}

                    <div class="col-md-12">
                        <label class="form-label">
                            Артикул
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" name="code" value="{{ $data->code }}" autocomplete="off">
                    </div>

                    <div class="w-100" style="margin-bottom: 15px;"></div>

                    <div class="col-md-12">
                        @include('admin.catalog.products.utils.categories', ['categories' => $categories, 'selected_category' => $data->category_id])
                    </div>

                    <div class="w-100" style="margin-bottom: 15px;"></div>

                    <div class="col-md-12">
                        <label class="form-label">
                            Характеристики
                        </label>
                        <table class="table table-bordered">
                            @php
                                $productChars = $data->chars ? $data->chars->groupBy('char_id') : collect();
                            @endphp
                            @foreach($chars as $char)
                                <tr>
                                    <th style="width: 5%; white-space: nowrap; vertical-align: middle">{{ $char->name_ru }}</th>
                                    <td>
                                        @if($char->type == 'input')
                                            <textarea name="char[{{ $char->type }}][{{ $char->id }}]" class="form-control">{{ @$productChars[$char->id][0]['value'] }}</textarea>
                                        @elseif($char->childs->count())
                                            @foreach($char->childs as $child)
                                                <div class="custom-control custom-{{ $char->type }}">
                                                    <input type="{{ $char->type }}"
                                                           name="char[{{ $char->type }}][{{ $char->id }}][]"
                                                           value="{{ $child->id }}"
                                                           class="custom-control-input"
                                                           id="item-{{ $child->id }}"
                                                            {{ (@$productChars[$char->id] && in_array($child->id, $productChars[$char->id]->pluck('value')->toArray())) ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="item-{{ $child->id }}">{{ $child->name_ru }}</label>
                                                </div>
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>

                    <div class="w-100" style="margin-bottom: 15px;"></div>

                    <button class="btn btn-xs btn-info" type="button" onclick="addProductPrice()">
                        <i class="fa fa-money" aria-hidden="true"></i>
                         Добавить цену
                    </button>

                    <div class="col-md-12" id="product-prices" style="{{ $data->prices->count() ? 'display:block;' : 'display:none;' }} margin-top: 15px; width: 50%;">
                        @foreach($data->prices as $item)
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Цена/Кол-во</span>
                                </div>
                                <input type="text" name="prices[price][]" value="{{ $item->price }}" placeholder="Цена руб" class="form-control number">
                                <input type="text" name="prices[quantity][]" value="{{ $item->quantity }}" placeholder="Кол-во " class="form-control number">
                                <a href="javascript:;" onclick="deleteLoadItem(this, '.input-group')" class="btn btn-danger btn-delete1 btn-sm">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <style>
                        #product-prices .btn-danger {
                            border-radius: 0px !important;
                        }
                    </style>

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
                           data-json='{"table": "product_images", "field": "image"}'
                           data-fileuploader-files='<?=json_encode($imgData)?>'>

                    <input type="hidden" name="image_sort" value="" id="img-sort">

                    <div class="w-100" style="margin-bottom: 15px;"></div>

                    <div class="col-md-12">
                        <label class="form-label">
                            Короткое описание
                        </label>
                        <textarea name="description[ru]" class="form-control" cols="30" rows="2">{{ $data->description_ru }}</textarea>
                    </div>

                    <div class="w-100" style="margin-bottom: 15px;"></div>

                    <div class="col-md-12">
                        <label class="form-label">
                            Подробное описание
                        </label>
                        <div class="ck-editor">
                            <div class="toolbar-container"></div>
                            <div class="editor-wrapper">
                                <div class="editor"></div>
                            </div>
                            <textarea name="text[ru]" style="display: none;">{{ $data->text_ru }}</textarea>
                        </div>
                    </div>


                </div>
                <button type="submit" class="btn btn-primary-dark-w mt-5 submit-btn">
                    Сохранить
                </button>
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