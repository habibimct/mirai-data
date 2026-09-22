<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // =========================
        // DATA UMUM (UNTUK SEMUA ROLE)
        // =========================
        $totalParticipants = Participant::count();
        $totalUsers = User::count();

        $latestParticipants = Participant::latest()->take(5)->get();
        $users = User::latest()->take(10)->get();

        // =========================
        // MEMBER ONLY (STATISTIK TAMBAHAN)
        // =========================
        $byQualification = [];
        $ageGroups = [];

        // =========================
        // STATISTIK KUALIFIKASI
        // =========================
        $byQualification = Participant::selectRaw('qualification, COUNT(*) as total')
            ->groupBy('qualification')
            ->pluck('total', 'qualification');

        // =========================
        // STATISTIK UMUR
        // =========================
        $participants = Participant::all();

        $ageGroups = [
            '18-20' => 0,
            '21-25' => 0,
            '26-30' => 0,
            '30+' => 0,
        ];

        foreach ($participants as $p) {
            if (!$p->date_of_birth) continue;
            $age = Carbon::parse($p->date_of_birth)->age;

            // HANYA 18+
            if ($age >= 18 && $age <= 20) {
                $ageGroups['18-20']++;
            } elseif ($age >= 21 && $age <= 25) {
                $ageGroups['21-25']++;
            } elseif ($age >= 26 && $age <= 30) {
                $ageGroups['26-30']++;
            } elseif ($age > 30) {
                $ageGroups['30+']++;
            }
        }
        
        // =========================
        // DATA CHART UMUR
        // =========================
        $ageLabels = array_keys($ageGroups);
        $ageTotals = array_values($ageGroups);

        // =========================
        // STATISTIK STATUS
        // =========================
        $statusGroups = Participant::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $statusLabels = $statusGroups->keys();
        $statusTotals = $statusGroups->values();


        $inviteCode = Setting::where('key', 'invite_code')
            ->value('value');

        // =========================
        // RETURN VIEW
        // =========================
        return view('dashboard', compact(
            'totalParticipants',
            'totalUsers',
            'latestParticipants',
            'users',
            'byQualification',

            // umur
            'ageGroups',
            'ageLabels',
            'ageTotals',

            // status
            'statusLabels',
            'statusTotals',

            'inviteCode'
        ));
    }

    public function updateInviteCode(Request $request)
    {
        $request->validate([
            'invite_code' => 'required'
        ]);

        Setting::updateOrCreate(
            ['key' => 'invite_code'],
            ['value' => $request->invite_code]
        );

        return back()->with(
            'success',
            'Kode undangan berhasil diubah'
        );
    }
}
