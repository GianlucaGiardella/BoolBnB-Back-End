{{-- @vite('resources/js/suggestion.js') --}}
{{-- @vite('resources/js/suggestion-prova.js') --}}
@vite('resources/js/autocomplete.js')
@vite('resources/js/client-validations/apartment-validations.js')

@extends('admin.layouts.base')

@section('contents')
    <div class="card mt-0">
        <div class="card-body py-3">
            <div class="container">
                <div class="d-inline-block text-gradient">
                    <h1>Aggiungi Appartamento</h1>
                    <hr>
                </div>
            </div>

            <form method="post" action="{{ route('admin.apartments.store') }}" id="form"
                class="d-flex flex-column gap-3 mb-0" enctype="multipart/form-data" novalidate>
                @csrf

                <div class="container">
                    <div class="row row-cols-1 row-cols-lg-2">
                        <div class="container">
                            <div class="row row-cols-1 mt-0">
                                <div class="input_container">
                                    <label for="title" class="form-label fs-4 fw-4">Titolo</label>
                                    <input type="text"
                                        class="form-control shadow-none @error('title') is-invalid @enderror" id="title"
                                        name="title" value="{{ old('title') }}">
                                    <div class="error"></div>
                                    @error('title')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="input_container">
                                    <label for="street" class="form-label fs-4 fw-4">Indirizzo Completo</label>
                                    <input type="text" class="form-control @error('street') is-invalid @enderror"
                                        id="street" name="street" value="{{ old('street') }}"
                                        placeholder="Indirizzo, Numero Civico, Città, Paese">
                                    <ul data-bs-spy="scroll" id="suggestions-street"
                                        class="list-group list-group-flush position-absolute z-3"
                                        style="top: calc(100% - 15px)">
                                    </ul>
                                    <div class="error"></div>
                                    @error('street')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row row-cols-1 row-cols-sm-2 mt-0">
                                <div class="input_container_split">
                                    <label for="size" class="form-label fs-4 fw-4">Metri Quadrati</label>
                                    <input type="number"
                                        class="form-control shadow-none @error('size') is-invalid @enderror" id="size"
                                        name="size" value="{{ old('size') }}">
                                    <div class="error"></div>
                                    @error('size')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="input_container_split">
                                    <label for="rooms" class="form-label fs-4 fw-4">Camere</label>
                                    <input type="number"
                                        class="form-control shadow-none @error('rooms') is-invalid @enderror" id="rooms"
                                        name="rooms" value="{{ old('rooms') }}">
                                    <div class="error"></div>
                                    @error('rooms')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="input_container_split">
                                    <label for="beds" class="form-label fs-4 fw-4">Letti</label>
                                    <input type="number"
                                        class="form-control shadow-none @error('beds') is-invalid @enderror" id="beds"
                                        name="beds" value="{{ old('beds') }}">
                                    <div class="error"></div>
                                    @error('beds')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="input_container_split">
                                    <label for="bathrooms" class="form-label fs-4 fw-4">Bagni</label>
                                    <input type="number"
                                        class="form-control shadow-none @error('bathrooms') is-invalid @enderror"
                                        id="bathrooms" name="bathrooms" value="{{ old('bathrooms') }}">
                                    <div class="error"></div>
                                    @error('bathrooms')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="input_container h-100">
                        <label for="description" class="form-label fs-4 fw-4">Descrizione</label>
                        <textarea type="text" class="form-control shadow-none @error('description') is-invalid @enderror" id="description"
                            name="description" rows="5">{{ old('description') }}</textarea>
                        <div class="error"></div>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="container">
                    <div class="row row-cols-1 row-cols-md-2 align-items-center g-3">
                        <div class="">
                            <h4 class="my-2">Immagine Principale</h4>
                            <div class="upload-img-container input_container">
                                <input type="file" class="upload-img @error('cover') is-invalid @enderror" id="cover"
                                    name="cover" accept="image/png, image/jpg, image/jpeg" value="{{ old('cover') }}">
                                <span id="remove-cover" class="remove-image btn">&#128465;</span>
                                <div class="error"></div>
                                @error('cover')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="">
                            <h4 class="my-2">Altre Immagini | max: 5</h4>
                            <div class="upload-img-container input_container">
                                <input type="file" class="upload-img @error('images') is-invalid @enderror"
                                    id="images" name="images[]" accept="image/png, image/jpg, image/jpeg"
                                    value="{{ old('images') }}" multiple>
                                <span id="remove-images" class="remove-image btn">&#128465;</span>
                                <div class="error"></div>
                                @error('images')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <h4 class="my-2">Servizi</h4>
                    <div class="container">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4">
                            @foreach ($services as $service)
                                <div class="mb-2 form-check">
                                    <input type="checkbox" class="form-check-input" id="service{{ $service->id }}"
                                        name="services[]" value="{{ $service->id }}"
                                        @if (in_array($service->id, old('services', []))) checked @endif>
                                    <label class="form-check-label"
                                        for="service{{ $service->id }}">{{ $service->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <h4 class="my-2">Visibilità Appartamento</h4>
                        <label class="rocker rocker-small">
                            <input type="checkbox" name="visibility" value="1"
                                {{ old('visibility') ? 'checked' : '' }}>
                            <span class="switch-left">Si</span>
                            <span class="switch-right">No</span>
                        </label>
                    </div>
                </div>

                <div class="container">
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="styled-btn">Aggiungi Appartamento</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection