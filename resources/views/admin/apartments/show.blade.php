@extends('layouts.base')

@section('contents')
    <div class="card box-shadow mt-0">
        <div class="card-body d-flex flex-column py-3 gap-4">

            {{-- Header --}}
            <div class="container overflow-hidden">
                <div class="d-inline-block text-gradient">
                    <h1>Vista Appartamento</h1>
                    <h2 class="ellipsis mw-100">{{ $apartment->title }}</h2>
                </div>
                <hr class="m-0">
            </div>

            <div class="container">
                <div class="row row-cols-1 row-cols-md-2 g-3">
                    <h1 class="mb-0">{{ $apartment->title }}</h1>
                    <div class="sponsor d-flex">
                        @if ($apartment->sponsors()->where('valid', true)->count() > 0)
                            <div>
                                <h5 class="sponsor-title d-flex align-items-center m-0 gap-2">
                                    <i class="fa-regular fa-star fs-3"></i>
                                    Sponsorizzato
                                </h5>
                                <p class="m-0">Scadenza:
                                    {{ $apartmentSponsor->end_date->format('H:i') }} del
                                    {{ $apartmentSponsor->end_date->format('d/m/y') }}
                                </p>
                            </div>
                        @else
                            <h5 class="m-0">Sponsorizzazione NON ATTIVA</h5>
                        @endif
                    </div>
                </div>
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
                <p class="pb-3 border-bottom m-0">{{ $apartment->description }}</p>
            </div>

            <div class="container">
                <div class="row row-cols-1 row-cols-md-2 border-bottom">
                    <div class="container">
                        <div class="d-flex flex-column gap-3 pb-3">
                            <div class="pb-3 border-bottom d-flex flex-column gap-2">
                                <h3>Informazioni appartamento:</h3>
                                <h4>Dimensioni: {{ $apartment->size }} m<sup>2</sup></h4>
                                <h4>Camere: {{ $apartment->rooms }}</h4>
                                <h4>Letti: {{ $apartment->beds }}</h4>
                                <h4 class="m-0 me-2">Bagni: {{ $apartment->bathrooms }}</h4>
                            </div>
                            <div class="">
                                <h4>Cosa troverai</h4>
                                <ul class="list-unstyled m-0 row row-cols-1 row-cols-md-2 g-3">
                                    @foreach ($apartment->services as $service)
                                        <li>
                                            <i class="{{ $service->icon }}"></i>
                                            {{ $service->name }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="d-flex flex-column h-100 gap-3 pb-3">
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

    <style>
        .sponsor,
        .sponsor-title {
            justify-content: flex-end !important;
        }

        @media (max-width: 767px) {

            .sponsor,
            .sponsor-title {
                justify-content: flex-start !important;
            }

        }
    </style>
