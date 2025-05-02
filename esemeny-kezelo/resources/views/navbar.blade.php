
<nav class="navbar navbar-expand-lg navbar-light bg-primary p-3">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="#">Events.hu</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#burgerMenu" aria-controls="burgerMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="burgerMenu">
            @if(Auth::check())
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Események</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Keresés</a>
                </li>
            </ul>
            @else
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Bejelentkezés</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Regisztráció</a>
                </li>
            </ul>
            @endif
        </div>
    </div>
</nav>