@extends('layouts.admin')
@section('content')
<h1>Dish</h1>
<ul>
    @foreach ($dishes as $dish)
        <li>{{$dish->name}}</li>
    @endforeach
</ul>

@endsection