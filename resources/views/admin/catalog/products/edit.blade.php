@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="col-md-12"> 
	 	<div class="widget">
			<div class="widget-header animated-underline-content">
				<ul class="nav nav-tabs mb-3" id="animateLine">
					<li class="active nav-item">
						<a href="#tab_1" data-toggle="tab" class="nav-link active" id="tab_1-tab" role="tab" aria-controls="tab_1" aria-selected="true">
							Основное </a>
					</li>
					<li class="nav-item">
						<a href="#tab_2" data-toggle="tab" class="nav-link" id="tab_2-tab" role="tab" aria-controls="tab_2" aria-selected="false">
							Seo </a>
					</li>
				</ul>
				@include('admin.utils.language_switcher')
			</div>
 
			<div class="widget-content">
	 
				<form action="/{{ $method }}/{{ $data['id'] }}/update" class="ajax__submit">

					{{ csrf_field() }}

					<div class="tab-content">
						<div class="tab-pane active" id="tab_1">
							@include('admin.utils.input', ['label' => 'Название', 'lang' => true, 'name' => 'name', 'data' => $data])

							@include('admin.utils.input', ['label' => 'Ссылка', 'req' => true, 'name' => 'url', 'help' => 'Без http://www и.т.п просто английская фраза, без пробелов, отражающая пункт меню, например Наш подход - our-approach', 'data' => $data])

							@include('admin.utils.input', ['label' => 'Код', 'name' => 'code'])

							@include('admin.utils.textarea', ['label' => 'Описание', 'lang' => true, 'name' => 'description', 'data' => $data])

						    @include('admin.utils.textarea', ['label' => 'Текст', 'lang' => true, 'name' => 'text', 'ckeditor' => true, 'data' => $data])

							<div class="form-group">
								<label>Поставщик <span class="req">*</span></label>
								<div>
									<select name="id_provider" class="form-control">
										<option value="0">Выбрать</option>
										@foreach($providers as $provider)
											<option {{ ($data->id_provider == $provider->id) ? 'selected' : '' }} value="{{ $provider->id }}">{{ $provider->name }}</option>
										@endforeach
									</select>
								</div>
							</div>

							@include('admin.catalog.products.utils.categories', ['categories' => $categories, 'selected_category' => $data->id_category])

							<div class="form-group">
								<label>Характеристики</label>
								<div>
									<table class="table table-bordered">
										@php
											$productChars = $data->chars ? $data->chars->groupBy('id_char') : collect();
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
							</div>

							<button class="btn btn-sm btn-info" type="button" onclick="addProductPrice()">Добавить цену</button>

							<div class="form-group" id="product-prices" style="{{ $data->prices->count() ? 'display:block;' : 'display:none;' }} margin-top: 15px; width: 50%;">
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

							@php
								$imgData = [];
                                if($data->images->count()){
                                  foreach($data->images as $image){
                                    $realPath = public_path('uploads/products') . '/' . $image->image;

                                    $imgData[] = [
                                      'name' => $image->image,
                                      'size' => filesize($realPath),
                                      'file' => '/uploads/products/' . $image->image,
                                      'type' => mime_content_type($realPath),
                                      'data' => [
                                          'thumbnail' => imageThumb($image->image, 'uploads/products', 500, 500, 1)
                                      ]
                                    ];
                                  }
                                }
							@endphp
							<input type="file"
								   name="files"
								   class="file_uploader_input"
								   data-fileuploader-theme="default"
								   data-json='{"table": "catalog_images", "field": "image"}'
								   data-fileuploader-files='<?=json_encode($imgData)?>'>
						</div>

						<div class="tab-pane" id="tab_2">
							@include('admin.utils.input', ['label' => 'Заголовок', 'lang' => true, 'name' => 'seo_title', 'data' => $data])

							@include('admin.utils.textarea', ['label' => 'Описание', 'lang' => true, 'name' => 'seo_description', 'data' => $data])

							@include('admin.utils.input', ['label' => 'Ключевые слова', 'lang' => true, 'name' => 'seo_keywords', 'data' => $data])
						</div>
					</div>
					<button type="submit" class="btn btn-success mt-3 submit-btn">Сохранить</button>
				</form> 

			</div>
		</div>
	</div>
</div>
 
@stop