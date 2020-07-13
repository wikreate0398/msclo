@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="col-md-12"> 
	 <div class="widget">

			<div class="widget-content">

			<form action="/{{ $method }}/{{ $data['id'] }}/update" class="ajax__submit form-horizontal">  

				{{ csrf_field() }}

				@include('admin.utils.input', ['label' => 'Название', 'lang' => false, 'name' => 'name', 'data' => $data])

				@include('admin.utils.image', [
						'inputName' => 'image',
						'label'    => 'Лого',
						'table'    => $table,
						'folder'   => $folder,
						'id'       => $data['id'],
						'filename' => $data['image']])

				<button type="submit" class="btn btn-success submit-btn">Сохранить</button>
			</form>
		</div>
	</div>
	</div>
</div>
 
@stop