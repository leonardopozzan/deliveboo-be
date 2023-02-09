@extends('layouts.admin')

@section('content')
<body>
    <div class="containery">
        <div class="cardShow">
            <div class="cardDescriptionShow p-4">
                <p>Nome: {{$restaurant->name}}</p>
                <p>Indirizzo: {{$restaurant->address}}</p>
                <p>Email: {{$restaurant->email}}</p>
                <p>Telefono: {{$restaurant->phone_number}}</p>
                <p>Partita IVA: {{$restaurant->p_iva}}</p>
                <p>
                    <span>Tipologia: </span>
                    @foreach($restaurant->types as $type)
                        <span> {{$type->name}}</span>
                    @endforeach
                </p>
                <p>Apertura: {{substr($restaurant->opening_hours,0,-3)}}</p>
                <p>Chiusura: {{substr($restaurant->closing_hours,0,-3)}}</p>
                @if ($restaurant->website)
               
                     <p>Sito Web: <a href="{{'http://'.$restaurant->website}}">{{$restaurant->website}}</a> </p>
                @endif
                
            </div>
            <div class="cardImageShow">
                @if ($restaurant->image)
                    <img src="{{asset('/storage/' . $restaurant->image)}}" alt="">
                @else
                    <img src="https://via.placeholder.com/300x200" alt="">
                @endif
            </div>
        </div>

        <div class="containerInfoShow">
            <div class="containerz">
                <div class="cardInfoShow">
                    <div class="cardOrderShow">
                      <p class="text-capitalize">ultimi ordini effettuati </p>
                    </div>
                    <div class="cardGraphShow p-3">
                        <p>?Grafico da implementare per gli ordini</p>
                    </div>
                </div>
            </div>
        </div> 
    </div> 
    

</body>

@endsection
