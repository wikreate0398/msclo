@extends('layouts.admin')

@section('content') 
	<div class="row">
		<div class="col-md-12" style="margin-bottom: 20px;">
			<a href="#add_panel" class="btn btn-primary btn-sm open-area-btn">
				<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Добавить
			</a> 
		</div>

		<div class="col-md-12 area-panel" id="add_panel"> 
			<div class="widget">
				<div class="widget-content">
					<form action="/{{ $method }}/create" class="ajax__submit form-horizontal">

						{{ csrf_field() }}

						<div class="form-group">
							<label>Тип</label>
							<div>
								<select name="type"  class="form-control">
									@foreach($userTypes as $key => $type)
										<option value="{{ $type->type }}">
											{{ $type["name_ru"] }}
										</option>
									@endforeach
								</select>
							</div>
						</div>

						@include('admin.utils.input', ['label' => 'Имя', 'req' => true, 'name' => 'name'])
						@include('admin.utils.input', ['label' => 'Телефон', 'name' => 'phone'])
						@include('admin.utils.input', ['label' => 'E-mail', 'req' => true, 'name' => 'email'])
						@include('admin.utils.image', ['inputName' => 'image'])
						@include('admin.utils.input', ['label' => 'Пароль', 'req' => true, 'name' => 'password', 'type' => 'password'])
						@include('admin.utils.input', ['label' => 'Повторите Пароль', 'req' => true, 'name' => 'repeat_password', 'type' => 'password'])

						<button type="submit" class="btn btn-success submit-btn">Сохранить</button>

					</form>
				</div>
			</div>
			 
		</div>


		<div class="col-md-12" style="margin-bottom: 20px;">
			<div class="row widget-statistic">
				<div class="col-md-4">
					<div class="widget widget-one_hybrid widget-followers">
						<div class="widget-heading">
							<div class="w-icon">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
							</div>
							<p class="w-value">{{ $today_reg }}</p>
							<h5 class="">Зарегистрировано сегодня </h5>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="widget widget-one_hybrid widget-referral">
						<div class="widget-heading">
							<div class="w-icon">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
							</div>
							<p class="w-value">{{ $week_reg }} </p>
							<h5 class="">Зарегистрировано за неделю </h5>
						</div>
						<div class="widget-content">
							<div class="w-chart">
								<div id="hybrid_followers1"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="widget widget-one_hybrid widget-engagement">
						<div class="widget-heading">
							<div class="w-icon">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
							</div>
							<p class="w-value">{{ $total_reg }}</p>
							<h5 class="">Всего зарегистрированных</h5>
						</div>
						<div class="widget-content">
							<div class="w-chart">
								<div id="hybrid_followers3"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12">

			<div class="widget" style="margin-bottom: 20px;">
				<div class="widget-content">
					<form action="">
						<div class="row">
							<div class="col-md-4">
								<input type="text" name="search" value="{{ @request()->search }}" class="form-control">
							</div>

							<div class="col-md-3">
								<select name="sort" class="form-control">
									<option value="0">Сортировать</option>
									<option value="all" {{ (request()->sort == 'all') ? 'selected' : '' }}>
										Все
									</option>
									<option value="active" {{ (request()->sort == 'active') ? 'selected' : '' }}>
										Активные
									</option>
									<option value="no-active" {{ (request()->sort == 'no-active') ? 'selected' : '' }}>
										Неактивные
									</option>
								</select>
							</div>

							<div class="col-md-3">
								<select name="sort" class="form-control">
									<option value="all" {{ (request()->type == 'all') ? 'selected' : '' }}>
										Все
									</option>
									<option value="active" {{ (request()->sort == 'client') ? 'selected' : '' }}>
										Активные
									</option>
									<option value="no-active" {{ (request()->sort == 'provider') ? 'selected' : '' }}>
										Неактивные
									</option>
								</select>
							</div>

							<div class="col-md-2">
								<button type="submit" class="btn btn-primary">Поиск</button>
								@if(request()->search or request()->sort)
									<a href="/{{ $method }}/" class="btn btn-danger">Сбросить</a>
								@endif
							</div>

						</div>
					</form>
				</div>
			</div>
			
			@if($data->count())
				<div class="widget">
					<div class="widget-content">

							<table class="table table-bordered">
								<tbody>
								<tr>
									<th style="width:5%; text-align: center"><i class="fa fa-check-square" aria-hidden="true"></i></th>
									<th class="nw">ФИО</th>
									<th class="nw">Тип</th>
									<th>E-mail</th>
									<th>Телефон</th>
									<th>Последний визит</th>
									<th style="width:5%; text-align: center"><i class="fa fa-cogs" aria-hidden="true"></i></th>
								</tr>
								</tbody>
								<tbody>
								@foreach($data as $item)
									<tr>
										<td style="width:5px; white-space: nowrap;">
											<label class="switch s-success mr-2">
												<input type="checkbox"
													   {{ !empty($item['active']) ? 'checked' : '' }}
													   onchange="Ajax.buttonView(this, '{{ $table }}', '{{ $item["id"] }}', 'active')">
												<span class="slider round"></span>
											</label>
										</td>
										<td class="nw">{{ $item->name }}</td>
										<td>{{ $item->typeData->name_ru }}</td>
										<td>{{ $item->email }}</td>
										<td>{{ $item->phone }}</td>
										<td class="nw">{{ $item->last_entry ? $item->last_entry->format('d.m.Y H:i') : '' }}</td>
										<td style="width: 5px; white-space: nowrap">
											<a href="/{{ $method }}/{{ $item['id'] }}/autologin/" target="_blank" class="btn btn-primary btn-xs">
												<i class="fa fa-sign-in" aria-hidden="true"></i>
											</a>
											<a style="margin-left: 5px;" href="/{{ $method }}/{{ $item['id'] }}/edit/" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
											<a class="btn btn-danger btn-xs" data-toggle="modal" href="#deleteModal_{{ $table }}_{{ $item['id'] }}"><i class="fa fa-trash"></i></a>
											<!-- Modal -->
										@include('admin.utils.delete', ['id' => $item['id'], 'table' => $table])
										<!-- Modal -->
										</td>
									</tr>
								@endforeach
								</tbody>
							</table>

					</div>
				</div>
			@else
				<div class="alert alert-warning">Нет клиентов</div>
			@endif
		</div>
	</div>
@stop

