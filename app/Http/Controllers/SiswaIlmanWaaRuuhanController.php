<?php

namespace App\Http\Controllers;

use App\Models\SiswaIlmanWaaRuuhan;
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
        //
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
    public function update(UpdateSiswaIlmanWaaRuuhanRequest $request, SiswaIlmanWaaRuuhan $siswaIlmanWaaRuuhan)
    {
        //
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
