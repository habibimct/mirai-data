@extends('layouts.app')

@section('content')
    <div class="container py-4">

        {{-- Judul Halaman --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Daftar Peserta LPK Mirai Gresik</h2>

            @auth
                @if (auth()->user()->role == 'admin')
                    <a href="{{ route('participants.create') }}" class="btn btn-outline-success">
                        <i class="bi bi-person-plus-fill"></i> Tambah Peserta
                    </a>
                @endif
            @endauth
        </div>

        {{-- Bila tidak ada peserta --}}
        @if ($participants->isEmpty())
            <div class="alert alert-info text-center">
                Belum ada peserta terdaftar.
            </div>
        @endif

        <form method="GET" class="row g-2 mb-2">

            <div>
                <input type="text" name="search" class="form-control" placeholder="Cari nama..."
                    value="{{ request('search') }}">
            </div>

            <div class="col-md-4">
                <select name="qualification" class="form-control">
                    <option value="">-- Semua Kualifikasi --</option>

                    @foreach ($filters as $filter)
                        <option value="{{ $filter }}" {{ request('qualification') == $filter ? 'selected' : '' }}>
                            {{ $filter }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <input type="number" name="age_min" class="form-control" placeholder="Umur min"
                    value="{{ request('age_min') }}">
            </div>

            <div class="col-md-2">
                <input type="number" name="age_max" class="form-control" placeholder="Umur max"
                    value="{{ request('age_max') }}">
            </div>

            <div class="col-md-2 d-grid">
                <button class="btn btn-outline-primary">Filter</button>
            </div>

            <div class="col-md-2 d-grid">
                <a href="{{ route('participants.index') }}" class="btn btn-outline-secondary">
                    Reset
                </a>
            </div>

        </form>

        @php
            if (!function_exists('sortArrow')) {
                function sortArrow($field)
                {
                    return request('sort') == $field ? (request('direction') == 'asc' ? '↑' : '↓') : '';
                }
            }
        @endphp

        <form method="GET" class="d-flex align-items-center gap-1 mb-1">

            <label class="mb-0">Tampilkan</label>

            <select name="per_page" class="form-select" style="width:120px" onchange="this.form.submit()">

                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>
                    10
                </option>

                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>
                    25
                </option>

                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>
                    50
                </option>

                <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>
                    100
                </option>

                <option value="all" {{ request('per_page') == 'all' ? 'selected' : '' }}>
                    Semua
                </option>

            </select>

        </form>

        {{-- Tabel Peserta --}}
        <div class="table-responsive shadow-sm rounded">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th class="text-center">Foto</th>
                        <th style="max-width:300px;">
                            <a
                                href="{{ request()->fullUrlWithQuery([
                                    'sort' => 'name',
                                    'direction' => request('direction') == 'asc' ? 'desc' : 'asc',
                                ]) }}">
                                Nama{!! sortArrow('name') !!}
                            </a>
                        </th>
                        <th>
                            <a
                                href="{{ request()->fullUrlWithQuery([
                                    'sort' => 'age',
                                    'direction' => request('direction') == 'asc' ? 'desc' : 'asc',
                                ]) }}">
                                Usia{!! sortArrow('age') !!}
                            </a>
                        </th>
                        <th>
                            <a
                                href="{{ request()->fullUrlWithQuery([
                                    'sort' => 'qualification',
                                    'direction' => request('direction') == 'asc' ? 'desc' : 'asc',
                                ]) }}">
                                Kualifikasi{!! sortArrow('qualification') !!}
                            </a>
                        </th>
                        <th>
                            <a
                                href="{{ request()->fullUrlWithQuery([
                                    'sort' => 'status',
                                    'direction' => request('direction') == 'asc' ? 'desc' : 'asc',
                                ]) }}">
                                Status{!! sortArrow('status') !!}
                            </a>
                        </th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($participants as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            {{-- Foto --}}
                            <td class="text-center">
                                <img src="{{ $p->photo ? asset($p->photo) : asset('images/default-user.png') }}"
                                    class="rounded-circle shadow-sm" width="60" height="60"
                                    alt="Foto {{ $p->name }}">
                            </td>

                            {{-- Nama --}}
                            <td class="fw-semibold text-capitalize" style="max-width:300px;">{{ $p->name }}</td>

                            {{-- Usia --}}
                            <td>{{ $p->age }} tahun</td>

                            {{-- Kualifikasi --}}
                            <td>{{ $p->qualification }}</td>

                            {{-- Status --}}
                            <td>
                                @if ($p->status == 'Sending')
                                    <span class="badge bg-success">
                                        Sending
                                    </span>
                                @elseif($p->status == 'Existing')
                                    <span class="badge bg-primary">
                                        Existing
                                    </span>
                                @else
                                    -
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td class="text-center">
                                <a href="{{ route('participants.show', $p->id) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-eye-fill">Detail</i>
                                </a>

                                @auth
                                    @if (auth()->user()->role == 'admin')
                                        <a href="{{ route('participants.edit', $p->id) }}"
                                            class="btn btn-outline-warning btn-sm">
                                            <i class="bi bi-pencil-square">Edit</i>
                                        </a>

                                        <form action="{{ route('participants.destroy', $p->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Yakin ingin menghapus peserta ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger btn-sm">
                                                <i class="bi bi-trash-fill">Hapus</i>
                                            </button>
                                        </form>
                                    @endif
                                @endauth
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if ($participants instanceof \Illuminate\Pagination\LengthAwarePaginator)
            {{ $participants->withQueryString()->links() }}
        @endif
        
    </div>
@endsection
