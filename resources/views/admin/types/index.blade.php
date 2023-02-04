@extends('layouts.admin')
@section('content')
<h1>Types</h1>
<ul>
    @foreach ($types as $type)
        <li>{{$type->name}}</li>
    @endforeach
</ul>
@endsection