<nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white">
    <!-- Container wrapper -->
    <div class="container position-relative">

        <i id="menu" class="fa-solid fa-bars"></i>

        <!-- Right links -->
        <ul class="navbar-nav ms-auto d-flex flex-row align-items-center">
            <li class="nav-item me-2">
                @if (Auth::user()->restaurant && Auth::user()->restaurant->image)
                    <img class="my-img" src="{{ asset('storage/' . Auth::user()->restaurant->image) }}">
                @endif
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#" id="userProfile" role="button">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link me-3 me-lg-0" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="Logout">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>


        </ul>
    </div>
    <!-- Container wrapper -->
</nav>
