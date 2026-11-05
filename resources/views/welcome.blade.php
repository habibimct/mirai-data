
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LPK Mirai Gresik') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('LOGO_MIRAI.png') }}">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <!-- Tailwind CSS v4 -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="min-h-screen bg-white font-poppins antialiased text-slate-800">


    <!-- ==========================================
         HERO SECTION
    =========================================== -->

    <section class="relative isolate overflow-hidden bg-gradient-to-br from-slate-950 via-blue-950 to-blue-800">

        <!-- BACKGROUND DECORATION -->
        <div class="pointer-events-none absolute inset-0 overflow-hidden">

            <div class="absolute -right-40 -top-40 h-96 w-96 rounded-full bg-blue-400/20 blur-3xl"></div>

            <div class="absolute -bottom-40 -left-40 h-96 w-96 rounded-full bg-indigo-500/20 blur-3xl"></div>

            <div class="absolute inset-0 opacity-[0.07]"
                 style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 28px 28px;">
            </div>

        </div>


        <!-- ======================================
             NAVBAR
        ======================================= -->

        <nav class="relative z-10 border-b border-white/10">

            <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-5 sm:px-8 lg:px-10">

                <!-- BRAND -->
                <a
                    href="{{ url('/') }}"
                    class="flex items-center gap-3 no-underline"
                >

                    <img
                        src="{{ asset('LOGO_MIRAI.png') }}"
                        alt="Logo LPK Mirai"
                        class="h-11 w-11 rounded-full border-2 border-white/20 bg-white object-cover shadow-lg"
                    >

                    <div>

                        <h1 class="text-base font-bold tracking-wide text-white">
                            LPK MIRAI
                        </h1>

                        <p class="text-[10px] font-medium uppercase tracking-[0.18em] text-blue-200">
                            Gresik, Indonesia
                        </p>

                    </div>

                </a>


                <!-- NAV ACTION -->
                <div class="flex items-center gap-2 sm:gap-3">

                    @auth

                        <a
                            href="{{ route('dashboard') }}"
                            class="mobile-pressable inline-flex items-center gap-2 rounded-lg bg-white px-4 py-2.5 text-xs font-semibold text-blue-900 no-underline shadow-sm transition-all duration-200 hover:bg-blue-50 active:scale-[0.97] sm:px-5 sm:text-sm"
                        >
                            <i class="bi bi-grid-1x2-fill"></i>
                            Dashboard
                        </a>

                    @else

                        <a
                            href="{{ route('login') }}"
                            class="mobile-pressable inline-flex items-center gap-2 rounded-lg border border-white/30 bg-white/10 px-4 py-2.5 text-xs font-semibold text-white no-underline backdrop-blur-sm transition-all duration-200 hover:border-white hover:bg-white/20 active:scale-[0.97] sm:px-5 sm:text-sm"
                        >
                            <i class="bi bi-box-arrow-in-right"></i>
                            Login
                        </a>

                        @if (Route::has('register'))

                            <a
                                href="{{ route('register') }}"
                                class="mobile-pressable hidden items-center gap-2 rounded-lg bg-white px-5 py-2.5 text-sm font-semibold text-blue-900 no-underline shadow-sm transition-all duration-200 hover:bg-blue-50 active:scale-[0.97] sm:inline-flex"
                            >
                                Register
                                <i class="bi bi-arrow-right"></i>
                            </a>

                        @endif

                    @endauth

                </div>

            </div>

        </nav>


        <!-- ======================================
             HERO CONTENT
        ======================================= -->

        <div class="relative z-10 mx-auto grid min-h-[580px] max-w-7xl grid-cols-1 items-center gap-12 px-5 py-16 sm:px-8 lg:min-h-[650px] lg:grid-cols-2 lg:gap-16 lg:px-10 lg:py-20">


            <!-- LEFT CONTENT -->
            <div class="text-center lg:text-left">

                <!-- BADGE -->
                <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-blue-300/20 bg-blue-400/10 px-4 py-2 text-xs font-medium text-blue-100 backdrop-blur-sm">

                    <span class="h-2 w-2 rounded-full bg-emerald-400 shadow-[0_0_10px_rgba(52,211,153,0.8)]"></span>

                    LPK MIRAI GRESIK

                    <span class="text-blue-300">|</span>

                    Management System

                </div>


                <!-- TITLE -->
                <h2 class="text-3xl font-bold leading-tight tracking-tight text-white sm:text-4xl lg:text-5xl xl:text-[54px]">

                    Sistem Pendataan

                    <span class="block text-blue-300">
                        Peserta Pelatihan
                    </span>

                    <span class="block">
                        LPK Mirai Gresik
                    </span>

                </h2>


                <!-- DESCRIPTION -->
                <p class="mx-auto mt-6 max-w-xl text-sm leading-7 text-blue-100/80 sm:text-base lg:mx-0">

                    Platform administrasi untuk mengelola data peserta,
                    informasi pengguna, statistik, dan dokumentasi
                    pelatihan secara terintegrasi, modern, dan efisien.

                </p>


                <!-- ACTION BUTTONS -->
                <div class="mt-8 flex flex-col items-center justify-center gap-3 sm:flex-row lg:justify-start">

                    @auth

                        <a
                            href="{{ route('dashboard') }}"
                            class="mobile-pressable inline-flex w-full items-center justify-center gap-2 rounded-xl bg-white px-6 py-3.5 text-sm font-bold text-blue-900 no-underline shadow-lg shadow-blue-950/20 transition-all duration-200 hover:-translate-y-1 hover:bg-blue-50 hover:shadow-xl active:scale-[0.98] sm:w-auto"
                        >
                            <i class="bi bi-grid-fill"></i>
                            Masuk Dashboard
                            <i class="bi bi-arrow-right ml-1"></i>
                        </a>

                    @else

                        <a
                            href="{{ route('login') }}"
                            class="mobile-pressable inline-flex w-full items-center justify-center gap-2 rounded-xl bg-white px-7 py-3.5 text-sm font-bold text-blue-900 no-underline shadow-lg shadow-blue-950/20 transition-all duration-200 hover:-translate-y-1 hover:bg-blue-50 hover:shadow-xl active:scale-[0.98] sm:w-auto"
                        >
                            <i class="bi bi-box-arrow-in-right"></i>
                            Login Sistem
                            <i class="bi bi-arrow-right ml-1"></i>
                        </a>

                        @if (Route::has('register'))

                            <a
                                href="{{ route('register') }}"
                                class="mobile-pressable inline-flex w-full items-center justify-center gap-2 rounded-xl border border-white/30 bg-white/10 px-7 py-3.5 text-sm font-semibold text-white no-underline backdrop-blur-sm transition-all duration-200 hover:-translate-y-1 hover:bg-white/20 active:scale-[0.98] sm:w-auto"
                            >
                                Buat Akun
                            </a>

                        @endif

                    @endauth

                </div>


                <!-- BOTTOM INFORMATION -->
                <div class="mt-10 flex flex-wrap items-center justify-center gap-x-6 gap-y-3 text-xs text-blue-100/70 lg:justify-start">

                    <div class="flex items-center gap-2">
                        <i class="bi bi-shield-check text-emerald-300"></i>
                        Sistem Administrasi
                    </div>

                    <div class="flex items-center gap-2">
                        <i class="bi bi-lightning-charge text-amber-300"></i>
                        Pengelolaan Terintegrasi
                    </div>

                </div>

            </div>


            <!-- RIGHT CONTENT -->
            <div class="relative mx-auto w-full max-w-lg lg:max-w-none">

                <!-- DECORATIVE CIRCLE -->
                <div class="absolute -right-8 -top-8 h-40 w-40 rounded-full border border-white/10"></div>

                <div class="absolute -bottom-8 -left-8 h-40 w-40 rounded-full border border-white/10"></div>


                <!-- DASHBOARD MOCKUP -->
                <div class="relative overflow-hidden rounded-2xl border border-white/20 bg-white shadow-2xl shadow-slate-950/30">


                    <!-- MOCKUP HEADER -->
                    <div class="flex items-center justify-between border-b border-slate-100 bg-white px-5 py-4">

                        <div class="flex items-center gap-3">

                            <img
                                src="{{ asset('LOGO_MIRAI.png') }}"
                                alt="Logo Mirai"
                                class="h-9 w-9 rounded-full object-cover"
                            >

                            <div>

                                <h3 class="text-xs font-bold text-slate-800">
                                    MIRAI MANAGEMENT
                                </h3>

                                <p class="text-[9px] text-slate-400">
                                    Participant Administration
                                </p>

                            </div>

                        </div>

                        <div class="flex items-center gap-1.5">

                            <span class="h-2 w-2 rounded-full bg-red-400"></span>
                            <span class="h-2 w-2 rounded-full bg-amber-400"></span>
                            <span class="h-2 w-2 rounded-full bg-emerald-400"></span>

                        </div>

                    </div>


                    <!-- MOCKUP CONTENT -->
                    <div class="bg-slate-50 p-5 sm:p-6">

                        <div class="mb-5 flex items-center justify-between">

                            <div>

                                <p class="text-[10px] font-medium text-slate-400">
                                    ADMINISTRATION
                                </p>

                                <h3 class="mt-1 text-lg font-bold text-slate-800">
                                    Dashboard
                                </h3>

                            </div>

                            <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 text-blue-600">
                                <i class="bi bi-grid-1x2-fill"></i>
                            </div>

                        </div>


                        <!-- MOCKUP CARDS -->
                        <div class="grid grid-cols-3 gap-2.5 sm:gap-1 sm:flex-row">

                            <div class="rounded-xl border border-slate-100 bg-white p-3 shadow-sm">

                                <div class="mb-2 flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                                    <i class="bi bi-people-fill text-sm"></i>
                                </div>

                                <p class="text-[10px] font-medium text-slate-400">
                                    Peserta
                                </p>

                                <p class="mt-1 text-xs font-bold text-slate-700">
                                    Data
                                </p>

                            </div>


                            <div class="rounded-xl border border-slate-100 bg-white p-3 shadow-sm">

                                <div class="mb-2 flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                                    <i class="bi bi-bar-chart-fill text-sm"></i>
                                </div>

                                <p class="text-[10px] font-medium text-slate-400">
                                    Statistik
                                </p>

                                <p class="mt-1 text-xs font-bold text-slate-700">
                                    Analisis
                                </p>

                            </div>


                            <div class="rounded-xl border border-slate-100 bg-white p-3 shadow-sm">

                                <div class="mb-2 flex h-8 w-8 items-center justify-center rounded-lg bg-amber-50 text-amber-600">
                                    <i class="bi bi-shield-lock-fill text-sm"></i>
                                </div>

                                <p class="text-[10px] font-medium text-slate-400">
                                    Pengguna
                                </p>

                                <p class="mt-1 text-xs font-bold text-slate-700">
                                    Akses
                                </p>

                            </div>

                        </div>


                        <!-- MOCKUP CHART -->
                        <div class="mt-4 rounded-xl border border-slate-100 bg-white p-4 shadow-sm">

                            <div class="mb-4 flex items-center justify-between">

                                <div>
                                    <h4 class="text-xs font-bold text-slate-700">
                                        Statistik Peserta
                                    </h4>

                                    <p class="mt-0.5 text-[9px] text-slate-400">
                                        Visualisasi data pelatihan
                                    </p>
                                </div>

                                <i class="bi bi-three-dots text-slate-400"></i>

                            </div>


                            <!-- DECORATIVE CHART -->
                            <div class="flex h-28 items-end justify-around gap-3 border-b border-slate-100 px-2">

                                <div class="h-[35%] w-7 rounded-t-md bg-blue-200"></div>

                                <div class="h-[60%] w-7 rounded-t-md bg-blue-300"></div>

                                <div class="h-[45%] w-7 rounded-t-md bg-blue-400"></div>

                                <div class="h-[85%] w-7 rounded-t-md bg-blue-600"></div>

                                <div class="h-[65%] w-7 rounded-t-md bg-indigo-400"></div>

                                <div class="h-[95%] w-7 rounded-t-md bg-blue-700"></div>

                                <div class="h-[55%] w-7 rounded-t-md bg-blue-300"></div>

                            </div>

                            <div class="mt-3 flex items-center justify-between text-[9px] text-slate-400">

                                <span>Data</span>
                                <span>Statistik</span>
                                <span>Pelatihan</span>

                            </div>

                        </div>


                        <!-- MOCKUP TABLE -->
                        <div class="mt-4 overflow-hidden rounded-xl border border-slate-100 bg-white shadow-sm">

                            <div class="border-b border-slate-100 px-4 py-3">

                                <h4 class="text-xs font-bold text-slate-700">
                                    Manajemen Peserta
                                </h4>

                            </div>

                            <div class="space-y-3 p-4">

                                <div class="flex items-center justify-between">

                                    <div class="flex items-center gap-2">

                                        <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-blue-50 text-blue-500">
                                            <i class="bi bi-person-fill text-xs"></i>
                                        </div>

                                        <div>
                                            <div class="h-2 w-20 rounded-full bg-slate-200"></div>
                                            <div class="mt-1.5 h-1.5 w-14 rounded-full bg-slate-100"></div>
                                        </div>

                                    </div>

                                    <span class="rounded-full bg-emerald-50 px-2 py-1 text-[9px] font-semibold text-emerald-600">
                                        Sending
                                    </span>

                                </div>


                                <div class="flex items-center justify-between">

                                    <div class="flex items-center gap-2">

                                        <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-indigo-50 text-indigo-500">
                                            <i class="bi bi-person-fill text-xs"></i>
                                        </div>

                                        <div>
                                            <div class="h-2 w-24 rounded-full bg-slate-200"></div>
                                            <div class="mt-1.5 h-1.5 w-16 rounded-full bg-slate-100"></div>
                                        </div>

                                    </div>

                                    <span class="rounded-full bg-blue-50 px-2 py-1 text-[9px] font-semibold text-blue-600">
                                        Existing
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- FLOATING BADGE -->
                <div class="absolute -bottom-5 -left-3 hidden rounded-xl border border-white/50 bg-white px-4 py-3 shadow-xl sm:block">

                    <div class="flex items-center gap-2.5">

                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                            <i class="bi bi-check-circle-fill text-lg"></i>
                        </div>

                        <div>

                            <p class="text-[11px] font-bold text-slate-800">
                                Management System
                            </p>

                            <p class="text-[9px] text-slate-400">
                                LPK Mirai Gresik
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>



    <!-- ==========================================
         FEATURES SECTION
    =========================================== -->

    <section class="bg-slate-50 py-20 sm:py-24">

        <div class="mx-auto max-w-7xl px-5 sm:px-8 lg:px-10">


            <!-- SECTION HEADER -->
            <div class="mx-auto mb-12 max-w-2xl text-center">

                <span class="inline-flex items-center gap-2 rounded-full bg-blue-50 px-4 py-2 text-xs font-semibold text-blue-700">

                    <i class="bi bi-grid-fill"></i>

                    Fitur Sistem

                </span>

                <h2 class="mt-5 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">

                    Pengelolaan Data yang

                    <span class="text-blue-600">
                        Lebih Efisien
                    </span>

                </h2>

                <p class="mt-4 text-sm leading-7 text-slate-500 sm:text-base">

                    Sistem administrasi terpadu untuk mendukung pengelolaan
                    data dan aktivitas pelatihan LPK Mirai Gresik.

                </p>

            </div>


            <!-- FEATURE CARDS -->
            <div class="grid grid-cols-1 gap-5 md:grid-cols-3">


                <!-- FEATURE 1 -->
                <div class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-blue-200 hover:shadow-lg sm:p-7">

                    <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-600 transition-colors group-hover:bg-blue-600 group-hover:text-white">

                        <i class="bi bi-people-fill text-2xl"></i>

                    </div>

                    <h3 class="text-base font-bold text-slate-800">
                        Manajemen Data Peserta
                    </h3>

                    <p class="mt-3 text-sm leading-6 text-slate-500">

                        Kelola informasi pribadi, kualifikasi, status,
                        dokumentasi foto, dan data kompetensi peserta
                        dalam satu sistem.

                    </p>

                    <div class="mt-5 flex items-center gap-2 text-xs font-semibold text-blue-600">

                        <i class="bi bi-check-circle-fill"></i>

                        Pengelolaan Terpusat

                    </div>

                </div>


                <!-- FEATURE 2 -->
                <div class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-emerald-200 hover:shadow-lg sm:p-7">

                    <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 transition-colors group-hover:bg-emerald-600 group-hover:text-white">

                        <i class="bi bi-bar-chart-line-fill text-2xl"></i>

                    </div>

                    <h3 class="text-base font-bold text-slate-800">
                        Statistik Dashboard
                    </h3>

                    <p class="mt-3 text-sm leading-6 text-slate-500">

                        Pantau statistik peserta, distribusi usia,
                        kualifikasi, serta status peserta melalui
                        visualisasi data yang informatif.

                    </p>

                    <div class="mt-5 flex items-center gap-2 text-xs font-semibold text-emerald-600">

                        <i class="bi bi-check-circle-fill"></i>

                        Monitoring Data

                    </div>

                </div>


                <!-- FEATURE 3 -->
                <div class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-amber-200 hover:shadow-lg sm:p-7">

                    <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 text-amber-600 transition-colors group-hover:bg-amber-500 group-hover:text-white">

                        <i class="bi bi-shield-lock-fill text-2xl"></i>

                    </div>

                    <h3 class="text-base font-bold text-slate-800">
                        Multi User & Keamanan
                    </h3>

                    <p class="mt-3 text-sm leading-6 text-slate-500">

                        Sistem pengelolaan akun dengan pembagian
                        hak akses Admin dan Member untuk menjaga
                        keamanan informasi.

                    </p>

                    <div class="mt-5 flex items-center gap-2 text-xs font-semibold text-amber-600">

                        <i class="bi bi-check-circle-fill"></i>

                        Role-Based Access

                    </div>

                </div>

            </div>

        </div>

    </section>



    <!-- ==========================================
         CTA SECTION
    =========================================== -->

    <section class="relative overflow-hidden bg-white py-16 sm:py-20">

        <div class="mx-auto max-w-5xl px-5 text-center sm:px-8">

            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-50 text-blue-600">

                <i class="bi bi-buildings-fill text-2xl"></i>

            </div>

            <h2 class="mt-5 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">

                Selamat Datang di

                <span class="text-blue-600">
                    LPK Mirai Gresik
                </span>

            </h2>

            <p class="mx-auto mt-4 max-w-2xl text-sm leading-7 text-slate-500">

                Sistem ini dirancang untuk mendukung pengelolaan
                informasi peserta dan administrasi pelatihan
                secara lebih terstruktur dan profesional.

            </p>

            @auth

                <a
                    href="{{ route('dashboard') }}"
                    class="mobile-pressable mt-7 inline-flex items-center gap-2 rounded-xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white no-underline shadow-sm transition-all duration-200 hover:bg-blue-700 hover:shadow-md active:scale-[0.98]"
                >
                    Buka Dashboard
                    <i class="bi bi-arrow-right"></i>
                </a>

            @else

                <a
                    href="{{ route('login') }}"
                    class="mobile-pressable mt-7 inline-flex items-center gap-2 rounded-xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white no-underline shadow-sm transition-all duration-200 hover:bg-blue-700 hover:shadow-md active:scale-[0.98]"
                >
                    Masuk ke Sistem
                    <i class="bi bi-arrow-right"></i>
                </a>

            @endauth

        </div>

    </section>



    <!-- ==========================================
         FOOTER
    =========================================== -->

    <footer class="bg-slate-950">

        <div class="mx-auto max-w-7xl px-5 py-10 sm:px-8 lg:px-10">


            <!-- FOOTER MAIN -->
            <div class="flex flex-col items-center justify-between gap-6 border-b border-white/10 pb-8 sm:flex-row">


                <!-- BRAND -->
                <div class="flex items-center gap-3">

                    <img
                        src="{{ asset('LOGO_MIRAI.png') }}"
                        alt="Logo LPK Mirai"
                        class="h-12 w-12 rounded-full border border-white/20 bg-white object-cover"
                    >

                    <div>

                        <h3 class="text-sm font-bold tracking-wide text-white">
                            LPK MIRAI GRESIK
                        </h3>

                        <p class="mt-1 text-[10px] uppercase tracking-[0.15em] text-slate-400">
                            Management System
                        </p>

                    </div>

                </div>


                <!-- FOOTER NAVIGATION -->
                <div class="flex flex-wrap items-center justify-center gap-5 text-xs font-medium text-slate-400">

                    <a
                        href="{{ url('/') }}"
                        class="no-underline transition-colors hover:text-white"
                    >
                        Home
                    </a>

                    @auth

                        <a
                            href="{{ route('dashboard') }}"
                            class="no-underline transition-colors hover:text-white"
                        >
                            Dashboard
                        </a>

                    @else

                        <a
                            href="{{ route('login') }}"
                            class="no-underline transition-colors hover:text-white"
                        >
                            Login
                        </a>

                    @endauth

                </div>

            </div>


            <!-- FOOTER BOTTOM -->
            <div class="flex flex-col items-center justify-between gap-3 pt-6 text-center sm:flex-row sm:text-left">

                <p class="text-[11px] text-slate-500">

                    © {{ date('Y') }} LPK Mirai Gresik.
                    All Rights Reserved.

                </p>

                <p class="text-[11px] text-slate-500">

                    Built for LPK Mirai Gresik

                </p>

            </div>

        </div>

    </footer>


</body>
</html>
