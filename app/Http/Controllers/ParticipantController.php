<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participant;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ParticipantsImport;

class ParticipantController extends Controller
{
    // =========================
    // 1. LIST DATA
    // =========================
    public function index(Request $request)
    {
        $query = Participant::query();

        // =========================
        // SEARCH (nama)
        // =========================
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // =========================
        // FILTER KUALIFIKASI
        // =========================
        if ($request->filled('qualification')) {
            $filter = $request->qualification;
            $query->where(function ($q) use ($filter) {
                $q->where('qualification', $filter)
                    ->orWhere('status', $filter);
            });
        }

        // =========================
        // FILTER USIA (pakai tanggal lahir)
        // =========================
        if ($request->filled('age_min')) {
            $query->whereDate('date_of_birth', '<=', now()->subYears($request->age_min));
        }

        if ($request->filled('age_max')) {
            $query->whereDate('date_of_birth', '>=', now()->subYears($request->age_max));
        }

        // =========================
        // SORT
        // =========================
        if ($request->filled('sort')) {
            $direction = $request->get('direction', 'asc');

            switch ($request->sort) {

                case 'name':
                    $query->orderBy('name', $direction);
                    break;

                case 'qualification':
                    $query->orderBy('qualification', $direction);
                    break;

                case 'age':
                    // umur = kebalikan dari tanggal lahir
                    $query->orderBy('date_of_birth', $direction == 'asc' ? 'desc' : 'asc');
                    break;

                case 'date_of_birth':
                    $query->orderBy('date_of_birth', $direction);
                    break;

                case 'status':
                    $query->orderBy('status', $direction);
                    break;

                default:
                    $query->latest();
                    break;
            }
        } else {
            $query->latest();
        }

        // =========================
        // PAGINATION
        // =========================
        $perPage = $request->get('per_page', 10);

        if ($perPage == 'all') {
            $participants = $query->get();
        } else {
            $participants = $query->paginate($perPage)
                ->appends($request->query());
        }

        // =========================
        // AMBIL KUALIFIKASI OTOMATIS
        // =========================
        $qualifications = Participant::whereNotNull('qualification')
            ->where('qualification', '!=', '')
            ->pluck('qualification')
            ->toArray();

        $statuses = Participant::whereNotNull('status')
            ->where('status', '!=', '')
            ->pluck('status')
            ->toArray();

        $filters = collect(array_merge($qualifications, $statuses))
            ->unique()
            ->sort()
            ->values();

        return view('participants.index', compact('participants', 'filters'));
    }

    // =========================
    // 2. FORM CREATE
    // =========================
    public function create()
    {
        return view('participants.create');
    }

    // =========================
    // 3. SIMPAN DATA
    // =========================
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'place_of_birth' => 'nullable',
            'date_of_birth' => 'required|date',
            'address' => 'nullable',
            'status' => 'nullable|in:Sending,Existing',
            'japanese_skills' => 'nullable',
            'materials' => 'nullable',
            'motivation' => 'nullable',
            'vision' => 'nullable',
            'youtube_link' => 'nullable|url',
            'skill_video_link' => 'nullable|url',
            'welding_photos' => 'nullable|array',
            'welding_photos.*' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        // Hitung umur otomatis dari tanggal lahir
        $data['age'] = \Carbon\Carbon::parse($data['date_of_birth'])->age;

        $data['youtube_link'] = $this->convertYoutube($request->youtube_link);

        $data['skill_video_link'] = $request->filled('skill_video_link')
            ? $this->convertYoutube($request->skill_video_link)
            : null;

        if ($request->hasFile('photo')) {

            $file = $request->file('photo');

            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(
                public_path('uploads/participants'),
                $filename
            );

            $data['photo'] = 'uploads/participants/' . $filename;
        }

        if ($request->hasFile('welding_photos')) {

            $photos = [];

            foreach ($request->file('welding_photos') as $file) {

                $photos[] = $this->compressWeldingPhoto($file);
            }

            $data['welding_photos'] = $photos;
        }

        Participant::create($data);

        return redirect()
            ->route('participants.index')
            ->with('success', 'Peserta berhasil ditambahkan.');
    }

    // =========================
    // 4. DETAIL
    // =========================
    public function show($id, Request $request)
    {
        $participant = Participant::findOrFail($id);

        $returnUrl = $request->query('return_url');

        // =========================
        // BASE QUERY (FILTER)
        // =========================
        $query = Participant::query();

        if ($request->filled('qualification')) {
            $filter = $request->qualification;
            $query->where(function ($q) use ($filter) {

                $q->where('qualification', $filter)
                    ->orWhere('status', $filter);
            });
        }

        if ($request->filled('age_min')) {
            $query->whereDate('date_of_birth', '<=', now()->subYears($request->age_min));
        }

        if ($request->filled('age_max')) {
            $query->whereDate('date_of_birth', '>=', now()->subYears($request->age_max));
        }

        // =========================
        // NEXT & PREVIOUS (PAKAI FILTER)
        // =========================
        $previous = (clone $query)
            ->where('id', '<', $participant->id)
            ->orderBy('id', 'desc')
            ->first();

        $next = (clone $query)
            ->where('id', '>', $participant->id)
            ->orderBy('id')
            ->first();

        // =========================
        // DROPDOWN KUALIFIKASI
        // =========================
        $qualifications = Participant::whereNotNull('qualification')
            ->where('qualification', '!=', '')
            ->pluck('qualification')
            ->toArray();

        $statuses = Participant::whereNotNull('status')
            ->where('status', '!=', '')
            ->pluck('status')
            ->toArray();

        $filters = collect(array_merge($qualifications, $statuses))
            ->unique()
            ->sort()
            ->values();

        return view('participants.show', compact(
            'participant',
            'previous',
            'next',
            'qualifications',
            'filters',
            'returnUrl'
        ));
    }

    // =========================
    // 5. FORM EDIT
    // =========================
    public function edit(Request $request, $id)
    {
        $participant = Participant::findOrFail($id);

        $returnUrl = $request->query('return_url');

        return view('participants.edit', compact(
            'participant',
            'returnUrl'
        ));
    }

    // =========================
    // 6. UPDATE DATA
    // =========================

    public function update(Request $request, $id)
    {
        $participant = Participant::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'place_of_birth' => 'nullable',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable',
            'status' => 'nullable|in:Sending,Existing',
            'japanese_skills' => 'nullable',
            'materials' => 'nullable',
            'motivation' => 'nullable',
            'vision' => 'nullable',
            'youtube_link' => 'nullable|url',
            'skill_video_link' => 'nullable|url',

            // FOTO HASIL LAS: MAKSIMAL 5 MB PER FOTO
            'welding_photos' => 'nullable|array',
            'welding_photos.*' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',

            // FOTO YANG AKAN DIHAPUS
            'delete_photos' => 'nullable|array',
            'delete_photos.*' => 'string',
        ]);

        // ==========================================
        // HITUNG UMUR OTOMATIS
        // ==========================================

        if (array_key_exists('date_of_birth', $data)) {
            $data['age'] = !empty($data['date_of_birth'])
                ? \Carbon\Carbon::parse($data['date_of_birth'])->age
                : null;
        }

        // ==========================================
        // YOUTUBE VIDEO
        // ==========================================

        if ($request->filled('youtube_link')) {
            $data['youtube_link'] = $this->convertYoutube($request->youtube_link);
        } else {
            unset($data['youtube_link']);
        }

        // ==========================================
        // SKILL VIDEO
        // ==========================================

        if ($request->filled('skill_video_link')) {
            $data['skill_video_link'] = $this->convertYoutube($request->skill_video_link);
        } else {
            unset($data['skill_video_link']);
        }

        // ==========================================
        // FOTO PROFIL
        // ==========================================

        if ($request->hasFile('photo')) {

            if ($participant->photo && Storage::exists('public/' . $participant->photo)) {
                Storage::delete('public/' . $participant->photo);
            }

            $file = $request->file('photo');

            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(
                public_path('uploads/participants'),
                $filename
            );

            $data['photo'] = 'uploads/participants/' . $filename;
        }

        // ==========================================
        // FOTO HASIL LAS
        // ==========================================

        // Ambil foto lama
        $existingPhotos = $participant->welding_photos ?? [];

        // Pastikan berupa array
        if (!is_array($existingPhotos)) {
            $existingPhotos = [];
        }

        // ==========================================
        // HAPUS FOTO TERPILIH
        // ==========================================

        foreach ($request->input('delete_photos', []) as $photo) {

            // Pastikan foto memang milik peserta ini
            if (in_array($photo, $existingPhotos, true)) {

                $filePath = public_path($photo);

                if (is_file($filePath)) {
                    unlink($filePath);
                }

                $existingPhotos = array_values(
                    array_filter(
                        $existingPhotos,
                        fn($p) => $p !== $photo
                    )
                );
            }
        }

        // ==========================================
        // UPLOAD FOTO BARU + KOMPRES OTOMATIS
        // ==========================================

        if ($request->hasFile('welding_photos')) {

            foreach ($request->file('welding_photos') as $file) {

                $existingPhotos[] = $this->compressWeldingPhoto($file);
            }
        }

        // ==========================================
        // SIMPAN FOTO
        // ==========================================

        $data['welding_photos'] = array_values($existingPhotos);

        // ==========================================
        // UPDATE DATABASE
        // ==========================================

        $participant->update($data);

        $returnUrl = $request->input('return_url');

        if (!$returnUrl) {
            $returnUrl = route('participants.index');
        }

        return redirect()
            ->to($returnUrl)
            ->with('success', 'Data peserta berhasil diperbarui.');
    }


    // =========================
    // 7. DELETE
    // =========================
    public function destroy($id)
    {
        $participant = Participant::findOrFail($id);

        // hapus foto
        if ($participant->photo && file_exists(public_path($participant->photo))) {
            unlink(public_path($participant->photo));
        }

        $participant->delete();

        return redirect()->route('participants.index')
            ->with('success', 'Data berhasil dihapus');
    }

    private function convertYoutube($url)
    {
        if (!$url) return null;

        parse_str(parse_url($url, PHP_URL_QUERY), $params);

        if (isset($params['v'])) {
            return "https://www.youtube.com/embed/" . $params['v'];
        }

        return $url;
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        Excel::import(new ParticipantsImport, $request->file('file'));

        return redirect()->route('participants.index')
            ->with('success', 'Data berhasil diimport!');
    }


    /**
     * Kompres foto hasil las menggunakan PHP GD.
     * Maksimum resolusi 1920px, kualitas JPEG 82%.
     */
    private function compressWeldingPhoto(
        \Illuminate\Http\UploadedFile $file
    ): string {

        // Pastikan ekstensi GD tersedia
        if (
            !function_exists('imagecreatefromstring') ||
            !function_exists('imagejpeg')
        ) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'welding_photos' => 'Fitur kompresi gambar belum tersedia. Hubungi administrator server.'
            ]);
        }

        // Baca gambar asli
        $imageData = file_get_contents($file->getRealPath());

        if ($imageData === false) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'welding_photos' => 'Gagal membaca foto yang diunggah.'
            ]);
        }

        $source = @imagecreatefromstring($imageData);

        if (!$source) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'welding_photos' => 'Format gambar tidak dapat diproses.'
            ]);
        }

        // Koreksi orientasi foto dari kamera jika EXIF tersedia
        if (
            in_array(strtolower($file->getClientOriginalExtension()), ['jpg', 'jpeg']) &&
            function_exists('exif_read_data')
        ) {
            $exif = @exif_read_data($file->getRealPath());
            $orientation = $exif['Orientation'] ?? 1;

            $rotation = match ($orientation) {
                3 => 180,
                6 => -90,
                8 => 90,
                default => 0,
            };

            if ($rotation !== 0) {
                $rotated = imagerotate($source, $rotation, 0);

                if ($rotated !== false) {
                    imagedestroy($source);
                    $source = $rotated;
                }
            }
        }

        // Ukuran gambar asli
        $width = imagesx($source);
        $height = imagesy($source);

        // Maksimum resolusi 1920 x 1920
        $maxSize = 1920;

        $scale = min(
            1,
            $maxSize / $width,
            $maxSize / $height
        );

        $newWidth = max(1, (int) round($width * $scale));
        $newHeight = max(1, (int) round($height * $scale));

        // Buat canvas baru
        $canvas = imagecreatetruecolor($newWidth, $newHeight);

        if (!$canvas) {
            imagedestroy($source);

            throw \Illuminate\Validation\ValidationException::withMessages([
                'welding_photos' => 'Gagal memproses ukuran gambar.'
            ]);
        }

        // Latar putih untuk gambar PNG transparan
        $white = imagecolorallocate($canvas, 255, 255, 255);
        imagefill($canvas, 0, 0, $white);

        // Resize gambar
        imagecopyresampled(
            $canvas,
            $source,
            0,
            0,
            0,
            0,
            $newWidth,
            $newHeight,
            $width,
            $height
        );

        // Buat folder jika belum tersedia
        $folder = public_path('uploads/welding_photos');

        if (
            !is_dir($folder) &&
            !mkdir($folder, 0755, true) &&
            !is_dir($folder)
        ) {
            imagedestroy($source);
            imagedestroy($canvas);

            throw \Illuminate\Validation\ValidationException::withMessages([
                'welding_photos' => 'Folder penyimpanan foto tidak dapat dibuat.'
            ]);
        }

        // Nama file unik
        $filename = 'welding_' .
            now()->format('Ymd_His') . '_' .
            bin2hex(random_bytes(5)) . '.jpg';

        $destination = $folder . '/' . $filename;

        // Simpan sebagai JPEG kualitas 82
        $saved = imagejpeg($canvas, $destination, 82);

        imagedestroy($source);
        imagedestroy($canvas);

        if (!$saved) {
            @unlink($destination);

            throw \Illuminate\Validation\ValidationException::withMessages([
                'welding_photos' => 'Gagal menyimpan hasil kompresi foto.'
            ]);
        }

        // Kembalikan path relatif
        return 'uploads/welding_photos/' . $filename;
    }
}
