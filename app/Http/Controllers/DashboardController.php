<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Periode;
use App\Models\ProfilSekolah;
use App\Models\Kelas;
use App\Models\SubKelas;

use App\Models\Pengumuman;

class DashboardController extends Controller
{
    public function index()
    {
        $periode = Periode::where('status', 'aktif')->first();
        $user = User::count();
        $guru = Guru::count();
        $siswa = Siswa::where('periode_id', $periode->id)->count();
        $kelas = SubKelas::where('periode_id', $periode->id)->count();
        $catatan_kelas = SubKelas::where('periode_id', $periode->id)->get();
        $pengumuman = Pengumuman::all();
        $profil = ProfilSekolah::first();
        
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
        
        return view('dashboard',
        [
            'user'=>$user,
            'guru'=>$guru,
            'siswa'=>$siswa,
            'kelas'=>$kelas,
            'catatan_kelas'=>$catatan_kelas,
            'periode'=>$periode,
            'pengumuman'=>$pengumuman,
            'profil'=>$profil,
        ]);
    }
}
