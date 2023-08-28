@extends('guests.layouts.base')

@section('contents')
    <form method="post" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name *</label>
            <input type="text" class="form-control" id="name" name="name" required autofocus autocomplete="name"
                value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Surname</label>
            <input type="text" class="form-control" id="surname" name="surname" autofocus autocomplete="surname"
                value="{{ old('surname') }}">
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" id="birth_date" name="birth_date" autofocus autocomplete="birth_date"
                value="{{ old('birth_date') }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email *</label>
            <input type="email" class="form-control" id="email" name="email" required autofocus
                autocomplete="username" value="{{ old('email') }}">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password *</label>
            <input type="password" class="form-control" id="password" name="password" required autocomplete="new-password">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Confirm Password *</label>
            <input type="password" class="form-control" id="password" name="password_confirmation" required
                autocomplete="new-password">
        </div>

        <a href="{{ route('login') }}">
            Already registered?
        </a>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
@endsection
