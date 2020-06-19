@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="col-md-12"> 
	 <div class="widget">

			<div class="widget-content">
 
				<form action="/{{ $method }}/{{ $data['id'] }}/update" class="ajax__submit">

					{{ csrf_field() }}
					
					<div class="form-body" style="padding-top: 20px;"> 
						<h4>{{ $data->name }}</h4>
						<hr>
						@include('admin.utils.input', ['label' => 'Theme', 'name' => 'theme', 'lang' => true, 'data' => $data])

						@include('admin.utils.textarea', ['label' => 'Message', 'ckeditor' => true, 'name' => 'message', 'lang' => true, 'data' => $data, 'const' => explode(',', $data->const)])
						 
					</div>
					<button type="submit" class="btn btn-success submit-btn">Save</button>
				</form>
			</div>
	</div>
	</div>
</div>
 
@stop