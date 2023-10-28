<?php

namespace App\Http\Controllers;

use App\Models\SiswaIbadahHarian;
use App\Models\PenilaianDeskripsi;
use App\Models\Kelas;
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
        $siswa_ib = SiswaIbadahHarian::with('siswa','ibadah_harian_1','penilaian_deskripsi')->whereHas('ibadah_harian_1', function ($query) {
            $query->where('kelas_id', 1);
        })->get();

        $modified_siswa_ib = $siswa_ib->groupBy(['siswa_id'])->map(function ($item) {
            $result = [];
            $result['siswa_id'] = $item[0]->siswa_id;
            $result['nama_siswa'] = $item[0]->siswa->nama_siswa;
            $result['nisn'] = $item[0]->siswa->nisn;
            foreach ($item as $ibadah_harian_siswa) {
                $result[$ibadah_harian_siswa->ibadah_harian_1->nama_kriteria] = $ibadah_harian_siswa->penilaian_deskripsi->keterangan;
            }
            return $result;
        });

        $data_kelas = Kelas::all();
        return view('/siswaIbadahHarian/indexSiswaIbadahHarian', 
        [
            'siswa_ib'=>$modified_siswa_ib,
            'data_kelas'=>$data_kelas
        ]);

        //return response()->json($modified_siswa_ib);
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
    public function destroy($siswa_id)
    {
        $siswa_ib = SiswaIbadahHarian::where('siswa_id', $siswa_id)->get();
        $berhasil = 0;
        $processed = 0;
        foreach ($siswa_ib as $ibadah_harian_siswa) {
            $processed++;
            if ($ibadah_harian_siswa->delete()) {
                $berhasil++;
            }
        }
        if ($berhasil > 0 && $berhasil == $processed) {
            return response()->json(['success' => 'Data berhasil dihapus!', 'status' => '200']);
        } else {
            return response()->json(['error' => 'Data gagal dihapus!']);
        }
    }
}
