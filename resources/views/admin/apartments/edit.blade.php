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

                <div class="mb-4">
                    <h4 class="my-1">Servizi</h4>
                    @foreach ($services as $service)
                        <div class="mb-1 form-check">
                            <input type="checkbox" class="form-check-input" id="service{{ $service->id }}"
                                name="services[]" value="{{ $service->id }}"
                                @if (in_array($service->id, old('services', $apartment->services->pluck('id')->all()))) checked @endif>
                            <label class="form-check-label" for="service{{ $service->id }}">{{ $service->name }}</label>
                        </div>
                    @endforeach
                </div>

                <button class="btn btn-primary">Aggiorna</button>
            </form>

        </div>
    </div>
@endsection
