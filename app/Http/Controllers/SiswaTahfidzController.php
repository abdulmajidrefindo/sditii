<?php

namespace App\Http\Controllers;

use App\Models\SiswaTahfidz;
use App\Models\Tahfidz1;
use App\Models\Kelas;
use App\Http\Requests\StoreSiswaTahfidzRequest;
use App\Http\Requests\UpdateSiswaTahfidzRequest;
use App\Models\PenilaianHurufAngka;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiswaTahfidzController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa_t = SiswaTahfidz::with('siswa','tahfidz_1','penilaian_huruf_angka')->whereHas('tahfidz_1', function ($query) {
            $query->where('kelas_id', 1);
        })->get();

        $modified_siswa_t = $siswa_t->groupBy(['siswa_id'])->map(function ($item) {
            $result = [];
            $result['siswa_id'] = $item[0]->siswa_id;
            $result['nama_siswa'] = $item[0]->siswa->nama_siswa;
            $result['nisn'] = $item[0]->siswa->nisn;
            foreach ($item as $tahfidz_siswa) {
                $result[$tahfidz_siswa->tahfidz_1->nama_nilai] = $tahfidz_siswa->penilaian_huruf_angka->nilai_angka;
            }
            return $result;
        });

        $data_kelas = Kelas::all();
        return view('/siswaTahfidz/indexSiswaTahfidz', 
        [
            'siswa_t'=>$modified_siswa_t,
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
     * @param  \App\Http\Requests\StoreSiswaTahfidzRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSiswaTahfidzRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SiswaTahfidz  $siswaTahfidz
     * @return \Illuminate\Http\Response
     */
    public function show(SiswaTahfidz $siswaTahfidz)
    {
        $siswaTahfidz = SiswaTahfidz::with('siswa','tahfidz_1','tahfidz_2','tahfidz_3','tahfidz_4','tahfidz_5','tahfidz_6','tahfidz_7','tahfidz_8','tahfidz_9','tahfidz_10','tahfidz_11','tahfidz_12','tahfidz_13','tahfidz_14','tahfidz_15')->where('id',$siswaTahfidz->id)->first();
        return view('/siswaTahfidz/showSiswaTahfidz', 
        [
            'siswaTahfidz'=>$siswaTahfidz,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SiswaTahfidz  $siswaTahfidz
     * @return \Illuminate\Http\Response
     */
    public function edit(SiswaTahfidz $siswaTahfidz)
    {
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSiswaTahfidzRequest  $request
     * @param  \App\Models\SiswaTahfidz  $siswaTahfidz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SiswaTahfidz $siswaTahfidz)
    {
        $messages = [];
        $validator_rules = [];
        $tahfidz_fields = ['tahfidz_1_id', 'tahfidz_2_id', 'tahfidz_3_id', 'tahfidz_4_id', 'tahfidz_5_id', 'tahfidz_6_id', 'tahfidz_7_id', 'tahfidz_8_id', 'tahfidz_9_id', 'tahfidz_10_id', 'tahfidz_11_id', 'tahfidz_12_id', 'tahfidz_13_id', 'tahfidz_14_id', 'tahfidz_15_id'];

        foreach ($tahfidz_fields as $field) {
            $messages[$field.'.integer'] = 'Tahfidz '.substr($field, 8, -3).' harus berupa angka.';
            $messages[$field.'.min'] = 'Tahfidz '.substr($field, 8, -3).' tidak boleh kurang dari 0.';
            $messages[$field.'.max'] = 'Tahfidz '.substr($field, 8, -3).' tidak boleh lebih dari 100.';
            $validator_rules[$field] = 'integer|min:0|max:100';
        }

        $validator = Validator::make($request->all(), $validator_rules, $messages);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        foreach ($tahfidz_fields as $field) {
            $siswaTahfidz->$field = $request->input($field);
        }

        if ($siswaTahfidz->save()) {
            return response()->json(['success' => 'Data berhasil diupdate!', 'status' => '200']);
        } else {
            return response()->json(['error' => 'Data gagal diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SiswaTahfidz  $siswaTahfidz
     * @return \Illuminate\Http\Response
     */
    public function destroy($siswa_id)
    {
        $siswaTahfidz = SiswaTahfidz::where('siswa_id', $siswa_id)->get();
        $berhasil = 0;
        foreach ($siswaTahfidz as $item) {
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
