@extends('layouts.app')

@section('title', 'Edit Peserta | LPK Mirai Gresik')

@section('content')

    @php
        $inputClass =
            'block w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-800 shadow-sm outline-none transition-all duration-200 placeholder:text-slate-400 hover:border-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100';

        $textareaClass =
            'block w-full resize-y rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-800 shadow-sm outline-none transition-all duration-200 placeholder:text-slate-400 hover:border-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100';

        $labelClass = 'mb-1.5 block text-xs font-semibold text-slate-700';

        $fileClass =
            'block w-full cursor-pointer rounded-lg border border-slate-300 bg-white text-xs text-slate-600 shadow-sm transition file:mr-3 file:cursor-pointer file:border-0 file:bg-slate-50 file:px-3 file:py-2.5 file:text-xs file:font-semibold file:text-slate-700 hover:file:bg-slate-100 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100';

        $dateValue = $participant->date_of_birth
            ? \Illuminate\Support\Carbon::parse($participant->date_of_birth)->format('Y-m-d')
            : '';
    @endphp


    <div class="mx-auto w-full max-w-7xl px-4 py-6 sm:px-6 lg:px-8">

        <!-- ==========================================
                     PAGE HEADER
                =========================================== -->

        <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

            <div>

                <div class="mb-2 flex items-center gap-2 text-xs text-slate-500">

                    <a href="{{ route('participants.index') }}" class="no-underline transition-colors hover:text-blue-600">
                        Data Peserta
                    </a>

                    <i class="bi bi-chevron-right text-[10px]"></i>

                    <span class="font-medium text-slate-700">
                        Edit Peserta
                    </span>

                </div>

                <h2 class="text-2xl font-bold tracking-tight text-slate-900">
                    Edit Peserta
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Perbarui informasi dan data peserta.
                </p>

            </div>

            <a href="{{ $returnUrl ?? route('participants.index') }}"
                class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 shadow-sm no-underline transition-all duration-200 hover:border-slate-300 hover:bg-slate-50 active:scale-[0.98]">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>

        </div>


        <!-- ==========================================
                     MAIN FORM
                =========================================== -->

        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

            <!-- FORM HEADER -->
            <div class="flex items-center gap-3 border-b border-amber-100 bg-amber-50/60 px-5 py-3.5">

                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-amber-100 text-amber-700">
                    <i class="bi bi-pencil-square text-lg"></i>
                </div>

                <div>
                    <h3 class="text-sm font-bold text-slate-800">
                        Edit Informasi Peserta
                    </h3>

                    <p class="mt-0.5 text-xs text-slate-500">
                        Perbarui data sesuai informasi terbaru peserta.
                    </p>
                </div>

            </div>


            <div class="p-5 sm:p-6">

                <!-- ==================================
                             VALIDATION ERRORS
                        =================================== -->

                @if ($errors->any())

                    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4">

                        <div class="mb-2 flex items-center gap-2 text-sm font-bold text-red-700">
                            <i class="bi bi-exclamation-circle-fill"></i>
                            Terdapat kesalahan pada pengisian form.
                        </div>

                        <ul class="ml-6 list-disc space-y-1 text-sm text-red-600">

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </ul>

                    </div>

                @endif


                <form action="{{ route('participants.update', $participant->id) }}" method="POST"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <input type="hidden" name="return_url" value="{{ $returnUrl ?? route('participants.index') }}">


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

                                <label for="name" class="{{ $labelClass }}">
                                    Nama Lengkap
                                    <span class="text-red-500">*</span>
                                </label>

                                <input type="text" id="name" name="name"
                                    value="{{ old('name', $participant->name) }}" required
                                    placeholder="Masukkan nama lengkap peserta" class="{{ $inputClass }}">

                            </div>


                            <!-- TEMPAT LAHIR -->
                            <div>

                                <label for="place_of_birth" class="{{ $labelClass }}">
                                    Tempat Lahir
                                    <span class="text-red-500">*</span>
                                </label>

                                <input type="text" id="place_of_birth" name="place_of_birth"
                                    value="{{ old('place_of_birth', $participant->place_of_birth) }}"
                                    placeholder="Contoh: Gresik" class="{{ $inputClass }}">

                            </div>


                            <!-- TANGGAL LAHIR -->
                            <div>

                                <label for="date_of_birth" class="{{ $labelClass }}">
                                    Tanggal Lahir
                                    <span class="text-red-500">*</span>
                                </label>

                                <input type="date" id="date_of_birth" name="date_of_birth"
                                    value="{{ old('date_of_birth', $dateValue) }}" class="{{ $inputClass }}">

                            </div>


                            <!-- KUALIFIKASI -->
                            <div>

                                <label for="qualification" class="{{ $labelClass }}">
                                    Kualifikasi
                                    <span class="text-red-500">*</span>
                                </label>

                                <input type="text" id="qualification" name="qualification"
                                    value="{{ old('qualification', $participant->qualification) }}"
                                    placeholder="Masukkan kualifikasi peserta" class="{{ $inputClass }}">

                            </div>


                            <!-- STATUS -->
                            <div>

                                <label for="status" class="{{ $labelClass }}">
                                    Status Peserta
                                </label>

                                <select id="status" name="status" class="{{ $inputClass }} cursor-pointer">

                                    <option value="">-- Pilih Status --</option>

                                    <option value="Sending" @selected(old('status', $participant->status) == 'Sending')>
                                        Sending
                                    </option>

                                    <option value="Existing" @selected(old('status', $participant->status) == 'Existing')>
                                        Existing
                                    </option>

                                </select>

                            </div>


                            <!-- JAPANESE SKILLS -->
                            <div>

                                <label for="japanese_skills" class="{{ $labelClass }}">
                                    Kemampuan Bahasa Jepang
                                </label>

                                <input type="text" id="japanese_skills" name="japanese_skills"
                                    value="{{ old('japanese_skills', $participant->japanese_skills) }}"
                                    placeholder="Contoh: N5, N4, JFT A2" class="{{ $inputClass }}">

                            </div>


                            <!-- ==================================
                                         CURRENT PHOTO
                                    =================================== -->

                            <div>

                                <label class="{{ $labelClass }}">
                                    Foto Saat Ini
                                </label>

                                @if ($participant->photo)
                                    <div class="inline-flex rounded-xl border border-slate-200 bg-slate-50 p-2">

                                        <img src="{{ asset($participant->photo) }}" alt="Foto {{ $participant->name }}"
                                            class="h-32 w-32 rounded-lg object-cover">

                                    </div>
                                @else
                                    <div
                                        class="flex items-center gap-2 rounded-lg border border-dashed border-slate-300 bg-slate-50 p-4">

                                        <i class="bi bi-image text-xl text-slate-400"></i>

                                        <p class="text-xs text-slate-500">
                                            Belum ada foto peserta.
                                        </p>

                                    </div>
                                @endif

                            </div>


                            <!-- ==================================
                                         REPLACE PHOTO
                                    =================================== -->

                            <div>

                                <label for="photo" class="{{ $labelClass }}">
                                    Ganti Foto
                                </label>

                                <input type="file" id="photo" name="photo" accept="image/*"
                                    class="{{ $fileClass }}">

                                <p class="mt-1.5 text-[11px] text-slate-400">
                                    Pilih foto baru apabila ingin mengganti foto saat ini.
                                </p>


                                <!-- NEW PHOTO PREVIEW -->
                                <div id="preview_container" class="mt-3 hidden">

                                    <p class="mb-2 text-xs font-semibold text-slate-600">
                                        Preview Foto Baru
                                    </p>

                                    <div class="inline-flex rounded-xl border border-blue-200 bg-blue-50 p-2">

                                        <img id="preview" alt="Preview foto baru"
                                            class="h-32 w-32 rounded-lg object-cover">

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

                                <label for="address" class="{{ $labelClass }}">
                                    Alamat
                                </label>

                                <textarea id="address" name="address" rows="3" placeholder="Masukkan alamat lengkap peserta"
                                    class="{{ $textareaClass }}">{{ old('address', $participant->address) }}</textarea>

                            </div>


                            <!-- MATERI -->
                            <div>

                                <label for="materials" class="{{ $labelClass }}">
                                    Materi
                                </label>

                                <textarea id="materials" name="materials" rows="2" placeholder="Masukkan materi pelatihan"
                                    class="{{ $textareaClass }}">{{ old('materials', $participant->materials) }}</textarea>

                            </div>


                            <!-- MOTIVASI -->
                            <div>

                                <label for="motivation" class="{{ $labelClass }}">
                                    Motivasi
                                </label>

                                <textarea id="motivation" name="motivation" rows="2" placeholder="Masukkan motivasi peserta"
                                    class="{{ $textareaClass }}">{{ old('motivation', $participant->motivation) }}</textarea>

                            </div>


                            <!-- VISI -->
                            <div>

                                <label for="vision" class="{{ $labelClass }}">
                                    Visi
                                </label>

                                <textarea id="vision" name="vision" rows="2" placeholder="Masukkan visi peserta"
                                    class="{{ $textareaClass }}">{{ old('vision', $participant->vision) }}</textarea>

                            </div>


                            <!-- ==================================
                                         YOUTUBE
                                    =================================== -->

                            <div>

                                <label for="youtube_link" class="{{ $labelClass }}">
                                    Link YouTube
                                </label>

                                <div class="relative">

                                    <div
                                        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-red-500">
                                        <i class="bi bi-youtube text-lg"></i>
                                    </div>

                                    <input type="url" name="youtube_link" id="youtube_link"
                                        value="{{ old('youtube_link', $participant->youtube_link) }}"
                                        placeholder="https://youtube.com/..." class="{{ $inputClass }} pl-10">

                                </div>


                                <!-- YOUTUBE PREVIEW -->
                                <div id="youtube_preview_container" class="mt-3 hidden">

                                    <p class="mb-2 text-xs font-semibold text-slate-600">
                                        <i class="bi bi-play-circle-fill mr-1 text-red-500"></i>
                                        Preview Video
                                    </p>

                                    <div
                                        class="aspect-video overflow-hidden rounded-xl border border-slate-200 bg-slate-100">

                                        <iframe id="youtube_preview" class="h-full w-full" title="YouTube Video Preview"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

                                    </div>

                                </div>

                            </div>



                            {{-- ==========================================
                                VIDEO SKILL PESERTA
                            =========================================== --}}

                            <div>

                                <label for="skill_video_link" class="mb-2 block text-sm font-semibold text-slate-700">
                                    Link Video Skill Peserta
                                </label>

                                <div class="relative">

                                    <div
                                        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                        <i class="bi bi-camera-video-fill text-lg"></i>
                                    </div>

                                    <input type="url" name="skill_video_link" id="skill_video_link"
                                        value="{{ old('skill_video_link', $participant->skill_video_link) }}"
                                        placeholder="https://youtube.com/..."
                                        class="block w-full rounded-xl border border-slate-300 bg-white py-3 pl-11 pr-4 text-sm text-slate-800 shadow-sm outline-none transition-all placeholder:text-slate-400 hover:border-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100">

                                </div>

                                @error('skill_video_link')
                                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                                @enderror

                                {{-- VIDEO SKILL PREVIEW --}}
                                <div id="skill_video_preview_container" class="mt-4 hidden">

                                    <div class="mb-2 flex items-center gap-2 text-xs font-semibold text-slate-500">
                                        <i class="bi bi-play-circle-fill text-blue-500"></i>
                                        Preview Video Skill
                                    </div>

                                    <div
                                        class="aspect-video overflow-hidden rounded-xl border border-slate-200 bg-slate-100 shadow-sm">

                                        <iframe id="skill_video_preview" class="h-full w-full"
                                            title="Video Skill Peserta" frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

                                    </div>

                                </div>

                            </div>




                            <!-- ==================================
                                WELDING PHOTOS
                            =================================== -->

                            <div class="pt-2">

                                <div class="mb-3 flex items-center justify-between gap-3">

                                    <div>
                                        <h4 class="text-sm font-bold text-slate-800">
                                            Hasil Las
                                        </h4>

                                        <p class="mt-0.5 text-[11px] text-slate-400">
                                            Galeri hasil pekerjaan pengelasan.
                                        </p>
                                    </div>

                                    <span class="rounded-lg bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600">
                                        {{ is_countable($participant->welding_photos) ? count($participant->welding_photos) : 0 }}
                                        Foto
                                    </span>

                                </div>

                                <!-- ADD WELDING PHOTOS -->
                                <input type="file" id="welding_photos" name="welding_photos[]" multiple
                                    accept="image/jpeg,image/png" class="{{ $fileClass }}">

                                <div class="mt-2 space-y-1">

                                    <p class="flex items-center gap-1.5 text-[11px] text-slate-400">
                                        <i class="bi bi-images"></i>
                                        Bisa mengunggah lebih dari satu gambar.
                                    </p>

                                    <p class="flex items-center gap-1.5 text-[11px] text-blue-600">
                                        <i class="bi bi-stars"></i>
                                        Maksimal 5 MB per foto. Gambar otomatis dikompres saat disimpan.
                                    </p>

                                    <p class="text-[11px] text-slate-400">
                                        Format JPG dan PNG.
                                    </p>

                                </div>

                                <!-- VALIDATION ERRORS -->
                                @error('welding_photos')
                                    <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                                @enderror

                                @error('welding_photos.*')
                                    <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                                @enderror


                                <!-- EXISTING GALLERY -->
                                @if ($participant->welding_photos && count($participant->welding_photos))

                                    <div class="mt-4 grid grid-cols-2 gap-3 sm:grid-cols-3">

                                        @foreach ($participant->welding_photos as $index => $photo)
                                            <div
                                                class="group relative overflow-hidden rounded-xl border border-slate-200 bg-slate-50 shadow-sm">

                                                <!-- DELETE CHECKBOX -->
                                                <input type="checkbox" name="delete_photos[]"
                                                    value="{{ $photo }}" id="delete-photo-{{ $index }}"
                                                    class="peer sr-only">

                                                <!-- IMAGE -->
                                                <img src="{{ asset($photo) }}"
                                                    alt="Hasil pengelasan {{ $index + 1 }}"
                                                    class="aspect-[4/3] w-full object-cover transition-all duration-300 peer-checked:scale-95 peer-checked:opacity-30 peer-checked:grayscale group-hover:scale-[1.03]">

                                                <!-- DELETION OVERLAY -->
                                                <div
                                                    class="pointer-events-none absolute inset-0 flex items-center justify-center bg-white/20 opacity-0 transition-opacity peer-checked:opacity-100">

                                                    <span
                                                        class="rounded-lg bg-slate-900/85 px-3 py-1.5 text-xs font-semibold text-white">
                                                        Ditandai untuk dihapus
                                                    </span>

                                                </div>

                                                <!-- DELETE BUTTON -->
                                                <label for="delete-photo-{{ $index }}"
                                                    title="Tandai foto untuk dihapus"
                                                    class="absolute right-2 top-2 flex h-8 w-8 cursor-pointer items-center justify-center rounded-lg bg-red-500 text-white shadow-md transition-all duration-200 hover:bg-red-600 active:scale-90 peer-checked:bg-slate-800 peer-checked:hover:bg-slate-900">
                                                    <i class="bi bi-trash3 text-sm"></i>
                                                </label>

                                                <!-- PHOTO NUMBER -->
                                                <div
                                                    class="absolute bottom-2 left-2 rounded-md bg-slate-900/70 px-2 py-1 text-[10px] font-semibold text-white">
                                                    Foto {{ $index + 1 }}
                                                </div>

                                            </div>
                                        @endforeach

                                    </div>

                                    <div
                                        class="mt-3 flex items-start gap-2 rounded-lg bg-amber-50 p-3 text-xs text-amber-700">

                                        <i class="bi bi-info-circle mt-0.5"></i>

                                        <p>
                                            Klik ikon tempat sampah untuk menandai foto yang ingin dihapus.
                                            Foto akan dihapus setelah perubahan disimpan.
                                        </p>

                                    </div>
                                @else
                                    <div
                                        class="mt-4 flex flex-col items-center justify-center rounded-xl border border-dashed border-slate-300 bg-slate-50 py-8 text-center">

                                        <i class="bi bi-images mb-2 text-3xl text-slate-300"></i>

                                        <p class="text-xs font-medium text-slate-500">
                                            Belum ada foto hasil las.
                                        </p>

                                    </div>

                                @endif

                            </div>


                            <!-- ==========================================
                                 FORM ACTIONS
                            =========================================== -->

                            <div
                                class="mt-8 flex flex-col-reverse justify-between gap-3 border-t border-slate-100 pt-6 sm:flex-row sm:items-center">

                                <a href="{{ $returnUrl ?? route('participants.index') }}"
                                    class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 no-underline shadow-sm transition-all duration-200 hover:border-slate-300 hover:bg-slate-50 active:scale-[0.98]">
                                    <i class="bi bi-arrow-left"></i>
                                    Kembali
                                </a>

                                <button type="submit"
                                    class="mobile-pressable inline-flex items-center justify-center gap-2 rounded-lg bg-amber-500 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition-all duration-200 hover:bg-amber-600 hover:shadow-md active:scale-[0.98] focus:outline-none focus:ring-4 focus:ring-amber-100">
                                    <i class="bi bi-check2-circle"></i>
                                    Update Data Peserta
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
        document.addEventListener('DOMContentLoaded', function() {

            // ==========================================
            // PHOTO PREVIEW
            // ==========================================

            const photoInput = document.getElementById('photo');
            const photoPreview = document.getElementById('preview');
            const previewContainer = document.getElementById('preview_container');

            let currentPhotoUrl = null;

            if (photoInput && photoPreview && previewContainer) {

                photoInput.addEventListener('change', function(event) {

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

                    const segments = url.pathname.split('/').filter(Boolean);

                    let videoId = null;

                    if (hostname === 'youtu.be') {

                        videoId = segments[0];

                    } else if (
                        hostname === 'youtube.com' ||
                        hostname === 'm.youtube.com'
                    ) {

                        if (url.pathname === '/watch') {

                            videoId = url.searchParams.get('v');

                        } else if (
                            ['embed', 'shorts', 'live'].includes(segments[0])
                        ) {

                            videoId = segments[1];

                        }

                    }

                    // Validasi ID video YouTube
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

                // Menampilkan video yang sudah tersimpan
                updateYouTubePreview();

            }



            // ==========================================
            // VIDEO SKILL PREVIEW
            // ==========================================

            const skillVideoInput = document.getElementById('skill_video_link');
            const skillVideoPreview = document.getElementById('skill_video_preview');
            const skillVideoContainer = document.getElementById('skill_video_preview_container');

            function updateSkillVideoPreview() {

                if (!skillVideoInput || !skillVideoPreview || !skillVideoContainer) {
                    return;
                }

                const url = skillVideoInput.value.trim();

                if (!url) {
                    skillVideoPreview.removeAttribute('src');
                    skillVideoContainer.classList.add('hidden');
                    return;
                }

                // Menggunakan fungsi getYouTubeVideoId() yang sudah ada
                const videoId = getYouTubeVideoId(url);

                if (videoId) {

                    skillVideoPreview.src = 'https://www.youtube.com/embed/' + videoId;
                    skillVideoContainer.classList.remove('hidden');

                } else {

                    skillVideoPreview.removeAttribute('src');
                    skillVideoContainer.classList.add('hidden');

                }
            }

            if (skillVideoInput) {

                skillVideoInput.addEventListener('input', updateSkillVideoPreview);

                // Preview muncul kembali jika terdapat old value
                updateSkillVideoPreview();

            }

        });
    </script>
@endpush
