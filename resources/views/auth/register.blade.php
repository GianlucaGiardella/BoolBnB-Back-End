@vite('resources/js/client-validations/register-validations.js')

@extends('layouts.base')

@section('contents')
    <div class="form_background">
        <form method="post" action="{{ route('register') }}" id="register" class="form_container box-shadow mb-0">
            @csrf

            <div class="title_container text-gradient mb-3">
                <h1 class="title">Crea un Account</h1>
            </div>

            {{-- Name --}}
            <div class="input_container">
                <label for="name" class="input_label text-gradient">Nome (opzionale)</label>
                <i class="fa-solid fa-user-plus icon" style="color: #666666;"></i>
                <input type="text" class="input_field @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name') }}" placeholder="Nome" autocomplete="name">
                @error('name')
                    <div class="invalid-feedback text-end">
                        {{ $message }}
                    </div>
                @enderror
                <div class="error"></div>
            </div>

            {{-- Surname --}}
            <div class="input_container">
                <label for="name" class="input_label text-gradient">Cognome (opzionale)</label>
                <i class="fa-solid fa-user-plus icon" style="color: #666666;"></i>
                <input type="text" class="input_field @error('surname') is-invalid @enderror" id="surname"
                    name="surname" value="{{ old('surname') }}" placeholder="Cognome" autocomplete="surname">
                @error('surname')
                    <div class="invalid-feedback text-end">
                        {{ $message }}
                    </div>
                @enderror
                <div class="error"></div>
            </div>

            {{-- DateOfBirth --}}
            <div class="input_container">
                <label for="name" class="input_label text-gradient">Data di Nascita (opzionale)</label>
                <i class="fa-solid fa-cake-candles icon" style="color: #666666;"></i>
                <input type="date" class="input_field @error('birth_date') is-invalid @enderror" id="birth_date"
                    name="birth_date" autocomplete="birth_date" min="1920-01-01"
                    max="<?= date('Y-m-d', strtotime('-18 year')) ?>">
                @error('birth_date')
                    <div class="invalid-feedback text-end">
                        {{ $message }}
                    </div>
                @enderror
                <div class="error">
                </div>
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

            {{-- ConfirmPassword --}}
            <div class="input_container">
                <label class="input_label text-gradient" for="password">Conferma Password</label>
                <i class="fa-solid fa-user-lock icon" style="color: #666666;"></i>
                <input type="password" class="input_field @error('password_confirmation') is-invalid @enderror"
                    id="confirmPassword" name="password_confirmation" placeholder="Conferma password"
                    autocomplete="new-password">
                @error('password_confirmation')
                    <div class="invalid-feedback text-end">
                        {{ $message }}
                    </div>
                @enderror
                <div class="error"></div>
            </div>

            {{-- ToLogIn --}}
            <a class="mb-3 text-gradient text-decoration-none" href="{{ route('login') }}">
                Sono già registrato
            </a>

            <button type="submit" class="styled-btn">Registrati</button>
        </form>
    </div>
@endsection
