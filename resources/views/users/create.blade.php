@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow border-0">
                
                <div class="card-header bg-primary text-white text-center">
                    <h5 class="mb-0">Tambah User</h5>
                </div>

                <div class="card-body">

                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf

                        {{-- Nama --}}
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name"
                                   class="form-control"
                                   placeholder="Masukkan nama lengkap"
                                   required>
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email"
                                   class="form-control"
                                   placeholder="contoh@email.com"
                                   required>
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label class="form-label">Password</label>

                            <div class="input-group">
                                <input type="password"
                                       name="password"
                                       id="password"
                                       class="form-control"
                                       placeholder="Minimal 6 karakter"
                                       required>

                                <button type="button"
                                        class="btn btn-outline-secondary"
                                        onclick="togglePassword()">
                                    👁️
                                </button>
                            </div>
                        </div>

                        {{-- Role --}}
                        <div class="mb-4">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-select">
                                <option value="admin">Admin</option>
                                <option value="member">Member</option>
                            </select>
                        </div>

                        {{-- Action --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('dashboard') }}" 
                               class="btn btn-outline-secondary">
                                Kembali
                            </a>

                            <button class="btn btn-success">
                                Simpan User
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

<script>
function togglePassword() {
    let input = document.getElementById('password');
    input.type = input.type === 'password' ? 'text' : 'password';
}
</script>
@endsection