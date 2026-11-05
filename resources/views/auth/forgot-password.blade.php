
@extends('layouts.guest')

@section('title', 'Forgot Password | LPK Mirai Gresik')

@section('content')
    <div class="relative isolate flex min-h-screen items-center justify-center overflow-hidden bg-slate-950 px-4 py-10 sm:px-6">

        {{-- BACKGROUND IMAGE --}}
        <div class="pointer-events-none absolute inset-0 -z-10 overflow-hidden">

            <div
                class="absolute inset-0 bg-cover bg-center"
                style="background-image: url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=2071&auto=format&fit=crop');">
            </div>

            {{-- BLUE OVERLAY --}}
            <div class="absolute inset-0 bg-gradient-to-br from-blue-950/90 via-blue-900/85 to-indigo-950/90"></div>

            {{-- DECORATIVE BLUR --}}
            <div class="absolute inset-0 bg-blue-300/10"></div>

            <div class="absolute -left-32 -top-32 h-96 w-96 rounded-full bg-blue-300/30 blur-3xl"></div>

            <div class="absolute -bottom-40 -right-32 h-96 w-96 rounded-full bg-indigo-300/30 blur-3xl"></div>

        </div>

        {{-- FORGOT PASSWORD CARD --}}
        <div class="relative z-10 w-full max-w-[500px]">

            <div class="overflow-hidden rounded-[2rem] border border-white/30 bg-white/95 shadow-2xl shadow-black/25 backdrop-blur-xl">

                <div class="px-6 py-10 sm:px-10 sm:py-12">

                    {{-- HEADER --}}
                    <div class="mb-8 text-center">

                        <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-3xl bg-gradient-to-br from-blue-600 to-indigo-700 text-white shadow-lg shadow-blue-600/30">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-10 w-10"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 5.25a3.75 3.75 0 00-7.5 0v3h7.5v-3z" />
                                <rect x="5" y="8.25" width="14" height="12" rx="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 12.5v3" />
                            </svg>

                        </div>

                        <h1 class="mt-6 text-3xl font-bold tracking-tight text-slate-900">
                            Forgot Password?
                        </h1>

                        <p class="mx-auto mt-3 max-w-sm text-sm leading-6 text-slate-500">
                            Jangan khawatir. Masukkan alamat email Anda dan kami akan mengirimkan link untuk mengatur ulang password.
                        </p>

                    </div>

                    {{-- SUCCESS STATUS --}}
                    @if (session('status'))
                        <div class="mb-6 flex items-start gap-3 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-700">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="mt-0.5 h-5 w-5 shrink-0"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M5 13l4 4L19 7" />
                            </svg>

                            <div>
                                <p class="font-semibold">Permintaan berhasil diproses</p>
                                <p class="mt-1">{{ session('status') }}</p>
                            </div>

                        </div>
                    @endif

                    {{-- ERROR --}}
                    @if ($errors->any())
                        <div class="mb-6 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="mt-0.5 h-5 w-5 shrink-0"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3m0 4h.01M10.3 3.86l-8.1 14.02A1.5 1.5 0 003.5 20h17a1.5 1.5 0 001.3-2.12l-8.1-14.02a1.5 1.5 0 00-2.6 0z" />
                            </svg>

                            <div>
                                <p class="font-semibold">Terjadi kesalahan</p>
                                <p class="mt-1">{{ $errors->first() }}</p>
                            </div>

                        </div>
                    @endif

                    {{-- RESET FORM --}}
                    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                        @csrf

                        {{-- EMAIL --}}
                        <div>
                            <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">
                                Alamat Email
                            </label>

                            <div class="relative">

                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.7">
                                        <rect x="3" y="5" width="18" height="14" rx="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 7l9 6 9-6" />
                                    </svg>
                                </div>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="nama@email.com"
                                    autocomplete="email"
                                    required
                                    autofocus
                                    class="h-[52px] w-full rounded-xl border border-slate-300 bg-white pl-12 pr-4 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 hover:border-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 @error('email') border-red-400 focus:border-red-500 focus:ring-red-500/10 @enderror"
                                >

                            </div>

                            @error('email')
                                <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- SUBMIT BUTTON --}}
                        <button
                            type="submit"
                            class="flex h-[52px] w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-700 px-5 text-sm font-semibold text-white shadow-lg shadow-blue-600/20 transition duration-200 hover:-translate-y-0.5 hover:from-blue-700 hover:to-indigo-800 hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-blue-500/25 active:translate-y-0">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 8l9 6 9-6M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>

                            Kirim Link Reset Password

                        </button>

                    </form>

                    {{-- BACK TO LOGIN --}}
                    <div class="mt-8 border-t border-slate-200 pt-6 text-center">

                        <a
                            href="{{ route('login') }}"
                            class="inline-flex items-center gap-2 text-sm font-semibold text-blue-600 transition hover:text-blue-800 hover:underline">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 12H5m7 7l-7-7 7-7" />
                            </svg>

                            Kembali ke Login

                        </a>

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
