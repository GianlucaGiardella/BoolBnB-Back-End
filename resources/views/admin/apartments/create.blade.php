@extends('admin.layouts.base')

@section('contents')

    <h1>Aggiungi appartamento</h1>

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

        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea type="text" class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="country" class="form-label">Nazione</label>
            <input type="text" class="form-control" id="country" name="country" value="{{ old('country') }}">
        </div>

        <div class="mb-3">
            <label for="city" class="form-label">Citta'</label>
            <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}">
        </div>

        <div class="mb-3">
            <label for="street" class="form-label">Via</label>
            <input type="text" class="form-control" id="street" name="street" value="{{ old('street') }}">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Civico</label>
            <input type="number" class="form-control" id="address" name="address" value="{{ old('address') }}">
        </div>

        <div class="mb-3">
            <label for="postalcode" class="form-label">CAP</label>
            <input type="text" class="form-control" id="postalcode" name="postalcode" value="{{ old('postalcode') }}">
        </div>

        <div class="mb-3">
            <label for="size" class="form-label">Metri Quadri</label>
            <input type="number" class="form-control" id="size" name="size" value="{{ old('size') }}">
        </div>

        <div class="mb-3">
            <label for="rooms" class="form-label">Camere</label>
            <input type="number" class="form-control" id="rooms" name="rooms" value="{{ old('rooms') }}">
        </div>

        <div class="mb-3">
            <label for="beds" class="form-label">Letti</label>
            <input type="number" class="form-control" id="beds" name="beds" value="{{ old('beds') }}">
        </div>

        <div class="mb-3">
            <label for="bathrooms" class="form-label">Bagni</label>
            <input type="number" class="form-control" id="bathrooms" name="bathrooms" value="{{ old('bathrooms') }}">
        </div>

        <div class="input-group mb-3">
            <input type="file" class="form-control" id="cover" name="cover" accept="cover/*">
            <label class="input-group-text" for="cover">Aggiungi Immagine
                di Copertina</label>
        </div>

        <div class="mb-3">
            <label for="visibility" class="form-label">Visibilità</label>
            <input type="checkbox" class="form-check-input" id="visibility" name="visibility" value="1"
                {{ old('visibility') ? 'checked' : '' }}>
        </div>

        <button type="submit" class="btn btn-primary">Aggiungi</button>
    </form>
@endsection
