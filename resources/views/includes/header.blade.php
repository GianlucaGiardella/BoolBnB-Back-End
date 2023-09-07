@php $user = Auth::user(); @endphp

<nav class="navbar navbar-expand-lg w-100 bg-white">
    <div class="container">
        <a class="navbar-brand" href="http://localhost:5174">
            <img src="{{ url('/logos/multicolor-horizontal-logo.png') }}" alt="">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse bg-white p-2 rounded" id="navbarSupportedContent">
            <ul class="navbar-nav flex-grow-1 mb-lg-0 log-btn gap-3">
                <li class="nav-item">
                    <button class="home-link">
                        <a href="http://localhost:5174">Home</a>
                    </button>
                </li>
                <li class="nav-item">
                    <button class="search-link">
                        <a href="http://localhost:5174/search">Cerca Appartamenti</a>
                    </button>
                </li>
            </ul>
            @if (Route::has('login'))
                @auth
                    <ul class="navbar-nav mb-lg-0 log-btn">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.messages.index') }}">Messaggi</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                I Miei Appartamenti
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('admin.apartments.index') }}">Lista
                                        Appartamenti</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.apartments.create') }}">Aggiungi
                                        Appartamento</a></li>
                            </ul>
                        </li>
                    </ul>
                @endauth
            @endif

            @if (Route::has('login'))
                <div class="log-btn">
                    @auth
                        <div class="navbar-nav mb-2 mb-lg-0">
                            <div class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle fs-5" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ $user->email }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <div>
                                        <form action="{{ route('logout') }}" method="post" class="dropdown-item exit mb-0">
                                            @csrf
                                            <button class="btn p-0 text-danger pe-auto">Esci</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="d-flex gap-2">
                            <button class="login-link">
                                <a href="{{ route('login') }}">Accedi</a>
                            </button>
                            <div class="border border-1 border-dark"></div>
                            @if (Route::has('register'))
                                <button class="register-link">
                                    <a href="{{ route('register') }}">Registrati</a>
                                </button>
                            @endif
                        </div>
                    @endauth
                </div>
            @endif
        </div>
    </div>
</nav>

<style>
    .navbar {
        height: 70px;
        position: fixed;
        left: 0;
        top: 0;
        z-index: 99;
        border-bottom: 1px solid #FF7210;
    }

    .log-btn a {
        text-decoration: none;
    }

    .log-btn a:hover {
        color: #424172;
    }

    .log-btn a:hover,
    .exit:hover button {
        cursor: pointer;
        text-decoration: underline;
    }

    .auth {
        color: #FF7210;
    }

    a img {
        width: 120px;
    }

    .home-link,
    .search-link,
    .login-link,
    .register-link {
        padding: 0;
        margin: 0;
        border: none;
        background: none;
    }

    .home-link,
    .search-link,
    .login-link,
    .register-link {
        --primary-color: #424172;
        --hovered-color: #FF7210;
        position: relative;
        display: flex;
        font-weight: 600;
        gap: 0.5rem;
        align-items: center;
    }

    .home-link a,
    .search-link a,
    .login-link a,
    .register-link a {
        margin: 0;
        position: relative;
        color: var(--primary-color)
    }

    .home-link a::before,
    .search-link a::before,
    .login-link a::before,
    .register-link a::before {
        position: absolute;
        width: 0%;
        inset: 0;
        color: var(--hovered-color);
        overflow: hidden;
        transition: 0.3s ease-out;
    }

    .home-link a::before {
        content: "Home";
    }

    .search-link a::before {
        content: "Cerca\00a0 Appartamenti";
    }

    .login-link a::before {
        content: "Accedi";
    }

    .register-link a::before {
        content: "Registrati";
    }

    .home-link a:hover,
    .search-link a:hover,
    .login-link a:hover,
    .register-link a:hover {
        text-decoration: none;
    }

    .home-link:hover::after,
    .search-link:hover::after,
    .login-link:hover::after,
    .register-link::after {
        width: 100%;
    }

    .home-link:hover a::before,
    .search-link:hover a::before,
    .login-link:hover a::before,
    .register-link:hover a::before {
        width: 100%;
    }
</style>
