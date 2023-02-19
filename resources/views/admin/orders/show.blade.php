@extends('layouts.admin')
@section('content')
    <div id="order-show">
        <h1 class="text-center mb-4">RIEPILOGO ORDINE</h1>
        <div class="d-flex flex-wrap justify-content-around mb-4">
            <div class="col-12 col-md-6">
                <h3 class="p-1">Dati Ordine</h3>
                <div class="p-1"><span class="fw-bold">Codice:</span> {{ $order->code }}</div>
                <div class="p-1"><span class="fw-bold">Data:</span> {{ $order->date }}</div>
                <div class="p-1 price"><span class="fw-bold">Prezzo Totale:</span> {{ $order->total_price }}&nbsp;&euro;
                </div>
            </div>
            <div class="col-12 col-md-6">
                <h3 class="p-1">Dati Cliente</h3>
                <div class="d-flex flex-wrap">
                    <div class="me-5 p-1 col-12 col-xxl-5"><span class="fw-bold">Nome:</span> {{ $order->name }}</div>
                    <div class="p-1 col-12 col-xxl-5"><span class="fw-bold">Telefono:</span> {{ $order->phone_number }}
                    </div>
                </div>
                <div class="p-1"><span class="fw-bold">Indirizzo</span>: {{ $order->address }}</div>
                <div class="p-1"><span class="fw-bold">Email:</span> {{ $order->email }}</div>
            </div>
        </div>
        <table class="my-lg-5">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Quantità</th>
                    <th scope="col">Prezzo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->allDishes as $dish)
                    <tr>
                        <td>{{ $dish->name }}</td>
                        <td>{{ $dish->pivot->quantity }}</td>
                        <td>{{ $dish->pivot->current_price }}&nbsp;&euro;</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

