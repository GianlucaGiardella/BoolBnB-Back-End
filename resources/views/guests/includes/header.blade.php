<header>
    <div class="prenav">
        <nav class="navbar navbar-expand-lg w-100 bg-body-tertiary">
            <div class="d-flex justify-content-between align-items-center w-100 h-100">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="/"><img src="" alt=""></a>
            <div class="collapse navbar-collapse d-flex justify-content-between h-100" id="navbarTogglerDemo03">
                
                <form class="d-flex m-auto" role="search">
                    <input class="form-control m-6" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn" type="submit"><span style="color: #ff7210">Search</span></button>
                </form>
                <div>
                    @if (Route::has('login'))
                <div class="hidden px-4 py-4 sm:block log-btn">
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="text-sm">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
                </div>
            </div>
            </div>
        </nav>
    </div>
</header>

<style>
  
  .navbar{
        background-color: rgb(42, 41, 72) !important;
        height: 60px;
        width: 100%;
        display: flex;
        justify-content: space-between;
        position: fixed;
        left: 0;
        top: 0;
    }
    a img{
        width: 100px;
    }
</style>
