<nav class="navbar navbar-expand-lg navbar-dark bg-dark"> {{-- removed sticky-top --}}
    <div class="container-fluid">
        <a class="navbar-brand logo-name" href="#">Campus 360</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item text-center">
                    <a class="nav-link" aria-current="page" href="#">Home</a>
                </li>

                <li class="nav-item text-center">
                    <a class="nav-link" aria-current="page" href="#">Courses</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">Job
                        Preparation</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">Blog</a>
                </li>

                @auth
                    <a class="logout-btn py-1 px-3" style="color: white" href="{{ url('/logout') }}">Logout</a>
                @else
                    <a class="login-btn py-1 px-3" style="color: white" href="{{ url('/userLogin') }}">Login</a>
                    <a class="reg-btn py-1 px-3" style="color: white" href="{{ url('/userRegistration') }}">Signup</a>
                @endauth
            </ul>
        </div>
    </div>
</nav>
