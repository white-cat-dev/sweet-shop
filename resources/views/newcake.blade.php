@extends('layout')

@section('content')
<div class="container">
	<h1>Новый торт</h1>
	<div class="row justify-content-center">
		<div class="col-12 col-xl-10">
			@if (count($errors) > 0)
			  <div class="alert alert-danger">
			    Не удалось добавить новый торт
			  </div>
			@endif
			<form action="/cake" method="POST" id="cake">
				{{ csrf_field() }} 
				<div class="cake-main">
					<div class="row">
						<div class="col-12 col-md-6 col-lg-4 text-center">
							<img src="/img/noimg.jpg" class="img-fluid">
							Фотография торта
						</div>
						<div class="col-12 col-md-6 col-lg-8">
							<div class="form-group">
								<label>Название</label>
								<input type="text" class="field" value="{{ old('title') }}" name="title">
								@if ($errors->has('title'))
									<p class="danger">
									    {{ $errors->first('title') }}
									</p>
								@endif
							</div>
							<div class="form-group">
								<label>Описание</label>
								<textarea class="field" rows="5" name="description">{{ old('description') }}</textarea>
								@if ($errors->has('description'))
									<p class="danger">
									    {{ $errors->first('description') }}
									</p>
								@endif
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label>Вес</label>
								<input type="text" value="{{ old('weight') }}" class="field small" name="weight"> кг
								@if ($errors->has('weight'))
									<p class="danger">
									    {{ $errors->first('weight') }}
									</p>
								@endif
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label>Цена</label>
								<input type="text" value="{{ old('price') }}" class="field small" name="price"> руб.
								@if ($errors->has('price'))
									<p class="danger">
									    {{ $errors->first('price') }}
									</p>
								@endif
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
				<button type="submit" class="btn btn-primary" form="cake"><i class="fas fa-save"></i> Сохранить</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	@if (old('ingredients'))
		window.ingredients = {!! json_encode(old('ingredients')) !!};
	@else 
		window.ingredients = [];
	@endif
	console.log(window.ingredients);
</script>
<script type="text/javascript" src="/js/cake.js"></script>

@endsection