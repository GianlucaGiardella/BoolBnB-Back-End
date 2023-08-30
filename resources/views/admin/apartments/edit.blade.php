@extends('admin.layouts.base')

@section('contents')
    <div class="card mt-3 p-2">
        <div class="card-body">
            <div class="d-inline-block">
                <h1>Modifica Appartamento</h1>
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

            <form method="post" action="{{ route('admin.apartments.update', ['apartment' => $apartment]) }}"
                enctype="multipart/form-data" novalidate>
                @csrf
                @method('put')

                <div class="mb-4">
                    <label for="title" class="form-label">
                        <h4 class="my-0">Titolo</h4>
                    </label>
                    <input type="text" class="form-control" id="title" name="title"
                        value="{{ old('title', $apartment->title) }}" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label">
                        <h4 class="my-0">Descrizione</h4>
                    </label>
                    <textarea class="form-control" id="description" rows="5" name="description" required>{{ old('description', $apartment->description) }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="address" class="form-label">
                        <h4 class="my-0">Indirizzo</h4>
                    </label>
                    <input type="text" class="form-control" id="address" name="address"
                        value="{{ old('address', $apartment->address) }}">
                </div>

                <div class="mb-4">
                    <label for="size" class="form-label">
                        <h4 class="my-0">Metri Quadri</h4>
                    </label>
                    <input type="number" class="form-control" id="size" name="size"
                        value="{{ old('size', $apartment->size) }}" required min="5" max="9999">
                </div>

                <div class="mb-4">
                    <label for="rooms" class="form-label">
                        <h4 class="my-0">Camere</h4>
                    </label>
                    <input type="number" class="form-control" id="rooms" name="rooms"
                        value="{{ old('rooms', $apartment->rooms) }}" required min="1" max="99">
                </div>

                <div class="mb-4">
                    <label for="beds" class="form-label">
                        <h4 class="my-0">Letti</h4>
                    </label>
                    <input type="number" class="form-control" id="beds" name="beds"
                        value="{{ old('beds', $apartment->beds) }}" required min="1" max="99">
                </div>

                <div class="mb-4">
                    <label for="bathrooms" class="form-label">
                        <h4 class="my-0">Bagni</h4>
                    </label>
                    <input type="number" class="form-control" id="bathrooms" name="bathrooms"
                        value="{{ old('bathrooms', $apartment->bathrooms) }}" required min="1" max="99">
                </div>

                <div class="input-group mb-3">
                    <input type="file" class="form-control" id="cover" name="cover" accept="cover/*">
                    <label class="input-group-text" for="cover">Aggiungi Immagine
                        di Copertina</label>
                </div>

                <div class="mb-4 d-flex align-items-center">
                    <h4 class="my-2">Visibile</h4>
                    <label class="rocker rocker-small">
                        <input type="checkbox" name="visibility" value="1"
                            {{ old('visibility', $apartment->visibility) ? 'checked' : '' }}>
                        <span class="switch-left">Si</span>
                        <span class="switch-right">No</span>
                    </label>
                </div>

                <div class="mb-4">
                    <h4 class="my-1">Servizi</h4>
                    @foreach ($services as $service)
                        <div class="mb-1 form-check">
                            <input type="checkbox" class="form-check-input" id="service{{ $service->id }}"
                                name="services[]" value="{{ $service->id }}"
                                @if (in_array($service->id, old('services', $apartment->services->pluck('id')->all()))) checked @endif>
                            <label class="form-check-label"
                                for="service{{ $service->id }}">{{ $service->name }}</label>
                        </div>
                    @endforeach
                </div>

                <button class="btn btn-primary">Aggiorna</button>
            </form>

        </div>
    </div>
@endsection

<style>
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
</style>
