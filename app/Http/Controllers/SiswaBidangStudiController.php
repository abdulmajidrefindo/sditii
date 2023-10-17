<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreSiswaBidangStudiRequest;
use App\Http\Requests\UpdateSiswaBidangStudiRequest;
use App\Models\SiswaBidangStudi;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\Kelas;

class SiswaBidangStudiController extends Controller
{
    public function choose(){
        $data_mapel=Mapel::all();
        return view('/siswaBidangStudi/chooseSiswaBidangStudi',
        [
            'data_mapel'=>$data_mapel
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data_mapel=Mapel::all();
        $mapel=$request->mapel_id;
        $siswa_bs = SiswaBidangStudi::with('siswa','nilai_uh_1','nilai_uh_2','nilai_uh_3','nilai_uh_4','nilai_tugas_1','nilai_tugas_2','nilai_uts','nilai_pas')->where('mapel_id',$mapel)->get();
        return view('/siswaBidangStudi/indexSiswaBidangStudi', 
        [
            'data_mapel'=>$data_mapel,
            'siswa_bs'=>$siswa_bs
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
     * @param  \App\Http\Requests\StoreSiswaBidangStudiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSiswaBidangStudiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SiswaMapel  $siswaMapel
     * @return \Illuminate\Http\Response
     */
    public function show(SiswaBidangStudi $siswaBidangStudi)
    {
        $siswaBidangStudi = SiswaBidangStudi::with('siswa','nilai_uh_1','nilai_uh_2','nilai_uh_3','nilai_uh_4','nilai_tugas_1','nilai_tugas_2','nilai_uts','nilai_pas')->where('id',$siswaBidangStudi->id)->first();
        return view('/siswaBidangStudi/showSiswaBidangStudi', 
        [
            'siswaBidangStudi'=>$siswaBidangStudi
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SiswaMapel  $siswaMapel
     * @return \Illuminate\Http\Response
     */
    public function edit(SiswaBidangStudi $siswaBidangStudi)
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
    public function update(UpdateSiswaBidangStudiRequest $request, SiswaBidangStudi $siswaBidangStudi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SiswaMapel  $siswaMapel
     * @return \Illuminate\Http\Response
     */
    public function destroy(SiswaBidangStudi $siswaBidangStudi)
    {
        if ($siswaBidangStudi->delete()) {
            return response()->json(['success' => 'Data berhasil dihapus!', 'status' => '200']);
        } else {
            return response()->json(['error' => 'Data gagal dihapus!']);
        }
    }
}
