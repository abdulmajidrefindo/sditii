<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
        $data_kelas=Kelas::all();
        return view('/siswaBidangStudi/indexSiswaBidangStudi', 
        [
            'data_mapel'=>$data_mapel,
            'data_kelas'=>$data_kelas
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
        $data_kelas=Kelas::all();
        $mapel=$request->mapel_id;
        $kelas=$request->kelas_id;
        $siswa_bs = SiswaBidangStudi::with('siswa','uh_1','uh_2','uh_3','uh_4','tugas_1','tugas_2','uts','pas')->where('mapel_id',$mapel)->whereHas('siswa', function ($query) use ($kelas) {
            $query->where('kelas_id', $kelas);
        })->get();
        return view('/siswaBidangStudi/indexSiswaBidangStudi', 
        [
            'data_mapel'=>$data_mapel,
            'data_kelas'=>$data_kelas,
            'siswa_bs'=>$siswa_bs
        ]);

        //return response()->json($siswa_bs);
    }

    public function kelas_mapel($kelas_id){
        $mapel = Mapel::where('kelas_id',$kelas_id)->get();
        return response()->json($mapel);
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
        $siswaBidangStudi = SiswaBidangStudi::with('siswa','uh_1','uh_2','uh_3','uh_4','tugas_1','tugas_2','uts','pas')->where('id',$siswaBidangStudi->id)->first();
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
    public function update(Request $request, SiswaBidangStudi $siswaBidangStudi)
    {

        $messages = [];
        $validator_rules = [];
        $nilai_fields = [];

        foreach ($request->all() as $key => $value) {
            $nilai_fields[] = $key;
        }
    
        foreach ($nilai_fields as $field) {
            $messages[$field.'.integer'] = 'Nilai harus berupa angka.';
            $messages[$field.'.min'] = 'Nilai tidak boleh kurang dari 0.';
            $messages[$field.'.max'] = 'Nilai tidak boleh lebih dari 100.';
            $validator_rules[$field] = 'integer|min:0|max:100';
        }
    
        $validator = Validator::make($request->all(), $validator_rules, $messages);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        foreach ($request->all() as $key => $value) {
            $value = $value == 0 ? 101 : $value;
            $siswaBidangStudi->$key = $value;
        }
    
        if ($siswaBidangStudi->save()) {
            return response()->json(['success' => 'Data berhasil diupdate!', 'status' => '200']);
        } else {
            return response()->json(['error' => 'Data gagal diupdate!']);
        }

        //return response()->json($request->all());
        
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
