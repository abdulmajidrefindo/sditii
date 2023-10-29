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
    public function index(Request $request)
    {
        $kelas_id = $request->kelas_id;
        $siswa_t = SiswaTahfidz::with('siswa','tahfidz_1','penilaian_huruf_angka')->whereHas('tahfidz_1', function ($query) use ($kelas_id) {
            $query->where('kelas_id', $kelas_id);
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

        $data_kelas = Kelas::all()->except(Kelas::all()->last()->id);
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
    public function show($siswa_id)
    {
        $siswaTahfidz = SiswaTahfidz::where('siswa_id', $siswa_id)->get();
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
    public function update(Request $request, $siswa_id)
    {
        $messages = [];
        $tahfidz_fields = [];
        $validator_rules = [];

        foreach ($request->all() as $key => $value) {
            $tahfidz_fields[] = $key;
        }

        foreach ($tahfidz_fields as $field) {
            $messages[$field.'.integer'] = 'Nilai tahfidz harus berupa angka.';
            $messages[$field.'.min'] = 'Nilai tahfidz tidak boleh kurang dari 0.';
            $messages[$field.'.max'] = 'Nilai tahfidz tidak boleh lebih dari 100.';
            $validator_rules[$field] = 'integer|min:0|max:100';
        }

        $validator = Validator::make($request->all(), $validator_rules, $messages);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $berhasil = 0;
        foreach($request->all() as $key => $value) {
            $id = str_replace('tahfidz_', '', $key);
            $siswatahfidz = SiswaTahfidz::find($id);
            $value = ($value == 0) ? 101 : $value; 
            $siswatahfidz->penilaian_huruf_angka_id = $value;
            if ($siswatahfidz->save()) {
                $berhasil++;
            }
        }
        $count_request = count($request->all());
        if ($berhasil > 0 && $berhasil == $count_request) {
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
        $processed = 0;
        foreach ($siswaTahfidz as $item) {
            $processed++;
            if ($item->delete()) {
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
