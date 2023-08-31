@vite('resources/js/suggestion.js')
@vite('resources/js/client-validations/apartment-validations.js')

@extends('admin.layouts.base')

@section('contents')
    <div class="card mt-3 p-2">
        <div class="card-body">
            <div class="d-inline-block text-gradient">
                <h1>Aggiungi Appartamento</h1>
                <hr>
            </div>

            <form method="post" action="{{ route('admin.apartments.store') }}" id="create-apartment"
                class="d-flex flex-column gap-3 mb-0" enctype="multipart/form-data" novalidate>
                @csrf

                <div class="row row-cols-1 row-cols-md-2">
                    <div class="d-flex flex-column gap-2 mt-0">
                        <div class="input_container">
                            <label for="title" class="form-label fs-4 fw-4">Titolo</label>
                            <input type="text" class="form-control shadow-none" id="title" name="title"
                                value="{{ old('title') }}">
                            <div class="error"></div>
                        </div>

                        <div class="input_container">
                            <label for="country" class="form-label fs-4 fw-4">Nazione</label>
                            <input type="text" class="form-control" id="country" name="country"
                                value="{{ old('country') }}">
                            <ul id="suggestions-country" class="list-group list-group-flush position-absolute z-3">
                                <!-- Suggestions will be dynamically added here -->
                            </ul>
                            <div class="error"></div>
                        </div>

                        <div class="input_container">
                            <label for="street" class="form-label fs-4 fw-4">Via</label>
                            <input type="text" class="form-control" id="street" name="street"
                                value="{{ old('street') }}">
                            <ul id="suggestions-street" class="list-group list-group-flush position-absolute z-3">
                                <!-- Suggestions will be dynamically added here -->
                            </ul>
                            <div class="error"></div>
                        </div>

                        <div class="input_container">
                            <label for="address" class="form-label fs-4 fw-4">Civico</label>
                            <input type="number" class="form-control shadow-none" id="address" name="address"
                                value="{{ old('address') }}">
                            <div class="error"></div>
                        </div>
                    </div>

                    <div class="d-flex flex-column gap-2 mt-0">
                        <div class="input_container">
                            <label for="size" class="form-label fs-4 fw-4">Metri Quadrati</label>
                            <input type="number" class="form-control shadow-none" id="size" name="size"
                                value="{{ old('size') }}">
                            <div class="error"></div>
                        </div>

                        <div class="input_container">
                            <label for="rooms" class="form-label fs-4 fw-4">Camere</label>
                            <input type="number" class="form-control shadow-none" id="rooms" name="rooms"
                                value="{{ old('rooms') }}">
                            <div class="error"></div>
                        </div>

                        <div class="input_container">
                            <label for="beds" class="form-label fs-4 fw-4">Letti</label>
                            <input type="number" class="form-control shadow-none" id="beds" name="beds"
                                value="{{ old('beds') }}">
                            <div class="error"></div>
                        </div>

                        <div class="input_container">
                            <label for="bathrooms" class="form-label fs-4 fw-4">Bagni</label>
                            <input type="number" class="form-control shadow-none" id="bathrooms" name="bathrooms"
                                value="{{ old('bathrooms') }}">
                            <div class="error"></div>
                        </div>
                    </div>
                </div>

                <div class="input_container h-100">
                    <label for="description" class="form-label fs-4 fw-4">Descrizione</label>
                    <textarea type="text" class="form-control shadow-none" id="description" name="description" rows="5">{{ old('description') }}</textarea>
                    <div class="error"></div>
                </div>

                <div class="row row-cols-1 row-cols-md-2 align-items-center g-2">
                    <div class="input_container w-50">
                        <h4 class="my-2">Immagine Principale</h4>
                        <div class="upload-img-container">
                            <input type="file" class="upload-img" id="cover" name="cover"
                                accept="image/png, image/jpg, image/jpeg">
                            <div class="error"></div>
                        </div>
                    </div>

                    <div class="input_container w-50">
                        <h4 class="my-2">Altre Immagini | max: 5</h4>
                        <div class="upload-img-container">
                            <input type="file" class="upload-img" onchange="countImages()" id="images"
                                name="images[]" multiple accept="image/png, image/jpg, image/jpeg">
                            <div class="error"></div>
                        </div>
                    </div>
                </div>

                <div class="">
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

                <div class="d-flex flex-column justify-content-center align-items-center">
                    <h4 class="my-2">Visibilità Appartamento</h4>
                    <label class="rocker rocker-small">
                        <input type="checkbox" name="visibility" value="1"
                            {{ old('visibility') ? 'checked' : '' }}>
                        <span class="switch-left">Si</span>
                        <span class="switch-right">No</span>
                    </label>
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="styled-btn">Aggiungi Appartamento</button>
                </div>
            </form>
        </div>
    </div>
@endsection

<style>
    .list-group-item:hover {
        cursor: pointer !important;
        text-decoration: underline;
        background-color: #f8f9fa;
    }

    /* Switch starts here */
    .rocker {
        display: inline-block;
        position: relative;
        /*
  SIZE OF SWITCH
  ==============
  All sizes are in em - therefore
  changing the font-size here
  will change the size of the switch.
  See .rocker-small below as example.
  */
        font-size: 2em;
        font-weight: bold;
        text-align: center;
        text-transform: uppercase;
        color: #888;
        width: 7em;
        height: 4em;
        overflow: hidden;
        border-bottom: 0.5em solid #eee;
    }

    .rocker-small {
        font-size: 0.75em;
        /* Sizes the switch */
    }

    .rocker::before {
        content: "";
        position: absolute;
        top: 0.5em;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #999;
        border: 0.5em solid #eee;
        border-bottom: 0;
    }

    .rocker input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .switch-left,
    .switch-right {
        cursor: pointer;
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 2.5em;
        width: 3em;
        transition: 0.2s;
        user-select: none;
    }

    .switch-left {
        height: 2.4em;
        width: 2.75em;
        left: 0.85em;
        bottom: 0.4em;
        background-color: #ddd;
        transform: rotate(15deg) skewX(15deg);
    }

    .switch-right {
        right: 0.5em;
        bottom: 0;
        background-color: #dc3545;
        color: #fff;
    }

    .switch-left::before,
    .switch-right::before {
        content: "";
        position: absolute;
        width: 0.4em;
        height: 2.45em;
        bottom: -0.45em;
        background-color: #ccc;
        transform: skewY(-65deg);
    }

    .switch-left::before {
        left: -0.4em;
    }

    .switch-right::before {
        right: -0.375em;
        background-color: transparent;
        transform: skewY(65deg);
    }

    input:checked+.switch-left {
        background-color: #198754;
        color: #fff;
        bottom: 0px;
        left: 0.5em;
        height: 2.5em;
        width: 3em;
        transform: rotate(0deg) skewX(0deg);
    }

    input:checked+.switch-left::before {
        background-color: transparent;
        width: 3.0833em;
    }

    input:checked+.switch-left+.switch-right {
        background-color: #ddd;
        color: #888;
        bottom: 0.4em;
        right: 0.8em;
        height: 2.4em;
        width: 2.75em;
        transform: rotate(-15deg) skewX(-15deg);
    }

    input:checked+.switch-left+.switch-right::before {
        background-color: #ccc;
    }

    /* Keyboard Users */
    input:focus+.switch-left {
        color: #333;
    }

    input:checked:focus+.switch-left {
        color: #fff;
    }

    input:focus+.switch-left+.switch-right {
        color: #fff;
    }

    input:checked:focus+.switch-left+.switch-right {
        color: #333;
    }

    .upload-img-container {
        border: 1px solid #dee2e6;
        padding: 8px;
        border-radius: 7px;
        overflow: hidden;
    }

    .upload-img::file-selector-button {
        margin-right: 8px;
        border: none;
        background: #424172;
        padding: 10px 20px;
        border-radius: 7px;
        color: #fff;
        cursor: pointer;
        transition: background .2s ease-in-out;
    }

    .upload-img::file-selector-button:hover {
        background: #FF7210;
    }
</style>
