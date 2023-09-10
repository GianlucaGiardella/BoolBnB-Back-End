@extends('layouts.base')

@section('contents')
    <div class="card box-shadow mt-0">
        <div class="card-body d-flex flex-column py-3 gap-4">
            <div class="container d-flex justify-content-between">
                <h1>{{ $apartment->title }}</h1>
                @if ($apartment->sponsors()->where('valid', true)->count() > 0)
                
              <div>
                La tua sponsorizzazione scade il:
                <div>
                  {{ $apartmentSponsor->end_date->format('d/m/y') }}  
                </div>
                  Alle ore: <span>{{ $apartmentSponsor->end_date->format('H:i') }}</span>
              </div>
         
            @else
                <div>Sponsorizzazione NON ATTIVA</div>
            @endif
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
