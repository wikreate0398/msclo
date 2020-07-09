@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="col-md-12"> 
	 <div class="widget">

			<div class="widget-content">

			<form action="/{{ $method }}/{{ $data['id'] }}/update" class="ajax__submit form-horizontal">  

				{{ csrf_field() }}

				@include('admin.utils.input', ['label' => 'Название', 'lang' => true, 'name' => 'name', 'data' => $data])

				@include('admin.utils.input', ['label' => 'Полная ссылка', 'help' => 'Пример <code>/ru/catalog/shoes</code>', 'lang' => false, 'name' => 'link', 'data' => $data])

				@include('admin.utils.image', [
						'inputName' => 'image',
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