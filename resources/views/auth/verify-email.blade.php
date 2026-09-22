@extends('layouts.guest')

@section('content')

<div class="container">

    <div class="row justify-content-center align-items-center min-vh-100">

        <div class="col-md-7 col-lg-5">

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                {{-- HEADER --}}
                <div class="bg-primary bg-gradient text-white text-center py-4">

                    <div class="bg-white text-primary rounded-circle d-inline-flex align-items-center justify-content-center shadow"
                         style="width:80px;height:80px;font-size:32px;">
                        📧
                    </div>

                    <h3 class="fw-bold mt-3 mb-1">
                        Verifikasi Email
                    </h3>

                    <p class="mb-0 opacity-75">
                        Aktivasi akun Anda terlebih dahulu
                    </p>

                </div>

                {{-- BODY --}}
                <div class="card-body p-4 p-lg-5">

                    {{-- STATUS --}}
                    @if (session('status') == 'verification-link-sent')
                        <div class="alert alert-success rounded-3">
                            ✅ Link verifikasi baru berhasil dikirim ke email Anda.
                        </div>
                    @endif

                    {{-- INFO --}}
                    <div class="alert alert-light border rounded-3">

                        Terima kasih telah mendaftar 😊

                        <hr>

                        Sebelum mulai menggunakan aplikasi, silakan cek email Anda lalu klik link verifikasi yang telah kami kirim.

                        <br><br>

                        Jika belum menerima email, klik tombol kirim ulang di bawah ini.

                    </div>

                    <div class="d-grid gap-3 mt-4">

                        {{-- RESEND --}}
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf

                            <button type="submit"
                                    class="btn btn-primary btn-lg rounded-3 fw-semibold w-100">
                                🔄 Kirim Ulang Email Verifikasi
                            </button>
                        </form>

                        {{-- LOGOUT --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit"
                                    class="btn btn-outline-secondary rounded-3 w-100">
                                Logout
                            </button>
                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection