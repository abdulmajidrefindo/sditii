<?php

namespace App\Http\Controllers;

use App\Models\SiswaHadist;
use App\Models\Kelas;
use App\Http\Requests\StoreSiswaHadistRequest;
use App\Http\Requests\UpdateSiswaHadistRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiswaHadistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa_h = SiswaHadist::with('siswa','hadist_1','penilaian_huruf_angka')->whereHas('hadist_1', function ($query) {
            $query->where('kelas_id', 1);
        })->get();
        $modified_siswa_h = $siswa_h->groupBy(['siswa_id'])->map(function ($item) {
            $result = [];
            $result['siswa_id'] = $item[0]->siswa_id;
            $result['nama_siswa'] = $item[0]->siswa->nama_siswa;
            $result['nisn'] = $item[0]->siswa->nisn;
            foreach ($item as $hadist_siswa) {
                $result[$hadist_siswa->hadist_1->nama_nilai] = $hadist_siswa->penilaian_huruf_angka->nilai_angka;
            }
            return $result;
        });
        // return view('/siswaHadist/indexSiswaHadist', 
        // [
        //     'siswa_h'=>$siswa_h
        // ]);

        $data_kelas = Kelas::all();
        return view('/siswaHadist/indexSiswaHadist', 
        [
            'siswa_h'=>$modified_siswa_h,
            'data_kelas'=>$data_kelas
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
        $siswaHadist = SiswaHadist::with('siswa','hadist_1','hadist_2','hadist_3','hadist_4','hadist_5','hadist_6','hadist_7','hadist_8','hadist_9')->where('id',$siswaHadist->id)->first();
        return view('/siswaHadist/showSiswaHadist', 
        [
            'siswaHadist'=>$siswaHadist
        ]);
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

    public function update(Request $request, SiswaHadist $siswaHadist)
    {
        $messages = [];
        $validator_rules = [];
        $hadist_fields = ['hadist_1_id', 'hadist_2_id', 'hadist_3_id', 'hadist_4_id', 'hadist_5_id', 'hadist_6_id', 'hadist_7_id', 'hadist_8_id', 'hadist_9_id'];
    
        foreach ($hadist_fields as $field) {
            $messages[$field.'.integer'] = 'Hadist '.substr($field, 7, -3).' harus berupa angka.';
            $messages[$field.'.min'] = 'Hadist '.substr($field, 7, -3).' tidak boleh kurang dari 0.';
            $messages[$field.'.max'] = 'Hadist '.substr($field, 7, -3).' tidak boleh lebih dari 100.';
            $validator_rules[$field] = 'integer|min:0|max:100';
        }
    
        $validator = Validator::make($request->all(), $validator_rules, $messages);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
    
        foreach ($hadist_fields as $field) {
            $siswaHadist->$field = $request->input($field);
        }
    
        if ($siswaHadist->save()) {
            return response()->json(['success' => 'Data berhasil diupdate!', 'status' => '200']);
        } else {
            return response()->json(['error' => 'Data gagal diupdate!']);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SiswaHadist  $siswaHadist
     * @return \Illuminate\Http\Response
     */
    public function destroy($siswa_id)
    {
        $siswaHadist = SiswaHadist::where('siswa_id', $siswa_id)->get();
        $berhasil = 0;
        foreach ($siswaHadist as $item) {
            if ($item->delete()) {
                $berhasil++;
            }
        }

        if ($berhasil > 0) {
            return response()->json(['success' => 'Data berhasil dihapus!', 'status' => '200']);
        } else {
            return response()->json(['error' => 'Data gagal dihapus!']);
        }
    }
}
