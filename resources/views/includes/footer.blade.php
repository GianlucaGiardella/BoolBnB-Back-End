<footer>
    <p class="m-0 d-flex justify-content-center align-items-center gap-1 py-3">
        <!-- Facebook -->
        <a class="btn text-white m-1" style="background-color: #3b5998;" href="#" role="button"><i
                class="fa-brands fa-facebook"></i></a>

        <!-- Twitter -->
        <a class="btn text-white m-1" style="background-color: #55acee;" href="#" role="button"><i
                class="fa-brands fa-twitter"></i></a>

        <!-- Google -->
        <a class="btn text-white m-1" style="background-color: #dd4b39;" href="#" role="button"><i
                class="fa-brands fa-google"></i></a>

        <!-- Instagram -->
        <a class="btn text-white m-1" style="background-color: #ac2bac;" href="#" role="button"><i
                class="fa-brands fa-instagram"></i></a>

        <!-- Linkedin -->
        <a class="btn text-white m-1" style="background-color: #0082ca;" href="#" role="button"><i
                class="fa-brands fa-linkedin"></i></a>

        <!-- Github -->
        <a class="btn text-white m-1" style="background-color: #333333;" href="#" role="button"><i
                class="fa-brands fa-github"></i></a>
    </p>

    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-center py-3 border-top">
            <p class="col-md-4 mb-0 text-muted">© 2023 Boolean, Classe 96</p>

            <!-- Logo -->
            <a class="d-flex justify-content-center" href="http://localhost:5174">
                <img class="full-logo" src="{{ url('/logos/multicolor-horizontal-logo.png') }}" alt="">
                <img class="icon-logo" src="{{ url('/logos/multicolor-logo.ico') }}" alt="">
            </a>

            <ul class="nav col-md-4 justify-content-end">
                <li class="nav-item"><a href="http://localhost:5174"
                        class="px-2 text-black link-unstyled nav-link">Home</a></li>
                <li class="nav-item"><a href="http://localhost:5174/search"
                        class="px-2 text-black link-unstyled nav-link">Cerca</a></li>
                <li class="nav-item"><a href="http://localhost:5174/aboutus"
                        class="px-2 text-black link-unstyled nav-link">About</a></li>
                <li class="nav-item"><a href="{{ route('admin.dashboard') }}"
                        class="px-2 text-black link-unstyled nav-link">Profilo</a></li>
            </ul>
        </div>
    </div>
</footer>

<style scoped lang="scss">
    footer {
        background-color: #fdfdfd;
        box-shadow: 0px -2px 10px -2px rgba(0, 0, 0, 0.3);
    }

    .full-logo {
        height: 30px;
    }
</style>
