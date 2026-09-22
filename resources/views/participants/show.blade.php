@extends('layouts.app')

@section('content')
    <div class="container py-4">

        <form method="GET" action="{{ route('participants.show', $participant->id) }}" class="row g-2 mb-3">

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
                <a href="{{ route('participants.show', $participant->id) }}" class="btn btn-outline-secondary">
                    Reset
                </a>
            </div>

        </form>

        <div class="card shadow-sm">
            <div class="card-body">

                <div class="row">

                    {{-- FOTO --}}
                    <div class="col-md-4 text-center">
                        @if ($participant->photo)
                            <img src="{{ asset($participant->photo) }}"
                                class="rounded shadow border d-block mx-auto"
                                style="width:250px;height:250px;object-fit:cover;">
                        @else
                            <div class="text-muted">Tidak ada foto</div>
                        @endif

                        <h4 class="mt-2">{{ $participant->name }}</h4>

                        <span class="badge bg-primary">
                            {{ $participant->age ?? '-' }} Tahun
                        </span>
                    </div>

                    {{-- DATA --}}
                    <div class="col-md-8 border-1">

                        <h5 class="mb-2 mt-3 text-center fw-bold">Informasi Peserta</h5>

                        <hr>

                        <table class="table table-border">
                            <tr>
                                <th width="150">Tempat, Tgl Lahir</th>
                                <td>
                                    {{ $participant->place_of_birth ?? '-' }},
                                    {{ \Carbon\Carbon::parse($participant->date_of_birth)->translatedFormat('d F Y') }}
                                </td>
                            </tr>

                            <tr>
                                <th>Alamat</th>
                                <td>{{ $participant->address ?? '-' }}</td>
                            </tr>

                            <tr>
                                <th>Kualifikasi</th>
                                <td>{{ $participant->qualification ?? '-' }}</td>
                            </tr>

                            <tr>
                                <th>Status Peserta</th>
                                <td>
                                    @if ($participant->status == 'Sending')
                                        <span class="badge bg-success">
                                            Sending
                                        </span>
                                    @elseif($participant->status == 'Existing')
                                        <span class="badge bg-primary">
                                            Existing
                                        </span>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th>Bahasa Jepang</th>
                                <td>
                                    <span class="badge bg-success">
                                        {{ $participant->japanese_skills ?? '-' }}
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <th>Materi</th>
                                <td>{{ $participant->materials ?? '-' }}</td>
                            </tr>

                            <tr>
                                <th>Motivasi</th>
                                <td>{{ $participant->motivation ?? '-' }}</td>
                            </tr>

                            <tr>
                                <th>Visi</th>
                                <td>{{ $participant->vision ?? '-' }}</td>
                            </tr>
                        </table>

                    </div>

                    @if ($participant->youtube_link)
                        <div class="mt-3">
                            <iframe width="100%" height="315" src="{{ $participant->youtube_link }}" frameborder="0"
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        </div>
                    @endif

                    {{-- HASIL LAS --}}
                    @if ($participant->welding_photos)
                        <div class="card shadow border-0 rounded-4 mt-4 overflow-hidden">

                            <div class="card-header bg-danger text-white py-2">
                                <h5 class="mb-0 fw-bold text-center">
                                    Hasil Las
                                </h5>
                            </div>

                            <div class="card-body bg-light">

                                <div class="row g-4">

                                    @foreach ($participant->welding_photos as $photo)
                                        <div class="col-6 col-md-4 col-lg-3">

                                            <div class="welding-card">

                                                <img src="{{ asset($photo) }}"
                                                    class="img-fluid rounded-4 shadow-sm border welding-image"
                                                    onclick="openImage(this.src)">

                                            </div>

                                        </div>
                                    @endforeach

                                </div>

                            </div>
                        </div>

                        {{-- IMAGE VIEWER --}}
                        <div id="imageViewer" class="image-viewer" onclick="closeImage()">

                            <span class="close-btn">&times;</span>

                            <img id="viewerImage">

                        </div>
                    @endif

                    {{-- BUTTON --}}
                    <div class="d-flex justify-content-between mt-4 mb-2">

                        {{-- PREVIOUS --}}
                        @if ($previous)
                            <a href="{{ route('participants.show', $previous->id) }}?{{ http_build_query(request()->all()) }}"
                                class="btn btn-outline-primary">
                                Sebelumnya
                            </a>
                        @else
                            <span></span>
                        @endif

                        {{-- NEXT --}}
                        @if ($next)
                            <a href="{{ route('participants.show', $next->id) }}?{{ http_build_query(request()->all()) }}"
                                class="btn btn-outline-primary">
                                Berikutnya
                            </a>
                        @endif

                    </div>
                    <div class="d-flex justify-content-between">

                        <div class="">
                            <a href="{{ route('participants.index') }}" class="btn btn-outline-secondary">
                                Kembali
                            </a>
                        </div>

                        @auth
                            @if (auth()->user()->role == 'admin')
                                <div class="">
                                    <a href="{{ route('participants.edit', $participant->id) }}"
                                        class="btn btn-outline-warning">
                                        Edit
                                    </a>

                                    <form action="{{ route('participants.destroy', $participant->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Yakin hapus data?')">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-outline-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth

                    </div>

                </div>

            </div>
        </div>

    </div>

    {{-- -------------------- --}}

    {{-- STYLE --}}
    <style>
        .welding-card {
            overflow: hidden;
            border-radius: 20px;
        }

        .welding-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
            cursor: pointer;
            transition: .3s;
        }

        .welding-image:hover {
            transform: scale(1.05);
            filter: brightness(0.8);
        }

        /* FULLSCREEN VIEWER */
        .image-viewer {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.9);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            padding: 30px;
        }

        .image-viewer img {
            max-width: 95%;
            max-height: 95%;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.2);
            animation: zoomIn .2s ease;
        }

        .close-btn {
            position: absolute;
            top: 20px;
            right: 35px;
            font-size: 45px;
            color: white;
            cursor: pointer;
        }

        @keyframes zoomIn {
            from {
                transform: scale(.8);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>

    {{-- ------------------- --}}

    {{-- SCRIPT --}}
    <script>
        function openImage(src) {

            document.getElementById('viewerImage').src = src;

            document.getElementById('imageViewer').style.display = 'flex';
        }

        function closeImage() {

            document.getElementById('imageViewer').style.display = 'none';
        }
    </script>
@endsection
