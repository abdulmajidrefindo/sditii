<?php

namespace App\Http\Controllers;

use App\Models\SiswaIbadahHarian;
use App\Models\PenilaianDeskripsi;
use App\Http\Requests\StoreSiswaIbadahHarianRequest;
use App\Http\Requests\UpdateSiswaIbadahHarianRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $siswaIbadahHarian = SiswaIbadahHarian::with('siswa','ibadah_harian_1','ibadah_harian_2','ibadah_harian_3','ibadah_harian_4','ibadah_harian_5','ibadah_harian_6','ibadah_harian_7','ibadah_harian_8','ibadah_harian_9','penilaian_deskripsi')->where('id',$siswaIbadahHarian->id)->first();
        $penilaian_deskripsi = PenilaianDeskripsi::all();
        return view('/siswaIbadahHarian/showSiswaIbadahHarian', 
        [
            'siswaIbadahHarian'=>$siswaIbadahHarian,
            'penilaian_deskripsi'=>$penilaian_deskripsi
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SiswaIbadahHarian  $siswaIbadahHarian
     * @return \Illuminate\Http\Response
     */
    public function edit(SiswaIbadahHarian $siswaIbadahHarian)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSiswaIbadahHarianRequest  $request
     * @param  \App\Models\SiswaIbadahHarian  $siswaIbadahHarian
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, SiswaIbadahHarian $siswaIbadahHarian)
    {
        $messages = [];
        $validator_rules = [];
        $ibadah_harian_fields = ['ibadah_harian_1_id', 'ibadah_harian_2_id', 'ibadah_harian_3_id', 'ibadah_harian_4_id', 'ibadah_harian_5_id', 'ibadah_harian_6_id', 'ibadah_harian_7_id', 'ibadah_harian_8_id', 'ibadah_harian_9_id'];
    
        foreach ($ibadah_harian_fields as $field) {
            $messages[$field.'.integer'] = 'Ibadah harian '.substr($field, 16, -3).' tak boleh kosong.';
            $messages[$field.'.min'] = 'Ibadah harian '.substr($field, 16, -3).' tidak boleh diluar pilihan.';
            $messages[$field.'.max'] = 'Ibadah harian '.substr($field, 16, -3).' tidak boleh diluar pilihan.';
            $validator_rules[$field] = 'integer|min:1|max:4';
        }
    
        $validator = Validator::make($request->all(), $validator_rules, $messages);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
    
        foreach ($ibadah_harian_fields as $field) {
            $siswaIbadahHarian->$field = $request->input($field);
        }
    
        if ($siswaIbadahHarian->save()) {
            return response()->json(['success' => 'Data berhasil diupdate!', 'status' => '200']);
        } else {
            return response()->json(['error' => 'Data gagal diupdate!']);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SiswaIbadahHarian  $siswaIbadahHarian
     * @return \Illuminate\Http\Response
     */
    public function destroy(SiswaIbadahHarian $siswaIbadahHarian)
    {
        if ($siswaIbadahHarian->delete()) {
            return response()->json(['success' => 'Data berhasil dihapus!', 'status' => '200']);
        } else {
            return response()->json(['error' => 'Data gagal dihapus!']);
        }
    }
}
