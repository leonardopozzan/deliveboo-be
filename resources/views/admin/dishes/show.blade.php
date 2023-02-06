@extends('layouts.admin')
@section('content')
 <h1 class="text-center">{{$dish->name}}</h1>
<div class="containerx">
    <div class="cardShow">
        <div class="cardImageShow">
            {{-- {{dd($dish)}}  --}}
            <img src="{{asset('storage/' . $dish->image)}}" alt="">
        </div>
          <div class="cardDescriptionShow">
            <p>Ingredienti : {{$dish->ingredients}}</p> 
            <p>Prezzo : {{$dish->price}}</p> 
            @if ($dish->category)
                <p>Categoria : {{$dish->category->name}}</p>
            @endif

            <p>Visibile : {{$dish->visible}}</p>
            
            <a href="{{route('admin.dishes.index', $dish->slug)}}" class="btn btn-primary">INDIETRO</a>
            <a href="{{route('admin.dishes.edit', $dish->slug)}}" class="btn btn-secondary">MODIFICA</a>
            <form action="{{route('admin.dishes.destroy', $dish->slug)}}" method="POST" class=" d-inline">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">ELIMINA</button>
            </form>
          </div>
    </div>
</div> 
@endsection