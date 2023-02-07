@extends('layouts.admin')
@section('content')
<div id="table-list">
    <div class="table-container">
        {{-- @if(session()->has('message'))
        <div class="alert alert-success mb-3 mt-3 w-75 m-auto text-capitalize">
            {{ session()->get('message') }}
        </div>
        @endif --}}
        {{-- <a href="{{route('admin.orders.create')}}" class="text-white"><button class="btn btn-primary mb-2"><i class="fa-solid fa-plus"></i></button></a> --}}
        <table class="mb-2">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Codice Ordine</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Indirizzo</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Email</th>
                    <th scope="col">Data ordine</th>
                    <th scope="col">Prezzo Totale</th>
                    <th scope="col">Status Pagamento</th>
                </tr>
            </thead>
            <tbody>
                 @foreach ($orders as $order) 
                    <tr>
                        <th scope="row">{{$order->id}}</th>
                        <td><a href="{{route('admin.orders.show', $order->code)}}" title="View order">{{$order->code}}</a></td>
                        <td>{{$order->total_price}}&nbsp;&euro;</td>
                        <td>{{$order->payment_status}}</td>
                        {{-- <td>
                            <form action="{{route('admin.dishes.destroy', $dish->slug)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-button text-white btn btn-danger ms-3" data-item-title="{{$dish->name}}"><i class="fa-solid fa-trash-can"></i></button>
                            </form>
                        </td> --}}
                    </tr> 
                @endforeach
            </tbody>
        </table>
        {{-- {{ $orders->links('vendor.pagination.bootstrap-5') }} --}}
        @include('partials.admin.modal')
    </div>
</div>

@endsection