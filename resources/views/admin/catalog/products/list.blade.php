@extends('layouts.admin')

@section('content')
	 
	<div class="row">
		<div class="col-md-12" style="margin-bottom: 20px;">
			<a onclick="$('.area-panel').toggleClass('show'); $('.area-panel .nav-link:first').toggleClass('active'); return false;" class="btn btn-primary btn-sm open-area-btn">
				<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Добавить
			</a> 
		</div>

		<div class="col-md-12 col-12 area-panel" id="add_panel">
			<div class="widget">
				<div class="widget-header animated-underline-content">
					<ul class="nav nav-tabs mb-3" id="animateLine">
						<li class="nav-item">
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
					<form action="/{{ $method }}/create" class="ajax__submit ">

						{{ csrf_field() }}

						<div class="tab-content" id="animateLineContent-4">
							<div class="tab-pane fade show active" id="tab_1">
								@include('admin.utils.input', ['label' => 'Название', 'lang' => true, 'name' => 'name'])

{{--								@include('admin.utils.input', ['label' => 'Ссылка', 'req' => true, 'name' => 'url', 'help' => 'Без http://www и.т.п просто английская фраза, без пробелов, отражающая пункт меню, например Наш подход - our-approach'])--}}

								@include('admin.utils.input', ['label' => 'Код', 'name' => 'code'])

								@include('admin.utils.textarea', ['label' => 'Описание', 'lang' => true, 'name' => 'description'])

								@include('admin.utils.textarea', ['label' => 'Текст', 'lang' => true, 'name' => 'text', 'ckeditor' => true])

								<div class="form-group">
									<label>Поставщик <span class="req">*</span></label>
									<div>
										<select name="provider_id" class="form-control">
											<option value="0">Выбрать</option>
											@foreach($providers as $provider)
												<option value="{{ $provider->id }}">{{ $provider->name }}</option>
											@endforeach
										</select>
									</div>
								</div>

								@include('admin.catalog.products.utils.categories', ['categories' => $categories])

								<div class="form-group">
									<label>Характеристики</label>
									<div>
										<table class="table table-bordered">
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
								</div>

								<button class="btn btn-sm btn-info" type="button" onclick="addProductPrice()">Добавить цену</button>

								<div class="form-group" id="product-prices" style="display: none; margin-top: 15px; width: 50%;">
								</div>

								<input type="file"
									   name="files"
									   class="file_uploader_input">

							</div>

							<div class="tab-pane fade" id="tab_2">
								@include('admin.utils.input', ['label' => 'Заголовок', 'lang' => true, 'name' => 'seo_title'])

								@include('admin.utils.textarea', ['label' => 'Описание', 'lang' => true, 'name' => 'seo_description'])

								@include('admin.utils.input', ['label' => 'Ключевые слова', 'lang' => true, 'name' => 'seo_keywords'])
							</div>
						</div>

						<button type="submit" class="btn btn-success mt-3 submit-btn">Сохранить</button>
					</form>
				</div>
			</div>
		</div>

		<div class="col-md-9 col-9">
			@if($data->count())
				<div class="widget">
					<div class="widget-content">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th style="width:50px; text-align:center;"></th>
									<th style="width:5%; text-align: center" class="nw">Показать</th>
									<th class="nw">Заголовок</th>
									<th style="width:5%; text-align: center"><i class="fa fa-cogs" aria-hidden="true"></i></th>
								</tr>
							</thead>
							<tbody class="sort-items" data-table="{{ $table }}" data-action="{{ route('sortElement') }}">
							@foreach($data as $item)
								<tr id="<?=$item['id']?>">
									<td style="width:50px; text-align:center;" class="handle"> </td>
									<td style="width:5px; white-space: nowrap;" align="center">
										<label class="switch s-success mr-2">
											<input type="checkbox"
												   {{ !empty($item['view']) ? 'checked' : '' }}
												   onchange="Ajax.buttonView(this, '{{ $table }}', '{{ $item["id"] }}', 'view')">
											<span class="slider round"></span>
										</label>
									</td>
									<td class="nw">{{ $item->name_ru }}</td>
									<td style="width: 5px; white-space: nowrap">
										<a style="margin-left: 5px;" href="/{{ $method }}/{{ $item['id'] }}/edit/" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>

										@if(!$item->let_alone)
											<a class="btn btn-danger btn-xs" data-toggle="modal" href="#deleteModal_{{ $table }}_{{ $item['id'] }}"><i class="fa fa-trash"></i></a>
											<!-- Modal -->
												@include('admin.utils.delete', ['id' => $item['id'], 'table' => $table])
											<!-- Modal -->
										@endif
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			@else
				<div class="col-md-12">
					<div class="alert alert-warning">Нет данных</div>
				</div>
			@endif
		</div>

		<div class="col-md-3 col-3">
			<div class="widget widget-activity-three" style="height: auto; margin-bottom: 20px;">
				<h5 style="margin-bottom: 20px;">Фильтр</h5>
				<div class="widget-content filter-content" style="padding: 0">

					<div class="filter-item">
						<h6>Поставщик</h6>
						<select name="provider_id" id="provider_id" class="form-control" onchange="filterCatalog()">
							<option value="all">Все</option>
							@foreach($providers as $provider)
								<option {{ (request()->provider_id == $provider->id) ? 'selected' : '' }} value="{{ $provider->id }}">{{ $provider->name }}</option>
							@endforeach
						</select>
					</div>

					@foreach($filters as $char)
						<div class="filter-item">
							<h6 style="border-bottom: 1px dashed #ccc; padding-bottom: 10px; margin-bottom: 10px;">{{ $char->name_ru }}</h6>
							@foreach($char->childs as $child)
								@if($child->values_products_count)
									<div class="custom-control custom-{{ $char->type }}">
										<input type="{{ $char->type }}"
											   name="char[{{ $char->type }}][{{ $char->id }}][]"
											   value="{{ $child->id }}"
											   class="custom-control-input filter-input"
											   id="filter-{{ $child->id }}"
											   {{ (request()->params && in_array($child->id, explode(',', request()->params))) ? 'checked' : '' }}
											   onchange="filterCatalog()">
										<label class="custom-control-label" for="filter-{{ $child->id }}">
											{{ $child->name_ru }} ({{ $child->values_products_count }})
										</label>
									</div>
								@endif
							@endforeach
						</div>
					@endforeach
				</div>
			</div>

			@if(request()->params)
				<div style="text-align: center">
					<a href="/{{ $method }}" class="btn btn-danger" style="display: block">Сбросить</a>
				</div>
			@endif
		</div>
	</div>

	<script>
		function filterCatalog() {
			olink='/{{ $method }}/';
			const provider_id = $('#provider_id').val();

			params='';
			pluser='';
			$.each($('input.filter-input'),function() {
				if ($(this).is(':checked')) {
					params+=pluser+$(this).val();
					pluser=',';
				}
			});

			flt='?filter=1';
			if (params!='') flt+='&params='+params;
			if (provider_id) flt+= '&provider_id=' + provider_id;
			window.location.href = olink+flt;
		}
	</script>
@stop

