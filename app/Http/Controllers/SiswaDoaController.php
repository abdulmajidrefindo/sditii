<?php

namespace App\Http\Controllers;

use App\Models\SiswaDoa;
use App\Http\Requests\StoreSiswaDoaRequest;
use App\Http\Requests\UpdateSiswaDoaRequest;

class SiswaDoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa_d = SiswaDoa::with('siswa','doa_1','doa_2','doa_3','doa_4','doa_5',
        'doa_6','doa_7','doa_8','doa_9','penilaian_huruf_angka')->get();
        return view('/siswaDoa/indexSiswaDoa', 
        [
            'siswa_d'=>$siswa_d
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
     * @param  \App\Http\Requests\StoreSiswaDoaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSiswaDoaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SiswaDoa  $siswaDoa
     * @return \Illuminate\Http\Response
     */
    public function show(SiswaDoa $siswaDoa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SiswaDoa  $siswaDoa
     * @return \Illuminate\Http\Response
     */
    public function edit(SiswaDoa $siswaDoa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSiswaDoaRequest  $request
     * @param  \App\Models\SiswaDoa  $siswaDoa
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSiswaDoaRequest $request, SiswaDoa $siswaDoa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SiswaDoa  $siswaDoa
     * @return \Illuminate\Http\Response
     */
    public function destroy(SiswaDoa $siswaDoa)
    {
        //
    }
}
