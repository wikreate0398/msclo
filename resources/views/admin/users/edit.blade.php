@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="col-md-12"> 
		<div class="widget">
			<div class="widget-content">
				<form action="/{{ $method }}/{{ $data['id'] }}/update" class="ajax__submit form-horizontal">
					{{ csrf_field() }}

					<input type="hidden" name="type" value="{{ $data->type }}">

					<div class="form-body" style="padding-top: 20px;">
						<div class="tab-content">

							@include('admin.utils.input', ['label' => 'Имя', 'req' => true, 'name' => 'name', 'data' => $data])


							@include('admin.utils.input', ['label' => 'Телефон', 'name' => 'phone', 'data' => $data])
							@include('admin.utils.input', ['label' => 'E-mail', 'req' => true, 'name' => 'email', 'data' => $data])


							@include('admin.utils.image', [
                                    'inputName' => 'image',
                                    'table' => $table,
                                    'folder' => 'users',
                                    'id' => $data['id'],
                                    'filename' => $data['image']])

							<div class="usr_pass">
								@include('admin.utils.input', ['label' => 'Новый Пароль', 'name' => 'password', 'type' => 'password', 'data' => []])
								@include('admin.utils.input', ['label' => 'Повторите Пароль', 'name' => 'repeat_password', 'type' => 'password'])
							</div>
						</div>
					</div>
					<div class="form-actions">
						<div class="btn-set pull-left">
							<button type="submit" class="btn btn-success submit-btn">Сохранить</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
 
@stop