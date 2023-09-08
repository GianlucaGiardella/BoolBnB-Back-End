@php $user = Auth::user(); @endphp

<nav class="navbar navbar-expand-lg w-100">
    <div class="container">
        <a class="navbar-brand" href="http://localhost:5174">
            <img src="{{ url('/logos/multicolor-horizontal-logo.png') }}" alt="">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse p-2 rounded" id="navbarSupportedContent">
            <ul class="navbar-nav flex-grow-1 log-btn gap-3">
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost:5174/search">Cerca Appartamenti</a>
                </li>
            </ul>
            @if (Route::has('login'))
                @auth
                    <div class="log-btn">
                        <div class="navbar-nav mb-2 mb-lg-0">
                            <div class="nav-item dropdown">
                                <button class="button f-4" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="text-gradient"><i class="fa-regular fa-user"></i>
                                        Profilo</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end list-unstyled">
                                    <li class="nav-item">
                                        <a class="nav-link px-3 py-1" href="/"><i class="fa-solid fa-list"></i>
                                            Dashboard</a>
                                    </li>
                                    <hr class="m-0">
                                    <li class="nav-item">
                                        <a class="nav-link px-3 py-1" href="{{ route('admin.apartments.index') }}">
                                            <i class="fa-solid fa-house-user" style="color: #666666;"></i>
                                            Appartamenti</a>
                                    </li>
                                    <hr class="m-0">
                                    <li class="nav-item">
                                        <a class="nav-link px-3 py-1" href="{{ route('admin.messages.index') }}"><i
                                                class="fa-regular fa-message"></i> Messaggi</a>
                                    </li>
                                    <hr class="m-0">
                                    <li class="nav-item">
                                        <a class="nav-link px-3 py-1" href="{{ route('admin.sponsors.index') }}"><i
                                                class="fa-regular fa-star"></i>
                                            Sponsorizza</a>
                                    </li>
                                    <hr class="m-0">
                                    <li class="m-0 p-0">
                                        <form action="{{ route('logout') }}" method="post" class="dropdown-item exit mb-0">
                                            @csrf
                                            <button class="btn p-0 text-danger pe-auto">
                                                <i class="fa-solid fa-arrow-right-from-bracket"></i> Esci
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @else
                        <div class="d-flex gap-2">
                            <button class="button">
                                <a class="link-unstyled text-gradient" href="{{ route('login') }}">Accedi</a>
                            </button>
                            <div class="border border-1 border-dark"></div>
                            @if (Route::has('register'))
                                <button class="button">
                                    <a class="link-unstyled text-gradient" href="{{ route('register') }}">Registrati</a>
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
        background-color: #fdfdfd;
        box-shadow: 0px 2px 10px 2px rgba(0, 0, 0, 0.1);
        /* border-bottom: 1px solid #FF7210; */
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
    .dashboard-link,
    .messages-link,
    .sponsors-link,
    .apartments-link,
    .login-link,
    .register-link {
        padding: 0;
        margin: 0;
        border: none;
        background: none;
    }

    .home-link,
    .search-link,
    .dashboard-link,
    .messages-link,
    .sponsors-link,
    .apartments-link,
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
    .dashboard-link a,
    .messages-link a,
    .sponsors-link a,
    .apartments-link a,
    .login-link a,
    .register-link a {
        margin: 0;
        position: relative;
        color: var(--primary-color)
    }

    .home-link a::before,
    .search-link a::before,
    .dashboard-link a::before,
    .messages-link a::before,
    .sponsors-link a::before,
    .apartments-link a::before,
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

    .dashboard-link a::before {
        content: "Dashboard";
    }

    .messages-link a::before {
        content: "Messaggi";
    }

    .sponsors-link a::before {
        content: "Sponsorizza";
    }

    .apartments-link a::before {
        content: "I\00a0 Miei\00a0 Appartamenti\00a0\00a0\00a0\00a0\00a0 "
    }

    .login-link a::before {
        content: "Accedi";
    }

    .register-link a::before {
        content: "Registrati";
    }

    .home-link a:hover,
    .search-link a:hover,
    .dashboard-link a:hover,
    .messages-link a:hover,
    .sponsors-link a:hover,
    .apartments-link a:hover,
    .login-link a:hover,
    .register-link a:hover {
        text-decoration: none;
    }

    .home-link:hover::after,
    .search-link:hover::after,
    .dashboard-link:hover::after,
    .messages-link:hover::after,
    .sponsors-link:hover::after,
    .apartments-link:hover::after,
    .login-link:hover::after,
    .register-link::after {
        width: 100%;
    }

    .home-link:hover a::before,
    .search-link:hover a::before,
    .dashboard-link:hover a::before,
    .messages-link:hover a::before,
    .sponsors-link:hover a::before,
    .apartments-link:hover a::before,
    .login-link:hover a::before,
    .register-link:hover a::before {
        width: 100%;
    }
</style>
