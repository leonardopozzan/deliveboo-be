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
                    <th scope="col">Codice</th>
                    <th scope="col">Email Cliente</th>
                    <th scope="col">Data Ricezione</th>
                    <th scope="col">Prezzo Totale</th>
                    <th scope="col">Status Pagamento</th>
                    <th scope="col">Nome Cliente</th>
                    <th scope="col">Telefono Cliente</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order) 
                    <tr>
                        <th scope="row">{{$order->id}}</th>
                        <td><a href="{{route('admin.orders.show', $order->code)}}" title="View order">{{$order->code}}</a></td>
                        <td>{{$order->email}}</td>
                        <td>{{$order->date}}</td>
                        <td>{{$order->total_price}}&nbsp;&euro;</td>
                        @if ($order->payment_status)
                            <td>Pagato</td>
                        @else
                            <td>Non Pagato</td>
                        @endif
                        <td>{{$order->name}}</td>
                        <td>{{$order->phone_number}}</td>
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
        {{ $orders->links('vendor.pagination.bootstrap-5') }}
        @include('partials.admin.modal')
    </div>
</div>

@endsection