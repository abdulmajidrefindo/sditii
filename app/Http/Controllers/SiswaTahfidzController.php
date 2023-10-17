<?php

namespace App\Http\Controllers;

use App\Models\SiswaTahfidz;
use App\Models\Tahfidz1;
use App\Http\Requests\StoreSiswaTahfidzRequest;
use App\Http\Requests\UpdateSiswaTahfidzRequest;
use App\Models\PenilaianHurufAngka;

class SiswaTahfidzController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa_t = SiswaTahfidz::with('siswa','tahfidz_1','tahfidz_2','tahfidz_3','tahfidz_4','tahfidz_5','tahfidz_6','tahfidz_7','tahfidz_8','tahfidz_9','tahfidz_10','tahfidz_11','tahfidz_12','tahfidz_13','tahfidz_14','tahfidz_15')->get();
        return view('/siswaTahfidz/indexSiswaTahfidz', 
        [
            'siswa_t'=>$siswa_t,
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
     * @param  \App\Http\Requests\StoreSiswaTahfidzRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSiswaTahfidzRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SiswaTahfidz  $siswaTahfidz
     * @return \Illuminate\Http\Response
     */
    public function show(SiswaTahfidz $siswaTahfidz)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SiswaTahfidz  $siswaTahfidz
     * @return \Illuminate\Http\Response
     */
    public function edit(SiswaTahfidz $siswaTahfidz)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSiswaTahfidzRequest  $request
     * @param  \App\Models\SiswaTahfidz  $siswaTahfidz
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSiswaTahfidzRequest $request, SiswaTahfidz $siswaTahfidz)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SiswaTahfidz  $siswaTahfidz
     * @return \Illuminate\Http\Response
     */
    public function destroy(SiswaTahfidz $siswaTahfidz)
    {
        if ($siswaTahfidz->delete()) {
            return response()->json(['success' => 'Data berhasil dihapus!', 'status' => '200']);
        } else {
            return response()->json(['error' => 'Data gagal dihapus!']);
        }
    }
}
