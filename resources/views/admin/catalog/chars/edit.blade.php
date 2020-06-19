@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="col-md-12">
	 	<div class="widget">
			<div class="widget-content">
				<form action="/{{ $method }}/{{ $data['id'] }}/update" class="ajax__submit form-horizontal">

					{{ csrf_field() }}

					<div class="form-body" style="padding-top: 20px;">
						@include('admin.utils.input', ['label' => 'Название', 'name' => 'name', 'lang' => true, 'data' => $data])

						<div class="form-group">
							<label>Тип</label>
							<div>
								<div class="n-chk">
									<label class="new-control new-radio new-radio-text radio-primary">
										<input type="radio" {{ ($data->type == 'input') ? 'checked' : '' }} onchange="selectCharType(this)" class="new-control-input" name="type" value="input">
										<span class="new-control-indicator"></span><span class="new-radio-content">Свободный</span>
									</label>
								</div>

								<div class="n-chk">
									<label class="new-control new-radio new-radio-text radio-primary">
										<input type="radio" {{ ($data->type == 'checkbox') ? 'checked' : '' }} onchange="selectCharType(this)" class="new-control-input" name="type" value="checkbox">
										<span class="new-control-indicator"></span><span class="new-radio-content">Множественный</span>
									</label>
								</div>

								<div class="n-chk">
									<label class="new-control new-radio new-radio-text radio-primary">
										<input type="radio" {{ ($data->type == 'radio') ? 'checked' : '' }} onchange="selectCharType(this)" class="new-control-input" name="type" value="radio">
										<span class="new-control-indicator"></span><span class="new-radio-content">Один из нескольких</span>
									</label>
								</div>
							</div>
						</div>

						@if(!$data->parent_id)
							<div style="{{ !in_array($data->type, ['checkbox', 'radio']) ? 'display: none;' : '' }}">
								<button class="btn btn-sm btn-warning" type="button" onclick="addChars();">Добавить значения</button>

								<table class="table table-bordered" style="<?=!$data->childs->count() ? 'display: none;' : ''?> margin-top: 20px;" id="add-chars-table">
									<tbody class="sort-chars">
									<?php foreach ($data->childs as $item): ?>
									<tr>
										<td style="width:50px; text-align:center;" class="handle"> </td>
										<td style="width: calc(99% - 50px)">
											<input type="text"
												   name="value[ru][id:<?=$item['id']?>]"
												   class="form-control lang-area"
												   id="field_ru"
												   value="<?=$item["name_ru"]?>">
										</td>
										<td style="width:1%">
											<a class="btn default btn-sm" data-toggle="modal" href="#deleteModal_{{ $table }}_{{ $item['id'] }}">
												<i class="fa fa-times"></i> Удалить
											</a>
											@include('admin.utils.delete', ['id' => $item['id'], 'table' => $table])
										</td>
									</tr>
									<?php endforeach ?>
									</tbody>
								</table>
							</div>
						@endif
					</div>

					<button type="submit" class="btn btn-success submit-btn" style="margin-top: 20px;">Сохранить</button>
				</form>
			</div>
		</div>
	</div>
</div>
@stop