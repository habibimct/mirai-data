@extends('layouts.guest')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background:
                linear-gradient(rgba(13, 110, 253, 0.85),
                    rgba(13, 110, 253, 0.85)),
                url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=2071&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
        }

        .register-card {
            width: 100%;
            max-width: 500px;
            background: rgba(255, 255, 255, 0.96);
            border-radius: 30px;
            padding: 40px;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.2);
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
            box-shadow: 0 10px 20px rgba(13, 110, 253, 0.3);
        }

        .form-control {
            height: 52px;
            border-radius: 14px;
            padding-left: 15px;
        }

        .input-group .btn {
            border-radius: 0 14px 14px 0;
        }

        .btn-register {
            height: 52px;
            border-radius: 14px;
            font-size: 17px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-register:hover {
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .register-card {
                padding: 30px 25px;
            }
        }
    </style>

    <div class="container">

        <div class="row justify-content-center align-items-center min-vh-100 py-4">

            <div class="col-lg-5 col-md-7">

                <div class="register-card mx-auto">

                    {{-- ICON --}}
                    <div class="text-center mb-4">

                        <div class="logo-circle">
                            📝
                        </div>

                        <h1 class="fw-bold mt-4 mb-1">
                            Create Account
                        </h1>

                        <p class="text-muted mb-0">
                            Silahkan daftar untuk membuat akun
                        </p>

                    </div>

                    {{-- ERROR --}}
                    @if ($errors->any())
                        <div class="alert alert-danger rounded-4">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- NAME --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Nama
                            </label>

                            <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                placeholder="Masukkan nama" required autofocus>
                        </div>

                        {{-- EMAIL --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Email
                            </label>

                            <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                                placeholder="Masukkan email" required>
                        </div>

                        {{-- PASSWORD --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Password
                            </label>

                            <div class="input-group">

                                <input type="password" name="password" id="password" class="form-control border-end-0"
                                    placeholder="Masukkan password" required>

                                <button type="button" class="btn btn-outline-secondary"
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

                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control border-end-0" placeholder="Ulangi password" required>

                                <button type="button" class="btn btn-outline-secondary"
                                    onclick="togglePassword('password_confirmation', this)">
                                    👁️
                                </button>

                            </div>
                        </div>

                        {{-- KODE --}}
                        <div class="mb-3">
                            <label class="form-label">
                                Kode Undangan
                            </label>

                            <input type="text" name="invite_code" class="form-control" placeholder="Kode silahkan minta ke admin" required>

                            @error('invite_code')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- BUTTON --}}
                        <button type="submit" class="btn btn-primary btn-register w-100 shadow-sm">
                            Register
                        </button>

                        {{-- LOGIN --}}
                        <div class="text-center mt-4">

                            <span class="text-muted">
                                Sudah punya akun?
                            </span>

                            <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">
                                Login
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
