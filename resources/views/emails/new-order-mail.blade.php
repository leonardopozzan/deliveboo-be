{{-- <h1>Hai un nuovo ordine da {{$lead->name}}</h1>
<p>
    <p>
		Clicca per vedere i dettagli:<br>
		{{ $lead->message }}
    </p>
</p> --}}



<body bgcolor="#EC0B43"  id="customer-email">
  <div class="mail-container">
    <div class="box">
      <h1>Hai un nuovo ordine da {{$lead->name}}</h1>
    
      <div class="link"><a target="_blank"  href="{{ $lead->message }}">Vai ai dettagli</a> </div>

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

.mail-container .box a{
  text-decoration: none;
  background-color: #EC0B43;
  padding: 0.7rem 1.2rem; 
  color: white;
  font-size: 19px;
  font-weight: bold;
  border-radius: 10px;
}
.mail-container .box .link{
  margin: 30px 0;

}
    .mail-container .box .img-box{
      width: 150px;
    }

</style>