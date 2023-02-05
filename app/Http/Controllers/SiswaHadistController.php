<?php

namespace App\Http\Controllers;

use App\Models\SiswaHadist;
use App\Http\Requests\StoreSiswaHadistRequest;
use App\Http\Requests\UpdateSiswaHadistRequest;

class SiswaHadistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa_h = SiswaHadist::with('siswa','hadist','penilaian_deskripsi')->get();
        return view('/siswaHadist/indexSiswaHadist', 
        [
            'siswa_h'=>$siswa_h
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
     * @param  \App\Http\Requests\StoreSiswaHadistRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSiswaHadistRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SiswaHadist  $siswaHadist
     * @return \Illuminate\Http\Response
     */
    public function show(SiswaHadist $siswaHadist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SiswaHadist  $siswaHadist
     * @return \Illuminate\Http\Response
     */
    public function edit(SiswaHadist $siswaHadist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSiswaHadistRequest  $request
     * @param  \App\Models\SiswaHadist  $siswaHadist
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSiswaHadistRequest $request, SiswaHadist $siswaHadist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SiswaHadist  $siswaHadist
     * @return \Illuminate\Http\Response
     */
    public function destroy(SiswaHadist $siswaHadist)
    {
        //
    }
}
