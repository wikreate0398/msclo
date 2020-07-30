@extends('profile.layout')

@section('profile')
<div class="col-lg-9 order-lg-1">
	<div class="pb-7 mb-7">

		<!-- Title -->
		<div class="border-bottom border-color-1 mb-5">
			<h3 class="section-title mb-0 pb-2 font-size-25">Файлы</h3>
		</div>
		<!-- End Title -->

		<form action="{{ route('save_files', ['lang' => $lang]) }}"
			  class="ajax__submit">
			{{ csrf_field() }}

			<div class="provider_files_wrapper">
				@php
					$imgData = [];
					$imgInfo = [];
                    if($files->count()){
                      foreach($files as $image){
                        $realPath = public_path('uploads/provider_files') . '/' . $image->file;

                        $imgData[] = [
                          'name'  => $image->file,

                          'size'  => filesize($realPath),
                          'file'  => '/uploads/provider_files/' . $image->file,
                          'type'  => mime_content_type($realPath),
                        ];

                        $imgInfo[] = [
                            'title' => $image->name_ru,
                          	'text'  => $image->description_ru,
						];
                      }
                    }
				@endphp
				<input type="file"
					   name="files"
					   class="provider_files"
					   data-fileuploader-theme="default"
					   data-json='{"table": "providers_files", "field": "file"}'
					   data-info='<?=json_encode($imgInfo)?>'
					   data-fileuploader-files='<?=json_encode($imgData)?>'>

					<div class="text-danger mb-3">Расширения: <code>pdf</code>,<code>doc</code>,<code>docx</code>,<code>word</code></div>
			</div>

			<button type="submit"
					class="btn btn-primary-dark-w files-btn-save submit-btn"
					style="{{ !$files->count() ? 'display:none' : '' }}">
				Сохранить
			</button>
		</form>

		<link href="{{ asset('admin_theme/assets/js') }}/fileuploader/dist/font/font-fileuploader.css" media="all" rel="stylesheet">
		<link href="{{ asset('admin_theme/assets/js') }}/fileuploader/dist/jquery.fileuploader.min.css" media="all" rel="stylesheet">
		<script src="{{ asset('admin_theme/assets/js') }}/fileuploader/dist/jquery.fileuploader.min.js" type="text/javascript"></script>

		<script>
			var deleteProviderFileRoute = '{{ route('delete_file', compact('lang')) }}';
		</script>
	</div>
</div>

@stop