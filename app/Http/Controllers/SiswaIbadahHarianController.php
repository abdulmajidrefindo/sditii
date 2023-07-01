<?php

namespace App\Http\Controllers;

use App\Models\SiswaIbadahHarian;
use App\Http\Requests\StoreSiswaIbadahHarianRequest;
use App\Http\Requests\UpdateSiswaIbadahHarianRequest;

class SiswaIbadahHarianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa_ih = SiswaIbadahHarian::with('siswa','ibadah_harian_1','ibadah_harian_2','ibadah_harian_3','ibadah_harian_4','ibadah_harian_5','ibadah_harian_6','ibadah_harian_7','ibadah_harian_8','ibadah_harian_9','penilaian_deskripsi')->get();
        return view('/siswaIbadahHarian/indexSiswaIbadahHarian', 
        [
            'siswa_ih'=>$siswa_ih
        ]
        );
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
     * @param  \App\Http\Requests\StoreSiswaIbadahHarianRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSiswaIbadahHarianRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SiswaIbadahHarian  $siswaIbadahHarian
     * @return \Illuminate\Http\Response
     */
    public function show(SiswaIbadahHarian $siswaIbadahHarian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SiswaIbadahHarian  $siswaIbadahHarian
     * @return \Illuminate\Http\Response
     */
    public function edit(SiswaIbadahHarian $siswaIbadahHarian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSiswaIbadahHarianRequest  $request
     * @param  \App\Models\SiswaIbadahHarian  $siswaIbadahHarian
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSiswaIbadahHarianRequest $request, SiswaIbadahHarian $siswaIbadahHarian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SiswaIbadahHarian  $siswaIbadahHarian
     * @return \Illuminate\Http\Response
     */
    public function destroy(SiswaIbadahHarian $siswaIbadahHarian)
    {
        //
    }
}
