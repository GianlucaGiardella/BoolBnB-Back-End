@vite('resources/js/suggestion.js')
@extends('admin.layouts.base')
@section('contents')
    <div class="card mt-3 p-2">
        <div class="card-body">
            <div class="d-inline-block text-gradient">
                <h1>Aggiungi Appartamento</h1>
                <hr class="rounded">
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.apartments.store') }}">
                @csrf

                <div class="row row-cols-1 row-cols-md-2 mb-4">
                    <div>
                        <div class="mb-3">
                            <label for="title" class="form-label fs-4 fw-4">Titolo</label>
                            <input type="text" class="form-control" id="title" name="title"
                                value="{{ old('title') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="size" class="form-label fs-4 fw-4">Metri Quadri</label>
                            <input type="number" class="form-control" id="size" name="size"
                                value="{{ old('size') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="rooms" class="form-label fs-4 fw-4">Camere</label>
                            <input type="number" class="form-control" id="rooms" name="rooms"
                                value="{{ old('rooms') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="beds" class="form-label fs-4 fw-4">Letti</label>
                            <input type="number" class="form-control" id="beds" name="beds"
                                value="{{ old('beds') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="bathrooms" class="form-label fs-4 fw-4">Bagni</label>
                            <input type="number" class="form-control" id="bathrooms" name="bathrooms"
                                value="{{ old('bathrooms') }}" required>
                        </div>
                    </div>

                    <div>
                        <div class="mb-3">
                            <label for="country" class="form-label">Nazione</label>
                            <input type="text" class="form-control" id="country" name="country"
                                value="{{ old('country') }}">
                        </div>

                        <div class="mb-3">
                            <label for="street" class="form-label">Via</label>
                            <input type="text" class="form-control" id="street" name="street"
                                value="{{ old('street') }}">
                        </div>

                        <ul id="suggestions" class="list-group list-group-flush">
                            <!-- Suggestions will be dynamically added here -->
                        </ul>

                        <div class="mb-3">
                            <label for="address" class="form-label">Civico</label>
                            <input type="number" class="form-control" id="address" name="address"
                                value="{{ old('address') }}">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label fs-4 fw-4">Descrizione</label>
                        <textarea type="text" class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                    </div>

                    <div class="row row-cols-1 row-cols-md-2 mb-3 align-items-center">
                        <div class="d-flex align-items-center">
                            <h4 class="my-2">Visibile</h4>
                            <label class="rocker rocker-small">
                                <input type="checkbox" name="visibility" value="1"
                                    {{ old('visibility') ? 'checked' : '' }}>
                                <span class="switch-left">Si</span>
                                <span class="switch-right">No</span>
                            </label>
                        </div>

                        <div>
                            <div class="upload-img-container">
                                <input type="file" class="upload-img" id="cover" name="cover" accept="cover/*"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
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

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="styled-btn">Aggiungi Appartamento</button>
                    </div>
            </form>
        </div>
    </div>
@endsection

<style>
    .input-group>.form-control,
    .input-group>.form-select,
    .input-group>.form-floating {
        flex: 0 1 500px;
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
        margin: 1em;
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
        background-color: #bd5757;
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
        background-color: #0084d0;
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
    }

    .upload-img::file-selector-button {
        margin-right: 16px;
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
