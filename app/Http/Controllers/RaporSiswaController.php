<?php

namespace App\Http\Controllers;

use App\Models\RaporSiswa;
use App\Http\Requests\StoreRaporSiswaRequest;
use App\Http\Requests\UpdateRaporSiswaRequest;
use App\Models\IlmanWaaRuuhan;
use App\Models\SiswaIbadahHarian;
use App\Models\SiswaIlmanWaaRuuhan;
use App\Models\SiswaMapel;
use App\Models\Siswa;

class RaporSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        {
            // $rapor = RaporSiswa::with('siswa_iwr','siswa_ih','siswa_doa','siswa_hadist','siswa_tahfidz','siswa_mapel')->get();
            $data_siswa = Siswa::all();
            $data_iwr = SiswaIlmanWaaRuuhan::all();
            $data_ih = SiswaIbadahHarian::all();
            $data_mapel = SiswaMapel::all();
            return view('/raporSiswa/indexRaporSiswa', 
            [
                'data_siswa'=>$data_siswa,
                'data_iwr'=>$data_iwr,
                'data_ih'=>$data_ih,
                'data_mapel'=>$data_mapel
            ]);
        }
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
        //
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
}
