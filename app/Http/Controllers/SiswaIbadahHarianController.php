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
    public function index(Request  $request)
    {
        $kelas_id = $request->kelas_id;
        $siswa_ib = SiswaIbadahHarian::with('siswa','ibadah_harian_1','penilaian_deskripsi')->whereHas('siswa', function ($query) use ($kelas_id) {
            $query->where('kelas_id', $kelas_id);
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

        $data_kelas = Kelas::all()->except(Kelas::all()->last()->id);
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
    public function show($siswa_id)
    {
        $siswaIbadahHarian = SiswaIbadahHarian::where('siswa_id', $siswa_id)->get();
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

    public function update(Request $request, $siswa_id)
    {
        $messages = [];
        $ibadah_harian_fields = [];
        $validator_rules = [];

        foreach ($request->all() as $key => $value) {
            $ibadah_harian_fields[] = $key;
        }
    
        foreach ($ibadah_harian_fields as $field) {
            $messages[$field.'.integer'] = 'Ibadah harian tak boleh kosong.';
            $messages[$field.'.min'] = 'Ibadah harian tidak boleh diluar pilihan.';
            $messages[$field.'.max'] = 'Ibadah harian tidak boleh diluar pilihan.';
            $validator_rules[$field] = 'integer|min:1|max:4';
        }
    
        $validator = Validator::make($request->all(), $validator_rules, $messages);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $berhasil = 0;
        $processed = 0;
        foreach($request->all() as $key => $value) {
            $id = str_replace('ibadah_harian_', '', $key);
            $siswaibadahharian = SiswaIbadahHarian::find($id);
            $siswaibadahharian->penilaian_deskripsi_id = $value;
            $processed++;
            if ($siswaibadahharian->save()) {
                $berhasil++;
            }
        }
        if ($berhasil > 0 && $berhasil == $processed) {
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
