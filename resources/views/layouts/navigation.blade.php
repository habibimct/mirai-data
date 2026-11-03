
<div class="app-navigation"
     x-data="{ sidebarOpen: false, userMenuOpen: false }">

    <!-- ==========================================
         MOBILE HEADER
    =========================================== -->
    <header class="fixed inset-x-0 top-0 z-40 flex h-16 items-center justify-between border-b border-slate-200 bg-white px-4 lg:hidden">

        <div class="flex items-center gap-3">

            <button
                type="button"
                x-on:click="sidebarOpen = true"
                class="mobile-pressable mobile-pressable-blue
                    inline-flex h-10 w-10 items-center justify-center
                    rounded-xl border border-slate-200 bg-white
                    text-slate-600 shadow-sm
                    transition-all duration-200
                    hover:border-blue-300 hover:bg-blue-50
                    hover:text-blue-700 hover:shadow-md"
            >
                <i class="bi bi-list text-2xl"></i>
            </button>

            <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
                <img
                    src="{{ asset('LOGO_MIRAI.png') }}"
                    alt="Logo LPK Mirai"
                    class="h-9 w-9 rounded-full object-cover"
                >

                <span class="text-base font-bold tracking-tight text-slate-900">
                    LPK Mirai
                </span>
            </a>

        </div>

        @auth
            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-600 text-sm font-bold text-white">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
        @endauth

    </header>


    <!-- ==========================================
         MOBILE SIDEBAR OVERLAY
    =========================================== -->
    <div
        x-cloak
        x-show="sidebarOpen"
        x-transition.opacity
        x-on:click="sidebarOpen = false"
        class="fixed inset-0 z-40 bg-slate-950/50 lg:hidden"
    ></div>


    <!-- ==========================================
         SIDEBAR
    =========================================== -->
    <aside
        x-bind:class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed inset-y-0 left-0 z-50 flex w-64 flex-col border-r border-slate-200 bg-white transition-transform duration-300 ease-in-out lg:translate-x-0"
    >

        <!-- BRAND -->
        <div class="flex h-20 shrink-0 gap-2 items-center justify-between border-b border-slate-100 px-5">

            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 mt-3">

                <img
                    src="{{ asset('LOGO_MIRAI.png') }}"
                    alt="Logo LPK Mirai"
                    class="h-11 w-11 rounded-full object-cover mb-2 shadow-sm"
                >

                <div>
                    <h1 class="text-base mb-0 font-bold tracking-tight text-slate-900">
                        MIRAI GRESIK
                    </h1>

                    <p class="text-[10px] font-semibold uppercase tracking-[0.16em] text-slate-400">
                        Administration
                    </p>
                </div>

            </a>

            <!-- CLOSE MOBILE SIDEBAR -->
            <button
                type="button"
                x-on:click="sidebarOpen = false"
                class="mobile-pressable mobile-pressable-red
                    inline-flex h-9 w-9 items-center justify-center
                    rounded-full border border-slate-200 bg-slate-100
                    text-slate-500
                    transition-all duration-200
                    hover:border-red-200 hover:bg-red-50
                    hover:text-red-600
                    lg:hidden"
            >
                <i class="bi bi-x-lg text-base"></i>
            </button>

        </div>


        <!-- NAVIGATION MENU -->
        <div class="flex-1 overflow-y-auto px-4 py-6">

            <p class="mb-3 px-3 text-[10px] font-bold uppercase tracking-[0.15em] text-slate-400">
                Main Menu
            </p>

            <nav class="space-y-1.5">

                <!-- DASHBOARD -->
                <a
                    href="{{ route('dashboard') }}"
                    x-on:click="sidebarOpen = false"
                    class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold transition
                    {{ request()->routeIs('dashboard')
                        ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-100'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
                >
                    <i class="bi bi-grid-1x2-fill text-lg"></i>

                    <span>Dashboard</span>

                    @if(request()->routeIs('dashboard'))
                        <span class="ml-auto h-2 w-2 rounded-full bg-blue-600"></span>
                    @endif
                </a>


                <!-- PESERTA -->
                <a
                    href="{{ route('participants.index') }}"
                    x-on:click="sidebarOpen = false"
                    class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold transition
                    {{ request()->routeIs('participants.*')
                        ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-100'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
                >
                    <i class="bi bi-people-fill text-lg"></i>

                    <span>Data Peserta</span>

                    @if(request()->routeIs('participants.*'))
                        <span class="ml-auto h-2 w-2 rounded-full bg-blue-600"></span>
                    @endif
                </a>

            </nav>

        </div>


        <!-- SIDEBAR BOTTOM -->
        <div class="shrink-0 border-t border-slate-100 p-4">

            <!-- SOCIAL MEDIA -->
            <div class="mb-4">

                <p class="mb-3 px-1 text-[10px] font-bold uppercase tracking-[0.15em] text-slate-400">
                    Connect With Us
                </p>

                <div class="flex items-center justify-between px-1">

                    <a
                        href="https://facebook.com/lpkmiraigresik?locale=id_ID"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="Facebook"
                        class="flex h-9 w-9 items-center justify-center rounded-lg text-slate-400 transition hover:bg-blue-50 hover:text-blue-600"
                    >
                        <i class="bi bi-facebook text-lg"></i>
                    </a>

                    <a
                        href="https://instagram.com/lpkmiraigresik/"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="Instagram"
                        class="flex h-9 w-9 items-center justify-center rounded-lg text-slate-400 transition hover:bg-pink-50 hover:text-pink-600"
                    >
                        <i class="bi bi-instagram text-lg"></i>
                    </a>

                    <a
                        href="https://youtube.com/@LPKMIRAIGRESIK"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="YouTube"
                        class="flex h-9 w-9 items-center justify-center rounded-lg text-slate-400 transition hover:bg-red-50 hover:text-red-600"
                    >
                        <i class="bi bi-youtube text-lg"></i>
                    </a>

                    <a
                        href="https://tiktok.com/@lpkmiraigresik"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="TikTok"
                        class="flex h-9 w-9 items-center justify-center rounded-lg text-slate-400 transition hover:bg-slate-100 hover:text-slate-900"
                    >
                        <i class="bi bi-tiktok text-lg"></i>
                    </a>

                    <a
                        href="https://wa.me/6281234567890"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="WhatsApp"
                        class="flex h-9 w-9 items-center justify-center rounded-lg text-slate-400 transition hover:bg-green-50 hover:text-green-600"
                    >
                        <i class="bi bi-whatsapp text-lg"></i>
                    </a>

                </div>

            </div>


            <!-- USER PROFILE -->
            @auth

                <div class="relative">

                    <!-- USER DROPDOWN -->
                    <div
                        x-cloak
                        x-show="userMenuOpen"
                        x-transition.origin.bottom.left
                        x-on:click.outside="userMenuOpen = false"
                        class="absolute bottom-full left-0 z-50 mb-2 w-full overflow-hidden rounded-xl border border-slate-200 bg-white p-1.5 shadow-xl"
                    >

                        <a
                            href="{{ route('profile.edit') }}"
                            class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                        >
                            <i class="bi bi-person-circle text-lg"></i>
                            My Profile
                        </a>

                        <div class="my-1 border-t border-slate-100"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button
                                type="submit"
                                class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-red-600 transition hover:bg-red-50"
                            >
                                <i class="bi bi-box-arrow-right text-lg"></i>
                                Logout
                            </button>

                        </form>

                    </div>


                    <!-- USER BUTTON -->
                    <button
                        type="button"
                        x-on:click="userMenuOpen = !userMenuOpen"
                        class="group flex items-center gap-3 rounded-xl px-2 py-2 text-sm font-semibold transition hover:bg-slate-50"
                        aria-label="User menu"
                    >

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center mb-1 rounded-full bg-blue-600 text-sm font-bold text-white shadow-sm">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>

                        <div class="min-w-0 flex-1">

                            <p class="truncate text-sm font-bold mb-0 mt-2 text-slate-800">
                                {{ Auth::user()->name }}
                            </p>

                            <p class="text-xs text-slate-400">
                                Account Settings
                            </p>

                        </div>

                        <i
                            class="bi text-slate-400 transition"
                            x-bind:class="userMenuOpen ? 'bi-chevron-down' : 'bi-chevron-up'"
                        ></i>

                    </button>

                </div>

            @endauth

        </div>

    </aside>


    <!-- ==========================================
         DESKTOP TOPBAR
    =========================================== -->
    <header class="fixed right-0 top-0 z-30 hidden h-16 items-center justify-between border-b border-slate-200 bg-white px-8 lg:left-64 lg:flex">

        <div>
            <p class="text-sm font-semibold mb-0 mt-3 text-slate-800">
                LPK Mirai Gresik
            </p>

            <p class="text-xs text-slate-400">
                Participant Administration System
            </p>
        </div>


        <!-- DESKTOP SOCIAL MEDIA -->
        <div class="flex items-center gap-4">

            <span class="mr-1 text-xs font-medium text-slate-400">
                Follow us
            </span>

            <a
                href="https://facebook.com/lpkmiraigresik?locale=id_ID"
                target="_blank"
                rel="noopener noreferrer"
                class="text-slate-400 transition hover:text-blue-600"
                aria-label="Facebook"
            >
                <i class="bi bi-facebook text-lg"></i>
            </a>

            <a
                href="https://instagram.com/lpkmiraigresik/"
                target="_blank"
                rel="noopener noreferrer"
                class="text-slate-400 transition hover:text-pink-600"
                aria-label="Instagram"
            >
                <i class="bi bi-instagram text-lg"></i>
            </a>

            <a
                href="https://youtube.com/@LPKMIRAIGRESIK"
                target="_blank"
                rel="noopener noreferrer"
                class="text-slate-400 transition hover:text-red-600"
                aria-label="YouTube"
            >
                <i class="bi bi-youtube text-lg"></i>
            </a>

            <a
                href="https://tiktok.com/@lpkmiraigresik"
                target="_blank"
                rel="noopener noreferrer"
                class="text-slate-400 transition hover:text-slate-900"
                aria-label="TikTok"
            >
                <i class="bi bi-tiktok text-lg"></i>
            </a>

            <a
                href="https://wa.me/6281234567890"
                target="_blank"
                rel="noopener noreferrer"
                class="text-slate-400 transition hover:text-green-600"
                aria-label="WhatsApp"
            >
                <i class="bi bi-whatsapp text-lg"></i>
            </a>

        </div>

    </header>

</div>
