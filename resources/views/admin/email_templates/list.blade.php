@extends('layouts.admin') 

@section('content')
	<div class="row">  
		<div class="col-md-12">
			<div class="widget">
				<div class="widget-content">
					<table class="table table-bordered">
						<thead>
						<tr>
							<th>Название шаблонов</th>
							<th></th>
						</tr>
						</thead>

						<tbody>
						@foreach($data as $item)
							<tr>
								<td style="width: 99%;">{{ $item['name'] }}</td>
								<td>
									<a href="/{{ $method }}/{{ $item['id'] }}/edit/" class="btn btn-primary btn-xs">
										<i class="fa fa-pencil"></i>
									</a>
								</td>
							</tr>
						@endforeach

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@stop

