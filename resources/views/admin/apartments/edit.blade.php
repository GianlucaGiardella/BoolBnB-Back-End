@extends('admin.layouts.base')

@section('contents')
    <div class="card mt-3 p-2">
        <div class="card-body">
            <div class="d-inline-block">
                <h1>Modifica Appartamento</h1>
                <hr class="rounded">
            </div>

            <form method="post" action="{{ route('admin.apartments.update', ['apartment' => $apartment]) }}"
                enctype="multipart/form-data" novalidate>
                @csrf
                @method('put')

                <div class="mb-4">
                    <label for="title" class="form-label">
                        <h4 class="my-0">Titolo</h4>
                    </label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" value="{{ old('title', $apartment->title) }}">
                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label">
                        <h4 class="my-0">Descrizione</h4>
                    </label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="5"
                        name="description">{{ old('description', $apartment->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="price" class="form-label">
                        <h4 class="my-0">Prezzo</h4>
                    </label>
                    <input type="text" class="form-control @error('price') is-invalid @enderror" id="price"
                        name="price" value="{{ old('price', $apartment->price) }}">
                    @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="size" class="form-label">
                        <h4 class="my-0">Metri Quadri</h4>
                    </label>
                    <input type="text" class="form-control @error('size') is-invalid @enderror" id="size"
                        name="size" value="{{ old('size', $apartment->size) }}">
                    @error('size')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="rooms" class="form-label">
                        <h4 class="my-0">Camere</h4>
                    </label>
                    <input type="url" class="form-control @error('rooms') is-invalid @enderror" id="rooms"
                        name="rooms" value="{{ old('rooms', $apartment->rooms) }}">
                    @error('rooms')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="beds" class="form-label">
                        <h4 class="my-0">Letti</h4>
                    </label>
                    <input type="url" class="form-control @error('beds') is-invalid @enderror" id="beds"
                        name="beds" value="{{ old('beds', $apartment->beds) }}">
                    @error('rooms')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="bathrooms" class="form-label">
                        <h4 class="my-0">Bathbathrooms</h4>
                    </label>
                    <input type="url" class="form-control @error('bathrooms') is-invalid @enderror" id="bathrooms"
                        name="bathrooms" value="{{ old('bathrooms', $apartment->bathrooms) }}">
                    @error('bathrooms')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input type="file" class="form-control" id="cover" name="cover" accept="cover/*">
                    <label class="input-group-text  @error('cover') is-invalid @enderror" for="cover">Aggiungi Immagine
                        di Copertina</label>
                    @error('cover')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="type" class="form-label">
                        <h4 class="my-0">Type</h4>
                    </label>
                    <select class="form-select @error('type_id') is-invalid @enderror" id="type" name="type_id">
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}" @if (old('type_id', $apartment->type->id) == $type->id) selected @endif>
                                {{ $type->name }}</option>
                        @endforeach
                    </select>
                    @error('type_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <h4 class="my-1">Services</h4>
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
