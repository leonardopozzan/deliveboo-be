<h1>Ciao Persona!</h1>
<p>
    <p>
		Hai ricevuto un nuovo messaggio:<br>
		Nome: {{ $lead->name }}<br>
		Email: {{ $lead->email }}<br>
		Messaggio:<br>
		{{ $lead->message }}
    </p>
</p>