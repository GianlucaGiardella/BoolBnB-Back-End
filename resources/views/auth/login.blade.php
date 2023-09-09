@vite('resources/js/client-validations/login-validations.js')

@extends('layouts.base')

@section('contents')
    <div class="form_background">
        <form method="post" action="{{ route('login') }}" id="login" class="form_container box-shadow mb-0">
            @csrf

            <div class="title_container text-gradient mb-3">
                <h1 class="title">Accedi al tuo Account</h1>
            </div>

            {{-- Email --}}
            <div class="input_container">
                <label class="input_label text-gradient" for="email">Email</label>
                <i class="fa-solid fa-envelope icon" style="color: #666666;"></i>
                <input type="email" class="input_field @error('email') is-invalid @enderror" id="email"
                    aria-describedby="emailHelp" name="email" placeholder="nome@mail.com" value="{{ old('email') }}"
                    autocomplete="email">
                @error('email')
                    <div class="invalid-feedback text-end">
                        {{ $message }}
                    </div>
                @enderror
                <div class="error"></div>
            </div>

            {{-- Password --}}
            <div class="input_container">
                <label class="input_label text-gradient" for="password">Password</label>
                <i class="fa-solid fa-user-lock icon" style="color: #666666;"></i>
                <input type="password" class="input_field @error('password') is-invalid @enderror" id="password"
                    name="password" placeholder="Password" autocomplete="current-password">
                @error('password')
                    <div class="invalid-feedback text-end">
                        {{ $message }}
                    </div>
                @enderror
                <div class="error"></div>
            </div>

            {{-- Cookie --}}
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Ricordami</label>
            </div>

            <button type="submit" class="styled-btn">Accedi</button>
        </form>
    </div>
@endsection
