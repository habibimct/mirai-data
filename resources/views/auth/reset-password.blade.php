@extends('layouts.guest')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        background:
            linear-gradient(rgba(13,110,253,.85),
            rgba(13,110,253,.85)),
            url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=2071&auto=format&fit=crop');
        background-size: cover;
        background-position: center;
        min-height: 100vh;
        font-family: 'Poppins', sans-serif;
    }

    .reset-card {
        width: 100%;
        max-width: 520px;
        background: rgba(255,255,255,.96);
        border-radius: 28px;
        padding: 40px;
        box-shadow: 0 20px 45px rgba(0,0,0,.2);
        backdrop-filter: blur(8px);
    }

    .logo-circle {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        background: #0d6efd;
        color: white;
        font-size: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: auto;
    }

    .form-control {
        height: 52px;
        border-radius: 14px;
    }

    .input-group .btn {
        border-radius: 0 14px 14px 0;
    }

    .btn-reset {
        height: 52px;
        border-radius: 14px;
        font-weight: 600;
        font-size: 16px;
    }
</style>

<div class="container">

    <div class="row justify-content-center align-items-center min-vh-100 py-4">

        <div class="col-lg-5 col-md-7">

            <div class="reset-card mx-auto">

                {{-- HEADER --}}
                <div class="text-center mb-4">

                    <div class="logo-circle">
                        🔑
                    </div>

                    <h2 class="fw-bold mt-4 mb-2">
                        Reset Password
                    </h2>

                    <p class="text-muted">
                        Silahkan buat password baru untuk akun Anda.
                    </p>

                </div>

                {{-- ERROR --}}
                @if ($errors->any())
                    <div class="alert alert-danger rounded-4">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.store') }}">
                    @csrf

                    {{-- TOKEN --}}
                    <input type="hidden"
                        name="token"
                        value="{{ $request->route('token') }}">

                    {{-- EMAIL --}}
                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Email
                        </label>

                        <input type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email', $request->email) }}"
                            placeholder="Masukkan email"
                            required autofocus>

                    </div>

                    {{-- PASSWORD --}}
                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Password Baru
                        </label>

                        <div class="input-group">

                            <input type="password"
                                name="password"
                                id="password"
                                class="form-control border-end-0"
                                placeholder="Masukkan password baru"
                                required autocomplete="new-password">

                            <button type="button"
                                class="btn btn-outline-secondary"
                                onclick="togglePassword('password', this)">
                                👁️
                            </button>

                        </div>

                    </div>

                    {{-- CONFIRM PASSWORD --}}
                    <div class="mb-4">

                        <label class="form-label fw-semibold">
                            Konfirmasi Password
                        </label>

                        <div class="input-group">

                            <input type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                class="form-control border-end-0"
                                placeholder="Ulangi password"
                                required autocomplete="new-password">

                            <button type="button"
                                class="btn btn-outline-secondary"
                                onclick="togglePassword('password_confirmation', this)">
                                👁️
                            </button>

                        </div>

                    </div>

                    {{-- BUTTON --}}
                    <button type="submit"
                        class="btn btn-primary btn-reset w-100 shadow-sm">
                        Reset Password
                    </button>

                    {{-- BACK LOGIN --}}
                    <div class="text-center mt-4">

                        <a href="{{ route('login') }}"
                            class="text-decoration-none fw-semibold">
                            ← Kembali ke Login
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<script>
    function togglePassword(id, btn) {

        let input = document.getElementById(id);

        if (input.type === 'password') {
            input.type = 'text';
            btn.innerHTML = '🙈';
        } else {
            input.type = 'password';
            btn.innerHTML = '👁️';
        }
    }
</script>

@endsection