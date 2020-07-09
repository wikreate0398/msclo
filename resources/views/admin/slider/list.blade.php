@extends('layouts.admin') 
 
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

						@include('admin.utils.input', ['label' => 'Название', 'lang' => false, 'name' => 'name'])

						@include('admin.utils.image', ['inputName' => 'image'])

						<div class="form-group">
							<label> Товар </label>
							<div>
								<select name="id_product" class="form-control basic-select2">
									<option value="0">Выбрать</option>
									@foreach($products as $product)
										<option value="{{ $product->id }}">{{ $product->name_ru }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<button type="submit" class="btn btn-success submit-btn">Сохранить</button>
					</form> 
				</div>
			</div>
		</div>

	   	<div class="col-md-12">  
	   		@if($data->count())
	      		<div class="widget">
					<div class="widget-content">
						<table class="table table-bordered">
							<tbody>
							<tr>
								<td style="width:50px; text-align:center;"></td>
								<th style="width:5%; text-align: center"><i class="fa fa-check-square" aria-hidden="true"></i></th>
								<th class="nw">Название</th>
								<th style="width:5%; text-align: center"><i class="fa fa-cogs" aria-hidden="true"></i></th>
							</tr>
							</tbody>
							<tbody class="sort-items" data-table="{{ $table }}" data-action="{{ route('sortElement') }}">
							@foreach($data as $item)
								<tr id="<?=$item['id']?>">
									<td style="width:50px; text-align:center;" class="handle"> </td>
									<td style="width:5px; white-space: nowrap;">
										<label class="switch s-success">
											<input type="checkbox"
												   {{ !empty($item['view']) ? 'checked' : '' }}
												   onchange="Ajax.buttonView(this, '{{ $table }}', '{{ $item["id"] }}', 'view')">
											<span class="slider round"></span>
										</label>
									</td>
									<td class="nw">{{ $item->name }}</td>
									<td style="width: 5px; white-space: nowrap">
										<a style="margin-left: 5px;" href="/{{ $method }}/{{ $item['id'] }}/edit/" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
										<a class="btn btn-danger btn-xs" data-toggle="modal" href="#deleteModal_{{ $table }}_{{ $item['id'] }}"><i class="fa fa-trash"></i></a>
										<!-- Modal -->
									@include('admin.utils.delete', ['id' => $item['id'], 'table' => $table])
									<!-- Modal -->
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			@else
				<div class="alert alert-warning">Нет данных</div>
			@endif
	   	</div>
	</div>
@stop

