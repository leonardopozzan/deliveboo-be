@extends('layouts.admin')
@section('content')

    <body>
        <div class="containerShow">
            <div class="titleDish text-center">
                <h1 class="text-center text-uppercase mb-lg-5 mt-2">{{ $dish->name }}</h1>
            </div>
            <div class="containery">
                <div class="cardShow">
                    <div class="cardImageShow">
                        @if ($dish->image)
                            <img src="{{ asset('storage/' . $dish->image) }}" alt="">
                        @else
                            <img src="https://via.placeholder.com/300x200" alt="">
                        @endif
                    </div>
                    <div class="cardDescriptionShow p-lg-3 ms-5">
                        <p>Ingredienti : <span class="text-capitalize"> <em>{{ $dish->ingredients }}</em> </span></p>
                        <p>Prezzo : {{ $dish->price }} €</p>
                        @if ($dish->category)
                            <p>Categoria : <span class="text-capitalize">{{ $dish->category->name }}</span></p>
                        @endif
                        @if ($dish->visible)
                            <p>Visibile : Si</p>
                        @else
                            <p>Visibile : No </p>
                        @endif

                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-around m-4">
                <a href="{{ route('admin.dishes.index', $dish->slug) }}"
                    class="btn btn-primary text-uppercase">indietro</a>
                <a href="{{ route('admin.dishes.edit', $dish->slug) }}"
                    class="btn btn-danger text-uppercase text-white">modifica</a>
                {{-- <form action="{{route('admin.dishes.destroy', $dish->slug)}}" method="POST" class=" d-inline">
			@csrf
			@method('DELETE')
			<button type="submit" class="btn btn-danger">ELIMINA</button>
			</form> --}}
            </div>
        </div>
    </body>
@endsection
