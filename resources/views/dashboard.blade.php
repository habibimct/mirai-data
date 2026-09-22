@extends('layouts.app')

@section('content')
    <div class="container py-4">

        <h3 class="mb-4">Dashboard</h3>

        {{-- ================= ADMIN ================= --}}
        @if (auth()->user()->role == 'admin')
            <div class="row g-4 mb-4">

                {{-- TOTAL PESERTA --}}
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">

                            <div>
                                <p class="text-muted mb-1">Total Peserta</p>
                                <h3 class="fw-bold mb-0">{{ $totalParticipants ?? 0 }}</h3>
                            </div>

                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-3">
                                👥
                            </div>

                        </div>
                    </div>
                </div>

                {{-- TOTAL USER --}}
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex flex-column justify-content-between h-100">

                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <p class="text-muted mb-1">Total User</p>
                                    <h3 class="fw-bold mb-0">{{ $totalUsers ?? 0 }}</h3>
                                </div>

                                <div class="bg-success bg-opacity-10 text-success rounded-circle p-3">
                                    👤
                                </div>
                            </div>

                            <a href="{{ route('users.create') }}" class="btn btn-outline-success btn-sm w-100 mt-2">
                                ➕ Tambah User
                            </a>

                        </div>
                    </div>
                </div>

                {{-- QUICK ACTION --}}
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex flex-column justify-content-between h-100">

                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <p class="text-muted mb-1">Quick Action</p>
                                    <h6 class="mb-0">Tambah Data Baru</h6>
                                </div>

                                <div class="bg-warning bg-opacity-10 text-warning rounded-circle p-3">
                                    ⚡
                                </div>
                            </div>

                            <a href="{{ route('participants.create') }}" class="btn btn-outline-warning btn-sm w-100 mt-2">
                                ➕ Tambah Peserta
                            </a>

                        </div>
                    </div>
                </div>

            </div>

            @if (auth()->user()->role == 'admin')
                <div class="card border-0 shadow-sm rounded-4 mt-4">

                    <div class="card-header bg-primary text-white text-center">
                        <h5 class="mb-0">
                            🔐 Pengaturan Kode Undangan
                        </h5>
                    </div>

                    <div class="card-body">

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('update.invite.code') }}">

                            @csrf

                            <div class="mb-3">

                                <label class="form-label">
                                    Kode Undangan Saat Ini
                                </label>

                                <input type="text" name="invite_code" class="form-control" value="{{ $inviteCode }}">

                            </div>

                            <button class="btn btn-primary">
                                Simpan Perubahan
                            </button>

                        </form>

                    </div>

                </div>
            @endif

            <div class="row mt-3">
                {{-- BAR CHART --}}
                <div class="col-md-8 mb-2">
                    <div class="card shadow-sm h-100 text-center">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                Statistik Status Peserta
                            </h5>
                        </div>

                        <div class="card-body">
                            <canvas id="statusChart"></canvas>
                        </div>
                    </div>
                </div>

                {{-- PIE CHART --}}
                <div class="col-md-4 mb-2">
                    <div class="card shadow-sm h-100 text-center">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                Distribusi Usia
                            </h5>
                        </div>

                        <div class="card-body d-flex justify-content-center align-items-center">
                            <canvas id="pieChart"></canvas>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card shadow mt-4 mb-2">
                <div class="card-header bg-primary text-white text-center">
                    <span>Data User</span>
                </div>

                <div class="card-body p-2">
                    <table class="table mb-0">
                        <thead class="table-light text-center">
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th width="150">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users ?? [] as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge bg-{{ $user->role == 'admin' ? 'success' : 'secondary' }}">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('users.edit', $user->id) }}"
                                            class="btn btn-sm btn-outline-warning">
                                            Edit
                                        </a>

                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                            style="display:inline-block" onsubmit="return confirm('Yakin hapus user ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-sm btn-outline-danger">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">
                                        Belum ada user
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card shadow mb-2">
                <div class="card-header bg-primary text-white text-center">
                    Peserta Terbaru
                </div>
                <div class="card-body p-2">
                    <table class="table mb-0">
                        <thead class="table-light text-center">
                            <tr>
                                <th>Nama</th>
                                <th>Kualifikasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestParticipants ?? [] as $p)
                                <tr>
                                    <td>{{ $p->name }}</td>
                                    <td>{{ $p->qualification }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center text-muted">
                                        Belum ada data
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        {{-- ================= MEMBER ================= --}}
        @if (auth()->user()->role == 'member')
            <div class="row">

                {{-- KUALIFIKASI --}}
                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            Statistik Kualifikasi
                        </div>
                        <div class="card-body">
                            @forelse($byQualification ?? [] as $q => $total)
                                <div class="d-flex justify-content-between border-bottom py-1">
                                    <span>{{ $q }}</span>
                                    <span>{{ $total }}</span>
                                </div>
                            @empty
                                <p class="text-muted">Belum ada data</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- UMUR --}}
                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            Statistik Umur
                        </div>
                        <div class="card-body">
                            @forelse($ageGroups ?? [] as $range => $total)
                                <div class="d-flex justify-content-between border-bottom py-1">
                                    <span>{{ $range }}</span>
                                    <span>{{ $total }}</span>
                                </div>
                            @empty
                                <p class="text-muted">Belum ada data</p>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        @endif

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const ageLabels = <?= json_encode($ageLabels ?? []) ?>;
            const ageTotals = <?= json_encode($ageTotals ?? []) ?>;
            const statusCtx = document.getElementById('statusChart');

            // ================= LINE CHART =================
            new Chart(statusCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($statusLabels) !!},
                    datasets: [{
                        label: 'Jumlah Peserta',
                        data: {!! json_encode($statusTotals) !!},

                        // WARNA BAR
                        backgroundColor: [
                            '#198754', // Sending = success
                            '#0d6efd' // Existing = primary
                        ],

                        borderColor: [
                            '#198754',
                            '#0d6efd'
                        ],

                        borderWidth: 1,
                        borderRadius: 8
                    }]
                },

                options: {
                    responsive: true,

                    plugins: {
                        legend: {
                            display: false
                        }
                    },

                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });

            // ================= PIE CHART =================
            new Chart(document.getElementById('pieChart'), {
                type: 'pie',
                data: {
                    labels: ageLabels,
                    datasets: [{
                        data: ageTotals,
                        backgroundColor: [
                            '#0d6efd',
                            '#198754',
                            '#ffc107',
                            '#dc3545'
                        ]
                    }]
                }
            });

        });
    </script>

@endsection
