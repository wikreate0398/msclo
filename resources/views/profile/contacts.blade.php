@extends('profile.layout')

@section('profile')
<div class="col-lg-9 order-lg-1">
	<div class="pb-7 mb-7">

		<!-- Title -->
		<div class="border-bottom border-color-1 mb-5">
			<h3 class="section-title mb-0 pb-2 font-size-25">Контакты</h3>
		</div>
		<!-- End Title -->

		<form action="{{ route('save_provider_contacts', ['lang' => $lang]) }}"
			  class="ajax__submit">
			{{ csrf_field() }}
			<div class="row">
				<div class="col-md-4">
					<!-- Input -->
					<div class="js-form-message mb-6">
						<label class="form-label">
							Часы работы
						</label>
						<div class="timepicker d-flex align-items-center">
							<input type="text" class="form-control" placeholder="C" name="work_from" value="{{ user()->work_from }}" autocomplete="off">
							&nbsp;-&nbsp;
							<input type="text" class="form-control" placeholder="По" name="work_to" value="{{ user()->work_to }}" autocomplete="off">
						</div>
						<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
						<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

						<script>
							$(document).ready(function () {
								$('.timepicker input').timepicker({
									timeFormat: 'HH:mm',
									interval: 30,
									startTime: '08:00',
									dynamic: true,
									dropdown: true,
									scrollbar: true
								});
							})
						</script>
					</div>
					<!-- End Input -->
				</div>


				<div class="col-md-4">
					<!-- Input -->
					<div class="js-form-message mb-6">
						<label class="form-label">
							Основной телефон
						</label>
						<input type="text" class="form-control" name="phone" value="{{ user()->phone }}" autocomplete="off">
					</div>
					<!-- End Input -->
				</div>
				<div class="col-md-4">
					<!-- Input -->
					<div class="js-form-message mb-6">
						<label class="form-label">
							Дополнительный телефон
						</label>
						<input type="text" class="form-control" name="phone2" value="{{ user()->phone2 }}" autocomplete="off">
					</div>
					<!-- End Input -->
				</div>


				<div class="col-md-6">
					<!-- Input -->
					<div class="js-form-message mb-6">
						<label class="form-label">
							E-Mail для контактов
						</label>
						<input type="email" class="form-control" name="contact_email" value="{{ user()->contact_email }}" autocomplete="off">
					</div>
					<!-- End Input -->
				</div>
				<div class="col-md-6">
					<!-- Input -->
					<div class="js-form-message mb-6">
						<label class="form-label">
							E-Mail для обратной связи
						</label>
						<input type="email" class="form-control" name="feedback_email" value="{{ user()->feedback_email }}" autocomplete="off">
					</div>
					<!-- End Input -->
				</div>


				<div class="col-md-3">
					<!-- Input -->
					<div class="js-form-message mb-6">
						<label class="form-label">
							Сайт
						</label>
						<input type="text" class="form-control" name="site" value="{{ user()->site }}" autocomplete="off">
					</div>
					<!-- End Input -->
				</div>
				<div class="col-md-3">
					<!-- Input -->
					<div class="js-form-message mb-6">
						<label class="form-label">
							Skype
						</label>
						<input type="text" class="form-control" name="skype" value="{{ user()->skype }}" autocomplete="off">
					</div>
					<!-- End Input -->
				</div>
				<div class="col-md-3">
					<!-- Input -->
					<div class="js-form-message mb-6">
						<label class="form-label">
							Instagram
						</label>
						<input type="text" class="form-control" name="instagram" value="{{ user()->instagram }}" autocomplete="off">
					</div>
					<!-- End Input -->
				</div>
				<div class="col-md-3">
					<!-- Input -->
					<div class="js-form-message mb-6">
						<label class="form-label">
							Vk
						</label>
						<input type="text" class="form-control" name="vk" value="{{ user()->vk }}" autocomplete="off">
					</div>
					<!-- End Input -->
				</div>

				<div class="col-md-6">
					<!-- Input -->
					<div class="js-form-message mb-6">
						<label class="form-label">
							Адрес офиса
						</label>
						<input type="text" class="form-control" name="office_address" value="{{ user()->office_address }}" autocomplete="off">
					</div>
					<!-- End Input -->
				</div>

				<div class="col-md-6">
					<!-- Input -->
					<div class="js-form-message mb-6">
						<label class="form-label">
							Адрес склада
						</label>
						<input type="text" class="form-control" name="warehouse_address" value="{{ user()->warehouse_address }}" autocomplete="off">
					</div>
					<!-- End Input -->
				</div>
				<div class="col-md-12">
					<!-- Input -->
					<div class="js-form-message mb-6">
						<label class="form-label">
							Другие контакты
						</label>
						<input type="text" class="form-control" name="other_contacts" value="{{ user()->other_contacts }}" autocomplete="off">
					</div>
					<!-- End Input -->
				</div>
				<div class="col-md-12">
					<!-- Input -->
					<div class="js-form-message mb-6">
						<label class="form-label">
							Примечание (отображаются на боковой плашке)
						</label>
						<input type="text" class="form-control" name="note" value="{{ user()->note }}" autocomplete="off">
					</div>
					<!-- End Input -->
				</div>

			</div>
			<button type="submit" class="btn btn-primary-dark-w">
				Сохранить
			</button>
		</form>
	</div>
</div>

<link  href="{{ asset('js/cropperjs/dist/cropper.css') }}" rel="stylesheet">
<script src="{{ asset('js/cropperjs/dist/cropper.js') }}"></script>
@stop