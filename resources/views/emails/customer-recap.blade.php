

<body bgcolor="#EC0B43"  id="customer-email">
  <div class="mail-container">
    <div class="box">
      <h1>Ciao {{ $lead->name }}! </h1>
      <p>
          <h3>
      		Grazie per il tuo ordine!<br>
      		{{-- {!! $lead->message !!} --}}
          </h3>
      </p>
      <table class="my-lg-5">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Quantità</th>
                <th scope="col">Prezzo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items->allDishes as $dish)
                <tr>
                    <td>{{ $dish->name }}</td>
                    <td>{{ $dish->pivot->quantity }}</td>
                    <td>{{ $dish->pivot->current_price }}&nbsp;&euro;</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="price"><span class="fw-bold">Prezzo Totale:</span> {{ $items->total_price }}&nbsp;&euro;</div>
    <div class="date"><span class="fw-bold">Data:</span>  {{ substr($items->date, 0, 10) }}</div>
    <h2>Buon appetito da</h2>
    <img class="img-box" src="http://127.0.0.1:8000/storage/img/dish-drop-rb-01.png" alt="">
    </div>
    </div>
  </div>
</body>

<style >

  .mail-container{
    display: flex;
    align-items: center;
    justify-content: center;

  }
.mail-container .box{
  margin-top: 50px;

  background-color: white;
  padding: 2rem;
  border-radius: 20px;
  width: 600px;
}
.mail-container .box h1{
  text-transform: capitalize;
}

.mail-container .box table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.9em;
    font-family: sans-serif;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);



   
}
   

.mail-container .box table thead tr {
        background-color: #EC0B43;
        color: white;
        text-align: left;
    }

    .mail-container .box table th,
    .mail-container .box table td {
        padding: 12px 15px;
    }

    .mail-container .box table tbody tr {
        border-bottom: 1px solid $border-grey;
    }

    .mail-container .box table tbody tr:last-of-type {
        border-bottom: 2px solid #EC0B43;
    }

    .mail-container .box table tbody tr.active-row {
        font-weight: bold;
        color: #EC0B43;
    }

    .mail-container .box table button {
        color: white;
    }

    .mail-container .box .price{
      font-size: 20px;
      color: #EC0B43;
      margin: 20px 0;
    }
    .mail-container .box .img-box{
      width: 150px;
    }

</style>