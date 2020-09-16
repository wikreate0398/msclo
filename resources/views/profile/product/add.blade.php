@extends('profile.layout')

@section('profile')
    <div class="col-lg-12 order-lg-1">
        <div class="pb-7 mb-7">

            <!-- Title -->
            <div class="border-bottom border-color-1 mb-5">
                <h3 class="section-title mb-0 pb-2 font-size-25">Добавить Товары</h3>
            </div>
            <!-- End Title -->

            <form action="{{ route('create_product', ['lang' => $lang]) }}"
                  class="ajax__submit">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <label class="form-label">
                            Название
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" name="name[ru]" autocomplete="off">
                    </div>

                    <div class="w-100" style="margin-bottom: 15px;"></div>

{{--                    <div class="col-md-6">--}}
{{--                        <label class="form-label">--}}
{{--                            Ссылка--}}
{{--                            <span class="text-danger">*</span>--}}
{{--                        </label>--}}
{{--                        <input type="text" class="form-control" name="url" autocomplete="off">--}}
{{--                    </div>--}}

                    <div class="col-md-12">
                        <label class="form-label">
                            Артикул
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" name="code" autocomplete="off">
                    </div>

                    <div class="w-100" style="margin-bottom: 15px;"></div>

                    <div class="col-md-12">
                        @include('admin.catalog.products.utils.categories', ['categories' => $categories])
                    </div>

                    <div class="w-100" style="margin-bottom: 15px;"></div>

                    <div class="col-md-12">
                        <label class="form-label">
                            Характеристики
                        </label>
                        <table class="table table-bordered" s>
                            @foreach($chars as $char)
                                <tr>
                                    <th style="width: 5%; white-space: nowrap; vertical-align: middle">{{ $char->name_ru }}</th>
                                    <td>
                                        @if($char->type == 'input')
                                            <textarea name="char[{{ $char->type }}][{{ $char->id }}]" class="form-control"></textarea>
                                        @elseif($char->childs->count())
                                            @foreach($char->childs as $child)
                                                <div class="custom-control custom-{{ $char->type }}">
                                                    <input type="{{ $char->type }}"
                                                           name="char[{{ $char->type }}][{{ $char->id }}][]"
                                                           value="{{ $child->id }}"
                                                           class="custom-control-input"
                                                           id="item-{{ $child->id }}">
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

                    <div class="col-md-12" id="product-prices" style="display: none; margin-top: 15px; width: 50%;">
                    </div>

                    <style>
                        #product-prices .btn-danger {
                            border-radius: 0px !important;
                        }
                    </style>

                    <input type="file"
                           name="files"
                           class="gallery_media">

                    <input type="hidden" name="image_sort" value="" id="img-sort">

                    <div class="w-100" style="margin-bottom: 15px;"></div>

                    <div class="col-md-12">
                        <label class="form-label">
                            Короткое описание
                        </label>
                        <textarea name="description[ru]" class="form-control" cols="30" rows="2"></textarea>
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
                            <textarea name="text[ru]" style="display: none;"></textarea>
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