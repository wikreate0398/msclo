@if(empty($lang))
	<div class="form-group">
		<label>{!! $label !!} {!! @$req ? '<span class="req">*</span>' : '' !!}</label>
		<input type="{{ empty($type) ? 'text' : $type }}" autocomplete="off" class="form-control {{ @$attributes['class'] }}" {{ @$req ? 'required' : '' }} value="{{ !empty($data[@$name]) ? $data[@$name] : '' }}" name="{{ $name }}">
		@if(!empty($help))
			<span class="help-block">{!! $help !!}</span>
		@endif
	</div>
@else
	@foreach(Language::get() as $key => $language)
		<div class="form-group lang-area field_{{ $language['short'] }}">
			<label>{{ $label }} {!! @$req ? '<span class="req">*</span>' : '' !!}</label>
			<input type="text" 
			       class="form-control"
			       value="{{ !empty($data[@$name.'_'.$language['short']]) ? $data[@$name.'_'.$language['short']] : '' }}"
			       name="{{ $name }}[{{$language['short']}}]">

				@if(!empty($help))
					<span class="help-block">{!! $help !!}</span>
				@endif
		</div>
	@endforeach
@endif