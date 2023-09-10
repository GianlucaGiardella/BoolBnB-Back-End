@extends('layouts.base')

@section('contents')
    <div class="card box-shadow mt-0">
        <div class="card-body d-flex flex-column py-3 gap-4">

            {{-- Header --}}
            <div class="container">
                <div class="d-inline-block text-gradient">
                    <h1>Vista dell'appartamento: {{ $apartment->title }}</h1>
                </div>
                <hr class="m-0">
            </div>

            <div class="container">
                <h1>{{ $apartment->title }}</h1>
            </div>

            <div class="container">
                <h5>
                    <i class="fa-solid fa-map-location-dot"></i>
                    {{ $apartment->street }}
                </h5>
            </div>

            <div class="container">
                <div class="container container-img px-0">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-2">
                        <div class="img-apartment">
                            <div class="overflow-hidden">
                                <img src="{{ asset('storage/' . $apartment->cover) }}" alt="{{ $apartment->title }}"
                                    class="cover" />
                            </div>
                        </div>

                        @foreach ($apartment->images as $image)
                            <div class="img-apartment">
                                <div class="overflow-hidden">
                                    <img src="{{ asset('storage/' . $image->img_url) }}" alt="" />
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="container">
                <h4>Descrizione</h4>
                <p>{{ $apartment->description }}</p>
            </div>

            <div class="container">
                <div class="row row-cols-1 row-cols-md-2">
                    <div class="container">
                        <h3>Informazioni appartamento:</h3>
                        <h4>Dimensioni: {{ $apartment->size }} m<sup>2</sup></h4>
                        <h4>Camere: {{ $apartment->rooms }}</h4>
                        <h4>Letti: {{ $apartment->beds }}</h4>
                        <h4 class="line me-2">Bagni: {{ $apartment->bathrooms }}</h4>
                        <h4>Cosa troverai</h4>
                        <ul class="list-unstyled">
                            @foreach ($apartment->services as $service)
                                <li>
                                    <i class="fa-solid fa-square-check"></i>
                                    {{ $service->name }}
                                </li>
                            @endforeach
                        </ul>
                        @if ($apartment->sponsors()->where('valid', true)->count() > 0)
                            Hai gia una sponsor
                        @endif
                    </div>

                    <div class="container">
                        <div class="d-flex flex-column h-100 gap-3">
                            <a class="d-flex align-items-center justify-content-center link-unstyled text-white fs-2 w-100 h-100"
                                href="http://localhost:5174/apartments/{{ $apartment->slug }}" class="tip">
                                <button class="w-100 styled-btn">
                                    Mostra sul sito
                                </button>
                            </a>
                            <a class="d-flex align-items-center justify-content-center link-unstyled text-white fs-2 w-100 h-100"
                                href="{{ route('admin.apartments.edit', ['apartment' => $apartment]) }}" class="tip">
                                <button class="w-100 styled-btn">
                                    Modifica
                                </button>
                            </a>
                            <a class="d-flex align-items-center justify-content-center link-unstyled text-white fs-2 w-100 h-100"
                                href="{{ route('admin.apartments.messages', ['apartment' => $apartment]) }}"
                                class="tip">
                                <button class="w-100 styled-btn">
                                    Messaggi
                                </button>
                            </a>
                            <a class="d-flex align-items-center justify-content-center link-unstyled text-white fs-2 w-100 h-100"
                                href="{{ route('admin.apartments.sponsors', ['apartment' => $apartment]) }}"
                                class="tip">
                                <button class="w-100 styled-btn">
                                    Sponsorizza
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
