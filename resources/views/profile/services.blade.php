@extends('profile.layout')

@section('profile')
<div class="col-lg-12 order-lg-1">
	<div class="pb-7 mb-7">

		<!-- Title -->
		<div class="border-bottom border-color-1 mb-5">
			<h3 class="section-title mb-0 pb-2 font-size-25">Услуги</h3>
		</div>
		<!-- End Title -->

		<form action="{{ route('save_services', ['lang' => $lang]) }}"
			  class="ajax__submit">
			{{ csrf_field() }}
			<div class="row">

				@foreach($options as $option)
					<div class="col-md-4" style="margin-bottom: 20px;">
						<label class="form-label" >{{ $option->name_ru }}</label>
						<div>
							@if($option->type == 'input')
								<input name="char[{{ $option->type }}][{{ $option->id }}]"
									   class="form-control"
									   value="{{ @$values[$option->id][0]['value'] }}">
							@elseif($option->type == 'self_checkbox')
								<div>
									<div class="self-checkbox-wrapper" id="self-checkbox-wrapper-{{ $option->id }}">
										@if(@$values[$option->id] && $values[$option->id]->count())
											@foreach($values[$option->id] as $key => $item)
												<div class="input-group self-checkbox-item">
													<input type="text"
														   name="char[{{ $option->type }}][{{ $option->id }}][]"
														   class="form-control"
														   value="{{ $item['value'] }}">
													@if($key)
														<button class="btn btn-danger btn-sm"
																style="border-bottom-left-radius: 0; border-top-left-radius: 0;"
																type="button"
																onclick="deleteSelfCheckbox(this)">
															<i class="fa fa-times"></i>
														</button>
													@endif
												</div>
											@endforeach
										@else
											<div class="input-group self-checkbox-item">
												<input type="text" name="char[{{ $option->type }}][{{ $option->id }}][]" class="form-control">
											</div>
										@endif
									</div>

									<hr>
									<button class="btn btn-xs btn-warning"
											type="button"
											onclick="addSelfCheckbox({{ $option->id }})">
										<i class="fa fa-plus" aria-hidden="true"></i> Добавить
									</button>
								</div>
							@elseif($option->childs->count())
								@foreach($option->childs as $child)
									<div class="custom-control custom-{{ $option->type }}">
										<input type="{{ $option->type }}"
											   name="char[{{ $option->type }}][{{ $option->id }}][]"
											   value="{{ $child->id }}"
											   class="custom-control-input"
											   id="item-{{ $child->id }}"
												{{ (@$values[$option->id] && in_array($child->id, $values[$option->id]->pluck('value')->toArray())) ? 'checked' : '' }}>
										<label class="custom-control-label" for="item-{{ $child->id }}">{{ $child->name_ru }}</label>
									</div>
								@endforeach
							@endif
						</div>
					</div>
				@endforeach

{{--				<div class="col-md-4">--}}
{{--					<label class="form-label">--}}
{{--						Дополнительный телефон--}}
{{--					</label>--}}
{{--					<input type="text" class="form-control" name="phone2" value="{{ user()->phone2 }}" autocomplete="off">--}}
{{--				</div>--}}

			</div>
			<hr>
			<button type="submit" class="btn btn-primary-dark-w submit-btn">
				Сохранить
			</button>
		</form>
	</div>
</div>
@stop