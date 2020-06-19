@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="col-md-12"> 
	 	<div class="widget">
			<div class="widget-header animated-underline-content">
				<ul class="nav nav-tabs mb-3" id="animateLine">
					<li class="active nav-item">
						<a href="#tab_1" data-toggle="tab" class="nav-link active" id="tab_1-tab" role="tab" aria-controls="tab_1" aria-selected="true">
							Основное </a>
					</li>
					<li class="nav-item">
						<a href="#tab_2" data-toggle="tab" class="nav-link" id="tab_2-tab" role="tab" aria-controls="tab_2" aria-selected="false">
							Seo </a>
					</li>
				</ul>
				@include('admin.utils.language_switcher')
			</div>
 
			<div class="widget-content">
	 
				<form action="/{{ $method }}/{{ $data['id'] }}/update" class="ajax__submit">

					{{ csrf_field() }}

					<div class="tab-content">
						<div class="tab-pane active" id="tab_1">
							@include('admin.utils.input', ['label' => 'Название', 'lang' => true, 'name' => 'name', 'data' => $data])

							@if(!$data->let_alone)
								@include('admin.utils.input', ['label' => 'Ссылка', 'req' => true, 'name' => 'url', 'help' => 'Без http://www и.т.п просто английская фраза, без пробелов, отражающая пункт меню, например Наш подход - our-approach', 'data' => $data])
							@endif

						    @include('admin.utils.textarea', ['label' => 'Текст', 'lang' => true, 'name' => 'text', 'ckeditor' => true, 'data' => $data])
						</div>

						<div class="tab-pane" id="tab_2">
							@include('admin.utils.input', ['label' => 'Заголовок', 'lang' => true, 'name' => 'seo_title', 'data' => $data])

							@include('admin.utils.textarea', ['label' => 'Описание', 'lang' => true, 'name' => 'seo_description', 'data' => $data])

							@include('admin.utils.input', ['label' => 'Ключевые слова', 'lang' => true, 'name' => 'seo_keywords', 'data' => $data])
						</div>
					</div>
					<button type="submit" class="btn btn-success mt-3 submit-btn">Сохранить</button>
				</form> 

			</div>
		</div>
	</div>
</div>
 
@stop