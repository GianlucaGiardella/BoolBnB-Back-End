@vite('resources/js/suggestion.js')
@vite('resources/js/client-validations/apartment-validations.js')

@extends('admin.layouts.base')

@section('contents')
    <div class="card mt-0">
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
                    <div class="row row-cols-1 row-cols-md-2">
                        <div class="d-flex flex-column gap-2 mt-0">
                            <div class="input_container">
                                <label for="title" class="form-label fs-4 fw-4">Titolo</label>
                                <input type="text" class="form-control shadow-none" id="title" name="title"
                                    value="{{ old('title', $apartment->title) }}">
                                <div class="error"></div>
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="input_container">
                                <label for="country" class="form-label fs-4 fw-4">Nazione</label>
                                <select id="country" class="form-select @error('country') is-invalid @enderror"
                                    name="country">
                                    <option value="">Seleziona Nazione</option>
                                    {{-- <option value="">Seleziona Nazione</option> --}}
                                </select>
                                <input type="hidden" id="old_country" name="old_country"
                                    value="{{ old('country', $apartment->country) }}">
                                <div class="error"></div>
                                @error('country')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="input_container">
                                <label for="street" class="form-label fs-4 fw-4">Via</label>
                                <input type="text"
                                    class="form-control bs-autocomplete @error('street') is-invalid @enderror"
                                    id="street" name="street" value="{{ old('street', $apartment->street) }}"
                                    autocomplete="off">
                                <ul id="suggestions-street" class="list-group list-group-flush position-absolute z-3"
                                    style="top: calc(100% - 15px); left: 12px">
                                    <!-- Suggestions will be dynamically added here -->
                                </ul>
                                <div class="error"></div>
                                @error('street')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="input_container">
                                <label for="civic" class="form-label fs-4 fw-4">Civico</label>
                                <input type="number" class="form-control shadow-none @error('civic') is-invalid @enderror"
                                    id="civic" name="civic" value="{{ old('civic', $apartment->civic) }}">
                                <div class="error"></div>
                                @error('civic')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex flex-column gap-2 mt-0">
                            <div class="input_container">
                                <label for="size" class="form-label fs-4 fw-4">Metri Quadrati</label>
                                <input type="number" class="form-control shadow-none @error('size') is-invalid @enderror"
                                    id="size" name="size" value="{{ old('size', $apartment->size) }}">
                                <div class="error"></div>
                                @error('size')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="input_container">
                                <label for="rooms" class="form-label fs-4 fw-4">Camere</label>
                                <input type="number" class="form-control shadow-none @error('rooms') is-invalid @enderror"
                                    id="rooms" name="rooms" value="{{ old('rooms', $apartment->rooms) }}">
                                <div class="error"></div>
                                @error('rooms')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="input_container">
                                <label for="beds" class="form-label fs-4 fw-4">Letti</label>
                                <input type="number" class="form-control shadow-none @error('beds') is-invalid @enderror"
                                    id="beds" name="beds" value="{{ old('beds', $apartment->beds) }}">
                                <div class="error"></div>
                                @error('beds')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="input_container">
                                <label for="bathrooms" class="form-label fs-4 fw-4">Bagni</label>
                                <input type="number"
                                    class="form-control shadow-none @error('bathrooms') is-invalid @enderror" id="bathrooms"
                                    name="bathrooms" value="{{ old('bathrooms', $apartment->bathrooms) }}">
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

                <div class="container">
                    <div class="input_container h-100">
                        <label for="description" class="form-label fs-4 fw-4">Descrizione</label>
                        <textarea type="text" class="form-control shadow-none @error('description') is-invalid @enderror" id="description"
                            name="description" rows="5">{{ old('description', $apartment->description) }}</textarea>
                        <div class="error"></div>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                {{-- <div class="container">
                    <div class="row row-cols-1 row-cols-md-2 align-items-center g-3">
                        <div class="">
                            <h4 class="my-2">Immagine Principale</h4>
                            <div class="upload-img-container input_container">
                                <input type="file" class="upload-img @error('cover') is-invalid @enderror"
                                    id="cover" name="cover" accept="image/png, image/jpg, image/jpeg"
                                    value="{{ old('cover', $apartment->cover) }}">
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
                </div> --}}

                <div class="container">
                    <h4 class="my-2">Immagini</h4>
                    <div class="container container-img px-0">
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-2">
                            <div class="img-apartment position-relative">
                                <img src="{{ asset('storage/' . $apartment->cover) }}" id="images" alt="cover"
                                    class="d-block" />
                            </div>
                            @foreach ($apartment->images as $image)
                                <div class="img-apartment position-relative">
                                    <img src="{{ asset('storage/' . $image->img_url) }}" id="images"
                                        alt="image" />
                                    <form method="POST"
                                        action="{{ route('admin.images.destroy', [$apartment->id, $image->id]) }}">
                                        @csrf
                                        @method('delete')

                                        <button id="remove-images" class="remove-image btn">&#128465;</button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                        <div class="error"></div>
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
                                        @if (in_array($service->id, old('services', $apartment->services->pluck('id')->all()))) checked @endif>
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
                                {{ old('visibility', $apartment->visibility) ? 'checked' : '' }}>
                            <span class="switch-left">Si</span>
                            <span class="switch-right">No</span>
                        </label>
                    </div>
                </div>

                <div class="container">
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="styled-btn">Modifica Appartamento</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
