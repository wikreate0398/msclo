@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="col-md-12"> 
	 <div class="widget">

			<div class="widget-content">

			<form action="/{{ $method }}/{{ $data['id'] }}/update" class="ajax__submit form-horizontal">  

				{{ csrf_field() }}

				@include('admin.utils.input', ['label' => 'Название', 'name' => 'name', 'data' => $data])

				@include('admin.utils.image', [
						'inputName' => 'image',
						'table'    => $table,
						'folder'   => $folder,
						'id'       => $data['id'],
						'filename' => $data['image']])

				<div class="form-group">
					<label> Товар </label>
					<div>
						<select name="product_id" class="form-control basic-select2">
							<option value="0">Выбрать</option>
							@foreach($products as $product)
								<option {{ ($data->product_id == $product->id) ? 'selected' : '' }} value="{{ $product->id }}">{{ $product->name_ru }}</option>
							@endforeach
						</select>
					</div>
				</div>

				<button type="submit" class="btn btn-success submit-btn">Сохранить</button>
			</form>
		</div>
	</div>
	</div>
</div>
 
@stop