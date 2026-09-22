<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background:
                linear-gradient(rgba(13, 110, 253, .85),
                    rgba(13, 110, 253, .85)),
                url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=1600');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
        }

        .login-card {
            max-width: 520px;
            margin: auto;
            border: none;
            border-radius: 25px;
            overflow: hidden;
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }

        .form-control {
            border-radius: 12px;
            padding: 12px;
        }

        .btn-login {
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
        }

        .logo-circle {
            width: 90px;
            height: 90px;
            background: #0d6efd;
            color: white;
            font-size: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
        }

        .input-group-text {
            border-radius: 0 12px 12px 0;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="row justify-content-center align-items-center min-vh-100">

            <div class="col-11 col-sm-10 col-md-8 col-lg-6 col-xl-5">

                <div class="card login-card shadow-lg mx-auto">

                    <div class="card-body p-5">

                        {{-- LOGO --}}
                        <div class="text-center mb-4">

                            <div class="logo-circle mb-3">
                                🔐
                            </div>

                            <h2 class="fw-bold">
                                Welcome Back
                            </h2>

                            <p class="text-muted">
                                Silahkan login ke sistem
                            </p>

                        </div>

                        {{-- SESSION STATUS --}}
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{-- ERROR --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            {{-- EMAIL --}}
                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Email
                                </label>

                                <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                    placeholder="Masukkan email" required autofocus>

                            </div>

                            {{-- PASSWORD --}}
                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Password
                                </label>

                                <div class="input-group">

                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Masukkan password" required>

                                    <span class="input-group-text" onclick="togglePassword()">
                                        👁️
                                    </span>

                                </div>

                            </div>

                            {{-- REMEMBER --}}
                            <div class="form-check mb-3">

                                <input class="form-check-input" type="checkbox" name="remember" id="remember">

                                <label class="form-check-label" for="remember">
                                    Remember Me
                                </label>

                            </div>

                            {{-- FORGOT PASSWORD --}}
                            <div class="mb-3 text-end">

                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-decoration-none">
                                        Lupa Password?
                                    </a>
                                @endif

                            </div>

                            {{-- BUTTON --}}
                            <button type="submit" class="btn btn-primary w-100 btn-login shadow-sm">
                                Login
                            </button>

                        </form>

                        {{-- REGISTER --}}
                        @if (Route::has('register'))
                            <div class="text-center mt-4">

                                <span class="text-muted">
                                    Belum punya akun?
                                </span>

                                <a href="{{ route('register') }}" class="text-decoration-none fw-semibold">
                                    Register
                                </a>

                            </div>
                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script>
        function togglePassword() {
            let password = document.getElementById('password');

            if (password.type === 'password') {
                password.type = 'text';
            } else {
                password.type = 'password';
            }
        }
    </script>

</body>

</html>
