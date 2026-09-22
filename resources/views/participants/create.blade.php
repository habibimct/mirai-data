@extends('layouts.app')

@section('content')
    <div class="container py-4">

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-success text-white">
                Import Data Excel
            </div>

            <div class="card-body">
                <form action="{{ route('participants.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row align-items-center g-2">
                        <div class="col-md-6">
                            <input type="file" name="file" class="form-control" required>
                        </div>

                        <div class="col-md-3 d-grid">
                            <button class="btn btn-outline-success">
                                ⬆️ Upload
                            </button>
                        </div>

                        <div class="col-md-3 d-grid">
                            <a href="{{ asset('template.xlsx') }}" class="btn btn-outline-primary">
                                ⬇️ Template
                            </a>
                        </div>
                    </div>

                    <small class="text-muted">
                        Format: .xlsx atau .csv
                    </small>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Tambah Peserta</h5>
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

                <form action="{{ route('participants.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        {{-- KOLOM KIRI --}}
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" name="place_of_birth" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="date_of_birth" class="form-control">
                                <small class="text-muted">Umur akan dihitung otomatis</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kualifikasi</label>
                                <input type="text" name="qualification" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status Peserta</label>

                                <select name="status" class="form-select">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Sending">Sending</option>
                                    <option value="Existing">Existing</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Bahasa Jepang</label>
                                <input type="text" name="japanese_skills" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Foto</label>
                                <input type="file" name="photo" class="form-control">
                                <img id="preview" width="120" class="mt-2 d-none">
                            </div>

                        </div>

                        {{-- KOLOM KANAN --}}
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea name="address" class="form-control" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Materi</label>
                                <textarea name="materials" class="form-control" rows="2"></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Motivasi</label>
                                <textarea name="motivation" class="form-control" rows="2"></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Visi</label>
                                <textarea name="vision" class="form-control" rows="2"></textarea>
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

                            <div class="mb-3">
                                <label class="form-label">Hasil Las</label>

                                <input type="file" name="welding_photos[]" class="form-control" multiple
                                    accept="image/*">

                                <small class="text-muted">
                                    Bisa upload lebih dari satu gambar
                                </small>
                            </div>

                        </div>

                    </div>

                    {{-- BUTTON --}}
                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('participants.index') }}" class="btn btn-secondary">
                            ← Kembali
                        </a>

                        <button type="submit" class="btn btn-primary">
                            💾 Simpan Data
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

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
