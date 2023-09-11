@extends('layouts.base')

@section('contents')
    <div class="card box-shadow mt-0">
        <div class="card-body d-flex flex-column gap-3 py-3">

            {{-- Header --}}
            <div class="container">
                <div class="d-inline-block text-gradient">
                    <h1>Tutti i messaggi ricevuti</h1>
                </div>
                <hr class="m-0">
            </div>

            {{-- Message --}}
            <div class="container">
                @if (count($apartments))
                    <div class="d-flex flex-column gap-3">
                        @if (count($messages))
                            @foreach ($messages as $message)
                                <div class="message-card">
                                    <h2 class="text-gradient m-0 fs-5 ellipsis">{{ $message->apartment->title }} <br>
                                        Da: {{ $message->email_sender }}</h2>
                                    <p class="data text-gradient m-0" style="font-size: 14px">
                                        {{ $message->created_at->format('d/m/y') }}
                                    </p>
                                    <div class="message-overlay"></div>

                                    <!-- Button trigger modal -->
                                    <button class="message-card-btn" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal{{ $message->id }}">
                                        Apri
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{ $message->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content message-card-noMessage p-3">
                                                <h2 class="text-gradient fs-5 fw-3 ellipsis mw-100" id="exampleModalLabel">
                                                    Da:
                                                    {{ $message->email_sender }}
                                                </h2>
                                                <div class="py-2">{{ $message->text_message }}</div>
                                                <div class="text-gradient" style="font-size: 12px">Ricevuto il
                                                    {{ $message->created_at->format('d/m/y') }}
                                                    alle
                                                    {{ $message->created_at->format('H:i') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="container">
                                <h2>Attualmente non hai messaggi</h2>
                            </div>
                        @endif
                    </div>
                @else
                    <div class="container">
                        <h2>Non disponi di alcun appartamento</h2>
                        <button class="style-btn">Aggiungi</button>
                    </div>
                @endif
            </div>

            {{-- Pagination --}}
            {{-- <div class="container">
                {{ $messages->links() }}
            </div> --}}

        </div>
    </div>
@endsection
