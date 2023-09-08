@extends('layouts.base')
@section('contents')
    <div class="card mt-3 box-shadow">
        <div class="d-flex gap-3 align-items-center m-3 mt-5">
            <h1 class="text-gradient">Messaggi dell'Appartamento: {{ $apartment->title }}</h1>
            <img src="{{ asset('storage/' . $apartment->cover) }}" alt="{{ $apartment->title }}"
                style="height: 50px; border-radius: .5em;">
        </div>
        <div class="d-flex flex-wrap gap-5 justify-content-between m-3">
            @forelse ($messages as $message)
                <div class="message-card">
                    <p class="message-heading">Messaggio di: <br> {{ $message->email_sender }}</p>
                    <p class="message-para">Ricevuto il {{ $message->created_at->format('d/m/y') }}</p>
                    <div class="message-overlay"></div>

                    <!-- Button trigger modal -->
                    <button type="button" class="message-card-btn" data-bs-toggle="modal"
                        data-bs-target="#exampleModal{{ $message->id }}">
                        Leggi il messaggio
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{ $message->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                            <div class="modal-content message-card-noMessage">
                                <div class="d-flex justify-content-between">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Da: {{ $message->email_sender }}
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div style="padding: 2em;">{{ $message->text_message }}</div>
                                <div style="font-size: 12px">Ricevuto il {{ $message->created_at->format('d/m/y') }} alle
                                    {{ $message->created_at->format('H:i') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="message-card-noMessage">
                    <p class="message-heading">Nessun messaggio per questo Appartamento</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
