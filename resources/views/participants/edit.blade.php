@extends('layouts.app')

@section('content')
    <div class="container py-4">

        <div class="card shadow-sm">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0">Edit Peserta</h5>
            </div>

            <div class="card-body">

                {{-- ERROR --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
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

                    <div class="row">

                        {{-- KOLOM KIRI --}}
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" name="name" value="{{ old('name', $participant->name) }}"
                                    class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" name="place_of_birth"
                                    value="{{ old('place_of_birth', $participant->place_of_birth) }}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="date_of_birth"
                                    value="{{ old('date_of_birth', $participant->date_of_birth) }}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kualifikasi</label>
                                <input type="text" name="qualification"
                                    value="{{ old('qualification', $participant->qualification) }}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status Peserta</label>

                                <select name="status" class="form-select">
                                    <option value="">-- Pilih Status --</option>

                                    <option value="Sending" {{ $participant->status == 'Sending' ? 'selected' : '' }}>
                                        Sending
                                    </option>

                                    <option value="Existing" {{ $participant->status == 'Existing' ? 'selected' : '' }}>
                                        Existing
                                    </option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Bahasa Jepang</label>
                                <input type="text" name="japanese_skills"
                                    value="{{ old('japanese_skills', $participant->japanese_skills) }}"
                                    class="form-control">
                            </div>

                            {{-- FOTO LAMA --}}
                            <div class="mb-3">
                                <label class="form-label">Foto Saat Ini</label><br>

                                @if ($participant->photo)
                                    <img src="{{ asset($participant->photo) }}" width="120" class="rounded border">
                                @else
                                    <p class="text-muted">Belum ada foto</p>
                                @endif
                            </div>

                            {{-- GANTI FOTO --}}
                            <div class="mb-3">
                                <label class="form-label">Ganti Foto</label>
                                <input type="file" name="photo" class="form-control">
                                <img id="preview" class="mt-2 d-none rounded" width="120">
                            </div>

                        </div>

                        {{-- KOLOM KANAN --}}
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea name="address" class="form-control" rows="3">{{ old('address', $participant->address) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Materi</label>
                                <textarea name="materials" class="form-control" rows="2">{{ old('materials', $participant->materials) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Motivasi</label>
                                <textarea name="motivation" class="form-control" rows="2">{{ old('motivation', $participant->motivation) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Visi</label>
                                <textarea name="vision" class="form-control" rows="2">{{ old('vision', $participant->vision) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Link YouTube</label>
                                <input type="url" name="youtube_link" id="youtube_link" class="form-control"
                                    placeholder="https://youtube.com/...">

                                <div class="mt-3">
                                    <iframe id="youtube_preview" class="w-100 d-none" height="250" frameborder="0"
                                        allowfullscreen>
                                    </iframe>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold fs-5">
                                    Hasil Las
                                </label>

                                {{-- INPUT --}}
                                <input type="file" name="welding_photos[]" class="form-control mb-4" multiple
                                    accept="image/*">

                                {{-- GALLERY --}}
                                @if ($participant->welding_photos)
                                    <div class="row g-4">

                                        @foreach ($participant->welding_photos as $index => $photo)
                                            <div class="col-6 col-md-4 col-lg-3">

                                                <div class="gallery-card">

                                                    {{-- CHECKBOX --}}
                                                    <input type="checkbox" name="delete_photos[]"
                                                        value="{{ $photo }}" id="delete{{ $index }}"
                                                        class="d-none delete-checkbox">

                                                    {{-- IMAGE --}}
                                                    <img src="{{ asset($photo) }}" class="gallery-image">

                                                    {{-- DELETE BUTTON --}}
                                                    <label for="delete{{ $index }}" class="delete-btn">

                                                        &times;

                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>

                    {{-- BUTTON --}}
                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('participants.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>

                        <button type="submit" class="btn btn-warning">
                            Update Data
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    {{-- ------------------- --}}

    <style>
        .gallery-card {
            position: relative;
            overflow: hidden;
            border-radius: 20px;
            background: #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, .08);
            transition: .3s;
        }

        .gallery-card:hover {
            transform: translateY(-5px);
        }

        .gallery-image {
            width: 100%;
            height: 230px;
            object-fit: cover;
            display: block;
            transition: .3s;
        }

        .gallery-image:hover {
            transform: scale(1.05);
        }

        .delete-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: rgba(220, 53, 69, .95);
            color: white;
            font-size: 24px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: .2s;
            z-index: 10;
        }

        .delete-btn:hover {
            background: #dc3545;
            transform: scale(1.1);
        }

        /* Efek saat dipilih hapus */
        .delete-checkbox:checked~.gallery-image {
            opacity: .25;
            filter: grayscale(100%);
            transform: scale(.95);
        }

        .delete-checkbox:checked~.delete-btn {
            background: black;
        }
    </style>

    {{-- -------------------- --}}

    {{-- PREVIEW FOTO --}}
    <script>
        document.querySelector('input[name="photo"]').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('preview');

            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('d-none');
            }
        });
    </script>

    {{-- PREVIEW YOUTUBE --}}
    <script>
        document.getElementById('youtube_link').addEventListener('input', function() {
            let url = this.value;
            let iframe = document.getElementById('youtube_preview');

            if (!url) {
                iframe.classList.add('d-none');
                return;
            }

            // Ambil ID video
            let videoId = null;

            if (url.includes("watch?v=")) {
                videoId = url.split("v=")[1].split("&")[0];
            } else if (url.includes("youtu.be/")) {
                videoId = url.split("youtu.be/")[1];
            }

            if (videoId) {
                iframe.src = "https://www.youtube.com/embed/" + videoId;
                iframe.classList.remove('d-none');
            } else {
                iframe.classList.add('d-none');
            }
        });
    </script>

@endsection
