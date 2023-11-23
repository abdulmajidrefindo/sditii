<?php

namespace App\Http\Controllers;

use App\Models\SiswaIlmanWaaRuuhan;
use App\Models\IlmanWaaRuuhan;
use App\Models\Kelas;
use App\Models\Periode;
use App\Models\PenilaianDeskripsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreSiswaIlmanWaaRuuhanRequest;
use App\Http\Requests\UpdateSiswaIlmanWaaRuuhanRequest;

class SiswaIlmanWaaRuuhanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kelas_id = $request->kelas_id;
        $kelas = Kelas::all()->except(Kelas::all()->last()->id);
        $periode = Periode::where('status','aktif')->first();
        $siswa_i = SiswaIlmanWaaRuuhan::with('siswa','ilman_waa_ruuhan','penilaian_deskripsi')->where('periode_id',$periode->id)->whereHas('siswa', function ($query) use ($kelas_id) {
            $query->where('kelas_id', $kelas_id);
        })->get();
        return view('/siswaIWR/indexSiswaIWR', 
        [
            'siswa_i'=>$siswa_i,
            'data_kelas'=>$kelas
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
     * @param  \App\Http\Requests\StoreSiswaIlmanWaaRuuhanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSiswaIlmanWaaRuuhanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SiswaIlmanWaaRuuhan  $siswaIlmanWaaRuuhan
     * @return \Illuminate\Http\Response
     */
    public function show(SiswaIlmanWaaRuuhan $siswaIlmanWaaRuuhan)
    {
        $siswaIlmanWaaRuuhan = SiswaIlmanWaaRuuhan::with('siswa','ilman_waa_ruuhan','penilaian_deskripsi')->where('id',$siswaIlmanWaaRuuhan->id)->first();
        $penilaian_deskripsi = PenilaianDeskripsi::all();
        return view('/siswaIWR/showSiswaIWR', 
        [
            'siswaIlmanWaaRuuhan'=>$siswaIlmanWaaRuuhan,
            'penilaian_deskripsi'=>$penilaian_deskripsi
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SiswaIlmanWaaRuuhan  $siswaIlmanWaaRuuhan
     * @return \Illuminate\Http\Response
     */
    public function edit(SiswaIlmanWaaRuuhan $siswaIlmanWaaRuuhan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSiswaIlmanWaaRuuhanRequest  $request
     * @param  \App\Models\SiswaIlmanWaaRuuhan  $siswaIlmanWaaRuuhan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SiswaIlmanWaaRuuhan $siswaIlmanWaaRuuhan)
    {
        $messages = [];
        $validator_rules = [];
        $nilai_fields = ['ilman_waa_ruuhan_jilid', 'ilman_waa_ruuhan_halaman'];
    
        foreach ($nilai_fields as $field) {
            $messages[$field.'.integer'] = 'Nilai harus berupa angka.';
            $messages[$field.'.min'] = 'Nilai tidak boleh kurang dari 0.';
            $messages[$field.'.max'] = 'Nilai tidak boleh lebih dari 10.';
            $validator_rules[$field] = 'integer|min:0|max:100';
        }
    
        $validator = Validator::make($request->all(), $validator_rules, $messages);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        //where jilid and halaman
        //$ilman_waa_ruuhan = IlmanWaaRuuhan::where('jilid',$request->ilman_waa_ruuhan_jilid)->where('halaman',$request->ilman_waa_ruuhan_halaman)->first();
        $siswaIlmanWaaRuuhan->jilid = $request->ilman_waa_ruuhan_jilid;
        $siswaIlmanWaaRuuhan->halaman = $request->ilman_waa_ruuhan_halaman;
        $siswaIlmanWaaRuuhan->penilaian_deskripsi_id = $request->ilman_waa_ruuhan_nilai;
    
        if ($siswaIlmanWaaRuuhan->save()) {
            return response()->json(['success' => 'Data berhasil diupdate!', 'status' => '200']);
        } else {
            return response()->json(['error' => 'Data gagal diupdate!']);
        }

        //return response()->json($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SiswaIlmanWaaRuuhan  $siswaIlmanWaaRuuhan
     * @return \Illuminate\Http\Response
     */
    public function destroy(SiswaIlmanWaaRuuhan $siswaIlmanWaaRuuhan)
    {

        $siswaIlmanWaaRuuhan = SiswaIlmanWaaRuuhan::find($siswaIlmanWaaRuuhan->id);
        $siswaIlmanWaaRuuhan->jilid = '0';
        $siswaIlmanWaaRuuhan->halaman = '0';
        $siswaIlmanWaaRuuhan->penilaian_deskripsi_id = 5;

        if ($siswaIlmanWaaRuuhan->save()) {
            return response()->json(['success' => 'Data berhasil dihapus!', 'status' => '200']);
        } else {
            return response()->json(['error' => 'Data gagal dihapus!']);
        }
    }
}
