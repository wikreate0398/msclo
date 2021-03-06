@extends('layouts.admin') 
 
@section('content')
	 
	<div class="row">
		<div class="col-md-12" style="margin-bottom: 20px;">
			<a onclick="$('.area-panel').toggleClass('show'); return false;" class="btn btn-primary btn-sm open-area-btn">
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

								@include('admin.utils.input', ['label' => 'Ссылка', 'req' => true, 'name' => 'url', 'help' => 'Без http://www и.т.п просто английская фраза, без пробелов, отражающая пункт меню, например Наш подход - our-approach'])

								@include('admin.utils.textarea', ['label' => 'Текст', 'lang' => true, 'name' => 'text', 'ckeditor' => true])
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

	   	<div class="col-md-12 col-12">
			<div class="widget">
				<div class="widget-content">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th style="width:50px; text-align:center;"></th>
								<th style="width:5%; text-align: center" class="nw">В шапке</th>
								<th style="width:5%; text-align: center" class="nw">В подвале</th>
								<th class="nw">Заголовок</th>
								<th style="width:5%; text-align: center"><i class="fa fa-cogs" aria-hidden="true"></i></th>
							</tr>
						</thead>
						<tbody class="sort-items" data-table="{{ $table }}" data-action="{{ route('sortElement') }}">
						@foreach($menu as $item)
							<tr id="<?=$item['id']?>">
								<td style="width:50px; text-align:center;" class="handle"> </td>
								<td style="width:5px; white-space: nowrap;">
									<label class="switch s-success mr-2">
										<input type="checkbox"
											   {{ !empty($item['view_top']) ? 'checked' : '' }}
											   onchange="Ajax.buttonView(this, '{{ $table }}', '{{ $item["id"] }}', 'view_top')">
										<span class="slider round"></span>
									</label>
								</td>
								<td style="width:5px; white-space: nowrap;">
									<label class="switch s-success mr-2">
										<input type="checkbox"
											   {{ !empty($item['view_bottom']) ? 'checked' : '' }}
											   onchange="Ajax.buttonView(this, '{{ $table }}', '{{ $item["id"] }}', 'view_bottom')">
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
	   	</div>
	</div>
@stop

