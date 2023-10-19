<?php

namespace App\Http\Controllers;

use App\Models\SiswaIlmanWaaRuuhan;
use App\Models\IlmanWaaRuuhan;
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
    public function index()
    {
        $siswa_i = SiswaIlmanWaaRuuhan::with('siswa','ilman_waa_ruuhan','penilaian_deskripsi')->get();
        return view('/siswaIWR/indexSiswaIWR', 
        [
            'siswa_i'=>$siswa_i
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
        return view('/siswaIWR/showSiswaIWR', 
        [
            'siswaIlmanWaaRuuhan'=>$siswaIlmanWaaRuuhan
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
            $validator_rules[$field] = 'integer|min:0|max:10';
        }
    
        $validator = Validator::make($request->all(), $validator_rules, $messages);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        //where jilid and halaman
        $ilman_waa_ruuhan = IlmanWaaRuuhan::where('jilid',$request->ilman_waa_ruuhan_jilid)->where('halaman',$request->ilman_waa_ruuhan_halaman)->first();
        $siswaIlmanWaaRuuhan->ilman_waa_ruuhan_id = $ilman_waa_ruuhan->id;
    
        if ($siswaIlmanWaaRuuhan->save()) {
            return response()->json(['success' => 'Data berhasil diupdate!', 'status' => '200']);
        } else {
            return response()->json(['error' => 'Data gagal diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SiswaIlmanWaaRuuhan  $siswaIlmanWaaRuuhan
     * @return \Illuminate\Http\Response
     */
    public function destroy(SiswaIlmanWaaRuuhan $siswaIlmanWaaRuuhan)
    {
        if ($siswaIlmanWaaRuuhan->delete()) {
            return response()->json(['success' => 'Data berhasil dihapus!', 'status' => '200']);
        } else {
            return response()->json(['error' => 'Data gagal dihapus!']);
        }
    }
}
