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

    .forgot-card {
        width: 100%;
        max-width: 500px;
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

    .btn-send {
        height: 52px;
        border-radius: 14px;
        font-weight: 600;
        font-size: 16px;
    }
</style>

<div class="container">

    <div class="row justify-content-center align-items-center min-vh-100 py-4">

        <div class="col-lg-5 col-md-7">

            <div class="forgot-card mx-auto">

                {{-- HEADER --}}
                <div class="text-center mb-4">

                    <div class="logo-circle">
                        🔑
                    </div>

                    <h2 class="fw-bold mt-4 mb-2">
                        Forgot Password
                    </h2>

                    <p class="text-muted">
                        Masukkan email Anda untuk menerima link reset password.
                    </p>

                </div>

                {{-- STATUS --}}
                @if (session('status'))
                    <div class="alert alert-success rounded-4">
                        {{ session('status') }}
                    </div>
                @endif

                {{-- ERROR --}}
                @if ($errors->any())
                    <div class="alert alert-danger rounded-4">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    {{-- EMAIL --}}
                    <div class="mb-4">

                        <label class="form-label fw-semibold">
                            Email
                        </label>

                        <input type="email"
                            name="email"
                            class="form-control"
                            placeholder="Masukkan email"
                            value="{{ old('email') }}"
                            required autofocus>

                    </div>

                    {{-- BUTTON --}}
                    <button type="submit"
                        class="btn btn-primary btn-send w-100 shadow-sm">
                        Kirim Link Reset Password
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

@endsection