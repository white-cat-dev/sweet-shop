@extends('layout')

@section('content')

<div class="container">
	<h1>Ингредиенты и их наличие</h1>
	<div class="ingredients">
		<div class="row justify-content-center">
			<div class="col-12 col-xl-10 text-center">
				<ingredients></ingredients>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="/js/ingredients.js"></script>

@endsection