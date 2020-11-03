@extends('layouts.admin')

@function ( catList($menu, $method, $table) )
@foreach ($menu as $item)
	<li class="dd-item dd3-item" data-id="{{ $item['id'] }}">
		<div class="dd-handle dd3-handle handle "></div>
		<div class="dd3-content">
			<div class="dd3-name">
				<label class="switch s-success mr-2">
					<input type="checkbox"
						   class="cat-checkbox-view"
						   {{ !empty($item['view']) ? 'checked' : '' }}
						   onchange="Ajax.buttonView(this, '{{ $table }}', '{{ $item["id"] }}', 'view')">
					<span class="slider round"></span>
				</label>
				{{ $item['name_ru'] }}
			</div>
			<div style="float:right; margin:0 !important; display: flex; justify-content: flex-end; align-items: center;">
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
						<button type="submit" class="btn btn-success submit-btn">Сохранить</button>
					</form> 
				</div>
			</div>
		</div>

	   	<div class="col-md-12">
	   		@if($data->count())
				<div class="dd nestable" data-depth="3" data-table="{{ $table }}" data-action="{{ route('depth_sort') }}">
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

