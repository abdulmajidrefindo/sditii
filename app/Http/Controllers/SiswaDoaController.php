<?php

namespace App\Http\Controllers;

use App\Models\SiswaDoa;
use App\Models\Doa1;
use App\Models\Kelas;
use App\Http\Requests\StoreSiswaDoaRequest;
use App\Http\Requests\UpdateSiwaDoaRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class SiswaDoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Main page
        $kelas_id = $request->kelas_id;
        $data_kelas = Kelas::all()->except(Kelas::all()->last()->id);
        $siswa_d = SiswaDoa::with('siswa','doa_1','penilaian_huruf_angka')->whereHas('siswa', function ($query) use ($kelas_id) {
            $query->where('kelas_id', $kelas_id);
        })->get();
        $modified_siswa_d = $siswa_d->groupBy(['siswa_id'])->map(function ($item) {
            $result = [];
            $result['siswa_id'] = $item[0]->siswa_id;
            $result['nama_siswa'] = $item[0]->siswa->nama_siswa;
            $result['nisn'] = $item[0]->siswa->nisn;
            foreach ($item as $doa_siswa) {
                $result[$doa_siswa->doa_1->nama_nilai] = $doa_siswa->penilaian_huruf_angka->nilai_angka;
            }
            return $result;
        });

        return view('/siswaDoa/indexSiswaDoa', 
        [
            'siswa_d'=>$modified_siswa_d,
            'data_kelas'=>$data_kelas,
        ]);
        
        //return response()->json($modified_siswa_d);
    }

    public function kelas_doa($kelas_id){
        $data_doa = Doa1::where('kelas_id', $kelas_id)->get();
        return response()->json($data_doa);
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
     * @param  \App\Http\Requests\StoreSiswaDoaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return response()->json($request->all());
        $doa_fields = [];
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'doa_') !== false || strpos($key, 'delete_') !== false) {
                $doa_fields[$key] = $value;
            }
        }

        // Update Doa if containt doa_(id) and delete if containt delete_(id)
        $berhasil = 0;
        $processed = 0;
        foreach ($doa_fields as $field => $value) {
            if (strpos($field, 'doa_') !== false) {
                $id = str_replace('doa_', '', $field);
                $doa = Doa1::find($id);
                $doa->nama_nilai = $value;
                if ($doa->save()) {
                    $berhasil++;
                }
                $processed++;
            } else if (strpos($field, 'delete_') !== false) {
                $id = str_replace('delete_', '', $field);
                $doa = Doa1::find($id);
                if ($doa->delete()) {
                    $berhasil++;
                }
                $processed++;
            }
        }

        if ($berhasil > 0 && $berhasil == $processed) {
            return response()->json(['success' => 'Data berhasil disimpan!', 'status' => '200']);
        } else {
            return response()->json(['error' => 'Data gagal disimpan!']);
        }  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SiswaDoa  $siswaDoa
     * @return \Illuminate\Http\Response
     */
    public function show($siswa_id)
    {
        // Url di route show menggunana siswa_id bukan id siswa_doa
        $siswaDoa = SiswaDoa::where('siswa_id', $siswa_id)->get();
        //return response()->json($siswaDoa);
        return view('/siswaDoa/showSiswaDoa', ['siswaDoa' => $siswaDoa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SiswaDoa  $siswaDoa
     * @return \Illuminate\Http\Response
     */
    public function edit(SiswaDoa $siswaDoa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSiswaDoaRequest  $request
     * @param  \App\Models\SiswaDoa  $siswaDoa
     * @return \Illuminate\Http\Response
     */
public function update(Request $request, $siswa_id)
{
    $messages = [];
    $validator_rules = [];
    $doa_fields = [];

    foreach ($request->all() as $key => $value) {
        $doa_fields[] = $key;
    }

    foreach ($doa_fields as $field) {
        $messages[$field.'.integer'] = 'Nilai doa harus berupa angka.';
        $messages[$field.'.min'] = 'Nilai doa tidak boleh kurang dari 0.';
        $messages[$field.'.max'] = 'Nilai doa tidak boleh lebih dari 100.';
        $validator_rules[$field] = 'integer|min:0|max:100';
    }

    $validator = Validator::make($request->all(), $validator_rules, $messages);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 422);
    }

    $berhasil = 0;
    foreach($request->all() as $key => $value) {
        $id = str_replace('doa_', '', $key);
        $siswaDoa = SiswaDoa::find($id);
        $siswaDoa->penilaian_huruf_angka_id = $value;
        if ($siswaDoa->save()) {
            $berhasil++;
        }
    }
    $count_request = count($request->all());
    if ($berhasil > 0 && $berhasil == $count_request) {
        return response()->json(['success' => 'Data berhasil diupdate!', 'status' => '200']);
    } else {
        return response()->json(['error' => 'Data gagal diupdate!']);
    }

    //return response()->json($validator->validated());
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SiswaDoa  $siswaDoa
     * @return \Illuminate\Http\Response
     */

    public function destroy($siswa_id)
    {
        // Url di route destroy menggunana siswa_id bukan id siswa_doa
        $siswaDoa = SiswaDoa::where('siswa_id', $siswa_id)->get();
        $berhasil = 0;
        $processed = 0;
        foreach ($siswaDoa as $item) {
            // if ($item->delete()) {
            //     $berhasil++;
            // }
            $item->penilaian_huruf_angka_id = 101; // 101 = 0
            if ($item->save()) {
                $berhasil++;
            }
            $processed++;
        }

        if ($berhasil > 0 && $berhasil == $processed) {
            return response()->json(['success' => 'Data berhasil dihapus!', 'status' => '200']);
        } else {
            return response()->json(['error' => 'Data gagal dihapus!']);
        }
    }

    //get siswaDoa table for ajax and delete via sweetalert
    // public function getTable()
    // {
    //     $siswa_d = SiswaDoa::with('siswa','doa_1','doa_2','doa_3','doa_4','doa_5',
    //     'doa_6','doa_7','doa_8','doa_9','penilaian_huruf_angka')->get();
    //     return datatables()->of($siswa_d)
    //         ->addColumn('action', function ($siswa_d) {
    //             $btn = '<a href="'. route('siswaDoa.edit', $siswa_d->id) .'" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>';
    //             $btn .= '&nbsp;&nbsp;';
    //             $btn .= '<button type="button" name="delete" data-id="' . $siswa_d->id . '" class="btn btn-danger btn-sm delete"><i class="fas fa-trash"></i></button>';
    //         })
    //         ->rawColumns(['action'])
    //         ->addIndexColumn()
    //         ->make(true);
    // }
}
