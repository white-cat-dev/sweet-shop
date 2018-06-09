@extends('layout')

@section('content')
<div class="container">
	<h1>Мои торты</h1>
	<div class="cakes">
		<div class="row justify-content-center">
			@forelse($cakes as $cake)
				<div class="col-12 col-xl-10">
					<div class="cake-card">
						<h2>{{$cake->title}}</h2>
						<div class="row">
							<div class="col-12 col-md-6 col-lg-4">
								<img src="{{'/img/'.$cake->image->path}}" class="img-fluid" alt="{{$cake->image->alt}}">
							</div>
							<div class="col-12 col-md-6 col-lg-8">
								<h3>Описание</h3>
								<p>{{$cake->description}}</p>
								<h3>Ингредиенты</h3>
								<ol>
									@forelse($cake->ingredients as $num => $ingredient)
									<li>{{$num+1}}) {{$ingredient->title}} - {{$ingredient->pivot->quantity+0}} {{$ingredient->units}}</li>
									@empty
										Кажется, вы забыли добавить ингредиенты
									@endforelse
								</ol>
								<h3>Цена</h3>
								<p class="price">{{$cake->price}} руб.</p>
							</div>
						</div>
						<div class="buttons">
							<form action="/cake/{{$cake->id}}" method="POST">
								{{ csrf_field() }} 
								{{ method_field('DELETE') }}
								<button type="submit" class="btn btn-primary"><i class="fas fa-trash-alt"></i> Удалить</button>
							</form>
							<a href="/cake/{{$cake->id}}/edit" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Редактировать</a>
						</div>
					</div>
				</div>
			@empty
			<div class="center-info">У вас нет тортов</div>
			@endforelse
			<div class="bottom-buttons">
				<a href="/cake/create" class="btn btn-primary"><i class="fas fa-plus"></i> Добавить новый торт</a>
			</div>
		</div>
	</div>
</div>

@endsection