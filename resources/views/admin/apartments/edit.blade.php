@vite('resources/js/suggestion.js')
@vite('resources/js/client-validations/apartment-validations.js')

@extends('layouts.base')

@section('contents')
    <div class="card box-shadow mt-0">
        <div class="card-body py-3">
            <div class="container">
                <div class="d-inline-block text-gradient">
                    <h1>Modifica Appartamento</h1>
                    <hr>
                </div>
            </div>

            <form class="d-flex flex-column gap-3 mb-0" method="post"
                action="{{ route('admin.apartments.update', ['apartment' => $apartment]) }}" id="form"
                enctype="multipart/form-data" novalidate>
                @csrf
                @method('put')

                <div class="container">
                    <div class="row row-cols-1">
                        <div class="d-flex flex-column gap-2 mt-0">
                            {{-- Title --}}
                            <div class="input_container">
                                <label for="title" class="form-label fs-4 fw-4 text-gradient">Titolo</label>
                                <input type="text" class="form-control shadow-none" id="title" name="title"
                                    value="{{ old('title', $apartment->title) }}">
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="error"></div>
                            </div>

                            {{-- Country --}}
                            <div class="input_container">
                                <label for="country" class="form-label fs-4 fw-4 text-gradient">Nazione</label>
                                <select id="country" class="form-select @error('country') is-invalid @enderror"
                                    name="country">
                                    <option value="">Seleziona Nazione</option>
                                    {{-- <option value="">Seleziona Nazione</option> --}}
                                </select>
                                <input type="hidden" id="old_country" name="old_country"
                                    value="{{ old('country', $apartment->country) }}">
                                @error('country')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="error"></div>
                            </div>

                            {{-- Street --}}
                            <div class="input_container">
                                <label for="street" class="form-label fs-4 fw-4 text-gradient">Via</label>
                                <input type="text"
                                    class="form-control bs-autocomplete @error('street') is-invalid @enderror"
                                    id="street" name="street" value="{{ old('street', $apartment->street) }}"
                                    autocomplete="off">
                                <ul id="suggestions-street" class="list-group list-group-flush position-absolute z-3"
                                    style="top: calc(100% - 15px); left: 12px">
                                </ul>
                                @error('street')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="error"></div>
                            </div>

                            {{-- Zip --}}
                            <div class="input_container">
                                <label for="zip" class="form-label fs-4 fw-4 text-gradient">Numero Civico</label>
                                <input type="number" class="form-control shadow-none @error('zip') is-invalid @enderror"
                                    id="zip" name="zip" value="{{ old('zip', $apartment->zip) }}">
                                @error('zip')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="error"></div>
                            </div>
                        </div>

                        {{-- Images --}}
                        <div class="container">
                            <h4 class="my-2 text-gradient">Immagini</h4>
                            <div class="container container-img px-0">
                                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-2">

                                    {{-- Cover --}}
                                    <div class="img-apartment position-relative">
                                        <label for="add-cover" class="d-block">
                                            <img src="{{ asset('storage/' . $apartment->cover) }}" id="cover" />
                                        </label>
                                        <span id="remove-cover" class="btn remove-image">&#128465;</span>
                                        <input type="file" id="add-cover" name="cover"
                                            accept="image/png, image/jpg, image/jpeg" class="d-none">
                                        <input type="hidden" id="old-cover" class="d-none" name="old_cover"
                                            value="{{ $apartment->cover }}">
                                    </div>

                                    {{-- Others --}}
                                    @for ($i = 0; $i < 5; $i++)
                                        @if ($i < count($apartment->images))
                                            @php
                                                $image = $apartment->images[$i];
                                            @endphp
                                            <div class="img-apartment position-relative images">
                                                <label for="add-image{{ $i }}" class="d-block">
                                                    <img src="{{ asset('storage/' . $image->img_url) }}" class="image" />
                                                </label>

                                                <input type="file" class="d-none" id="add-image{{ $i }}"
                                                    name="image{{ $i }}"
                                                    accept="image/png, image/jpg, image/jpeg">

                                                <input type="hidden" class="d-none old-image"
                                                    name="old_image{{ $i }}" value="{{ $image->img_url }}">

                                                <span id="remove-images" class="btn remove-image">&#128465;</span>
                                            </div>
                                        @else
                                            <div class="img-apartment position-relative images">
                                                <label for="add-image{{ $i }}" class="d-block">
                                                    <img src="{{ asset('storage/') }}" class="image" />
                                                </label>

                                                <input type="file" class="d-none" id="add-image{{ $i }}"
                                                    name="image{{ $i }}"
                                                    accept="image/png, image/jpg, image/jpeg">

                                                <input type="hidden" class="d-none old-image"
                                                    name="old_image{{ $i }}" value="">

                                                <span id="remove-images" class="btn remove-image">&#128465;</span>
                                            </div>
                                        @endif
                                    @endfor

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Description --}}
                <div class="container">
                    <div class="input_container h-100">
                        <label for="description" class="form-label fs-4 fw-4 text-gradient">Descrizione</label>
                        <textarea type="text" class="form-control shadow-none @error('description') is-invalid @enderror" id="description"
                            name="description" rows="5">{{ old('description', $apartment->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="error"></div>
                    </div>
                </div>

                <div class="container">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-2 mt-0">
                        {{-- Size --}}
                        <div class="input_container_split">
                            <label for="size" class="form-label fs-4 fw-4 text-gradient">Dimensioni |
                                m<sup>2</sup></label>
                            <input type="number" class="form-control shadow-none @error('size') is-invalid @enderror"
                                id="size" name="size" value="{{ old('size', $apartment->size) }}">
                            @error('size')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="error"></div>
                        </div>

                        {{-- Rooms --}}
                        <div class="input_container_split">
                            <label for="rooms" class="form-label fs-4 fw-4 text-gradient">Camere</label>
                            <input type="number" class="form-control shadow-none @error('rooms') is-invalid @enderror"
                                id="rooms" name="rooms" value="{{ old('rooms', $apartment->rooms) }}">
                            @error('rooms')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="error"></div>
                        </div>

                        {{-- Beds --}}
                        <div class="input_container_split">
                            <label for="beds" class="form-label fs-4 fw-4 text-gradient">Letti</label>
                            <input type="number" class="form-control shadow-none @error('beds') is-invalid @enderror"
                                id="beds" name="beds" value="{{ old('beds', $apartment->beds) }}">
                            @error('beds')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="error"></div>
                        </div>

                        {{-- Bathrooms --}}
                        <div class="input_container_split">
                            <label for="bathrooms" class="form-label fs-4 fw-4 text-gradient">Bagni</label>
                            <input type="number"
                                class="form-control shadow-none @error('bathrooms') is-invalid @enderror" id="bathrooms"
                                name="bathrooms" value="{{ old('bathrooms', $apartment->bathrooms) }}">
                            @error('bathrooms')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="error"></div>
                        </div>
                    </div>
                </div>

                {{-- Services --}}
                <div class="container">
                    <h4 class="my-2 text-gradient">Servizi</h4>
                    <div class="container">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4">
                            @foreach ($services as $service)
                                <div class="mb-2 form-check">
                                    <input type="checkbox" class="form-check-input" id="service{{ $service->id }}"
                                        name="services[]" value="{{ $service->id }}"
                                        @if (in_array($service->id, old('services', $apartment->services->pluck('id')->all()))) checked @endif>
                                    <label class="form-check-label"
                                        for="service{{ $service->id }}">{{ $service->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Visibility --}}
                <div class="container">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <h4 class="my-2 text-gradient">Visibilità Appartamento</h4>
                        <label class="rocker rocker-small">
                            <input type="checkbox" name="visibility" value="1"
                                {{ old('visibility', $apartment->visibility) ? 'checked' : '' }}>
                            <span class="switch-left">Si</span>
                            <span class="switch-right">No</span>
                        </label>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="container">
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="styled-btn">Modifica Appartamento</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
