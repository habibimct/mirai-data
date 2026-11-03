
@extends('layouts.app')

@section('title', 'Tambah Peserta | LPK Mirai Gresik')

@section('content')

<div class="mx-auto w-full max-w-7xl px-4 py-6 sm:px-6 lg:px-8">

    <!-- ==========================================
         PAGE HEADER
    =========================================== -->

    <div class="mb-7 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

        <div>
            <div class="mb-2 flex items-center gap-2 text-sm text-slate-500">
                <a href="{{ route('participants.index') }}"
                   class="transition-colors hover:text-blue-600">
                    Data Peserta
                </a>

                <i class="bi bi-chevron-right text-xs"></i>

                <span class="font-medium text-slate-700">
                    Tambah Peserta
                </span>
            </div>

            <h2 class="text-2xl font-bold tracking-tight text-slate-900">
                Tambah Peserta
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Masukkan informasi dan data lengkap peserta baru.
            </p>
        </div>

        <a href="{{ route('participants.index') }}"
           class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 shadow-sm transition-all duration-200 hover:border-slate-300 hover:bg-slate-50 hover:text-slate-900 active:scale-[0.98]">

            <i class="bi bi-arrow-left"></i>
            Kembali ke Peserta

        </a>

    </div>



<!-- ==========================================
     IMPORT EXCEL - COMPACT DESIGN
=========================================== -->

<div class="mb-2 overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

    <!-- HEADER -->
    <div class="flex items-center gap-3 border-b border-emerald-100 bg-emerald-50/60 px-5 py-3">

        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-700">
            <i class="bi bi-file-earmark-spreadsheet-fill text-lg"></i>
        </div>

        <div>
            <h3 class="text-sm font-bold text-slate-800">
                Import Data Excel
            </h3>

            <p class="mt-0.5 text-xs text-slate-500">
                Tambahkan beberapa peserta sekaligus menggunakan file Excel.
            </p>
        </div>

    </div>


    <!-- BODY -->
    <div class="px-5 py-4">

        <form
            action="{{ route('participants.import') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            <div class="grid grid-cols-1 gap-3 md:grid-cols-12 md:items-start">

                <!-- FILE INPUT -->
                <div class="md:col-span-6">

                    <label
                        for="import_file"
                        class="mb-1.5 block text-xs font-semibold text-slate-700"
                    >
                        Pilih File Excel
                    </label>

                    <input
                        type="file"
                        id="import_file"
                        name="file"
                        accept=".xlsx,.csv"
                        required
                        class="block h-10 w-full cursor-pointer rounded-lg border border-slate-200 bg-white text-xs text-slate-600 shadow-sm transition
                               file:mr-3 file:h-full file:cursor-pointer file:border-0
                               file:bg-slate-50 file:px-3 file:text-xs file:font-medium file:text-slate-700
                               hover:file:bg-slate-100
                               focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100"
                    >

                    <p class="mt-1.5 text-[11px] text-slate-400">
                        Format: .xlsx atau .csv
                    </p>

                </div>


                <!-- ACTION BUTTONS -->
                <div class="flex flex-wrap items-center gap-2 md:col-span-6 md:pt-[25px]">

                    <!-- UPLOAD -->
                    <button
                        type="submit"
                        class="mobile-pressable inline-flex h-10 min-w-[145px] items-center justify-center gap-2 rounded-lg border border-emerald-200 bg-emerald-50 px-3 text-xs font-semibold text-emerald-700 transition-all duration-200 hover:border-emerald-300 hover:bg-emerald-100 hover:shadow-sm active:scale-[0.98]"
                    >
                        <i class="bi bi-cloud-arrow-up-fill"></i>
                        Upload Excel
                    </button>


                    <!-- DOWNLOAD TEMPLATE -->
                    <a
                        href="{{ asset('template.xlsx') }}"
                        download
                        class="mobile-pressable inline-flex h-10 min-w-[155px] items-center justify-center gap-2 rounded-lg border border-blue-200 bg-blue-50 px-3 text-xs font-semibold text-blue-700 no-underline transition-all duration-200 hover:border-blue-300 hover:bg-blue-100 hover:shadow-sm active:scale-[0.98]"
                    >
                        <i class="bi bi-download"></i>
                        Download Template
                    </a>

                </div>

            </div>

        </form>

    </div>

</div>



    <!-- ==========================================
         MAIN FORM
    =========================================== -->

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <!-- FORM HEADER -->
        <div class="flex items-center gap-3 border-b border-slate-100 px-5 py-5 sm:px-6">

            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                <i class="bi bi-person-plus-fill text-xl"></i>
            </div>

            <div>
                <h3 class="text-base font-bold text-slate-900">
                    Informasi Peserta
                </h3>

                <p class="text-xs text-slate-500">
                    Lengkapi formulir berikut sesuai data peserta.
                </p>
            </div>

        </div>


        <div class="p-5 sm:p-6 lg:p-8">


            <!-- ==========================================
                 VALIDATION ERRORS
            =========================================== -->

            @if ($errors->any())

                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4">

                    <div class="mb-2 flex items-center gap-2 text-sm font-bold text-red-700">

                        <i class="bi bi-exclamation-circle-fill text-lg"></i>

                        Terdapat kesalahan pada pengisian form.

                    </div>

                    <ul class="ml-6 list-disc space-y-1 text-sm text-red-600">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <!-- ==========================================
                 PARTICIPANT FORM
            =========================================== -->

            <form action="{{ route('participants.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="grid grid-cols-1 gap-8 lg:grid-cols-2 lg:gap-10">


                    <!-- ==================================
                         LEFT COLUMN
                    =================================== -->

                    <div class="space-y-5">

                        <!-- SECTION TITLE -->
                        <div class="flex items-center gap-2 border-b border-slate-100 pb-3">

                            <i class="bi bi-person-vcard text-lg text-blue-600"></i>

                            <h4 class="text-sm font-bold text-slate-800">
                                Data Pribadi
                            </h4>

                        </div>


                        <!-- NAMA -->
                        <div>

                            <label for="name"
                                   class="mb-2 block text-sm font-semibold text-slate-700">
                                Nama Lengkap
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                placeholder="Masukkan nama lengkap peserta"
                                class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 shadow-sm outline-none transition-all placeholder:text-slate-400 hover:border-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                            >

                        </div>


                        <!-- TEMPAT LAHIR -->
                        <div>

                            <label for="place_of_birth"
                                   class="mb-2 block text-sm font-semibold text-slate-700">
                                Tempat Lahir
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="text"
                                id="place_of_birth"
                                name="place_of_birth"
                                value="{{ old('place_of_birth') }}"
                                required
                                placeholder="Contoh: Gresik"
                                class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 shadow-sm outline-none transition-all placeholder:text-slate-400 hover:border-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                            >

                        </div>


                        <!-- TANGGAL LAHIR -->
                        <div>

                            <label for="date_of_birth"
                                   class="mb-2 block text-sm font-semibold text-slate-700">
                                Tanggal Lahir
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="date"
                                id="date_of_birth"
                                name="date_of_birth"
                                value="{{ old('date_of_birth') }}"
                                class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 shadow-sm outline-none transition-all hover:border-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                            >

                            <p class="mt-1.5 text-xs text-slate-400">
                                <i class="bi bi-info-circle mr-1"></i>
                                Umur peserta akan dihitung otomatis.
                            </p>

                        </div>


                        <!-- KUALIFIKASI -->
                        <div>

                            <label for="qualification"
                                   class="mb-2 block text-sm font-semibold text-slate-700">
                                Kualifikasi
                            </label>

                            <input
                                type="text"
                                id="qualification"
                                name="qualification"
                                value="{{ old('qualification') }}"
                                placeholder="Masukkan kualifikasi peserta"
                                class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 shadow-sm outline-none transition-all placeholder:text-slate-400 hover:border-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                            >

                        </div>


                        <!-- STATUS -->
                        <div>

                            <label for="status"
                                   class="mb-2 block text-sm font-semibold text-slate-700">
                                Status Peserta
                            </label>

                            <select
                                id="status"
                                name="status"
                                class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 shadow-sm outline-none transition-all hover:border-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                            >

                                <option value="">-- Pilih Status --</option>

                                <option value="Sending" @selected(old('status') == 'Sending')>
                                    Sending
                                </option>

                                <option value="Existing" @selected(old('status') == 'Existing')>
                                    Existing
                                </option>

                            </select>

                        </div>


                        <!-- BAHASA JEPANG -->
                        <div>

                            <label for="japanese_skills"
                                   class="mb-2 block text-sm font-semibold text-slate-700">
                                Kemampuan Bahasa Jepang
                            </label>

                            <input
                                type="text"
                                id="japanese_skills"
                                name="japanese_skills"
                                value="{{ old('japanese_skills') }}"
                                placeholder="Contoh: N5, N4, JFT A2"
                                class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 shadow-sm outline-none transition-all placeholder:text-slate-400 hover:border-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                            >

                        </div>


                        <!-- FOTO -->
                        <div>

                            <label for="photo"
                                   class="mb-2 block text-sm font-semibold text-slate-700">
                                Foto Peserta
                            </label>

                            <input
                                type="file"
                                id="photo"
                                name="photo"
                                accept="image/*"
                                class="block w-full cursor-pointer rounded-xl border border-slate-300 bg-white text-sm text-slate-600 shadow-sm transition-all file:mr-4 file:cursor-pointer file:border-0 file:bg-slate-100 file:px-4 file:py-3 file:text-sm file:font-semibold file:text-slate-700 hover:file:bg-slate-200 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100"
                            >

                            <!-- IMAGE PREVIEW -->
                            <div id="preview_container" class="mt-4 hidden">

                                <p class="mb-2 text-xs font-semibold text-slate-500">
                                    Preview Foto
                                </p>

                                <div class="inline-flex rounded-xl border border-slate-200 bg-slate-50 p-2">

                                    <img
                                        id="preview"
                                        alt="Preview foto peserta"
                                        class="h-36 w-36 rounded-lg object-cover"
                                    >

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- ==================================
                         RIGHT COLUMN
                    =================================== -->

                    <div class="space-y-5">

                        <!-- SECTION TITLE -->
                        <div class="flex items-center gap-2 border-b border-slate-100 pb-3">

                            <i class="bi bi-journal-text text-lg text-blue-600"></i>

                            <h4 class="text-sm font-bold text-slate-800">
                                Informasi dan Kompetensi
                            </h4>

                        </div>


                        <!-- ALAMAT -->
                        <div>

                            <label for="address"
                                   class="mb-2 block text-sm font-semibold text-slate-700">
                                Alamat
                            </label>

                            <textarea
                                id="address"
                                name="address"
                                rows="3"
                                placeholder="Masukkan alamat lengkap peserta"
                                class="block w-full resize-y rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 shadow-sm outline-none transition-all placeholder:text-slate-400 hover:border-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                            >{{ old('address') }}</textarea>

                        </div>


                        <!-- MATERI -->
                        <div>

                            <label for="materials"
                                   class="mb-2 block text-sm font-semibold text-slate-700">
                                Materi
                            </label>

                            <textarea
                                id="materials"
                                name="materials"
                                rows="2"
                                placeholder="Masukkan materi pelatihan"
                                class="block w-full resize-y rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 shadow-sm outline-none transition-all placeholder:text-slate-400 hover:border-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                            >{{ old('materials') }}</textarea>

                        </div>


                        <!-- MOTIVASI -->
                        <div>

                            <label for="motivation"
                                   class="mb-2 block text-sm font-semibold text-slate-700">
                                Motivasi
                            </label>

                            <textarea
                                id="motivation"
                                name="motivation"
                                rows="2"
                                placeholder="Masukkan motivasi peserta"
                                class="block w-full resize-y rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 shadow-sm outline-none transition-all placeholder:text-slate-400 hover:border-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                            >{{ old('motivation') }}</textarea>

                        </div>


                        <!-- VISI -->
                        <div>

                            <label for="vision"
                                   class="mb-2 block text-sm font-semibold text-slate-700">
                                Visi
                            </label>

                            <textarea
                                id="vision"
                                name="vision"
                                rows="2"
                                placeholder="Masukkan visi peserta"
                                class="block w-full resize-y rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 shadow-sm outline-none transition-all placeholder:text-slate-400 hover:border-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                            >{{ old('vision') }}</textarea>

                        </div>


                        <!-- YOUTUBE -->
                        <div>

                            <label for="youtube_link"
                                   class="mb-2 block text-sm font-semibold text-slate-700">
                                Link YouTube
                            </label>

                            <div class="relative">

                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                    <i class="bi bi-youtube text-lg"></i>
                                </div>

                                <input
                                    type="url"
                                    name="youtube_link"
                                    id="youtube_link"
                                    value="{{ old('youtube_link') }}"
                                    placeholder="https://youtube.com/..."
                                    class="block w-full rounded-xl border border-slate-300 bg-white py-3 pl-11 pr-4 text-sm text-slate-800 shadow-sm outline-none transition-all placeholder:text-slate-400 hover:border-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                >

                            </div>


                            <!-- YOUTUBE PREVIEW -->
                            <div id="youtube_preview_container" class="mt-4 hidden">

                                <div class="mb-2 flex items-center gap-2 text-xs font-semibold text-slate-500">
                                    <i class="bi bi-play-circle-fill text-red-500"></i>
                                    Preview Video
                                </div>

                                <div class="aspect-video overflow-hidden rounded-xl border border-slate-200 bg-slate-100 shadow-sm">

                                    <iframe
                                        id="youtube_preview"
                                        class="h-full w-full"
                                        title="YouTube video preview"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        referrerpolicy="strict-origin-when-cross-origin"
                                        allowfullscreen
                                    ></iframe>

                                </div>

                            </div>

                        </div>


                        <!-- WELDING PHOTOS -->
                        <div>

                            <label for="welding_photos"
                                   class="mb-2 block text-sm font-semibold text-slate-700">
                                Hasil Las
                            </label>

                            <input
                                type="file"
                                id="welding_photos"
                                name="welding_photos[]"
                                multiple
                                accept="image/*"
                                class="block w-full cursor-pointer rounded-xl border border-slate-300 bg-white text-sm text-slate-600 shadow-sm transition-all file:mr-4 file:cursor-pointer file:border-0 file:bg-slate-100 file:px-4 file:py-3 file:text-sm file:font-semibold file:text-slate-700 hover:file:bg-slate-200 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100"
                            >

                            <p class="mt-2 text-xs text-slate-400">
                                <i class="bi bi-images mr-1"></i>
                                Bisa mengunggah lebih dari satu gambar.
                            </p>

                        </div>

                    </div>

                </div>


                <!-- ==========================================
                     FORM ACTIONS
                =========================================== -->

                <div class="mt-8 flex flex-col-reverse justify-between gap-3 border-t border-slate-100 pt-6 sm:flex-row sm:items-center">

                    <a
                        href="{{ route('participants.index') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-600 shadow-sm transition-all duration-200 hover:border-slate-300 hover:bg-slate-50 hover:text-slate-900 active:scale-[0.98]"
                    >
                        <i class="bi bi-arrow-left"></i>
                        Kembali
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-7 py-3 text-sm font-semibold text-white shadow-sm transition-all duration-200 hover:bg-blue-700 hover:shadow-md active:scale-[0.98] focus:outline-none focus:ring-4 focus:ring-blue-100"
                    >
                        <i class="bi bi-floppy-fill"></i>
                        Simpan Data Peserta
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection


{{-- ==========================================
     FORM SCRIPTS
=========================================== --}}

@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

    // ==========================================
    // PHOTO PREVIEW
    // ==========================================

    const photoInput = document.getElementById('photo');
    const photoPreview = document.getElementById('preview');
    const previewContainer = document.getElementById('preview_container');

    let currentPhotoUrl = null;

    if (photoInput && photoPreview && previewContainer) {

        photoInput.addEventListener('change', function (event) {

            const file = event.target.files[0];

            if (currentPhotoUrl) {
                URL.revokeObjectURL(currentPhotoUrl);
                currentPhotoUrl = null;
            }

            if (!file) {
                photoPreview.removeAttribute('src');
                previewContainer.classList.add('hidden');
                return;
            }

            currentPhotoUrl = URL.createObjectURL(file);

            photoPreview.src = currentPhotoUrl;
            previewContainer.classList.remove('hidden');

        });

    }


    // ==========================================
    // YOUTUBE VIDEO PREVIEW
    // ==========================================

    const youtubeInput = document.getElementById('youtube_link');
    const youtubePreview = document.getElementById('youtube_preview');
    const youtubeContainer = document.getElementById('youtube_preview_container');


    function getYouTubeVideoId(value) {

        try {

            const url = new URL(value);

            const hostname = url.hostname.toLowerCase().replace(/^www\./, '');

            let videoId = null;

            if (hostname === 'youtu.be') {

                videoId = url.pathname.split('/')[1];

            } else if (
                hostname === 'youtube.com' ||
                hostname === 'm.youtube.com'
            ) {

                if (url.pathname === '/watch') {
                    videoId = url.searchParams.get('v');
                } else if (
                    url.pathname.startsWith('/embed/') ||
                    url.pathname.startsWith('/shorts/') ||
                    url.pathname.startsWith('/live/')
                ) {
                    videoId = url.pathname.split('/')[2];
                }

            }

            // Validasi format ID video YouTube
            if (videoId && /^[a-zA-Z0-9_-]{11}$/.test(videoId)) {
                return videoId;
            }

            return null;

        } catch (error) {

            return null;

        }

    }


    function updateYouTubePreview() {

        if (!youtubeInput || !youtubePreview || !youtubeContainer) {
            return;
        }

        const url = youtubeInput.value.trim();

        if (!url) {

            youtubePreview.removeAttribute('src');
            youtubeContainer.classList.add('hidden');

            return;

        }

        const videoId = getYouTubeVideoId(url);

        if (videoId) {

            youtubePreview.src = 'https://www.youtube.com/embed/' + videoId;
            youtubeContainer.classList.remove('hidden');

        } else {

            youtubePreview.removeAttribute('src');
            youtubeContainer.classList.add('hidden');

        }

    }


    if (youtubeInput) {

        youtubeInput.addEventListener('input', updateYouTubePreview);

        // Preview kembali muncul jika form dikembalikan dengan old value
        updateYouTubePreview();

    }

});
</script>

@endpush
