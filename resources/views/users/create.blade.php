
@extends('layouts.app')

@section('title', 'Tambah User | LPK Mirai Gresik')

@section('content')

<div class="mx-auto w-full max-w-2xl px-4 py-6 sm:px-6 lg:px-8">

    <!-- ==========================================
         PAGE HEADER
    =========================================== -->

    <div class="mb-6">

        <div class="mb-1 flex items-center gap-2 text-xs text-slate-400">
            <a
                href="{{ route('dashboard') }}"
                class="text-slate-500 no-underline transition-colors hover:text-blue-600"
            >
                Dashboard
            </a>

            <i class="bi bi-chevron-right text-[10px]"></i>

            <span class="font-medium text-slate-600">
                Tambah User
            </span>
        </div>

        <h2 class="text-2xl font-bold tracking-tight text-slate-900">
            Tambah User
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            Buat akun pengguna baru untuk mengakses sistem LPK Mirai.
        </p>

    </div>


    <!-- ==========================================
         MAIN CARD
    =========================================== -->

    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <!-- CARD HEADER -->
        <div class="flex items-center gap-3 border-b border-slate-100 bg-blue-50/50 px-5 py-3.5">

            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-blue-100 text-blue-600">
                <i class="bi bi-person-plus-fill text-xl"></i>
            </div>

            <div>
                <h3 class="text-sm font-bold text-slate-800">
                    Informasi Akun
                </h3>

                <p class="text-xs text-slate-500">
                    Lengkapi informasi pengguna baru.
                </p>
            </div>

        </div>


        <!-- CARD BODY -->
        <div class="p-5 sm:p-6">

            <!-- VALIDATION ERRORS -->
            @if ($errors->any())

                <div class="mb-5 rounded-lg border border-red-200 bg-red-50 p-3.5">

                    <div class="mb-2 flex items-center gap-2 text-xs font-bold text-red-700">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        Terdapat kesalahan pada pengisian form.
                    </div>

                    <ul class="ml-5 list-disc space-y-1 text-xs text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>

            @endif


            <!-- CREATE USER FORM -->
            <form
                action="{{ route('users.store') }}"
                method="POST"
                class="space-y-4"
            >

                @csrf


                <!-- NAME -->
                <div>

                    <label
                        for="name"
                        class="mb-1.5 block text-xs font-semibold text-slate-700"
                    >
                        Nama Lengkap
                        <span class="text-red-500">*</span>
                    </label>

                    <div class="relative">

                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                            <i class="bi bi-person text-base"></i>
                        </div>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            autofocus
                            autocomplete="name"
                            placeholder="Masukkan nama lengkap"
                            class="block w-full rounded-lg border border-slate-300 bg-white py-2.5 pl-10 pr-3.5 text-sm text-slate-800 shadow-sm outline-none transition-all duration-200 placeholder:text-slate-400 hover:border-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                        >

                    </div>

                    @error('name')
                        <p class="mt-1.5 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- EMAIL -->
                <div>

                    <label
                        for="email"
                        class="mb-1.5 block text-xs font-semibold text-slate-700"
                    >
                        Email
                        <span class="text-red-500">*</span>
                    </label>

                    <div class="relative">

                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                            <i class="bi bi-envelope text-base"></i>
                        </div>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="username"
                            placeholder="contoh@email.com"
                            class="block w-full rounded-lg border border-slate-300 bg-white py-2.5 pl-10 pr-3.5 text-sm text-slate-800 shadow-sm outline-none transition-all duration-200 placeholder:text-slate-400 hover:border-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
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

                    <label
                        for="password"
                        class="mb-1.5 block text-xs font-semibold text-slate-700"
                    >
                        Password
                        <span class="text-red-500">*</span>
                    </label>

                    <div class="relative">

                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                            <i class="bi bi-lock text-base"></i>
                        </div>

                        <input
                            x-bind:type="showPassword ? 'text' : 'password'"
                            id="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            placeholder="Minimal 6 karakter"
                            class="block w-full rounded-lg border border-slate-300 bg-white py-2.5 pl-10 pr-12 text-sm text-slate-800 shadow-sm outline-none transition-all duration-200 placeholder:text-slate-400 hover:border-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                        >

                        <!-- TOGGLE PASSWORD -->
                        <button
                            type="button"
                            x-on:click="showPassword = !showPassword"
                            class="mobile-pressable absolute inset-y-0 right-0 flex w-11 items-center justify-center rounded-r-lg text-slate-400 transition-colors hover:text-blue-600 active:bg-blue-50"
                            x-bind:aria-label="showPassword ? 'Sembunyikan password' : 'Tampilkan password'"
                        >
                            <i
                                class="bi text-base"
                                x-bind:class="showPassword ? 'bi-eye-slash-fill' : 'bi-eye-fill'"
                            ></i>
                        </button>

                    </div>

                    <p class="mt-1.5 text-[11px] text-slate-400">
                        <i class="bi bi-info-circle mr-1"></i>
                        Gunakan password minimal 6 karakter.
                    </p>

                    @error('password')
                        <p class="mt-1.5 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- ROLE -->
                <div>

                    <label
                        for="role"
                        class="mb-1.5 block text-xs font-semibold text-slate-700"
                    >
                        Role Pengguna
                    </label>

                    <div class="relative">

                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                            <i class="bi bi-shield-check text-base"></i>
                        </div>

                        <select
                            id="role"
                            name="role"
                            class="block w-full cursor-pointer rounded-lg border border-slate-300 bg-white py-2.5 pl-10 pr-3.5 text-sm text-slate-800 shadow-sm outline-none transition-all duration-200 hover:border-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                        >

                            <option
                                value="admin"
                                @selected(old('role', 'admin') == 'admin')
                            >
                                Admin
                            </option>

                            <option
                                value="member"
                                @selected(old('role') == 'member')
                            >
                                Member
                            </option>

                        </select>

                    </div>

                    @error('role')
                        <p class="mt-1.5 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                    <p class="mt-1.5 text-[11px] text-slate-400">
                        Pilih hak akses yang akan diberikan kepada pengguna.
                    </p>

                </div>


                <!-- FORM ACTIONS -->
                <div class="flex flex-col-reverse justify-between gap-2 border-t border-slate-100 pt-5 sm:flex-row sm:items-center">

                    <a
                        href="{{ route('dashboard') }}"
                        class="mobile-pressable inline-flex items-center justify-center gap-2 rounded-lg border border-slate-200 bg-white px-5 py-2.5 text-xs font-semibold text-slate-600 no-underline transition-all duration-200 hover:border-slate-300 hover:bg-slate-50 active:scale-[0.98]"
                    >
                        <i class="bi bi-arrow-left"></i>
                        Kembali
                    </a>

                    <button
                        type="submit"
                        class="mobile-pressable inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-xs font-semibold text-white shadow-sm transition-all duration-200 hover:bg-blue-700 hover:shadow-md active:scale-[0.98] focus:outline-none focus-visible:ring-4 focus-visible:ring-blue-100"
                    >
                        <i class="bi bi-person-check-fill"></i>
                        Simpan User
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
