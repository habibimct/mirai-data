<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'LPK Mirai Gresik') }}</title>

    <link rel="icon" type="image/png" href="{{ asset('LOGO_MIRAI.png') }}">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f7fb;
        }

        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background:
                linear-gradient(rgba(13, 110, 253, 0.85),
                    rgba(13, 110, 253, 0.85)),
                url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=1600');
            background-size: cover;
            background-position: center;
            color: white;
        }

        .hero-card {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(10px);
            border-radius: 25px;
            padding: 50px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .btn-custom {
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
        }

        .feature-card {
            border: none;
            border-radius: 20px;
            transition: .3s;
        }

        .feature-card:hover {
            transform: translateY(-8px);
        }

        .icon-box {
            width: 70px;
            height: 70px;
            border-radius: 20px;
            background: #0d6efd;
            color: white;
            font-size: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        footer {
            background: #0d1b2a;
            color: white;
        }
    </style>
</head>

<body>

    {{-- HERO --}}
    <section class="hero">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-8 text-center">

                    <div class="hero-card">

                        <h1 class="display-4 fw-bold mb-3">
                            Sistem Pendataan Peserta
                        </h1>

                        <p class="lead mb-4">
                            Kelola data peserta, user, statistik,
                            dan laporan pelatihan secara modern,
                            cepat, dan efisien.
                        </p>

                        <div class="d-flex justify-content-center gap-3 flex-wrap">

                            @auth
                                <a href="{{ route('dashboard') }}" class="btn btn-light btn-custom">
                                    Masuk Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-light btn-custom">
                                    Login
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-outline-light btn-custom">
                                        Register
                                    </a>
                                @endif
                            @endauth

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    {{-- FEATURES --}}
    <section class="py-5">

        <div class="container">

            <div class="text-center mb-5">
                <h2 class="fw-bold">
                    Fitur Utama
                </h2>

                <p class="text-muted">
                    Sistem modern untuk pengelolaan data pelatihan
                </p>
            </div>

            <div class="row g-4">

                <div class="col-md-4">

                    <div class="card feature-card shadow-sm h-100 p-4">

                        <div class="icon-box">
                            👥
                        </div>

                        <h5 class="fw-bold">
                            Data Peserta
                        </h5>

                        <p class="text-muted">
                            Kelola data peserta dengan mudah dan cepat.
                        </p>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="card feature-card shadow-sm h-100 p-4">

                        <div class="icon-box bg-success">
                            📊
                        </div>

                        <h5 class="fw-bold">
                            Statistik Dashboard
                        </h5>

                        <p class="text-muted">
                            Visualisasi data menggunakan chart modern.
                        </p>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="card feature-card shadow-sm h-100 p-4">

                        <div class="icon-box bg-warning">
                            🔐
                        </div>

                        <h5 class="fw-bold">
                            Multi User
                        </h5>

                        <p class="text-muted">
                            Sistem role admin dan member yang aman.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>

    {{-- FOOTER --}}
    <footer class="py-4">

        <div class="container text-center">

            <h5 class="fw-bold mb-2">
                LPK Mirai Management System
            </h5>

            <p class="mb-0 text-light">
                © {{ date('Y') }} All Rights Reserved
            </p>

        </div>

    </footer>

</body>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</html>
