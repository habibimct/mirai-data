@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow border-0">
                @error('name')
                <div class="text-danger small">{{ $message }}</div>
                @enderror
                
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                {{-- Header --}}
                <div class="card-header bg-warning text-dark text-center">
                    <h5 class="mb-0">Edit User</h5>
                </div>

                {{-- Body --}}
                <div class="card-body">

                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Nama --}}
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text"
                                name="name"
                                class="form-control"
                                value="{{ $user->name }}"
                                required>
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email"
                                name="email"
                                class="form-control"
                                value="{{ $user->email }}"
                                required>
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label class="form-label">
                                Password <small class="text-muted">(kosongkan jika tidak diubah)</small>
                            </label>

                            <div class="input-group">
                                <input type="password"
                                    name="password"
                                    id="password"
                                    class="form-control"
                                    placeholder="Isi jika ingin mengganti password">

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
                                <option value="admin" {{ $user->role=='admin'?'selected':'' }}>
                                    Admin
                                </option>
                                <option value="member" {{ $user->role=='member'?'selected':'' }}>
                                    Member
                                </option>
                            </select>
                        </div>

                        {{-- Action --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('dashboard') }}"
                                class="btn btn-outline-secondary">
                                Kembali
                            </a>

                            <button class="btn btn-warning">
                                Update User
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