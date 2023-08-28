@extends('guests.layouts.base')

@section('contents')
    <form method="post" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name *</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                autocomplete="name" value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Surname</label>
            <input type="text" class="form-control @error('surname') is-invalid @enderror" id="surname" name="surname"
                autocomplete="surname" value="{{ old('surname') }}">
            @error('surname')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Date of Birth</label>
            <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date"
                name="birth_date" autocomplete="birth_date" value="{{ old('birth_date') }}">
            @error('birth_date')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email *</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                autocomplete="username" value="{{ old('email') }}">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password *</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                name="password" autocomplete="new-password">
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Confirm Password *</label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password"
                name="password_confirmation" autocomplete="new-password">
            @error('password_confirmation')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <a href="{{ route('login') }}">
            Already registered?
        </a>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
@endsection
