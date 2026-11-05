
@extends('layouts.guest')

@section('title', 'Register | LPK Mirai Gresik')

@section('content')
    <div class="relative isolate flex min-h-screen items-center justify-center overflow-hidden bg-slate-950 px-4 py-10 sm:px-6">

        {{-- BACKGROUND --}}
        <div
            class="absolute inset-0 -z-20 bg-cover bg-center"
            style="background-image: url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=2071&auto=format&fit=crop');">
        </div>

        <div class="absolute inset-0 -z-10 bg-gradient-to-br from-blue-950/95 via-blue-900/90 to-indigo-950/95"></div>

        {{-- DECORATION --}}
        <div class="pointer-events-none absolute -left-32 -top-32 -z-10 h-96 w-96 rounded-full bg-blue-400/10 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-40 -right-32 -z-10 h-96 w-96 rounded-full bg-indigo-400/10 blur-3xl"></div>

        {{-- REGISTER CARD --}}
        <div class="w-full max-w-[500px]">

            <div class="overflow-hidden rounded-[2rem] border border-white/30 bg-white/95 shadow-2xl shadow-black/25 backdrop-blur-xl">

                <div class="px-6 py-9 sm:px-10 sm:py-10">

                    {{-- HEADER --}}
                    <div class="mb-8 text-center">

                        <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-3xl bg-gradient-to-br from-blue-600 to-indigo-700 text-white shadow-lg shadow-blue-600/30">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16 4l4 4m-2-6a2.121 2.121 0 013 3L7 19l-4 1 1-4L18 3z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13 6l5 5" />
                            </svg>
                        </div>

                        <div class="mt-6">
                            <h1 class="text-3xl font-bold tracking-tight text-slate-900">
                                Create Account
                            </h1>

                            <p class="mt-2 text-sm text-slate-500">
                                Silakan daftar untuk membuat akun LPK Mirai Gresik.
                            </p>
                        </div>

                    </div>

                    {{-- ERROR --}}
                    @if ($errors->any())
                        <div class="mb-6 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-5 w-5 shrink-0"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-11a1 1 0 112 0v3a1 1 0 11-2 0V7zm1 8a1 1 0 100-2 1 1 0 000 2z"
                                    clip-rule="evenodd" />
                            </svg>

                            <div>
                                <p class="font-semibold">Registrasi gagal</p>
                                <p class="mt-1">{{ $errors->first() }}</p>
                            </div>
                        </div>
                    @endif

                    {{-- REGISTER FORM --}}
                    <form method="POST" action="{{ route('register') }}" class="space-y-5">
                        @csrf

                        {{-- NAME --}}
                        <div>
                            <label for="name" class="mb-2 block text-sm font-semibold text-slate-700">
                                Nama Lengkap
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Masukkan nama lengkap"
                                autocomplete="name"
                                required
                                autofocus
                                class="h-13 w-full rounded-xl border border-slate-300 bg-white px-4 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 hover:border-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 @error('name') border-red-400 focus:border-red-500 focus:ring-red-500/10 @enderror"
                            >

                            @error('name')
                                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- EMAIL --}}
                        <div>
                            <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">
                                Email
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="nama@email.com"
                                autocomplete="email"
                                required
                                class="h-13 w-full rounded-xl border border-slate-300 bg-white px-4 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 hover:border-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 @error('email') border-red-400 focus:border-red-500 focus:ring-red-500/10 @enderror"
                            >

                            @error('email')
                                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- PASSWORD --}}
                        <div>
                            <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">
                                Password
                            </label>

                            <div
                                x-data="{ showPassword: false }"
                                class="relative"
                            >
                                <input
                                    :type="showPassword ? 'text' : 'password'"
                                    id="password"
                                    name="password"
                                    placeholder="Masukkan password"
                                    autocomplete="new-password"
                                    required
                                    class="h-13 w-full rounded-xl border border-slate-300 bg-white px-4 pr-12 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 hover:border-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 @error('password') border-red-400 focus:border-red-500 focus:ring-red-500/10 @enderror"
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
                                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- CONFIRM PASSWORD --}}
                        <div>
                            <label for="password_confirmation" class="mb-2 block text-sm font-semibold text-slate-700">
                                Konfirmasi Password
                            </label>

                            <div
                                x-data="{ showPassword: false }"
                                class="relative"
                            >
                                <input
                                    :type="showPassword ? 'text' : 'password'"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    placeholder="Masukkan ulang password"
                                    autocomplete="new-password"
                                    required
                                    class="h-13 w-full rounded-xl border border-slate-300 bg-white px-4 pr-12 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 hover:border-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
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
                        </div>

                        {{-- INVITATION CODE --}}
                        <div>
                            <label for="invite_code" class="mb-2 block text-sm font-semibold text-slate-700">
                                Kode Undangan
                            </label>

                            <input
                                type="text"
                                id="invite_code"
                                name="invite_code"
                                placeholder="Masukkan kode dari admin"
                                required
                                value="{{ old('invite_code') }}"
                                class="h-13 w-full rounded-xl border border-slate-300 bg-white px-4 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 hover:border-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 @error('invite_code') border-red-400 focus:border-red-500 focus:ring-red-500/10 @enderror"
                            >

                            <p class="mt-2 flex items-center gap-1.5 text-xs text-slate-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v2m0 4h.01M5.07 19h13.86a2 2 0 001.73-3L13.73 4a2 2 0 00-3.46 0L3.34 16a2 2 0 001.73 3z" />
                                </svg>
                                Kode undangan dapat diminta kepada admin.
                            </p>

                            @error('invite_code')
                                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- REGISTER BUTTON --}}
                        <button
                            type="submit"
                            class="flex h-13 w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-700 px-5 text-sm font-semibold text-white shadow-lg shadow-blue-600/20 transition duration-200 hover:-translate-y-0.5 hover:from-blue-700 hover:to-indigo-800 hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-blue-500/25 active:translate-y-0"
                        >
                            Create Account

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </button>

                    </form>

                    {{-- LOGIN LINK --}}
                    <div class="mt-7 border-t border-slate-200 pt-6 text-center">
                        <p class="text-sm text-slate-500">
                            Sudah memiliki akun?

                            <a
                                href="{{ route('login') }}"
                                class="ml-1 font-semibold text-blue-600 transition hover:text-blue-800 hover:underline"
                            >
                                Login di sini
                            </a>
                        </p>
                    </div>

                </div>

            </div>

            {{-- FOOTER --}}
            <p class="mt-6 text-center text-xs text-white/60">
                &copy; {{ date('Y') }} LPK Mirai Gresik. All rights reserved.
            </p>

        </div>

    </div>
@endsection
