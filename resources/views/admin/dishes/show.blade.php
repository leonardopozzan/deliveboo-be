@extends('layouts.admin')
@section('content')


<body>
	<div class="containerShow">
		<div class="titleDish text-center">
			<h1 class="text-center text-uppercase">{{$dish->name}}</h1>
		</div>
		<div class="containery">
			<div class="cardShow">
				<div class="cardImageShow">
					@if ($dish->image)
                    	<img src="{{asset('storage/' . $dish->image)}}" alt="">
                	@else
                    	<img src="https://via.placeholder.com/300x200" alt="">
                	@endif
				</div>
				<div class="cardDescriptionShow p-3">
					<p>Ingredienti : {{$dish->ingredients}}</p> 
					<p>Prezzo : {{$dish->price}}</p> 
					@if ($dish->category)
					<p>Categoria : {{$dish->category->name}}</p>
					@endif

					<p>Visibile : {{$dish->visible}}</p>
				</div>
			</div>
		</div>

		<div class="d-flex justify-content-around m-4">
			<a href="{{route('admin.dishes.index', $dish->slug)}}" class="btn gradient-1 text-uppercase text-white">indietro</a>
			<a href="{{route('admin.dishes.edit', $dish->slug)}}" class="btn gradient-2 text-uppercase text-white">modifica</a>
			{{-- <form action="{{route('admin.dishes.destroy', $dish->slug)}}" method="POST" class=" d-inline">
			@csrf
			@method('DELETE')
			<button type="submit" class="btn btn-danger">ELIMINA</button>
			</form> --}}
		</div> 
	</div>
</body>

@endsection