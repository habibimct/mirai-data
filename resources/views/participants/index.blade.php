
@extends('layouts.app')

@section('title', 'Daftar Peserta | LPK Mirai Gresik')

@section('content')

@php
    $inputClass = 'block w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 shadow-sm outline-none transition-all duration-200 placeholder:text-slate-400 hover:border-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100';

    $sortIndicator = function ($field) {
        if (request('sort') !== $field) {
            return '';
        }

        return request('direction') === 'asc' ? '↑' : '↓';
    };

    $sortUrl = function ($field) {
        $direction = request('sort') === $field && request('direction') === 'asc'
            ? 'desc'
            : 'asc';

        return request()->fullUrlWithQuery([
            'sort' => $field,
            'direction' => $direction,
            'page' => 1,
        ]);
    };
@endphp


<div class="mx-auto w-full max-w-7xl px-4 py-6 sm:px-6 lg:px-8">

    <!-- ==========================================
         PAGE HEADER
    =========================================== -->

    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

        <div>

            <div class="mb-1 flex items-center gap-2 text-xs text-slate-400">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Administration</span>
                <i class="bi bi-chevron-right text-[10px]"></i>
                <span class="font-medium text-slate-600">Peserta</span>
            </div>

            <h2 class="text-2xl font-bold tracking-tight text-slate-900">
                Daftar Peserta
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Kelola dan pantau seluruh data peserta LPK Mirai Gresik.
            </p>

        </div>

        @auth
            @if (auth()->user()->role == 'admin')

                <a
                    href="{{ route('participants.create') }}"
                    class="mobile-pressable inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm no-underline transition-all duration-200 hover:bg-blue-700 hover:shadow-md active:scale-[0.98]"
                >
                    <i class="bi bi-person-plus-fill"></i>
                    Tambah Peserta
                </a>

            @endif
        @endauth

    </div>


    <!-- ==========================================
         SEARCH & FILTER
    =========================================== -->

    <div class="mb-5 rounded-xl border border-slate-200 bg-white p-4 shadow-sm">

        <form method="GET" action="{{ route('participants.index') }}">

            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-12">

                <!-- SEARCH -->
                <div class="sm:col-span-2 lg:col-span-3">

                    <label for="search" class="mb-1.5 block text-xs font-semibold text-slate-600">
                        Cari Peserta
                    </label>

                    <div class="relative">

                        <input
                            type="text"
                            id="search"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari nama peserta..."
                            class="{{ $inputClass }} pl-10"
                        >

                        <i class="bi bi-search pointer-events-none absolute inset-y-0 right-2 flex items-center pl-3.5 text-slate-400"></i>

                    </div>

                </div>


                <!-- QUALIFICATION -->
                <div class="sm:col-span-2 lg:col-span-3">

                    <label for="qualification" class="mb-1.5 block text-xs font-semibold text-slate-600">
                        Kualifikasi
                    </label>

                    <select
                        id="qualification"
                        name="qualification"
                        class="{{ $inputClass }} cursor-pointer"
                    >

                        <option value="">Semua Kualifikasi</option>

                        @foreach ($filters as $filter)

                            <option
                                value="{{ $filter }}"
                                @selected(request('qualification') == $filter)
                            >
                                {{ $filter }}
                            </option>

                        @endforeach

                    </select>

                </div>


                <!-- MIN AGE -->
                <div class="lg:col-span-2">

                    <label for="age_min" class="mb-1.5 block text-xs font-semibold text-slate-600">
                        Usia Minimal
                    </label>

                    <input
                        type="number"
                        id="age_min"
                        name="age_min"
                        min="0"
                        value="{{ request('age_min') }}"
                        placeholder="Min."
                        class="{{ $inputClass }}"
                    >

                </div>


                <!-- MAX AGE -->
                <div class="lg:col-span-2">

                    <label for="age_max" class="mb-1.5 block text-xs font-semibold text-slate-600">
                        Usia Maksimal
                    </label>

                    <input
                        type="number"
                        id="age_max"
                        name="age_max"
                        min="0"
                        value="{{ request('age_max') }}"
                        placeholder="Max."
                        class="{{ $inputClass }}"
                    >

                </div>


                <!-- FILTER BUTTON -->
                <div class="flex items-end lg:col-span-1">

                    <button
                        type="submit"
                        class="mobile-pressable inline-flex h-[42px] w-full items-center justify-center gap-2 rounded-lg bg-blue-600 px-3 text-sm font-semibold text-white transition-all duration-200 hover:bg-blue-700 active:scale-95"
                    >
                        <i class="bi bi-funnel-fill"></i>
                        <span class="lg:hidden">Filter</span>
                    </button>

                </div>


                <!-- RESET BUTTON -->
                <div class="flex items-end lg:col-span-1">

                    <a
                        href="{{ route('participants.index') }}"
                        class="mobile-pressable inline-flex h-[42px] w-full items-center justify-center gap-2 rounded-lg border border-slate-200 bg-white px-3 text-sm font-semibold text-slate-600 no-underline transition-all duration-200 hover:bg-slate-50 hover:text-slate-800 active:scale-95"
                    >
                        <i class="bi bi-arrow-counterclockwise"></i>
                        <span class="lg:hidden">Reset</span>
                    </a>

                </div>

            </div>

        </form>

    </div>


    <!-- ==========================================
         TABLE TOOLBAR
    =========================================== -->

    <div class="mb-3 flex flex-col justify-between gap-3 sm:flex-row sm:items-center">

        <!-- DATA INFORMATION -->
        <div class="text-xs text-slate-500">

            @if ($participants instanceof \Illuminate\Pagination\LengthAwarePaginator)

                Menampilkan

                <span class="font-semibold text-slate-700">
                    {{ $participants->firstItem() ?? 0 }}–{{ $participants->lastItem() ?? 0 }}
                </span>

                dari

                <span class="font-semibold text-slate-700">
                    {{ $participants->total() }}
                </span>

                peserta

            @else

                <span class="font-semibold text-slate-700">
                    {{ $participants->count() }}
                </span>

                peserta ditemukan

            @endif

        </div>


        <!-- PER PAGE -->
        <form method="GET" action="{{ route('participants.index') }}"
              class="flex items-center gap-2">

            @foreach (request()->except(['per_page', 'page']) as $key => $value)

                @if (!is_array($value))

                    <input
                        type="hidden"
                        name="{{ $key }}"
                        value="{{ $value }}"
                    >

                @endif

            @endforeach

            <label for="per_page" class="whitespace-nowrap text-xs font-medium text-slate-500">
                Tampilkan
            </label>

            <select
                id="per_page"
                name="per_page"
                onchange="this.form.submit()"
                class="rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
            >

                <option value="10" @selected(request('per_page', '10') == '10')>
                    10
                </option>

                <option value="25" @selected(request('per_page') == '25')>
                    25
                </option>

                <option value="50" @selected(request('per_page') == '50')>
                    50
                </option>

                <option value="100" @selected(request('per_page') == '100')>
                    100
                </option>

                <option value="all" @selected(request('per_page') == 'all')>
                    Semua
                </option>

            </select>

            <span class="whitespace-nowrap text-xs text-slate-400">
                data
            </span>

        </form>

    </div>


    <!-- ==========================================
         PARTICIPANTS TABLE
    =========================================== -->

    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        @if ($participants->isEmpty())

            <!-- EMPTY STATE -->
            <div class="flex flex-col items-center justify-center px-5 py-16 text-center">

                <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-50 text-blue-500">
                    <i class="bi bi-people text-3xl"></i>
                </div>

                <h3 class="text-base font-bold text-slate-800">
                    Belum Ada Peserta
                </h3>

                <p class="mt-1 max-w-sm text-sm text-slate-500">
                    Belum ada peserta yang terdaftar atau tidak ditemukan data yang sesuai dengan pencarian.
                </p>

                @auth
                    @if (auth()->user()->role == 'admin')

                        <a
                            href="{{ route('participants.create') }}"
                            class="mt-4 inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white no-underline transition hover:bg-blue-700"
                        >
                            <i class="bi bi-plus-circle"></i>
                            Tambah Peserta
                        </a>

                    @endif
                @endauth

            </div>

        @else

            <div class="overflow-x-auto">

                <table class="w-full min-w-[850px] text-left">

                    <!-- TABLE HEADER -->
                    <thead class="bg-slate-50">

                        <tr class="border-b border-slate-200">

                            <th class="w-14 px-4 py-3.5 text-center text-[11px] font-bold uppercase tracking-wider text-slate-500">
                                No
                            </th>

                            <th class="w-20 px-3 py-3.5 text-center text-[11px] font-bold uppercase tracking-wider text-slate-500">
                                Foto
                            </th>

                            <th class="px-4 py-3.5 text-[11px] font-bold uppercase tracking-wider text-slate-500">

                                <a
                                    href="{{ $sortUrl('name') }}"
                                    class="inline-flex items-center gap-1.5 text-inherit no-underline transition-colors hover:text-blue-600"
                                >
                                    Nama Peserta

                                    <span class="{{ request('sort') == 'name' ? 'text-blue-600' : 'text-slate-300' }}">
                                        {{ $sortIndicator('name') ?: '↕' }}
                                    </span>

                                </a>

                            </th>

                            <th class="w-28 px-4 py-3.5 text-center text-[11px] font-bold uppercase tracking-wider text-slate-500">

                                <a
                                    href="{{ $sortUrl('age') }}"
                                    class="inline-flex items-center gap-1 text-inherit no-underline transition-colors hover:text-blue-600"
                                >
                                    Usia

                                    <span class="{{ request('sort') == 'age' ? 'text-blue-600' : 'text-slate-300' }}">
                                        {{ $sortIndicator('age') ?: '↕' }}
                                    </span>

                                </a>

                            </th>

                            <th class="px-4 py-3.5 text-[11px] font-bold uppercase tracking-wider text-slate-500">

                                <a
                                    href="{{ $sortUrl('qualification') }}"
                                    class="inline-flex items-center gap-1.5 text-inherit no-underline transition-colors hover:text-blue-600"
                                >
                                    Kualifikasi

                                    <span class="{{ request('sort') == 'qualification' ? 'text-blue-600' : 'text-slate-300' }}">
                                        {{ $sortIndicator('qualification') ?: '↕' }}
                                    </span>

                                </a>

                            </th>

                            <th class="w-32 px-4 py-3.5 text-center text-[11px] font-bold uppercase tracking-wider text-slate-500">

                                <a
                                    href="{{ $sortUrl('status') }}"
                                    class="inline-flex items-center gap-1.5 text-inherit no-underline transition-colors hover:text-blue-600"
                                >
                                    Status

                                    <span class="{{ request('sort') == 'status' ? 'text-blue-600' : 'text-slate-300' }}">
                                        {{ $sortIndicator('status') ?: '↕' }}
                                    </span>

                                </a>

                            </th>

                            <th class="w-52 px-4 py-3.5 text-center text-[11px] font-bold uppercase tracking-wider text-slate-500">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <!-- TABLE BODY -->
                    <tbody class="divide-y divide-slate-100">

                        @foreach ($participants as $p)

                            <tr class="group transition-colors duration-150 hover:bg-blue-50/40">

                                <!-- NUMBER -->
                                <td class="px-4 py-3.5 text-center text-xs font-medium text-slate-400">
                                    @if ($participants instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                        {{ ($participants->firstItem() ?? 1) + $loop->index }}
                                    @else
                                        {{ $loop->iteration }}
                                    @endif
                                </td>


                                <!-- PHOTO -->
                                <td class="px-3 py-3 text-center">

                                    <img
                                        src="{{ $p->photo ? asset($p->photo) : asset('images/default-user.png') }}"
                                        alt="Foto {{ $p->name }}"
                                        loading="lazy"
                                        class="mx-auto h-11 w-11 rounded-xl border border-slate-200 bg-slate-100 object-cover shadow-sm"
                                    >

                                </td>


                                <!-- NAME -->
                                <td class="px-4 py-3.5">

                                    <p class="max-w-[280px] truncate text-sm font-semibold capitalize text-slate-800">
                                        {{ $p->name }}
                                    </p>

                                </td>


                                <!-- AGE -->
                                <td class="px-4 py-3.5 text-center">

                                    <span class="text-sm font-medium text-slate-700">
                                        {{ $p->age !== null ? $p->age . ' tahun' : '-' }}
                                    </span>

                                </td>


                                <!-- QUALIFICATION -->
                                <td class="px-4 py-3.5">

                                    <span class="text-sm text-slate-600">
                                        {{ $p->qualification ?: '-' }}
                                    </span>

                                </td>


                                <!-- STATUS -->
                                <td class="px-4 py-3.5 text-center">

                                    @if ($p->status == 'Sending')

                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-[11px] font-semibold text-emerald-700 ring-1 ring-emerald-200">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                            Sending
                                        </span>

                                    @elseif ($p->status == 'Existing')

                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-blue-50 px-2.5 py-1 text-[11px] font-semibold text-blue-700 ring-1 ring-blue-200">
                                            <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>
                                            Existing
                                        </span>

                                    @else

                                        <span class="text-xs text-slate-400">-</span>

                                    @endif

                                </td>


                                <!-- ACTIONS -->
                                <td class="px-4 py-3.5">

                                    <div class="flex items-center justify-center gap-1.5">

                                        <!-- DETAIL -->
                                        <a
                                            href="{{ route('participants.show', [
                                                'id' => $p->id,
                                                'return_url' => request()->fullUrl(),
                                            ]) }}"
                                            title="Lihat Detail"
                                            class="mobile-pressable inline-flex h-8 items-center justify-center gap-1.5 rounded-lg border border-blue-200 bg-blue-50 px-2.5 text-xs font-semibold text-blue-700 no-underline transition-all duration-200 hover:border-blue-300 hover:bg-blue-100 active:scale-95"
                                        >
                                            <i class="bi bi-eye-fill"></i>
                                            Detail
                                        </a>


                                        @auth

                                            @if (auth()->user()->role == 'admin')

                                                <!-- EDIT -->
                                                <a
                                                    href="{{ route('participants.edit', [
                                                        'id' => $p->id,
                                                        'return_url' => request()->fullUrl(),
                                                    ]) }}"
                                                    title="Edit Peserta"
                                                    class="mobile-pressable inline-flex h-8 items-center justify-center gap-1.5 rounded-lg border border-amber-200 bg-amber-50 px-2.5 text-xs font-semibold text-amber-700 no-underline transition-all duration-200 hover:border-amber-300 hover:bg-amber-100 active:scale-95"
                                                >
                                                    <i class="bi bi-pencil-square"></i>
                                                    Edit
                                                </a>


                                                <!-- DELETE -->
                                                <form
                                                    action="{{ route('participants.destroy', $p->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus peserta ini?');"
                                                >

                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        title="Hapus Peserta"
                                                        class="mobile-pressable inline-flex h-8 items-center justify-center gap-1.5 rounded-lg border border-red-200 bg-red-50 px-2.5 text-xs font-semibold text-red-600 transition-all duration-200 hover:border-red-300 hover:bg-red-100 active:scale-95"
                                                    >
                                                        <i class="bi bi-trash3-fill"></i>
                                                        Hapus
                                                    </button>

                                                </form>

                                            @endif

                                        @endauth

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @endif

    </div>


    <!-- ==========================================
         PAGINATION
    =========================================== -->

    @if ($participants instanceof \Illuminate\Pagination\LengthAwarePaginator)

        <div class="mt-5 flex flex-col justify-between gap-3 sm:flex-row sm:items-center">

            <p class="text-xs text-slate-400">
                Halaman

                <span class="font-semibold text-slate-600">
                    {{ $participants->currentPage() }}
                </span>

                dari

                <span class="font-semibold text-slate-600">
                    {{ $participants->lastPage() }}
                </span>
            </p>

            <div>
                {{ $participants->withQueryString()->links() }}
            </div>

        </div>

    @endif

</div>

@endsection
