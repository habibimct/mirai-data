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
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable',
            'status' => 'nullable|in:Sending,Existing',
            'japanese_skills' => 'nullable',
            'materials' => 'nullable',
            'motivation' => 'nullable',
            'vision' => 'nullable',
            'youtube_link' => 'nullable|url',
            'welding_photos.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data['youtube_link'] = $this->convertYoutube($request->youtube_link);

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
                $filename = time() . '_' . $file->getClientOriginalName();

                $file->move(
                    public_path('uploads/welding_photos'),
                    $filename
                );

                $photos[] = 'uploads/welding_photos/' . $filename;
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
            'welding_photos.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->filled('youtube_link')) {
            $data['youtube_link'] = $this->convertYoutube($request->youtube_link);
        } else {
            // JANGAN overwrite jika kosong
            unset($data['youtube_link']);
        }

        if ($request->hasFile('photo')) {

            // hapus foto lama
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

        if ($request->hasFile('welding_photos')) {

            // upload baru
            $photos = [];
            foreach ($request->file('welding_photos') as $file) {
                $path = $file->store(
                    'welding_photos',
                    'public'
                );

                $photos[] = $path;
            }

            $data['welding_photos'] = $photos;
        }

        // FOTO LAMA
        $existingPhotos = $participant->welding_photos ?? [];

        // =========================
        // HAPUS FOTO TERPILIH
        // =========================
        if ($request->delete_photos) {

            foreach ($request->delete_photos as $photo) {

                if (file_exists(public_path($photo))) {
                    unlink(public_path($photo));
                }

                $existingPhotos = array_filter(
                    $existingPhotos,
                    fn($p) => $p != $photo
                );
            }
        }

        // =========================
        // TAMBAH FOTO BARU
        // =========================
        if ($request->hasFile('welding_photos')) {

            foreach ($request->file('welding_photos') as $file) {

                $filename = time() . '_' . $file->getClientOriginalName();

                $file->move(
                    public_path('uploads/welding_photos'),
                    $filename
                );

                $existingPhotos[] = 'uploads/welding_photos/' . $filename;
            }
        }

        // simpan ulang
        $data['welding_photos'] = array_values($existingPhotos);

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
}
