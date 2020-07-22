@if(empty($lang))
	<div class="form-group">
		<label>{{ $label }}</label>
		<div>
			@if(empty($ckeditor))
				<textarea name="{{ $name }}"
						  class="form-control">{{ !empty($data[@$name]) ? $data[@$name] : '' }}</textarea>
			@else
				<div class="ck-editor">
					<div class="toolbar-container"></div>
					<div class="editor-wrapper">
						<div class="editor"></div>
					</div>
					<textarea name="{{ $name }}" style="display: none;">
						{{ !empty($data[@$name]) ? $data[@$name] : '' }}
					</textarea>
				</div>
			@endif

			@if(!empty($help))
				<span class="help-block">{{ $help }}</span>
			@endif
		</div>
	</div>
@else
	@foreach(Language::get() as $key => $language)
		<div class="form-group lang-area field_{{ $language['short'] }}">
			<label>{{ $label }} {{ @$req ? '<span class="req">*</span>' : '' }}</label>
			<div>
				@if(empty($ckeditor))
					<textarea name="{{ $name }}[{{$language['short']}}]"
							  class="form-control">{{ !empty($data[@$name.'_'.$language['short']]) ? $data[@$name.'_'.$language['short']] : '' }}</textarea>
				@else
					<div class="ck-editor">
						<div class="toolbar-container"></div>
						<div class="editor-wrapper">
							<div class="editor"></div>
						</div>
						<textarea name="{{ $name }}[{{$language['short']}}]" style="display: none;">
							{{ !empty($data[@$name.'_'.$language['short']]) ? $data[@$name.'_'.$language['short']] : '' }}
						</textarea>
					</div>
				@endif

				@if(!empty($help))
					<span class="help-block">{{ $help }}</span>
				@endif
			</div>
		</div>
	@endforeach
@endif
