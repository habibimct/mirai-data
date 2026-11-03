
@extends('layouts.app')

@section('title', 'Detail Peserta | LPK Mirai Gresik')

@section('content')

@php
    $returnUrl = $returnUrl ?? route('participants.index');

    $navigationQuery = array_merge(request()->query(), [
        'return_url' => $returnUrl,
    ]);

    $dateOfBirth = $participant->date_of_birth
        ? \Carbon\Carbon::parse($participant->date_of_birth)->translatedFormat('d F Y')
        : '-';

    // Mendukung data foto dalam bentuk array atau JSON
    $weldingPhotos = $participant->welding_photos ?? [];

    if (is_string($weldingPhotos)) {
        $weldingPhotos = json_decode($weldingPhotos, true) ?: [];
    }

    if ($weldingPhotos instanceof \Illuminate\Support\Collection) {
        $weldingPhotos = $weldingPhotos->all();
    }

    if (!is_array($weldingPhotos)) {
        $weldingPhotos = [];
    }
@endphp


<div
    class="mx-auto w-full max-w-7xl px-4 py-6 sm:px-6 lg:px-8"
    x-data="{
        imageViewerOpen: false,
        viewerImage: '',
        closeViewer() {
            this.imageViewerOpen = false;
            this.viewerImage = '';
        }
    }"
    @keydown.escape.window="closeViewer()"
>


    <!-- ==========================================
         PAGE HEADER
    =========================================== -->

    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

        <div>

            <div class="mb-1 flex items-center gap-2 text-xs text-slate-400">

                <a
                    href="{{ $returnUrl }}"
                    class="text-slate-500 no-underline transition-colors hover:text-blue-600"
                >
                    Data Peserta
                </a>

                <i class="bi bi-chevron-right text-[10px]"></i>

                <span class="font-medium text-slate-700">
                    Detail Peserta
                </span>

            </div>

            <h2 class="text-2xl font-bold tracking-tight text-slate-900">
                Detail Peserta
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Informasi lengkap dan riwayat kompetensi peserta LPK Mirai Gresik.
            </p>

        </div>

        <a
            href="{{ $returnUrl }}"
            class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 no-underline shadow-sm transition-all duration-200 hover:border-slate-300 hover:bg-slate-50 active:scale-[0.98]"
        >
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>

    </div>


    <!-- ==========================================
         FILTER PARTICIPANTS
    =========================================== -->

    <div class="mb-5 rounded-xl border border-slate-200 bg-white p-4 shadow-sm">

        <div class="mb-3 flex items-center gap-2">

            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                <i class="bi bi-funnel-fill"></i>
            </div>

            <div>
                <h3 class="text-sm font-bold text-slate-800">
                    Filter Peserta
                </h3>

                <p class="text-[11px] text-slate-400">
                    Filter untuk navigasi peserta sebelumnya dan berikutnya.
                </p>
            </div>

        </div>


        <form
            method="GET"
            action="{{ route('participants.show', $participant->id) }}"
        >

            <input
                type="hidden"
                name="return_url"
                value="{{ $returnUrl }}"
            >

            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-12">

                <!-- QUALIFICATION -->
                <div class="lg:col-span-5">

                    <label
                        for="qualification"
                        class="mb-1.5 block text-xs font-semibold text-slate-600"
                    >
                        Kualifikasi
                    </label>

                    <select
                        id="qualification"
                        name="qualification"
                        class="block w-full cursor-pointer rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-700 outline-none transition-all hover:border-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                    >

                        <option value="">
                            Semua Kualifikasi
                        </option>

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

                    <label
                        for="age_min"
                        class="mb-1.5 block text-xs font-semibold text-slate-600"
                    >
                        Usia Minimal
                    </label>

                    <input
                        type="number"
                        id="age_min"
                        name="age_min"
                        min="0"
                        value="{{ request('age_min') }}"
                        placeholder="Min."
                        class="block w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-700 outline-none transition-all hover:border-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                    >

                </div>


                <!-- MAX AGE -->
                <div class="lg:col-span-2">

                    <label
                        for="age_max"
                        class="mb-1.5 block text-xs font-semibold text-slate-600"
                    >
                        Usia Maksimal
                    </label>

                    <input
                        type="number"
                        id="age_max"
                        name="age_max"
                        min="0"
                        value="{{ request('age_max') }}"
                        placeholder="Max."
                        class="block w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-700 outline-none transition-all hover:border-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                    >

                </div>


                <!-- FILTER BUTTON -->
                <div class="flex items-end lg:col-span-1">

                    <button
                        type="submit"
                        class="inline-flex h-[42px] w-full items-center justify-center gap-2 rounded-lg bg-blue-600 px-3 text-sm font-semibold text-white transition-all duration-200 hover:bg-blue-700 active:scale-95"
                    >
                        <i class="bi bi-funnel-fill"></i>
                        <span class="lg:hidden">Filter</span>
                    </button>

                </div>


                <!-- RESET -->
                <div class="flex items-end lg:col-span-2">

                    <a
                        href="{{ route('participants.show', $participant->id) }}?{{ http_build_query(['return_url' => $returnUrl]) }}"
                        class="inline-flex h-[42px] w-full items-center justify-center gap-2 rounded-lg border border-slate-200 bg-white px-3 text-sm font-semibold text-slate-600 no-underline transition-all duration-200 hover:bg-slate-50 active:scale-95"
                    >
                        <i class="bi bi-arrow-counterclockwise"></i>
                        Reset Filter
                    </a>

                </div>

            </div>

        </form>

    </div>


    <!-- ==========================================
         PARTICIPANT PROFILE
    =========================================== -->

    <div class="mb-5 overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <!-- PROFILE HEADER -->
        <div class="border-b border-slate-100 bg-gradient-to-r from-blue-50 via-white to-white px-5 py-5 sm:px-7">

            <div class="flex flex-col items-center gap-5 sm:flex-row sm:items-center">

                <!-- PROFILE PHOTO -->
                <div class="relative shrink-0">

                    <div class="flex h-32 w-32 items-center justify-center overflow-hidden rounded-2xl border-4 border-white bg-slate-100 shadow-md sm:h-36 sm:w-36">

                        @if ($participant->photo)

                            <img
                                src="{{ asset($participant->photo) }}"
                                alt="Foto {{ $participant->name }}"
                                class="h-full w-full object-cover"
                            >

                        @else

                            <i class="bi bi-person-fill text-6xl text-slate-300"></i>

                        @endif

                    </div>

                    <div class="absolute -bottom-2 -right-2 flex h-9 w-9 items-center justify-center rounded-xl border-4 border-white bg-blue-600 text-white shadow-sm">
                        <i class="bi bi-person-check-fill"></i>
                    </div>

                </div>


                <!-- IDENTITY -->
                <div class="min-w-0 flex-1 text-center sm:text-left">

                    <p class="text-[10px] font-bold uppercase tracking-[0.16em] text-blue-600">
                        Participant Profile
                    </p>

                    <h3 class="mt-1 break-words text-xl font-bold text-slate-900 sm:text-2xl">
                        {{ $participant->name }}
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        {{ $participant->qualification ?: 'Belum ada kualifikasi' }}
                    </p>


                    <!-- BADGES -->
                    <div class="mt-3 flex flex-wrap items-center justify-center gap-2 sm:justify-start">

                        <span class="inline-flex items-center gap-1.5 rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700 ring-1 ring-blue-200">

                            <i class="bi bi-calendar3"></i>

                            {{ $participant->age !== null ? $participant->age . ' Tahun' : 'Usia -' }}

                        </span>


                        @if ($participant->status == 'Sending')

                            <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700 ring-1 ring-emerald-200">

                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                Sending

                            </span>

                        @elseif ($participant->status == 'Existing')

                            <span class="inline-flex items-center gap-1.5 rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700 ring-1 ring-blue-200">

                                <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>

                                Existing

                            </span>

                        @else

                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-500">
                                Status -
                            </span>

                        @endif

                    </div>

                </div>


                <!-- JAPANESE SKILLS -->
                @if ($participant->japanese_skills)

                    <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-center">

                        <p class="text-[10px] font-bold uppercase tracking-wider text-emerald-600">
                            Japanese Skills
                        </p>

                        <p class="mt-1 text-lg font-bold text-emerald-700">
                            {{ $participant->japanese_skills }}
                        </p>

                    </div>

                @endif

            </div>

        </div>


        <!-- ==========================================
             PARTICIPANT INFORMATION
        =========================================== -->

        <div class="p-5 sm:p-7">

            <div class="mb-5 flex items-center gap-2">

                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                    <i class="bi bi-person-vcard-fill text-lg"></i>
                </div>

                <div>
                    <h4 class="text-sm font-bold text-slate-800">
                        Informasi Peserta
                    </h4>

                    <p class="text-[11px] text-slate-400">
                        Data pribadi dan informasi pelatihan.
                    </p>
                </div>

            </div>


            <div class="grid grid-cols-1 gap-x-8 sm:grid-cols-2">


                <!-- BIRTH PLACE -->
                <div class="border-b border-slate-100 py-3">

                    <p class="mb-1 text-xs font-medium text-slate-400">
                        Tempat, Tanggal Lahir
                    </p>

                    <p class="text-sm font-semibold text-slate-800">
                        {{ $participant->place_of_birth ?: '-' }},
                        {{ $dateOfBirth }}
                    </p>

                </div>


                <!-- AGE -->
                <div class="border-b border-slate-100 py-3">

                    <p class="mb-1 text-xs font-medium text-slate-400">
                        Usia
                    </p>

                    <p class="text-sm font-semibold text-slate-800">
                        {{ $participant->age !== null ? $participant->age . ' Tahun' : '-' }}
                    </p>

                </div>


                <!-- QUALIFICATION -->
                <div class="border-b border-slate-100 py-3">

                    <p class="mb-1 text-xs font-medium text-slate-400">
                        Kualifikasi
                    </p>

                    <p class="text-sm font-semibold text-slate-800">
                        {{ $participant->qualification ?: '-' }}
                    </p>

                </div>


                <!-- STATUS -->
                <div class="border-b border-slate-100 py-3">

                    <p class="mb-1 text-xs font-medium text-slate-400">
                        Status Peserta
                    </p>

                    <div>

                        @if ($participant->status == 'Sending')

                            <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                                Sending
                            </span>

                        @elseif ($participant->status == 'Existing')

                            <span class="inline-flex items-center rounded-full bg-blue-50 px-2.5 py-1 text-xs font-semibold text-blue-700">
                                Existing
                            </span>

                        @else

                            <span class="text-sm text-slate-500">-</span>

                        @endif

                    </div>

                </div>


                <!-- JAPANESE -->
                <div class="border-b border-slate-100 py-3 sm:col-span-2">

                    <p class="mb-1 text-xs font-medium text-slate-400">
                        Kemampuan Bahasa Jepang
                    </p>

                    <p class="text-sm font-semibold text-slate-800">
                        {{ $participant->japanese_skills ?: '-' }}
                    </p>

                </div>


                <!-- ADDRESS -->
                <div class="border-b border-slate-100 py-3 sm:col-span-2">

                    <p class="mb-1 flex items-center gap-2 text-xs font-medium text-slate-400">
                        <i class="bi bi-geo-alt"></i>
                        Alamat
                    </p>

                    <p class="whitespace-pre-line break-words text-sm leading-relaxed text-slate-700">
                        {{ $participant->address ?: '-' }}
                    </p>

                </div>


                <!-- MATERIALS -->
                <div class="border-b border-slate-100 py-3">

                    <p class="mb-1 flex items-center gap-2 text-xs font-medium text-slate-400">
                        <i class="bi bi-book"></i>
                        Materi
                    </p>

                    <p class="whitespace-pre-line break-words text-sm leading-relaxed text-slate-700">
                        {{ $participant->materials ?: '-' }}
                    </p>

                </div>


                <!-- MOTIVATION -->
                <div class="border-b border-slate-100 py-3">

                    <p class="mb-1 flex items-center gap-2 text-xs font-medium text-slate-400">
                        <i class="bi bi-lightbulb"></i>
                        Motivasi
                    </p>

                    <p class="whitespace-pre-line break-words text-sm leading-relaxed text-slate-700">
                        {{ $participant->motivation ?: '-' }}
                    </p>

                </div>


                <!-- VISION -->
                <div class="py-3 sm:col-span-2">

                    <p class="mb-1 flex items-center gap-2 text-xs font-medium text-slate-400">
                        <i class="bi bi-eye"></i>
                        Visi
                    </p>

                    <p class="whitespace-pre-line break-words text-sm leading-relaxed text-slate-700">
                        {{ $participant->vision ?: '-' }}
                    </p>

                </div>

            </div>

        </div>

    </div>


    <!-- ==========================================
         YOUTUBE VIDEO
    =========================================== -->

    @if ($participant->youtube_link)

        <div class="mb-5 overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

            <div class="flex items-center gap-3 border-b border-slate-100 px-5 py-3.5">

                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-red-50 text-red-600">
                    <i class="bi bi-youtube text-xl"></i>
                </div>

                <div>
                    <h3 class="text-sm font-bold text-slate-800">
                        Video Peserta
                    </h3>

                    <p class="text-[11px] text-slate-400">
                        Dokumentasi dan video kompetensi peserta.
                    </p>
                </div>

            </div>

            <div class="p-4 sm:p-5">

                <div
                    id="youtube_preview_container"
                    class="mx-auto hidden w-full max-w-3xl"
                >

                    <div class="aspect-video overflow-hidden rounded-xl bg-slate-100">

                        <iframe
                            id="youtube_preview"
                            class="h-full w-full"
                            title="Video peserta"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin"
                            allowfullscreen
                        ></iframe>

                    </div>

                </div>

                <div
                    id="youtube_fallback"
                    class="hidden rounded-lg bg-amber-50 p-4 text-sm text-amber-700"
                >
                    Format video tidak dapat ditampilkan secara otomatis.

                    <a
                        id="youtube_external_link"
                        href="{{ $participant->youtube_link }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="font-semibold text-blue-700 underline"
                    >
                        Buka video YouTube
                    </a>
                </div>

            </div>

        </div>

    @endif


    <!-- ==========================================
         WELDING GALLERY
    =========================================== -->

    <div class="mb-5 overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4 sm:px-6">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-red-50 text-red-600">
                    <i class="bi bi-images text-xl"></i>
                </div>

                <div>
                    <h3 class="text-sm font-bold text-slate-800">
                        Hasil Las
                    </h3>

                    <p class="text-[11px] text-slate-400">
                        Dokumentasi hasil pekerjaan pengelasan peserta.
                    </p>
                </div>

            </div>

            <span class="rounded-lg bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600">
                {{ count($weldingPhotos) }} Foto
            </span>

        </div>


        <div class="p-5 sm:p-6">

            @if (count($weldingPhotos))

                <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4">

                    @foreach ($weldingPhotos as $index => $photo)

                        <button
                            type="button"
                            x-on:click="viewerImage = $el.querySelector('img').src; imageViewerOpen = true"
                            aria-label="Lihat foto hasil las {{ $index + 1 }}"
                            class="group relative block w-full overflow-hidden rounded-xl border border-slate-200 bg-slate-50 text-left shadow-sm outline-none transition-all duration-200 hover:border-blue-300 hover:shadow-md focus-visible:ring-4 focus-visible:ring-blue-100"
                        >

                            <div class="aspect-[4/3] overflow-hidden">

                                <img
                                    src="{{ asset($photo) }}"
                                    alt="Hasil pengelasan {{ $index + 1 }}"
                                    loading="lazy"
                                    class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105"
                                >

                            </div>


                            <!-- HOVER OVERLAY -->
                            <div class="absolute inset-0 flex items-center justify-center bg-slate-950/40 opacity-0 transition-opacity duration-200 group-hover:opacity-100">

                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-white/95 text-slate-800 shadow-md">
                                    <i class="bi bi-zoom-in text-lg"></i>
                                </div>

                            </div>


                            <!-- PHOTO LABEL -->
                            <div class="border-t border-slate-100 bg-white px-3 py-2">

                                <p class="text-xs font-semibold text-slate-600">
                                    Foto {{ $index + 1 }}
                                </p>

                            </div>

                        </button>

                    @endforeach

                </div>

            @else

                <div class="flex flex-col items-center justify-center py-10 text-center">

                    <div class="mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">
                        <i class="bi bi-images text-2xl"></i>
                    </div>

                    <h4 class="text-sm font-semibold text-slate-700">
                        Belum Ada Foto Hasil Las
                    </h4>

                    <p class="mt-1 text-xs text-slate-400">
                        Dokumentasi pekerjaan pengelasan belum tersedia.
                    </p>

                </div>

            @endif

        </div>

    </div>


    <!-- ==========================================
         PREVIOUS / NEXT NAVIGATION
    =========================================== -->

    <div class="mb-5 flex items-center justify-between gap-3">

        <!-- PREVIOUS -->
        <div>

            @if ($previous)

                <a
                    href="{{ route('participants.show', $previous->id) }}?{{ http_build_query($navigationQuery) }}"
                    class="inline-flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 no-underline shadow-sm transition-all duration-200 hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700 active:scale-[0.98]"
                >
                    <i class="bi bi-chevron-left"></i>

                    <span>Sebelumnya</span>
                </a>

            @else

                <span class="inline-flex cursor-not-allowed items-center gap-2 rounded-lg border border-slate-100 bg-slate-50 px-4 py-2.5 text-sm font-medium text-slate-300">
                    <i class="bi bi-chevron-left"></i>
                    Sebelumnya
                </span>

            @endif

        </div>


        <!-- NEXT -->
        <div>

            @if ($next)

                <a
                    href="{{ route('participants.show', $next->id) }}?{{ http_build_query($navigationQuery) }}"
                    class="inline-flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 no-underline shadow-sm transition-all duration-200 hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700 active:scale-[0.98]"
                >
                    <span>Berikutnya</span>

                    <i class="bi bi-chevron-right"></i>
                </a>

            @else

                <span class="inline-flex cursor-not-allowed items-center gap-2 rounded-lg border border-slate-100 bg-slate-50 px-4 py-2.5 text-sm font-medium text-slate-300">
                    Berikutnya
                    <i class="bi bi-chevron-right"></i>
                </span>

            @endif

        </div>

    </div>


    <!-- ==========================================
         ACTION BUTTONS
    =========================================== -->

    <div class="flex flex-col-reverse justify-between gap-3 border-t border-slate-200 pt-5 sm:flex-row sm:items-center">

        <!-- BACK -->
        <a
            href="{{ $returnUrl }}"
            class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 no-underline shadow-sm transition-all duration-200 hover:border-slate-300 hover:bg-slate-50 active:scale-[0.98]"
        >
            <i class="bi bi-arrow-left"></i>
            Kembali ke Daftar Peserta
        </a>


        <!-- ADMIN ACTIONS -->
        @auth

            @if (auth()->user()->role == 'admin')

                <div class="flex flex-col gap-2 sm:flex-row">

                    <!-- EDIT -->
                    <a
                        href="{{ route('participants.edit', [
                            'id' => $participant->id,
                            'return_url' => $returnUrl,
                        ]) }}"
                        class="inline-flex items-center justify-center gap-2 rounded-lg border border-amber-200 bg-amber-50 px-5 py-2.5 text-sm font-semibold text-amber-700 no-underline transition-all duration-200 hover:border-amber-300 hover:bg-amber-100 active:scale-[0.98]"
                    >
                        <i class="bi bi-pencil-square"></i>
                        Edit Peserta
                    </a>


                    <!-- DELETE -->
                    <form
                        action="{{ route('participants.destroy', $participant->id) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus data peserta ini?')"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-lg border border-red-200 bg-red-50 px-5 py-2.5 text-sm font-semibold text-red-600 transition-all duration-200 hover:border-red-300 hover:bg-red-100 active:scale-[0.98]"
                        >
                            <i class="bi bi-trash3-fill"></i>
                            Hapus Peserta
                        </button>

                    </form>

                </div>

            @endif

        @endauth

    </div>


    <!-- ==========================================
         FULLSCREEN IMAGE VIEWER
    =========================================== -->

    <div
        x-cloak
        x-show="imageViewerOpen"
        x-transition.opacity
        x-on:click.self="closeViewer()"
        class="fixed inset-0 z-[100] flex items-center justify-center bg-slate-950/95 p-4 sm:p-8"
        role="dialog"
        aria-modal="true"
        aria-label="Preview gambar hasil las"
    >

        <!-- CLOSE BUTTON -->
        <button
            type="button"
            x-on:click="closeViewer()"
            class="absolute right-4 top-4 z-10 flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-white transition-all duration-200 hover:bg-white/20 active:scale-90 sm:right-7 sm:top-7"
            aria-label="Tutup gambar"
        >
            <i class="bi bi-x-lg text-xl"></i>
        </button>


        <!-- VIEWER IMAGE -->
        <img
            x-bind:src="viewerImage"
            alt="Preview hasil las"
            x-on:click.stop
            class="max-h-[90vh] max-w-full rounded-xl object-contain shadow-2xl"
        >

    </div>


</div>

@endsection


{{-- ==========================================
     YOUTUBE SCRIPT
=========================================== --}}

@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

    // ==========================================
    // YOUTUBE EMBED
    // ==========================================

    const youtubeUrl = @json($participant->youtube_link);

    const youtubeContainer = document.getElementById('youtube_preview_container');
    const youtubePreview = document.getElementById('youtube_preview');
    const youtubeFallback = document.getElementById('youtube_fallback');
    const youtubeExternalLink = document.getElementById('youtube_external_link');


    function getYouTubeVideoId(value) {

        try {

            const url = new URL(value);

            const hostname = url.hostname.toLowerCase().replace(/^www\./, '');

            const segments = url.pathname.split('/').filter(Boolean);

            let videoId = null;

            if (hostname === 'youtu.be') {

                videoId = segments[0];

            } else if (
                hostname === 'youtube.com' ||
                hostname === 'm.youtube.com' ||
                hostname === 'youtube-nocookie.com'
            ) {

                if (url.pathname === '/watch') {

                    videoId = url.searchParams.get('v');

                } else if (
                    ['embed', 'shorts', 'live'].includes(segments[0])
                ) {

                    videoId = segments[1];

                }

            }

            if (videoId && /^[a-zA-Z0-9_-]{11}$/.test(videoId)) {
                return videoId;
            }

            return null;

        } catch (error) {

            return null;

        }

    }


    if (
        youtubeUrl &&
        youtubeContainer &&
        youtubePreview &&
        youtubeFallback
    ) {

        const videoId = getYouTubeVideoId(youtubeUrl);

        if (videoId) {

            youtubePreview.src =
                'https://www.youtube-nocookie.com/embed/' + videoId;

            youtubeContainer.classList.remove('hidden');

        } else {

            youtubeFallback.classList.remove('hidden');

        }

    }

});
</script>

@endpush
