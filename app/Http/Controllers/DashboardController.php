<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Periode;
use App\Models\ProfilSekolah;
use App\Models\Kelas;

use App\Models\Pengumuman;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::count();
        $guru = Guru::count();
        $siswa = Siswa::count();
        $kelas = Kelas::count();
        $pengumuman = Pengumuman::all();

        //Group pengumuman by date sort by date
        $pengumuman = $pengumuman->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        })->sortKeysDesc();

        //Separate time from date
        $pengumuman = $pengumuman->map(function ($item) {
            return $item->map(function ($item) {
                $item->time = $item->created_at->format('H:i');
                return $item;
            });
        });
        
        

        $periode = Periode::where('status', 'aktif')->first();

        // return response()->json([
        //     'pengumuman' => $pengumuman
        // ]);

        return view('dashboard', compact('user', 'guru', 'siswa', 'kelas', 'periode', 'pengumuman'));
    }
}
