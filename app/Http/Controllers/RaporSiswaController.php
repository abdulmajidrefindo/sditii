<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RaporSiswa;
use App\Http\Requests\StoreRaporSiswaRequest;
use App\Http\Requests\UpdateRaporSiswaRequest;
use App\Models\Guru;
use App\Models\SubKelas;
use App\Models\SiswaIbadahHarian;
use App\Models\SiswaIlmanWaaRuuhan;
use App\Models\Siswa;
use App\Models\SiswaBidangStudi;
use App\Models\SiswaDoa;
use App\Models\SiswaHadist;
use App\Models\SiswaTahfidz;
use App\Models\Periode;
use App\Models\ProfilSekolah;


class RaporSiswaController extends Controller
{
    public function index(Request $request)
    {
        $periode = Periode::where('status','aktif')->first();
        $data_kelas = SubKelas::with('kelas')->where('periode_id', $periode->id)->get();
        foreach ($data_kelas as $key => $value) {
            $value->nama_kelas = $value->kelas->nama_kelas . " " . $value->nama_sub_kelas;
        }
        $kelas=$request->kelas_id;
        $kelas_aktif = null;
        if($kelas){
            $data_siswa = Siswa::all()->where('sub_kelas_id', $kelas);
            $kelas_aktif = SubKelas::where('id', $kelas)->first();
        }else{
            $data_siswa = Siswa::where('periode_id', $periode->id)->get();
        }
        
        $rapor_siswa = RaporSiswa::first();
        
        return view('/raporSiswa/indexRaporSiswa', 
        [
            'data_siswa'=>$data_siswa,
            'data_kelas'=>$data_kelas,
            'kelas_aktif'=>$kelas_aktif,
            'rapor_siswa'=>$rapor_siswa
            
        ]);
    }
    
    public function show(RaporSiswa $raporSiswa)
    {
        $data_iwr = SiswaIlmanWaaRuuhan::all();
        $data_ih = SiswaIbadahHarian::all();
        $data_t = SiswaTahfidz::all();
        $data_h = SiswaHadist::all();
        $data_d = SiswaDoa::all();
        $data_mapel = SiswaBidangStudi::all();
        return view('/raporSiswa/indexRaporSiswa', 
        [
            'data_iwr'=>$data_iwr,
            'data_ih'=>$data_ih,
            'data_t'=>$data_t,
            'data_h'=>$data_h,
            'data_d'=>$data_d,
            'data_mapel'=>$data_mapel
        ]);
    }
    
    public function update(UpdateRaporSiswaRequest $request, RaporSiswa $raporSiswa)
    {
        try{
            $rapor_siswa = RaporSiswa::first();
            $rapor_siswa->update([
                'tempat'=>$request->tempat,
                'tanggal'=>$request->tanggal,
            ]);
            
            return redirect()->route('raporSiswa.index')->with('rapor_berhasil', 'Data berhasil diubah');
        }catch(\Exception $e){
            return redirect()->route('raporSiswa.index')->with('rapor_gagal', 'Data gagal diubah');
        }
    }
    
    public function print($data)
    {
        $id = decrypt($data);
        $data_siswa = Siswa::with('sub_kelas','rapor_siswa')->where('id',$id)->first();
        $data_iwr = SiswaIlmanWaaRuuhan::with('ilman_waa_ruuhan')->where('siswa_id', $id)->get();
        $data_ih = SiswaIbadahHarian::with('ibadah_harian_1','penilaian_deskripsi')->where('siswa_id', $id)->get();
        $data_t = SiswaTahfidz::with('tahfidz_1','penilaian_huruf_angka')->where('siswa_id', $id)->get();
        $data_h = SiswaHadist::with('hadist_1','penilaian_huruf_angka')->where('siswa_id', $id)->get();
        $data_d = SiswaDoa::with('doa_1','penilaian_huruf_angka')->where('siswa_id', $id)->get();
        $data_mapel = SiswaBidangStudi::with('siswa','uh_1','uh_2','uh_3','uh_4','tugas_1','tugas_2','uts','pas','akhir')->where('siswa_id', $id)->get();
        
        $jumlah_nilai_akhir = 0;
        $count = 0;
        if($data_siswa->sub_kelas->kelas_id == 2 || $data_siswa->sub_kelas->kelas_id == 3 || $data_siswa->sub_kelas->kelas_id == 4 || $data_siswa->sub_kelas->kelas_id == 5)
        {
            foreach($data_mapel as $mapel){
                $jumlah_nilai_akhir += $mapel->akhir->nilai_angka;
                $count++;
            }
            $rata_rata = round($jumlah_nilai_akhir/$count, 2);
        }
        
        $periode = Periode::where('status', 'aktif')->first();
        $profil_sekolah = ProfilSekolah::first();
        
        if($data_siswa->sub_kelas->kelas->id == 1 or $data_siswa->sub_kelas->kelas->id == 6){
            return view('/raporSiswa/print_format_lain', 
            [
                'data_siswa'=>$data_siswa,
                'data_iwr'=>$data_iwr,
                'data_ih'=>$data_ih,
                'data_t'=>$data_t,
                'data_h'=>$data_h,
                'data_d'=>$data_d,
                'data_mapel'=>$data_mapel,
                'periode'=>$periode,
                'profil_sekolah'=>$profil_sekolah,
                
            ]);
        }
        else {
            return view('/raporSiswa/print', 
            [
                'data_siswa'=>$data_siswa,
                'data_iwr'=>$data_iwr,
                'data_ih'=>$data_ih,
                'data_t'=>$data_t,
                'data_h'=>$data_h,
                'data_d'=>$data_d,
                'data_mapel'=>$data_mapel,
                'periode'=>$periode,
                'profil_sekolah'=>$profil_sekolah,
                'rata_rata'=>$rata_rata,
                'jumlah'=>$jumlah_nilai_akhir,
            ]);
        }
    }
    public function printKelas($id)
    {
        $data = decrypt($id);
        $array_print = [];
        $siswa_kelas = Siswa::with('sub_kelas','rapor_siswa')->where('sub_kelas_id',$data)->get()->toArray();
        $array_print['data_siswa'] = $siswa_kelas;
        $tingkat_kelas_id = SubKelas::where('id',$data)->value('kelas_id');
        $counter = 0;
        
        foreach ($siswa_kelas as $s)
        {
            
            $data_siswa = Siswa::with('sub_kelas','rapor_siswa')->where('sub_kelas_id',$data)->get()->toArray();
            $data_iwr = SiswaIlmanWaaRuuhan::with('ilman_waa_ruuhan')->where('siswa_id', $s['id'])->get();
            $data_ih = SiswaIbadahHarian::with('ibadah_harian_1','penilaian_deskripsi')->where('siswa_id', $s['id'])->get();
            $data_t = SiswaTahfidz::with('tahfidz_1','penilaian_huruf_angka')->where('siswa_id', $s['id'])->get();
            $data_h = SiswaHadist::with('hadist_1','penilaian_huruf_angka')->where('siswa_id', $s['id'])->get();
            $data_d = SiswaDoa::with('doa_1','penilaian_huruf_angka')->where('siswa_id', $s['id'])->get();
            $data_mapel = SiswaBidangStudi::with('siswa','uh_1','uh_2','uh_3','uh_4','tugas_1','tugas_2','uts','pas','akhir')->where('siswa_id', $s['id'])->get();
            $guru_id = SubKelas::with('guru')->where('id',$s['sub_kelas_id'])->value('guru_id');
            $data_guru = Guru::where('id',$guru_id)->get()->toArray();
            
            $rata_rata = 0;
            $jumlah_nilai_akhir = 0;
            $count = 0;
            if($s['sub_kelas']['kelas_id'] == 2 || $s['sub_kelas']['kelas_id'] == 3 || $s['sub_kelas']['kelas_id'] == 4 || $s['sub_kelas']['kelas_id'] == 5)
            {
                foreach($data_mapel as $mapel){
                    $jumlah_nilai_akhir += $mapel->akhir->nilai_angka;
                    $count++;
                }
                $rata_rata = round($jumlah_nilai_akhir/$count, 2);
            }
            
            $periode = Periode::where('status', 'aktif')->first()->toArray();
            $profil_sekolah = ProfilSekolah::first()->toArray();
            $data_print = [
                'data_guru'=>$data_guru,
                'data_iwr'=>$data_iwr,
                'data_ih'=>$data_ih,
                'data_t'=>$data_t,
                'data_h'=>$data_h,
                'data_d'=>$data_d,
                'data_mapel'=>$data_mapel,
                'rata_rata'=>$rata_rata,
                'jumlah'=>$jumlah_nilai_akhir,
                'periode'=>$periode,
                'profil_sekolah'=>$profil_sekolah,
            ];
            array_push($array_print['data_siswa'][$counter], $data_print);
            $counter++;
        }
        if($tingkat_kelas_id == 1 or $tingkat_kelas_id == 6){
            return view('/raporSiswa/print_format_lain_kelas', compact('array_print'));
        }else {
            return view('/raporSiswa/print_kelas', compact('array_print'));
        }
    }
    
    public function detail($data)
    {
        $id = decrypt($data);
        $data_siswa = Siswa::with('sub_kelas')->where('id',$id)->first();
        $data_iwr = SiswaIlmanWaaRuuhan::with('ilman_waa_ruuhan')->where('siswa_id', $id)->get();
        $data_ih = SiswaIbadahHarian::with('ibadah_harian_1','penilaian_deskripsi')->where('siswa_id', $id)->get();
        $data_t = SiswaTahfidz::with('tahfidz_1','penilaian_huruf_angka')->where('siswa_id', $id)->get();
        $data_h = SiswaHadist::with('hadist_1','penilaian_huruf_angka')->where('siswa_id', $id)->get();
        $data_d = SiswaDoa::with('doa_1','penilaian_huruf_angka')->where('siswa_id', $id)->get();
        $data_mapel = SiswaBidangStudi::with('siswa','uh_1','uh_2','uh_3','uh_4','tugas_1','tugas_2','uts','pas','akhir')->where('siswa_id', $id)->get();
        
        $periode = Periode::where('status', 'aktif')->first();
        
        return view('/raporSiswa/showRaporSiswa', 
        [
            'data_siswa'=>$data_siswa,
            'data_iwr'=>$data_iwr,
            'data_ih'=>$data_ih,
            'data_t'=>$data_t,
            'data_h'=>$data_h,
            'data_d'=>$data_d,
            'data_mapel'=>$data_mapel,
            'periode'=>$periode
        ]);
    }
}
