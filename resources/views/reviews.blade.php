@extends('layout')

@section('content')

<div class="container">
	<h1>Отзывы</h1>
	<div class="reviews">
		<div class="row">
			@forelse($reviews as $review)
			<div class="col-12 col-lg-6">
				<div class="review-card">
					<div class="row align-items-center">
						<div class="col-12 col-sm-7 order-sm-2">
							<p class="name">{{$review->client->name}}</p>
							@if($review->cake)
							<h3>{{$review->cake->title}}</h3>
							@endif
							<p class="review">{{$review->review}}</p>
						</div>
						
						<div class="col-12 col-sm-5 order-sm-1">				@if($review->image)
							<img src="{{'/img/'.$review->image->path}}" alt="{{$review->image->alt}}" class="img-fluid">
							@else
							<img src="/img/noimg.jpg" class="img-fluid">
							@endif
						</div>
					</div>
					<div class="buttons">
						<form action="/review/{{$review->id}}" method="POST">
							{{ csrf_field() }} 
							{{ method_field('DELETE') }}
							<button type="submit" class="btn btn-primary"><i class="fas fa-trash-alt"></i> Удалить</button>
						</form>
					</div>
				</div>
			</div>
			@empty
			<div class="center-info">У вас нет отзывов</div>
			@endforelse
		</div>
	</div>
</div>

@endsection