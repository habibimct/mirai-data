
@extends('layouts.guest')

@section('title', 'Login | LPK Mirai Gresik')

@section('content')

<div class="relative flex min-h-screen items-center justify-center overflow-hidden bg-slate-50 px-4 py-8 sm:px-6">

    <!-- ==========================================
         BACKGROUND DECORATION
    =========================================== -->

{{-- BACKGROUND IMAGE + BLUE OVERLAY --}}
<div class="pointer-events-none absolute inset-0 z-0 overflow-hidden">

    {{-- Background Image --}}
    <div
        class="absolute inset-0 bg-cover bg-center"
        style="background-image: url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=2071&auto=format&fit=crop');">
    </div>

    {{-- Blue Overlay --}}
    <div class="absolute inset-0 bg-gradient-to-br from-blue-950/90 via-blue-900/80 to-indigo-950/85"></div>

    {{-- Decorative Blur --}}
    <div class="absolute inset-0 bg-blue-300/10"></div>

    <div class="absolute -left-32 -top-32 h-96 w-96 rounded-full bg-blue-300/30 blur-3xl"></div>

    <div class="absolute -bottom-40 -right-32 h-96 w-96 rounded-full bg-indigo-300/30 blur-3xl"></div>

</div>


    <!-- ==========================================
         LOGIN CONTAINER
    =========================================== -->

    <div class="relative z-10 mx-auto grid w-full max-w-5xl overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xl shadow-slate-900/10 lg:grid-cols-2">


        <!-- ======================================
             LEFT PANEL
        ======================================= -->

        <div class="relative hidden flex-col justify-between overflow-hidden bg-gradient-to-br from-slate-950 via-blue-950 to-blue-800 p-10 lg:flex">

            <!-- BACKGROUND DECORATION -->
            <div class="pointer-events-none absolute inset-0 overflow-hidden">

                <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full border border-white/10"></div>

                <div class="absolute -bottom-24 -left-20 h-72 w-72 rounded-full border border-white/10"></div>

                <div class="absolute right-10 top-1/3 h-48 w-48 rounded-full bg-blue-400/10 blur-3xl"></div>

            </div>


            <!-- BRAND -->
            <div class="relative z-10 flex items-center gap-3">

                <img
                    src="{{ asset('LOGO_MIRAI.png') }}"
                    alt="Logo LPK Mirai"
                    class="h-12 w-12 rounded-full border-2 border-white/20 bg-white object-cover shadow-lg"
                >

                <div>

                    <h2 class="text-base font-bold tracking-wide text-white">
                        LPK MIRAI GRESIK
                    </h2>

                    <p class="mt-0.5 text-[10px] font-medium uppercase tracking-[0.18em] text-blue-200">
                        Management System
                    </p>

                </div>

            </div>


            <!-- MAIN CONTENT -->
            <div class="relative z-10 py-10">

                <div class="mb-5 inline-flex items-center gap-2 rounded-full border border-blue-300/20 bg-blue-400/10 px-3 py-1.5 text-[10px] font-semibold uppercase tracking-wider text-blue-200">

                    <i class="bi bi-shield-check"></i>

                    Secure Administration

                </div>


                <h1 class="text-3xl font-bold leading-tight tracking-tight text-white xl:text-4xl">

                    Welcome Back to

                    <span class="mt-1 block text-blue-300">
                        LPK Mirai
                    </span>

                </h1>


                <p class="mt-5 max-w-sm text-sm leading-7 text-blue-100/75">

                    Sistem administrasi terpadu untuk mengelola
                    data peserta, informasi pengguna, statistik,
                    dan dokumentasi pelatihan secara efisien.

                </p>


                <!-- FEATURE LIST -->
                <div class="mt-9 space-y-4">

                    <div class="flex items-center gap-3">

                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-white/10 text-blue-200">
                            <i class="bi bi-people-fill"></i>
                        </div>

                        <span class="text-xs font-medium text-blue-100">
                            Manajemen Data Peserta
                        </span>

                    </div>


                    <div class="flex items-center gap-3">

                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-white/10 text-blue-200">
                            <i class="bi bi-bar-chart-fill"></i>
                        </div>

                        <span class="text-xs font-medium text-blue-100">
                            Statistik dan Monitoring
                        </span>

                    </div>


                    <div class="flex items-center gap-3">

                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-white/10 text-blue-200">
                            <i class="bi bi-shield-lock-fill"></i>
                        </div>

                        <span class="text-xs font-medium text-blue-100">
                            Keamanan dan Hak Akses
                        </span>

                    </div>

                </div>

            </div>


            <!-- FOOTER -->
            <div class="relative z-10 border-t border-white/10 pt-5">

                <p class="text-[10px] text-blue-200/60">
                    © {{ date('Y') }} LPK Mirai Gresik. All Rights Reserved.
                </p>

            </div>

        </div>



        <!-- ======================================
             RIGHT PANEL - LOGIN FORM
        ======================================= -->

        <div class="flex flex-col justify-center p-6 sm:p-10 lg:p-12">


            <!-- MOBILE BRAND -->
            <div class="mb-8 flex items-center justify-center gap-3 lg:hidden">

                <img
                    src="{{ asset('LOGO_MIRAI.png') }}"
                    alt="Logo LPK Mirai"
                    class="h-12 w-12 rounded-full border border-slate-200 bg-white object-cover shadow-sm"
                >

                <div>

                    <h2 class="text-sm font-bold tracking-wide text-slate-900">
                        LPK MIRAI GRESIK
                    </h2>

                    <p class="text-[10px] font-medium uppercase tracking-[0.15em] text-slate-400">
                        Management System
                    </p>

                </div>

            </div>


            <!-- LOGIN HEADER -->
            <div class="mb-7">

                <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">

                    <i class="bi bi-box-arrow-in-right text-xl"></i>

                </div>


                <h2 class="text-2xl font-bold tracking-tight text-slate-900">
                    Welcome Back!
                </h2>

                <p class="mt-2 text-sm text-slate-500">
                    Silakan login untuk mengakses sistem administrasi.
                </p>

            </div>


            <!-- ==================================
                 SESSION STATUS
            =================================== -->

            @if (session('status'))

                <div class="mb-5 flex items-center gap-2 rounded-lg border border-emerald-200 bg-emerald-50 p-3 text-xs font-medium text-emerald-700">

                    <i class="bi bi-check-circle-fill text-base"></i>

                    {{ session('status') }}

                </div>

            @endif


            <!-- ==================================
                 VALIDATION ERRORS
            =================================== -->

            @if ($errors->any())

                <div class="mb-5 flex items-start gap-2 rounded-lg border border-red-200 bg-red-50 p-3.5 text-xs text-red-700">

                    <i class="bi bi-exclamation-circle-fill mt-0.5 text-base"></i>

                    <div>

                        <p class="font-semibold">
                            Login gagal.
                        </p>

                        <p class="mt-1">
                            {{ $errors->first() }}
                        </p>

                    </div>

                </div>

            @endif



            <!-- ==================================
                 LOGIN FORM
            =================================== -->

            <form method="POST" action="{{ route('login') }}" class="space-y-5">

                @csrf


                <!-- EMAIL -->
                <div>

                    <label
                        for="email"
                        class="mb-1.5 block text-xs font-semibold text-slate-700"
                    >
                        Alamat Email
                    </label>

                    <div class="relative">

                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">

                            <i class="bi bi-envelope text-base"></i>

                        </div>

                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            placeholder="Masukkan email Anda"
                            required
                            autofocus
                            autocomplete="username"
                            class="block w-full rounded-lg border border-slate-300 bg-white py-3 pl-10 pr-4 text-sm text-slate-800 shadow-sm outline-none transition-all duration-200 placeholder:text-slate-400 hover:border-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                        >

                    </div>

                    @error('email')

                        <p class="mt-1.5 text-xs text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>



                <!-- PASSWORD -->
                <div x-data="{ showPassword: false }">

                    <div class="mb-1.5 flex items-center justify-between">

                        <label
                            for="password"
                            class="block text-xs font-semibold text-slate-700"
                        >
                            Password
                        </label>

                    </div>


                    <div class="relative">

                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">

                            <i class="bi bi-lock text-base"></i>

                        </div>


                        <input
                            x-bind:type="showPassword ? 'text' : 'password'"
                            name="password"
                            id="password"
                            placeholder="Masukkan password"
                            required
                            autocomplete="current-password"
                            class="block w-full rounded-lg border border-slate-300 bg-white py-3 pl-10 pr-12 text-sm text-slate-800 shadow-sm outline-none transition-all duration-200 placeholder:text-slate-400 hover:border-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                        >


{{-- SHOW / HIDE PASSWORD --}}
<button
    type="button"
    x-on:click="showPassword = !showPassword"
    x-bind:aria-label="showPassword ? 'Sembunyikan password' : 'Tampilkan password'"
    x-bind:aria-pressed="showPassword"
    class="password-toggle absolute right-1 top-1/2 z-10 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-lg text-slate-400 transition-all duration-200 hover:bg-blue-50 hover:text-blue-600 active:bg-blue-100 focus-visible:ring-2 focus-visible:ring-blue-500"
>
    <i
        class="bi text-lg"
        x-bind:class="showPassword ? 'bi-eye-slash-fill' : 'bi-eye-fill'"
    ></i>
</button>

                    </div>

                    @error('password')

                        <p class="mt-1.5 text-xs text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>



                <!-- REMEMBER & FORGOT PASSWORD -->
                <div class="flex flex-wrap items-center justify-between gap-3">

                    <!-- REMEMBER ME -->
                    <label class="inline-flex cursor-pointer items-center gap-2.5">

                        <input
                            type="checkbox"
                            name="remember"
                            id="remember"
                            value="1"
                            @checked(old('remember'))
                            class="h-4 w-4 cursor-pointer rounded border-slate-300 text-blue-600 focus:ring-2 focus:ring-blue-200"
                        >

                        <span class="text-xs font-medium text-slate-600">
                            Remember Me
                        </span>

                    </label>


                    <!-- FORGOT PASSWORD -->
                    @if (Route::has('password.request'))

                        <a
                            href="{{ route('password.request') }}"
                            class="text-xs font-semibold text-blue-600 no-underline transition-colors hover:text-blue-800"
                        >
                            Lupa Password?
                        </a>

                    @endif

                </div>



                <!-- LOGIN BUTTON -->
                <button
                    type="submit"
                    class="mobile-pressable flex w-full items-center justify-center gap-2 rounded-lg bg-blue-600 px-5 py-3 text-sm font-bold text-white shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:bg-blue-700 hover:shadow-md active:scale-[0.98] focus:outline-none focus-visible:ring-4 focus-visible:ring-blue-100"
                >

                    <i class="bi bi-box-arrow-in-right text-base"></i>

                    Login ke Sistem

                </button>


            </form>



            <!-- ==================================
                 REGISTER
            =================================== -->

            @if (Route::has('register'))

                <div class="mt-7 border-t border-slate-100 pt-6 text-center">

                    <p class="text-xs text-slate-500">

                        Belum punya akun?

                        <a
                            href="{{ route('register') }}"
                            class="ml-1 font-bold text-blue-600 no-underline transition-colors hover:text-blue-800"
                        >
                            Register
                        </a>

                    </p>

                </div>

            @endif


            <!-- MOBILE FOOTER -->
            <div class="mt-8 text-center lg:hidden">

                <p class="text-[10px] text-slate-400">
                    © {{ date('Y') }} LPK Mirai Gresik. All Rights Reserved.
                </p>

            </div>


        </div>

    </div>

</div>

@endsection
