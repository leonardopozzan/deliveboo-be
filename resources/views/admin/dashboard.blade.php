@extends('layouts.admin')

@section('content')
<body>
    <div class="containery">
        <div class="cardShow">
            <div class="cardDescriptionShow p-5">
                <p>Nome: {{$restaurant->name}}</p>
                <p>Indirizzo: {{$restaurant->address}}</p>
                <p>Email: {{$restaurant->email}}</p>
                <p>Telefono: {{$restaurant->phone_number}}</p>
                <p>Partita IVA: {{$restaurant->p_iva}}</p>
                <p>Apertura: {{$restaurant->opening_hours}}</p>
                <p>Chiusura: {{$restaurant->closing_hours}}</p>
                <p>Sito Web: {{$restaurant->website}}</p>

            </div>
            <div class="cardImageShow">
                <img src="{{asset('/storage/' . $restaurant->image)}}" alt="">
            </div>

            </div>
        </div>

        <div class="containerInfoShow">
            <div class="containerz">
                <div class="cardInfoShow">
                    <div class="cardOrderShow">
                      <p>ULTIMI ORDINI EFFETTUATI</p>
                    </div>
                    <div class="cardGraphShow p-3">
                        <p>GRAFICO</p>
                    </div>
                </div>
            </div>
        </div> 
    </div> 
    

</body>

@endsection
