@extends('layout')

@section('content')
<div class="container">
	<h1>Редактирование торта</h1>
	<div class="row justify-content-center">
		<div class="col-12 col-xl-10">
			<form action="/cake/{{$cake->id}}" method="post" id="cake">
				{{ csrf_field() }} 
				{{ method_field('PUT') }}
				<div class="cake-main">
					<div class="row">
						<div class="col-12 col-md-6 col-lg-4 text-center">
							<img src="{{'/img/'.$cake->image->path}}" class="img-fluid" alt="{{$cake->image->alt}}">
							Фотография торта
						</div>
						<div class="col-12 col-md-6 col-lg-8">
							<div class="form-group">
								<label>Название</label>
								<input type="text" class="field" value="{{$cake->title}}" name="title">
							</div>
							<div class="form-group">
								<label>Описание</label>
								<textarea class="field" rows="5" name="description">{{$cake->description}}</textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label>Вес</label>
								<input type="text" value="{{$cake->weight}}" class="field small" name="weight"> кг
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label>Цена</label>
								<input type="text" value="{{$cake->price}}" class="field small" name="price"> руб.
							</div>
						</div>
					</div>
					<label>Ингредиенты</label>
					<div class="ingredients">
						<cakeingredients></cakeingredients>
					</div>
				</div>
			</form>
			<div class="bottom-buttons">
				<form action="/cake/{{$cake->id}}" method="POST">
					{{ csrf_field() }} 
					{{ method_field('DELETE') }}
					<button type="submit" class="btn btn-primary"><i class="fas fa-trash-alt"></i> Удалить</button>
				</form>
				<button type="submit" class="btn btn-primary" form="cake"><i class="fas fa-save"></i> Сохранить</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	window.ingredients = {!! json_encode($cake->ingredients) !!};
</script>
<script type="text/javascript" src="/js/cake.js"></script>

@endsection