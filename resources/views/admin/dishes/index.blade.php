@extends('layouts.admin')

@section('content')
    <div id="table-list">
        <div class="table-container">
            @if (session()->has('message'))
                <div class="alert alert-success mb-3 mt-3 w-75 m-auto text-capitalize">
                    {{ session()->get('message') }}
                </div>
            @endif
            <a href="{{ route('admin.dishes.create') }}" class="text-white"><button class="btn btn-success mb-2"><i
                        class="fa-solid fa-plus"></i></button></a>
            <table class="mb-2">
                <thead>
                    <tr>
                        <th class="bl-hidden" scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th class="bl-hidden hidden" scope="col">Prezzo</th>
                        <th class="bl-hidden hidden" scope="col">Categoria</th>
                        <th class="bl-hidden hidden-small" scope="col">Visibile</th>
                        <th scope="col" class="hidden-small">Modifica</th>
                        <th scope="col">Cancella</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dishes as $dish)
                        <tr>
                            <th class="bl-hidden" scope="row">{{ $dish->id }}</th>
                            <td><a href="{{ route('admin.dishes.show', $dish->slug) }}"
                                    title="Guarda {{ $dish->name }}">{{ $dish->name }}</a></td>
                            <td class="bl-hidden hidden">{{ $dish->price }}&nbsp;&euro;</td>
                            <td class="bl-hidden hidden">{{ $dish->category->name }}</td>
                            @if ($dish->visible)
                                <td class="bl-hidden hidden-small">SI</td>
                            @else
                                <td class="bl-hidden hidden-small">NO</td>
                            @endif

                            <td class="hidden-small"><a class="link-secondary"
                                    href="{{ route('admin.dishes.edit', $dish->slug) }}" title="Edit dish"><i
                                        class="fa-solid fa-pen"></i></a></td>
                            <td>
                                <form action="{{ route('admin.dishes.destroy', $dish->slug) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-button text-white btn btn-danger ms-3"
                                        data-item-title="{{ $dish->name }}"><i
                                            class="fa-solid fa-trash-can"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $dishes->links('vendor.pagination.bootstrap-5') }}
            @include('partials.admin.modal')
        </div>
    </div>
@endsection
