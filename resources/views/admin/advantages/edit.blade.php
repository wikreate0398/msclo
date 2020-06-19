@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="col-md-12"> 
	 <div class="widget">

			<div class="widget-content">
			 
 
			<form action="/{{ $method }}/{{ $data['id'] }}/update" class="ajax__submit form-horizontal">  

				{{ csrf_field() }}

				@include('admin.utils.input', ['label' => 'Название', 'name' => 'name', 'lang' => true, 'data' => $data])

				<button type="submit" class="btn btn-success">Сохранить</button>
			</form>
		</div>
	</div>
	</div>
</div>
 
@stop