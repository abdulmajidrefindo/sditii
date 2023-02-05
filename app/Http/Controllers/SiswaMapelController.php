<?php

namespace App\Http\Controllers;

use App\Models\SiswaMapel;
use App\Http\Requests\StoreSiswaMapelRequest;
use App\Http\Requests\UpdateSiswaMapelRequest;

class SiswaMapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa_m = SiswaMapel::with('siswa','tugas_mapel','penilaian_huruf_angka')->get();
        return view('/siswaMapel/indexSiswaMapel', 
        [
            'siswa_m'=>$siswa_m
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
     * @param  \App\Http\Requests\StoreSiswaMapelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSiswaMapelRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SiswaMapel  $siswaMapel
     * @return \Illuminate\Http\Response
     */
    public function show(SiswaMapel $siswaMapel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SiswaMapel  $siswaMapel
     * @return \Illuminate\Http\Response
     */
    public function edit(SiswaMapel $siswaMapel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSiswaMapelRequest  $request
     * @param  \App\Models\SiswaMapel  $siswaMapel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSiswaMapelRequest $request, SiswaMapel $siswaMapel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SiswaMapel  $siswaMapel
     * @return \Illuminate\Http\Response
     */
    public function destroy(SiswaMapel $siswaMapel)
    {
        //
    }
}
