@extends('profile.layout')

@section('profile')
<div class="col-lg-12 order-lg-1">
	<div class="pb-7 mb-7">

		<div class="row align-items-center">
			<div class="col-md-12">
				<!-- Billing Form -->
				<form action="{{ route('edit_userdata', ['lang' => $lang]) }}"
					  class="ajax__submit profile__image_form" onsubmit="return false">
					{{ csrf_field() }}

						<div class="row">
							<div class="col-md-3">
								<div class="profile-photo">

										<div class="profile__img" style="background-image: url('{{ user()->image ? '/uploads/users/' . user()->image : '/uploads/no-avatar.png' }}');">
											<div class="actions__upload_photo" >
									<span class="btn-file">
									    <i class="fa fa-image" aria-hidden="true"></i>
									</span>
												<input type="file" class="avatar__fileimage" name="image" onchange="profilePhoto(this)">
												<input type="hidden" name="avatar" id="avatar">
											</div>

											<div class="preloader__image_content" style="display: none;">
												<div class="loader-inner ball-pulse">
													<div></div>
													<div></div>
													<div></div>
												</div>
											</div>
										</div>
								</div>
							</div>

							<div class="popup" style="display: none; width: 400px;height: 400px;" id="profile-avatar">
								<div class="row">
									<div class="col-md-12">
										<div class="cropper__image_content">
											<img src="" id="image__crop" alt="">
										</div>
									</div>

									<div class="col-md-12">
										<button id="crop__btn"  type="button" class="btn btn-primary">Обрезать</button>
										<div id="result"></div>
									</div>
								</div>
							</div>

							<div class="col-md-9">
								<div class="row">

									<div class="col-md-12">
										<!-- Input -->
										<div class="js-form-message mb-6">
											<label class="form-label">
												Имя
												<span class="text-danger">*</span>
											</label>
											<input type="text" class="form-control" name="name" value="{{ user()->name }}" autocomplete="off">
										</div>
										<!-- End Input -->
									</div>

									<div class="col-md-6">
										<!-- Input -->
										<div class="js-form-message mb-6">
											<label class="form-label">
												E-mail
												<span class="text-danger">*</span>
											</label>
											<input type="email" class="form-control" name="email" value="{{ user()->email }}" autocomplete="off">
										</div>
										<!-- End Input -->
									</div>

									<div class="col-md-6">
										<!-- Input -->
										<div class="js-form-message mb-6">
											<label class="form-label">
												Телефон
											</label>
											<input type="text" class="form-control" name="phone" value="{{ user()->phone }}" autocomplete="off">
										</div>
										<!-- End Input -->
									</div>
								</div>
							</div>
						</div>
					<div class="row">

						<div class="w-100"></div>

						@if(user()->type == 'provider')
							<div class="col-md-12 mb-5">
								<label class="form-label">
									Короткое Описание в карточке
								</label>
								<textarea name="description" class="form-control">{{ user()->description }}</textarea>
							</div>

							<div class="col-md-12">
								<label class="form-label">
									Полное описание в карточке
								</label>
								<div class="ck-editor">
									<div class="toolbar-container"></div>
									<div class="editor-wrapper">
										<div class="editor"></div>
									</div>
									<textarea name="text" style="display: none;">{{ user()->text }}</textarea>
								</div>
							</div>
					 	@endif

					</div>
					<button type="submit" class="btn btn-primary-dark-w mt-5 submit-btn">
						Сохранить
					</button>
				</form>
				<!-- End Billing Form -->
			</div>

		</div>


		<!-- Title -->
		<div class="border-bottom border-color-1 mb-5 mt-7">
			<h3 class="section-title mb-0 pb-2 font-size-25">Сменить пароль</h3>
		</div>
		<!-- End Title -->
		<!-- Accordion -->
		<div id="shopCartAccordion3" class="accordion rounded mb-5">
			<!-- Card -->
			<div class="card border-0">

				<form action="{{ route('change_password', ['lang' => $lang]) }}"
					  class="ajax__submit">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-md-4">
							<!-- Input -->
							<div class="js-form-message mb-6">
								<label class="form-label">
									Старый Пароль
									<span class="text-danger">*</span>
								</label>
								<input type="password" class="form-control" name="old_password" autocomplete="off">
							</div>
							<!-- End Input -->
						</div>


						<div class="col-md-4">
							<!-- Input -->
							<div class="js-form-message mb-6">
								<label class="form-label">
									Новый Пароль
									<span class="text-danger">*</span>
								</label>
								<input type="password" class="form-control" name="new_password" autocomplete="off">
							</div>
							<!-- End Input -->
						</div>

						<div class="col-md-4">
							<!-- Input -->
							<div class="js-form-message mb-6">
								<label class="form-label">
									Повторите
									пароль
									<span class="text-danger">*</span>
								</label>
								<input type="password" class="form-control" name="repeat_password" autocomplete="off">
							</div>
							<!-- End Input -->
						</div>

					</div>

					<button type="submit" class="btn btn-primary-dark-w submit-btn">
						Сохранить
					</button>
				</form>
			</div>
			<!-- End Card -->
		</div>
		<!-- End Accordion -->
	</div>
</div>

<link  href="{{ asset('js/cropperjs/dist/cropper.css') }}" rel="stylesheet">
<script src="{{ asset('js/cropperjs/dist/cropper.js') }}"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/19.1.1/decoupled-document/ckeditor.js"></script>
<script src="/js/ckinit.js?v={{ time() }}" type="text/javascript"></script>
@stop