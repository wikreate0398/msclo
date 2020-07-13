@extends('layouts.admin')

@function ( catList($menu, $method, $table) )
@foreach ($menu as $item)
	<li class="dd-item dd3-item" data-id="{{ $item['id'] }}">
		<div class="dd-handle dd3-handle handle "></div>
		<div class="dd3-content">
			<div class="dd3-name">
				{{ $item['name_ru'] }}
			</div>
			<div class="dd3-items">

				<ul>
					<li>
						<span class="option-name">Активировать</span>
						<label class="switch s-success mr-2" style="margin-bottom: 0">
							<input type="checkbox"
								   {{ !empty($item['view']) ? 'checked' : '' }}
								   onchange="Ajax.buttonView(this, '{{ $table }}', '{{ $item["id"] }}', 'view')">
							<span class="slider round"></span>
						</label>
					</li>

					@if(!$item['parent_id'])
						<li>
							<span class="option-name"> Показать в фильтре</span>
							<label class="switch s-success mr-2" style="margin-bottom: 0">
								<input type="checkbox"
									   {{ !empty($item['view_filter']) ? 'checked' : '' }}
									   onchange="Ajax.buttonView(this, '{{ $table }}', '{{ $item["id"] }}', 'view_filter')">
								<span class="slider round"></span>
							</label>
						</li>
					@endif

					@if(!$item['parent_id'])
						<li>
							<span class="option-name">Использовать при добавлении в корзину</span>
							<label class="switch s-success mr-2" style="margin-bottom: 0">
								<input type="checkbox"
									   {{ !empty($item['used_cart']) ? 'checked' : '' }}
									   onchange="Ajax.buttonView(this, '{{ $table }}', '{{ $item["id"] }}', 'used_cart')">
								<span class="slider round"></span>
							</label>
						</li>
					@endif
				</ul>

				<a style="margin-left: 5px;" href="/{{ $method }}/{{ $item['id'] }}/edit/" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
				&nbsp;
				<a class="btn btn-danger btn-xs" data-toggle="modal" href="#deleteModal_{{ $table }}_{{ $item['id'] }}"><i class="far fa-trash "></i></a>
				@include('admin.utils.delete', ['id' => $item['id'], 'table' => $table])
			</div>
		</div>
		@if(!empty($item['childs']))
			<ol class="dd-list">
				@catList($item['childs'], $method, $table)
			</ol>
		@endif
	</li>
@endforeach
@endfunction

@section('content')
	<div class="row">
		<div class="col-md-12" style="margin-bottom: 20px;">
			<a href="#add_panel" class="btn btn-primary btn-sm open-area-btn">
				<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Добавить
			</a> 
		</div>

		<div class="col-md-12 area-panel" id="add_panel"> 
			<div class="widget">
	 
				<div class="widget-content">
	 
					<form action="/{{ $method }}/create" class="ajax__submit form-horizontal">  

						{{ csrf_field() }}
						@include('admin.utils.input', ['label' => 'Название', 'lang' => true, 'name' => 'name'])

						<div class="form-group">
							<label>Тип</label>
							<div>
								<div class="n-chk">
									<label class="new-control new-radio new-radio-text radio-primary">
										<input type="radio" onchange="selectCharType(this)" class="new-control-input" name="type" value="input">
										<span class="new-control-indicator"></span><span class="new-radio-content">Свободный</span>
									</label>
								</div>

								<div class="n-chk">
									<label class="new-control new-radio new-radio-text radio-primary">
										<input type="radio" onchange="selectCharType(this)" class="new-control-input" name="type" value="checkbox">
										<span class="new-control-indicator"></span><span class="new-radio-content">Множественный</span>
									</label>
								</div>

								<div class="n-chk">
									<label class="new-control new-radio new-radio-text radio-primary">
										<input type="radio" onchange="selectCharType(this)" class="new-control-input" name="type" value="radio">
										<span class="new-control-indicator"></span><span class="new-radio-content">Один из нескольких</span>
									</label>
								</div>
							</div>
						</div>

						<div style="margin-bottom: 15px; display: none;" class="add-chars-values-inner">
							<button type="button" class="btn btn-warning btn-sm" onclick="addChars();">Добавить значения</button>

							<table class="table table-bordered" style="display: none; margin-top: 20px;" id="add-chars-table">
								<tbody class="sort-chars"></tbody>
							</table>
						</div>

						<button type="submit" class="btn btn-success submit-btn">Сохранить</button>
					</form> 
				</div>
			</div>
		</div>

	   	<div class="col-md-12">
	   		@if($data->count())
				<div class="dd nestable" data-depth="2" data-table="{{ $table }}" data-action="{{ route('depth_sort') }}">
					<ol class="dd-list">
						@catList(map_tree($data->toArray()), $method, $table)
					</ol>
				</div>
			@else
				<div class="alert alert-warning">Нет данных</div>
			@endif
	   	</div>
	</div>
@stop

