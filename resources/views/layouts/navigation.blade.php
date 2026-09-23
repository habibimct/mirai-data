<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow fixed-top">

    <div class="container">

        {{-- BRAND --}}
        <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('dashboard') }}">

            <img src="{{ asset('LOGO_MIRAI.png') }}" alt="Logo" width="40" height="40"
                class="me-2 rounded-circle shadow-sm">

            <span>LPK Mirai</span>

        </a>

        {{-- TOGGLER --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">

            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- MENU --}}
        <div class="collapse navbar-collapse" id="navbarContent">

            {{-- LEFT MENU --}}
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active fw-bold' : '' }}"
                        href="{{ route('dashboard') }}">
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('participants.*') ? 'active fw-bold' : '' }}"
                        href="{{ route('participants.index') }}">
                        Peserta
                    </a>
                </li>

            </ul>

            {{-- RIGHT MENU --}}
            <ul class="navbar-nav align-items-lg-center">

                {{-- SOCIAL MEDIA --}}
                <li class="nav-item me-lg-3">
                    <div class="d-flex align-items-center gap-3">

                        <a href="https://facebook.com/lpkmiraigresik?locale=id_ID" target="_blank"
                            class="text-white fs-5">
                            <i class="bi bi-facebook text-white fs-5 social-icon"></i>
                        </a>

                        <a href="https://instagram.com/lpkmiraigresik/" target="_blank" class="text-white fs-5">
                            <i class="bi bi-instagram text-white fs-5 social-icon"></i>
                        </a>

                        <a href="https://youtube.com/@LPKMIRAIGRESIK" target="_blank" class="text-white fs-5">
                            <i class="bi bi-youtube text-white fs-5 social-icon"></i>
                        </a>

                        <a href="https://tiktok.com/@lpkmiraigresik" target="_blank" class="text-white fs-5">
                            <i class="bi bi-tiktok text-white fs-5 social-icon"></i>
                        </a>

                        <a href="https://wa.me/6281234567890" target="_blank" class="text-white fs-5">
                            <i class="bi bi-whatsapp text-white fs-5 social-icon"></i>
                        </a>

                    </div>
                </li>

                {{-- USER DROPDOWN --}}
                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">

                        <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center me-2"
                            style="width:35px;height:35px;font-size:14px;">

                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                        </div>

                        {{ Auth::user()->name }}

                    </a>

                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3">

                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                👤 Profile
                            </a>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit" class="dropdown-item text-danger">
                                    🚪 Logout
                                </button>

                            </form>
                        </li>

                    </ul>

                </li>

            </ul>

        </div>

    </div>

    <style>
        .social-icon {
            transition: 0.3s;
        }

        .social-icon:hover {
            transform: translateY(-3px);
            opacity: 0.8;
        }
    </style>

</nav>
