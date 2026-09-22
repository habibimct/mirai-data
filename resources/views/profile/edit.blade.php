@extends('layouts.app')

@section('content')

<div class="container py-4">

    {{-- HEADER --}}
    <div class="mb-4">
        <h2 class="fw-bold mb-1">Profile</h2>
        <p class="text-muted mb-0">
            Kelola informasi akun dan keamanan akun Anda.
        </p>
    </div>

    <div class="row g-4">

        {{-- PROFILE INFORMATION --}}
        <div class="col-lg-6">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-header bg-primary text-white rounded-top-4 py-3">
                    <h5 class="mb-0">
                        👤 Informasi Profile
                    </h5>
                </div>

                <div class="card-body p-4">

                    <div class="text-center mb-4">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center"
                             style="width:90px;height:90px;font-size:35px;">
                            👤
                        </div>

                        <h5 class="mt-3 mb-1">
                            {{ auth()->user()->name }}
                        </h5>

                        <p class="text-muted">
                            {{ auth()->user()->email }}
                        </p>
                    </div>

                    @include('profile.partials.update-profile-information-form')

                </div>
            </div>

        </div>

        {{-- UPDATE PASSWORD --}}
        <div class="col-lg-6">

            <div class="card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-header bg-success text-white rounded-top-4 py-3">
                    <h5 class="mb-0">
                        🔒 Update Password
                    </h5>
                </div>

                <div class="card-body p-4">

                    @include('profile.partials.update-password-form')

                </div>
            </div>

            {{-- DELETE ACCOUNT --}}
            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-header bg-danger text-white rounded-top-4 py-3">
                    <h5 class="mb-0">
                        🗑️ Hapus Akun
                    </h5>
                </div>

                <div class="card-body p-4">

                    <div class="alert alert-warning">
                        Hati-hati, akun yang dihapus tidak dapat dikembalikan.
                    </div>

                    @include('profile.partials.delete-user-form')

                </div>
            </div>

        </div>

    </div>

</div>

@endsection