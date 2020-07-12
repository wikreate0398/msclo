@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="col-md-12"> 
	 <div class="widget">

			<div class="widget-content">

			<form action="/{{ $method }}/{{ $data['id'] }}/update" class="ajax__submit form-horizontal">  

				{{ csrf_field() }}

				@include('admin.utils.input', ['label' => 'Название', 'lang' => true, 'name' => 'name', 'data' => $data])

				<div class="form-group">
					<label> Товар </label>
					<div>
						@php $ids = $data->products ? $data->products->pluck('id')->toArray() : []; @endphp
						<select name="products[]" multiple class="form-control multiSelect">
							@foreach($products as $product)
								<option {{ in_array($product->id, $ids) ? 'selected' : '' }} value="{{ $product->id }}">{{ $product->name_ru }}</option>
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