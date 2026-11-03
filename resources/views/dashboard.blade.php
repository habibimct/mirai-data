
@extends('layouts.app')

@section('title', 'Dashboard | LPK Mirai Gresik')

@section('content')

<div class="mx-auto w-full max-w-7xl px-4 py-6 sm:px-6 lg:px-8">

    <!-- ==========================================
         PAGE HEADER
    =========================================== -->
    <div class="mb-7 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

        <div>
            <h2 class="text-2xl font-bold tracking-tight text-slate-900">
                Dashboard
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Ringkasan informasi dan aktivitas LPK Mirai Gresik.
            </p>
        </div>

        @if (auth()->user()->role == 'admin')
            <a
                href="{{ route('participants.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition-all duration-200 hover:bg-blue-700 hover:shadow-md active:scale-[0.98]"
            >
                <i class="bi bi-person-plus-fill"></i>
                Tambah Peserta
            </a>
        @endif

    </div>


    {{-- ==========================================
         ADMIN DASHBOARD
    =========================================== --}}

    @if (auth()->user()->role == 'admin')

        <!-- ==========================================
             STATISTIC CARDS
        =========================================== -->

        <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">

            <!-- TOTAL PESERTA -->
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition-all duration-200 hover:-translate-y-1 hover:shadow-md">

                <div class="flex items-start justify-between">

                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Total Peserta
                        </p>

                        <h3 class="mt-2 text-3xl font-bold tracking-tight text-slate-900">
                            {{ $totalParticipants ?? 0 }}
                        </h3>

                        <p class="mt-1 text-xs text-slate-400">
                            Jumlah seluruh peserta terdaftar
                        </p>
                    </div>

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                        <i class="bi bi-people-fill text-2xl"></i>
                    </div>

                </div>

            </div>


            <!-- TOTAL USER -->
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition-all duration-200 hover:-translate-y-1 hover:shadow-md">

                <div class="flex flex-col justify-between gap-4">

                    <div class="flex items-start justify-between">

                        <div>
                            <p class="text-sm font-medium text-slate-500">
                                Total User
                            </p>

                            <h3 class="mt-2 text-3xl font-bold tracking-tight text-slate-900">
                                {{ $totalUsers ?? 0 }}
                            </h3>

                            <p class="mt-1 text-xs text-slate-400">
                                Pengguna sistem terdaftar
                            </p>
                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                            <i class="bi bi-person-fill text-2xl"></i>
                        </div>

                    </div>

                    <a
                        href="{{ route('users.create') }}"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-2.5 text-sm font-semibold text-emerald-700 transition-all duration-200 hover:border-emerald-300 hover:bg-emerald-100 active:scale-[0.98]"
                    >
                        <i class="bi bi-plus-circle"></i>
                        Tambah User
                    </a>

                </div>

            </div>


            <!-- QUICK ACTION -->
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition-all duration-200 hover:-translate-y-1 hover:shadow-md sm:col-span-2 xl:col-span-1">

                <div class="flex flex-col justify-between gap-4">

                    <div class="flex items-start justify-between">

                        <div>
                            <p class="text-sm font-medium text-slate-500">
                                Quick Action
                            </p>

                            <h3 class="mt-2 text-lg font-bold text-slate-900">
                                Tambah Data Baru
                            </h3>

                            <p class="mt-1 text-xs text-slate-400">
                                Daftarkan peserta baru ke sistem.
                            </p>
                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                            <i class="bi bi-lightning-charge-fill text-2xl"></i>
                        </div>

                    </div>

                    <a
                        href="{{ route('participants.create') }}"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-amber-200 bg-amber-50 px-4 py-2.5 text-sm font-semibold text-amber-700 transition-all duration-200 hover:border-amber-300 hover:bg-amber-100 active:scale-[0.98]"
                    >
                        <i class="bi bi-person-plus-fill"></i>
                        Tambah Peserta
                    </a>

                </div>

            </div>

        </div>


        <!-- ==========================================
             INVITATION CODE SETTINGS
        =========================================== -->

        <div class="mb-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="flex items-center gap-3 border-b border-slate-100 px-5 py-4 sm:px-6">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                    <i class="bi bi-shield-lock-fill text-xl"></i>
                </div>

                <div>
                    <h3 class="text-base font-bold text-slate-900">
                        Pengaturan Kode Undangan
                    </h3>

                    <p class="text-xs text-slate-500">
                        Kelola kode undangan untuk registrasi pengguna.
                    </p>
                </div>

            </div>

            <div class="p-5 sm:p-6">

                @if (session('success'))
                    <div class="mb-5 flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700">

                        <i class="bi bi-check-circle-fill mt-0.5 text-lg"></i>

                        <span>
                            {{ session('success') }}
                        </span>

                    </div>
                @endif

                <form method="POST" action="{{ route('update.invite.code') }}">

                    @csrf

                    <div class="flex flex-col gap-4 sm:flex-row sm:items-end">

                        <div class="flex-1">

                            <label
                                for="invite_code"
                                class="mb-2 block text-sm font-semibold text-slate-700"
                            >
                                Kode Undangan Saat Ini
                            </label>

                            <input
                                type="text"
                                id="invite_code"
                                name="invite_code"
                                value="{{ $inviteCode ?? '' }}"
                                class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 shadow-sm outline-none transition-all duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                            >

                        </div>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition-all duration-200 hover:bg-blue-700 hover:shadow-md active:scale-[0.98]"
                        >
                            <i class="bi bi-check2-circle"></i>
                            Simpan Perubahan
                        </button>

                    </div>

                </form>

            </div>

        </div>


        <!-- ==========================================
             CHART STATISTICS
        =========================================== -->

        <div class="mb-6 grid grid-cols-1 gap-5 xl:grid-cols-5">

            <!-- STATUS CHART -->
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm xl:col-span-3">

                <div class="flex items-center gap-3 border-b border-slate-100 px-5 py-4 sm:px-6">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                        <i class="bi bi-bar-chart-fill text-xl"></i>
                    </div>

                    <div>
                        <h3 class="text-base font-bold text-slate-900">
                            Statistik Status Peserta
                        </h3>

                        <p class="text-xs text-slate-500">
                            Distribusi jumlah peserta berdasarkan status.
                        </p>
                    </div>

                </div>

                <div class="p-5 sm:p-6">

                    <div class="relative h-72 w-full">
                        <canvas id="statusChart"></canvas>
                    </div>

                </div>

            </div>


            <!-- AGE CHART -->
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm xl:col-span-2">

                <div class="flex items-center gap-3 border-b border-slate-100 px-5 py-4 sm:px-6">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-violet-50 text-violet-600">
                        <i class="bi bi-pie-chart-fill text-xl"></i>
                    </div>

                    <div>
                        <h3 class="text-base font-bold text-slate-900">
                            Distribusi Usia
                        </h3>

                        <p class="text-xs text-slate-500">
                            Pengelompokan peserta berdasarkan usia.
                        </p>
                    </div>

                </div>

                <div class="flex items-center justify-center p-5 sm:p-6">

                    <div class="relative h-72 w-full max-w-sm">
                        <canvas id="pieChart"></canvas>
                    </div>

                </div>

            </div>

        </div>


        <!-- ==========================================
             USER TABLE
        =========================================== -->

        <div class="mb-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4 sm:px-6">

                <div>
                    <h3 class="text-base font-bold text-slate-900">
                        Data User
                    </h3>

                    <p class="mt-1 text-xs text-slate-500">
                        Daftar pengguna yang memiliki akses ke sistem.
                    </p>
                </div>

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-600">
                    <i class="bi bi-people text-xl"></i>
                </div>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full min-w-[650px] text-left">

                    <thead class="bg-slate-50">

                        <tr class="border-b border-slate-200">

                            <th class="px-5 py-3.5 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Nama
                            </th>

                            <th class="px-5 py-3.5 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Email
                            </th>

                            <th class="px-5 py-3.5 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Role
                            </th>

                            <th class="px-5 py-3.5 text-center text-xs font-bold uppercase tracking-wider text-slate-500">
                                Action
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @forelse($users ?? [] as $user)

                            <tr class="transition-colors duration-150 hover:bg-slate-50">

                                <td class="whitespace-nowrap px-5 py-4 text-sm font-semibold text-slate-800">
                                    {{ $user->name }}
                                </td>

                                <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-600">
                                    {{ $user->email }}
                                </td>

                                <td class="whitespace-nowrap px-5 py-4">

                                    <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold
                                        {{ $user->role == 'admin'
                                            ? 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200'
                                            : 'bg-slate-100 text-slate-600 ring-1 ring-slate-200' }}"
                                    >
                                        {{ $user->role }}
                                    </span>

                                </td>

                                <td class="whitespace-nowrap px-5 py-4">

                                    <div class="flex items-center justify-center gap-2">

                                        <a
                                            href="{{ route('users.edit', $user->id) }}"
                                            class="inline-flex items-center gap-1.5 rounded-lg border border-amber-200 bg-amber-50 px-3 py-2 text-xs font-semibold text-amber-700 transition-all duration-200 hover:border-amber-300 hover:bg-amber-100 active:scale-95"
                                        >
                                            <i class="bi bi-pencil-square"></i>
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('users.destroy', $user->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin hapus user ini?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="inline-flex items-center gap-1.5 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-xs font-semibold text-red-600 transition-all duration-200 hover:border-red-300 hover:bg-red-100 active:scale-95"
                                            >
                                                <i class="bi bi-trash3"></i>
                                                Hapus
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="4" class="px-5 py-10 text-center">

                                    <div class="flex flex-col items-center gap-2 text-slate-400">

                                        <i class="bi bi-inbox text-3xl"></i>

                                        <span class="text-sm">
                                            Belum ada user
                                        </span>

                                    </div>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        <!-- ==========================================
             LATEST PARTICIPANTS
        =========================================== -->

        <div class="mb-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4 sm:px-6">

                <div>
                    <h3 class="text-base font-bold text-slate-900">
                        Peserta Terbaru
                    </h3>

                    <p class="mt-1 text-xs text-slate-500">
                        Data peserta yang baru ditambahkan.
                    </p>
                </div>

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                    <i class="bi bi-person-lines-fill text-xl"></i>
                </div>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full min-w-[400px] text-left">

                    <thead class="bg-slate-50">

                        <tr class="border-b border-slate-200">

                            <th class="px-5 py-3.5 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Nama
                            </th>

                            <th class="px-5 py-3.5 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Kualifikasi
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @forelse($latestParticipants ?? [] as $p)

                            <tr class="transition-colors duration-150 hover:bg-slate-50">

                                <td class="px-5 py-4 text-sm font-semibold text-slate-800">
                                    {{ $p->name }}
                                </td>

                                <td class="px-5 py-4 text-sm text-slate-600">
                                    {{ $p->qualification }}
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="2" class="px-5 py-10 text-center">

                                    <div class="flex flex-col items-center gap-2 text-slate-400">

                                        <i class="bi bi-inbox text-3xl"></i>

                                        <span class="text-sm">
                                            Belum ada data
                                        </span>

                                    </div>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    @endif


    {{-- ==========================================
         MEMBER DASHBOARD
    =========================================== --}}

    @if (auth()->user()->role == 'member')

        <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">

            <!-- QUALIFICATION STATISTICS -->
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="flex items-center gap-3 border-b border-slate-100 px-5 py-4 sm:px-6">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                        <i class="bi bi-award-fill text-xl"></i>
                    </div>

                    <div>
                        <h3 class="text-base font-bold text-slate-900">
                            Statistik Kualifikasi
                        </h3>

                        <p class="text-xs text-slate-500">
                            Jumlah peserta berdasarkan kualifikasi.
                        </p>
                    </div>

                </div>

                <div class="p-5 sm:p-6">

                    @forelse($byQualification ?? [] as $q => $total)

                        <div class="flex items-center justify-between border-b border-slate-100 py-3 last:border-0">

                            <span class="text-sm font-medium text-slate-600">
                                {{ $q }}
                            </span>

                            <span class="rounded-lg bg-blue-50 px-3 py-1.5 text-sm font-bold text-blue-700">
                                {{ $total }}
                            </span>

                        </div>

                    @empty

                        <div class="flex flex-col items-center gap-2 py-8 text-slate-400">

                            <i class="bi bi-inbox text-3xl"></i>

                            <p class="text-sm">
                                Belum ada data
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>


            <!-- AGE STATISTICS -->
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="flex items-center gap-3 border-b border-slate-100 px-5 py-4 sm:px-6">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-violet-50 text-violet-600">
                        <i class="bi bi-calendar2-heart-fill text-xl"></i>
                    </div>

                    <div>
                        <h3 class="text-base font-bold text-slate-900">
                            Statistik Umur
                        </h3>

                        <p class="text-xs text-slate-500">
                            Jumlah peserta berdasarkan kelompok usia.
                        </p>
                    </div>

                </div>

                <div class="p-5 sm:p-6">

                    @forelse($ageGroups ?? [] as $range => $total)

                        <div class="flex items-center justify-between border-b border-slate-100 py-3 last:border-0">

                            <span class="text-sm font-medium text-slate-600">
                                {{ $range }}
                            </span>

                            <span class="rounded-lg bg-violet-50 px-3 py-1.5 text-sm font-bold text-violet-700">
                                {{ $total }}
                            </span>

                        </div>

                    @empty

                        <div class="flex flex-col items-center gap-2 py-8 text-slate-400">

                            <i class="bi bi-inbox text-3xl"></i>

                            <p class="text-sm">
                                Belum ada data
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>

        </div>

    @endif

</div>

@endsection


{{-- ==========================================
     CHART SCRIPTS
=========================================== --}}

@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

    const ageLabels = @json($ageLabels ?? []);
    const ageTotals = @json($ageTotals ?? []);

    const statusLabels = @json($statusLabels ?? []);
    const statusTotals = @json($statusTotals ?? []);

    // ==========================================
    // STATUS BAR CHART
    // ==========================================

    const statusCanvas = document.getElementById('statusChart');

    if (statusCanvas && typeof Chart !== 'undefined') {

        new Chart(statusCanvas, {
            type: 'bar',

            data: {
                labels: statusLabels,

                datasets: [{
                    label: 'Jumlah Peserta',
                    data: statusTotals,

                    backgroundColor: [
                        '#198754',
                        '#0d6efd'
                    ],

                    borderColor: [
                        '#198754',
                        '#0d6efd'
                    ],

                    borderWidth: 1,
                    borderRadius: 8,
                    maxBarThickness: 55
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    legend: {
                        display: false
                    }
                },

                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },

                    y: {
                        beginAtZero: true,

                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

    }


    // ==========================================
    // AGE PIE CHART
    // ==========================================

    const pieCanvas = document.getElementById('pieChart');

    if (pieCanvas && typeof Chart !== 'undefined') {

        new Chart(pieCanvas, {
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
                    ],

                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    legend: {
                        position: 'bottom',

                        labels: {
                            usePointStyle: true,
                            padding: 20
                        }
                    }
                }
            }
        });

    }

});
</script>

@endpush
