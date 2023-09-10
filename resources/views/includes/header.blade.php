@php $user = Auth::user(); @endphp

<nav class="navbar navbar-expand-lg w-100">
    <div class="container">
        <div class="w-100 d-flex justify-content-between px-0">
            <a class="navbar-brand" href="http://localhost:5174">
                <img class="full-logo" src="{{ url('/logos/multicolor-horizontal-logo.png') }}" alt="">
                <img class="icon-logo" src="{{ url('/logos/multicolor-logo.ico') }}" alt="">
            </a>

            <div class="w-100 d-flex justify-content-end align-center gap-4">

                <a class="link-unstyled d-flex align-center" href="http://localhost:5174/search">
                    <button class="button">
                        <span><i class="fa-solid fa-magnifying-glass"></i> <span
                                class="disapear text-gradient">Cerca</span></span>
                    </button>
                </a>

                @if (Route::has('login'))
                    @auth
                        <div class="nav-item dropdown h-100">
                            <button class="h-100 button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class=""><i class="fa-regular fa-user"></i>
                                    <span class="disapear text-gradient">Profilo</span></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end list-unstyled box-shadow mt-3">
                                <li class="nav-item">
                                    <a class="w-100 nav-link px-3 py-1" href="{{ route('admin.dashboard') }}"><i
                                            class="fa-solid fa-list"></i>
                                        Dashboard</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li class="nav-item">
                                    <a class="w-100 nav-link px-3 py-1" href="{{ route('admin.apartments.index') }}">
                                        <i class="fa-solid fa-house-user" style="color: #666666;"></i>
                                        Appartamenti</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li class="nav-item">
                                    <a class="w-100 nav-link px-3 py-1" href="{{ route('admin.messages.index') }}"><i
                                            class="fa-regular fa-message"></i>
                                        Messaggi</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li class="nav-item">
                                    <a class="w-100 nav-link px-3 py-1" href="{{ route('admin.sponsors.index') }}"><i
                                            class="fa-regular fa-star"></i>
                                        Sponsorizza</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
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
                    @else
                        <div class="d-flex gap-2">
                            <a class="link-unstyled d-flex align-center" href="{{ route('login') }}">
                                <button class="button ">
                                    <i class="fa-solid fa-user-lock"></i> <span class="disapear text-gradient">Accedi</span>
                                </button>
                            </a>
                            <div class="border border-1 border-dark"></div>
                            @if (Route::has('register'))
                                <a class="link-unstyled d-flex align-center" href="{{ route('register') }}">
                                    <button class="button ">
                                        <i class="fa-solid fa-user-plus"></i> <span
                                            class="disapear text-gradient">Registrati</span>
                                    </button>
                                </a>
                            @endif
                        </div>
                    @endauth
                @endif
            </div>
        </div>
    </div>
</nav>

<style>
    .navbar {
        height: 70px;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 99;
        background-color: #fdfdfd;
        box-shadow: 0px 2px 10px 2px rgba(0, 0, 0, 0.1);
    }

    .dropdown-menu {
        border: none;
        border-radius: 6px
    }

    .full-logo,
    .icon-logo {
        height: 30px;
    }

    .full-logo {
        display: block;
    }

    .icon-logo {
        display: none;
    }

    @media screen and (max-width: 575px) {
        .disapear {
            display: none;
        }

        .nav-link {
            background: #424172;
            background: repeating-radial-gradient(circle farthest-corner at top left,
                    #424172 0%,
                    #ff7210 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .full-logo {
            display: none;
        }

        .icon-logo {
            display: block;
        }
    }
</style>
