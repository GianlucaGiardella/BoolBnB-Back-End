@extends('layouts.base')

@section('contents')
    {{-- <div class="card mt-3 p-2">

        <div class="card-body d-flex flex-column gap-3 align-items-start">
            <div class="text-gradient">
                <h1 class="">{{ $apartment->title }}</h1>
                <hr class="m-0">
            </div>
            <div class="container d-flex flex-row justify-content-between">
                <button class="styled-btn">
                    <a class="nav-link" href="{{ route('admin.apartments.edit', ['apartment' => $apartment]) }}">Modifica
                        Appartamento</a>
                </button>

                <div>
                    <button class="styled-btn d-flex align-items-center">
                        <a class="nav-link" href="{{ route('admin.apartments.sponsors', ['apartment' => $apartment]) }}">
                            Sponsorizza
                        </a>
                        <svg class="svgIcon" viewBox="0 0 576 512">
                            <path
                                d="M512 80c8.8 0 16 7.2 16 16v32H48V96c0-8.8 7.2-16 16-16H512zm16 144V416c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V224H528zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm56 304c-13.3 0-24 10.7-24 24s10.7 24 24 24h48c13.3 0 24-10.7 24-24s-10.7-24-24-24H120zm128 0c-13.3 0-24 10.7-24 24s10.7 24 24 24H360c13.3 0 24-10.7 24-24s-10.7-24-24-24H248z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div class="">
            <h4 class="">Description</h4>
            <p>{{ $apartment->description }}</p>
        </div>

        <div class="mt-4">
            <h4 class="">Servizi</h4>
            <p>
                @foreach ($apartment->services as $service)
                    {{ $service->name }}
                    {{ !$loop->last ? '|' : '' }}
                @endforeach
            </p>
        </div>

        <div>
            <h5>Via: {{ $apartment->street }}</h5>
            <h5>Metri Quadrati: {{ $apartment->size }}</h5>
            <h5>Camere: {{ $apartment->rooms }}</h5>
            <h5>Letti: {{ $apartment->beds }}</h5>
            <h5>Bagni: {{ $apartment->bathrooms }}</h5>
        </div>

        <div class="option-card">
            <div class="card red">
                <h2 class="tip">Modifica</h2>
            </div>
            <div class="card blue">
                <h2 class="tip">Messaggi</h2>
            </div>
            <div class="card green">
                <h2 class="tip">Sponsorizza</h2>
            </div>
        </div>

        <button class="styled-btn w-25">
            <a class="nav-link" href="{{ route('admin.apartments.messages', ['apartment' => $apartment]) }}">Messaggi</a>
        </button>
    </div> --}}

    <div class="card box-shadow mt-0">
        <div class="card-body d-flex flex-column py-3 gap-4">
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
                            <img src="{{ asset('storage/' . $apartment->cover) }}" alt="{{ $apartment->title }}"
                                class="cover" />
                        </div>

                        @foreach ($apartment->images as $image)
                            <div class="img-apartment">
                                <img src="{{ asset('storage/' . $image->img_url) }}" alt="" />
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
                    </div>
                    <div class="container">
                        <div class="option-card h-100 border rounded">
                            <div class="card red">
                                <a class="link-unstyled text-white fs-2 w-100 h-100"
                                    href="{{ route('admin.apartments.edit', ['apartment' => $apartment]) }}"
                                    class="tip">Modifica</a>
                            </div>
                            <div class="card blue">
                                <a class="link-unstyled text-white fs-2 w-100 h-100"
                                    href="{{ route('admin.apartments.messages', ['apartment' => $apartment]) }}"
                                    class="tip">Messaggi</a>
                            </div>
                            <div class="card green">
                                <a class="link-unstyled text-white fs-2 w-100 h-100"
                                    href="{{ route('admin.apartments.sponsors', ['apartment' => $apartment]) }}"
                                    class="tip">Sponsorizza</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
