@extends('layouts.admin')

@section('content')

		@if(\Auth::user()->id === 1)
		<div class="btn btn-info" onclick="$('.taggle_win').slideToggle();" style="cursor:pointer; margin-bottom: 20px;">
			<i class="fa fa-plus"></i> Добавить
		</div>
		@endif

		<div class="row taggle_win" style="margin-bottom: 20px; display: none">
			<div class="col-md-12">
				<div class="widget">
						<!-- BEGIN FORM-->
						<form action="/{{ $method }}/createConstant" method="POST" class="ajax__submit form-horizontal" data-redirect="/{{ $method }}/?dev=1">
							{{ csrf_field() }}

								<div class="form-group">
									<label>Константа</label>
									<div>
										<input type="text" class="form-control" name="name">
									</div>
								</div>

								<div class="form-group">
									<label>Описание</label>
									<div>
										<input type="text" class="form-control" name="description">
									</div>
								</div>

								<div class="form-group">
									<label>Ckeditor</label>
									<div>
										<input type="checkbox" name="editor">
									</div>
								</div>

								<div class="form-group">
									<label>Категория
									</label>
									<div>
										<select class="form-control" name="category_id">
											<option value="0">Выбрать...</option>
											@foreach($categories as $item)
												<option value="{{ $item['id'] }}">{{ $item["name"] }}</option>
											@endforeach
										</select>
									</div>
								</div>

								@foreach($langs as $key => $language)
									<div class="form-group">
										<label> Значение {{ $language->short }}</label>
										<div>
											<textarea name="value[{{ $language->short }}]" class="form-control"></textarea>
										</div>
									</div>
								@endforeach


							<button type="submit" class="btn btn-success btn-submit">Сохранить</button>
						</form>
						<!-- END FORM-->
				</div>
			</div>
		</div>

	<div class="row">
		<div class="col-md-12">

			<form action="/{{ $method }}/create" class="ajax__submit form-horizontal widget">

				{{ csrf_field() }}


					<div class="list-group" style="margin-bottom: 20px">
						@foreach($data as $category => $constants)
							<div class="list-group-item">
								<h2 class="list-group-item-heading">{{ $category }}</h2>
								<hr>
								<div class="list-group-item-text">
									@foreach($constants as $constant)
										<h5>{{ $constant->description }}</h5>
										<div class="row" style="margin-bottom: 20px;">
											@foreach($langs as $key => $language)
												<div class="col-md-{{ 12/$langs->count() }}">
													@if($langs->count() > 1)
														<span style="display: block;" class="label label-info">
															{{ $language->name }}
														</span>
													@endif
													<textarea name="data[{{ $constant->id }}][{{ $language->short }}]"
															  class="form-control {{ $constant->editor ? 'ckeditor' : '' }}"
															  style="max-width: 100%; min-width: 100%; min-height: 55px;">{{ @$constant->constants_value->keyBy('lang')[$language->short]['value'] }}</textarea>
												</div>
											@endforeach
										</div>
									@endforeach
								</div>
							</div>
						@endforeach
					</div>

					<button type="submit" class="btn btn-success btn-submit">Сохранить</button>

			</form>
		</div>
	</div>
@stop

