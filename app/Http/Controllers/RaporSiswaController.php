<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RaporSiswa;
use App\Http\Requests\StoreRaporSiswaRequest;
use App\Http\Requests\UpdateRaporSiswaRequest;
use App\Models\Kelas;
use App\Models\SiswaIbadahHarian;
use App\Models\SiswaIlmanWaaRuuhan;
use App\Models\Siswa;
use App\Models\SiswaBidangStudi;
use App\Models\SiswaDoa;
use App\Models\SiswaHadist;
use App\Models\SiswaTahfidz;
use App\Models\Periode;


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
    public function index()
    {
        // $data_kelas = Kelas::all();
        // $kelas = $request->kelas_id;
        $data_siswa = Siswa::all();
        return view('/raporSiswa/indexRaporSiswa', 
        [
            // 'data_kelas'=>$data_kelas,
            'data_siswa'=>$data_siswa,
        ]);
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
        //
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
        // $data_siswa = Siswa::find($id);
        // $data_iwr = SiswaIlmanWaaRuuhan::where('siswa_id', $id)->get();
        // $data_ih = SiswaIbadahHarian::where('siswa_id', $id)->get();
        // $data_t = SiswaTahfidz::where('siswa_id', $id)->get();
        // $data_h = SiswaHadist::where('siswa_id', $id)->get();
        // $data_d = SiswaDoa::where('siswa_id', $id)->get();
        // $data_mapel = SiswaBidangStudi::where('siswa_id', $id)->get();
        return view('/raporSiswa/print', 
        [
            // 'data_siswa'=>$data_siswa,
            // 'data_iwr'=>$data_iwr,
            // 'data_ih'=>$data_ih,
            // 'data_t'=>$data_t,
            // 'data_h'=>$data_h,
            // 'data_d'=>$data_d,
            // 'data_mapel'=>$data_mapel
        ]);
    }

    public function detail($id)
    {
        $data_siswa = Siswa::with('kelas')->find($id);
        $data_iwr = SiswaIlmanWaaRuuhan::with('ilman_waa_ruuhan')->where('siswa_id', $id)->get();
        $data_ih = SiswaIbadahHarian::with('ibadah_harian_1','penilaian_deskripsi')->where('siswa_id', $id)->get();
        $data_t = SiswaTahfidz::with('tahfidz_1','penilaian_huruf_angka')->where('siswa_id', $id)->get();
        $data_h = SiswaHadist::with('hadist_1','penilaian_huruf_angka')->where('siswa_id', $id)->get();
        $data_d = SiswaDoa::with('doa_1','penilaian_huruf_angka')->where('siswa_id', $id)->get();
        $data_mapel = SiswaBidangStudi::with('siswa','uh_1','uh_2','uh_3','uh_4','tugas_1','tugas_2','uts','pas')->where('siswa_id', $id)->get();
        // add nilai akhir to data_mapel
        foreach($data_mapel as $mapel){
            $mapel->nilai_akhir = ($mapel->uh_1->nilai_angka + $mapel->uh_2->nilai_angka + $mapel->uh_3->nilai_angka + $mapel->uh_4->nilai_angka + $mapel->tugas_1->nilai_angka + $mapel->tugas_2->nilai_angka + $mapel->uts->nilai_angka + $mapel->pas->nilai_angka)/8;
            $mapel->nilai_akhir = round($mapel->nilai_akhir, 0);
            $mapel->nilai_huruf = $mapel->nilai_akhir >= 90 ? 'A+' : ($mapel->nilai_akhir >= 85 ? 'A' : ($mapel->nilai_akhir >= 80 ? 'B+' : ($mapel->nilai_akhir >= 75 ? 'B' : ($mapel->nilai_akhir >= 70 ? 'B-' : ($mapel->nilai_akhir >= 65 ? 'C+' : ($mapel->nilai_akhir >= 60 ? 'C' : ($mapel->nilai_akhir >= 51 ? 'D' : 'E')))))));
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
        //     'data_mapel'=>$data_mapel
        // ]);
    }

}
