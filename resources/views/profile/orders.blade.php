@extends('profile.layout')

@section('profile')
<div class="col-lg-12 order-lg-1">
	<div class="pb-7 mb-7">

		<!-- Title -->
		<div class="border-bottom border-color-1 mb-5">
			<h3 class="section-title mb-0 pb-2 font-size-25">Заказы</h3>
		</div
		<!-- End Title -->

		@if($orders->count())
		<div class="mb-10 cart-table">
			<table class="table table-bordered" cellspacing="0">
				<thead>
					<tr>
						<th></th>
						<th>№</th>
						<th>Имя</th>
						<th>E-mail</th>
						<th>Телефон</th>
						<th>Дата</th>
						<th>Итог, {{ RUB }}</th>
					</tr>
				</thead>
				<tbody>
				@foreach($orders as $order)
					<tr>
						<td onclick="showPurchaseProducts(this)" class="purchase-collapse">
							<i class="fas fa-angle-right"></i>
						</td>
						<td>{{ $order->rand }}</td>
						<td>{{ $order->user->name }}</td>
						<td>{{ $order->user->email }}</td>
						<td>{{ $order->user->phone }}</td>
						<td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
						<td>{{ priceString($order->total_price) }}</td>
					</tr>
					<tr style="display: none" class="purchase-prod">
						<td colspan="7">
							<table class="table" style="background: #ededed">
								<thead>
									<tr>
										<th></th>
										<th>Наиминование</th>
										<th>Цена</th>
										<th>Кол-во</th>
										<th>Итог, {{ RUB }}</th>
									</tr>
								</thead>
								<tbody>
									@foreach($order->products as $product)
										<tr>
											<td>
												<a href="{{ route('view_product', ['lang' => lang(), 'url' => $product->product->url]) }}">
													<img class="img-fluid max-width-100 p-1 border border-color-1"
														 src="{{ imageThumb(@$product->product->images->first()->image, 'uploads/products', 300, 300, '300X300') }}">
												</a>
											</td>
											<td>{{ $product->product["name_$lang"] }}</td>
											<td>{{ priceString($product->price) }}</td>
											<td>{{ $product->qty }}</td>
											<td>{{ priceString($product->price*$product->qty) }}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
		@else
			<div class="alert alert-warning">
				Нет Заказов
			</div>
		@endif
	</div>
</div>

@stop