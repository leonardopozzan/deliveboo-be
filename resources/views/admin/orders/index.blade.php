@extends('layouts.admin')
@section('content')
    <div id="table-list">
        <div class="table-container">
            {{-- @if (session()->has('message'))
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
                        <th scope="col" class="hidden-large">Email Cliente</th>
                        <th scope="col" class="hidden-small">Data Ricezione</th>
                        <th scope="col" class="hidden-large">Prezzo Totale</th>
                        <th scope="col">Status Pagamento</th>
                        <th scope="col" class="hidden-small">Nome Cliente</th>
                        <th scope="col" class="hidden-small">Telefono Cliente</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <th scope="row">{{ $order->id }}</th>
                            <td><a href="{{ route('admin.orders.show', $order->code) }}"
                                    title="View order">{{ $order->code }}</a></td>
                            <td class="hidden-large hidden-large">{{ $order->email }}</td>
                            <td class="hidden-small">{{ $order->date }}</td>
                            <td class="hidden-large">{{ $order->total_price }}&nbsp;&euro;</td>
                            @if ($order->payment_status)
                                <td>Pagato</td>
                            @else
                                <td>Non Pagato</td>
                            @endif
                            <td class="hidden-small">{{ $order->name }}</td>
                            <td class="hidden-small">{{ $order->phone_number }}</td>
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
