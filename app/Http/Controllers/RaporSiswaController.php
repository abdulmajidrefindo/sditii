<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RaporSiswa;
use App\Http\Requests\StoreRaporSiswaRequest;
use App\Http\Requests\UpdateRaporSiswaRequest;
use App\Models\Kelas;
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
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    // public function pilihKelas()
    // {
        //         $data_kelas = Kelas::all();
        //         return view('/raporSiswa/selectRaporSiswa', 
        //         [
            //             'data_kelas'=>$data_kelas,
            //         ]);
            // }
            public function index(Request $request)
            {
                // $data_kelas = Kelas::all();
                // $kelas = $request->kelas_id;
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
                    // 'data_kelas'=>$data_kelas,
                    'data_siswa'=>$data_siswa,
                    'data_kelas'=>$data_kelas,
                    'kelas_aktif'=>$kelas_aktif,
                    'rapor_siswa'=>$rapor_siswa
                    
                ]);
                
                // return response()->json([
                    //     'data_siswa'=>$data_siswa,
                    //     'data_kelas'=>$data_kelas,
                    //     'kelas_aktif'=>$kelas_aktif
                    // ]);
                }
                
                /**
                * Show the form for creating a new resource.
                *
                * @return \Illuminate\Http\Response
                */
                public function create()
                {
                    //
                }
                
                /**
                * Store a newly created resource in storage.
                *
                * @param  \App\Http\Requests\StoreRaporSiswaRequest  $request
                * @return \Illuminate\Http\Response
                */
                public function store(StoreRaporSiswaRequest $request)
                {
                    //
                }
                
                /**
                * Display the specified resource.
                *
                * @param  \App\Models\RaporSiswa  $raporSiswa
                * @return \Illuminate\Http\Response
                */
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
                
                /**
                * Show the form for editing the specified resource.
                *
                * @param  \App\Models\RaporSiswa  $raporSiswa
                * @return \Illuminate\Http\Response
                */
                public function edit(RaporSiswa $raporSiswa)
                {
                    //
                }
                
                /**
                * Update the specified resource in storage.
                *
                * @param  \App\Http\Requests\UpdateRaporSiswaRequest  $request
                * @param  \App\Models\RaporSiswa  $raporSiswa
                * @return \Illuminate\Http\Response
                */
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
                
                /**
                * Remove the specified resource from storage.
                *
                * @param  \App\Models\RaporSiswa  $raporSiswa
                * @return \Illuminate\Http\Response
                */
                public function destroy(RaporSiswa $raporSiswa)
                {
                    //
                }

                                public function print($id)
                {
                    $data_siswa = Siswa::with('sub_kelas','rapor_siswa')->find($id);
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
                    }else {
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
                
                public function detail($id)
                {
                    $data_siswa = Siswa::with('sub_kelas')->find($id);
                    $data_iwr = SiswaIlmanWaaRuuhan::with('ilman_waa_ruuhan')->where('siswa_id', $id)->get();
                    $data_ih = SiswaIbadahHarian::with('ibadah_harian_1','penilaian_deskripsi')->where('siswa_id', $id)->get();
                    $data_t = SiswaTahfidz::with('tahfidz_1','penilaian_huruf_angka')->where('siswa_id', $id)->get();
                    $data_h = SiswaHadist::with('hadist_1','penilaian_huruf_angka')->where('siswa_id', $id)->get();
                    $data_d = SiswaDoa::with('doa_1','penilaian_huruf_angka')->where('siswa_id', $id)->get();
                    $data_mapel = SiswaBidangStudi::with('siswa','uh_1','uh_2','uh_3','uh_4','tugas_1','tugas_2','uts','pas','akhir')->where('siswa_id', $id)->get();
                    foreach($data_mapel as $mapel){
                        //$mapel->nilai_akhir = ($mapel->uh_1->nilai_angka + $mapel->uh_2->nilai_angka + $mapel->uh_3->nilai_angka + $mapel->uh_4->nilai_angka + $mapel->tugas_1->nilai_angka + $mapel->tugas_2->nilai_angka + $mapel->uts->nilai_angka + $mapel->pas->nilai_angka)/8;
                        //$mapel->nilai_akhir = round($mapel->nilai_akhir, 0);
                        //$mapel->nilai_huruf = $mapel->nilai_akhir >= 90 ? 'A+' : ($mapel->nilai_akhir >= 85 ? 'A' : ($mapel->nilai_akhir >= 80 ? 'B+' : ($mapel->nilai_akhir >= 75 ? 'B' : ($mapel->nilai_akhir >= 70 ? 'B-' : ($mapel->nilai_akhir >= 65 ? 'C+' : ($mapel->nilai_akhir >= 60 ? 'C' : ($mapel->nilai_akhir >= 51 ? 'D' : 'E')))))));
                        //$mapel->nilai_huruf = $mapel->nilai_akhir->nilai_huruf;
                    }
                    
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
                    
                    // return response()->json([
                        //     'data_siswa'=>$data_siswa,
                        //     'data_iwr'=>$data_iwr,
                        //     'data_ih'=>$data_ih,
                        //     'data_t'=>$data_t,
                        //     'data_h'=>$data_h,
                        //     'data_d'=>$data_d,
                        //     'data_mapel'=>$data_mapel,
                        //     'periode'=>$periode
                        
                        // ]);
                    }
                    
                }
                