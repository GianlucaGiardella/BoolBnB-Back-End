@extends('admin.layouts.base')
@section('contents')
<h1>Sponsorizzazione</h1>
<p>Raggiungete un vasto pubblico per il vostro appartamento con una sponsorizzazione su misura! Offriamo una varietà di opzioni di sponsorizzazione, sia standard che personalizzate, per soddisfare al meglio le vostre esigenze. Scegliete la soluzione ideale per promuovere il vostro appartamento e attirare il massimo numero di potenziali clienti!</p>
<div class="container d-flex justify-content-between">
    @foreach ($sponsors as $sponsor)
        <div class="card" style="width: 18rem;">
            <div class="card-body">
            <h5 class="card-title">{{ $sponsor->name}}</h5>
            <p class="card-text">Durata {{ $sponsor->duration}}h</p>
            <p class="card-text">Prezzo {{ $sponsor->price}}€</p>
            <a href="#" class="btn btn-primary">Compra</a>
            </div>
        </div>
    @endforeach
</div>

@endsection
