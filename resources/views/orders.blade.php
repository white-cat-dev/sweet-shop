@extends('layout')

@section('content')

<div class="container">
	<h1>Заказы</h1>
	<div class="orders">
		<div class="filters">
			Статус заказа:
			<a href="/orders/status=1" class="btn-link">Новый</a>
			<a href="/orders/status=2" class="btn-link">Текущий</a>
			<a href="/orders/status=3" class="btn-link">Отклоненный</a>
			<a href="/orders/status=4" class="btn-link">Выполненный</a>
			<a href="/orders" class="btn-link">Все</a>
		</div>
		<div class="row">
			@forelse($orders as $order)
			<div class="col-12 col-lg-6">
				<div class="order-card">
					<h2>Заказ №{{$order->id}}</h2>
					<p class="title">Данные клиента</p>
					<div class="block">
						<p><span class="field-title">Имя: </span>{{$order->client->name}}</p>
						<p><span class="field-title">Номер телефона: </span>{{$order->client->phone_number}}</p>
					</div>
					<p class="title">Комментарий к заказу</p>
					<div class="block">
						@if ($order->comment)
						{{$order->comment}}
						@else
						(Клиент не оставил комментарий)
						@endif
					</div>
					<p class="title">Дата исполнения</p>
					<div class="block">
						{{$order->execution_date}}
					</div>
					<p class="title">Состав заказа</p>
					<div class="block">
						<ol>
							@foreach($order->cakes as $num => $cake)
							<li>{{$num+1}}) {{$cake->title}} - {{$cake->price}} руб. ({{$cake->pivot->quantity+0}} шт)</li>
							@endforeach
						</ol>
						<p class="price">{{$order->cost}} руб.</p>
					</div>
					<p class="title">Статус</p>
					<div class="block">
						{{$statuses[$order->status]}} заказ
					</div>
					<div class="buttons">
					@switch($order->status)
					@case(1)
						<form action="/order/{{$order->id}}" method="POST">
							{{ csrf_field() }} 
							{{ method_field('PUT') }}
							<input type="hidden" name="status" value="2">
							<button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Принять</button>
						</form>
						<form action="/order/{{$order->id}}" method="POST">
							{{ csrf_field() }} 
							{{ method_field('PUT') }}
							<input type="hidden" name="status" value="3">
							<button type="submit" class="btn btn-primary"><i class="fas fa-times"></i> Отклонить</button>
						</form>
				    @break

				    @case(2)
						<form action="/order/{{$order->id}}" method="POST">
							{{ csrf_field() }} 
							{{ method_field('PUT') }}
							<input type="hidden" name="status" value="4">
							<button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Заказ выполнен</button>
						</form>
				    @break

				    @case(3)
						<form action="/order/{{$order->id}}" method="POST">
							{{ csrf_field() }} 
							{{ method_field('DELETE') }}
							<button type="submit" class="btn btn-primary"><i class="fas fa-trash-alt"></i> Удалить</button>
						</form>
				        @break

				    @case(4)
						<form action="/order/{{$order->id}}" method="POST">
							{{ csrf_field() }} 
							{{ method_field('DELETE') }}
							<button type="submit" class="btn btn-primary"><i class="fas fa-trash-alt"></i> Удалить</button>
						</form>
				        @break
					
					@endswitch
					</div>
				</div>
			</div>
			@empty
			<div class="center-info">У вас нет заказов</div>
			@endforelse
		</div>
	</div>
</div>

@endsection