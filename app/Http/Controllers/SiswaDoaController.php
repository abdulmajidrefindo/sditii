<?php

namespace App\Http\Controllers;

use App\Models\SiswaDoa;
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
    public function index()
    {
        // Join table siswa_doa, siswa, doa_1, penilaian_huruf_angka where doa_1.kelas_id = 1
        $siswa_d = SiswaDoa::with('siswa','doa_1','penilaian_huruf_angka')->whereHas('doa_1', function ($query) {
            $query->where('kelas_id', 1);
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

        // $modified_siswa_d = [];
        // foreach ($siswa_d as $item) {
        //     $siswa_id = $item->siswa_id;
        //     if (!isset($modified_siswa_d[$siswa_id])) {
        //         $modified_siswa_d[$siswa_id] = [
        //             'siswa_id' => $item->siswa_id,
        //             'siswa_nama' => $item->siswa->nama_siswa,
        //             'kelas' => $item->siswa->kelas->id
        //         ];
        //     }

        //     $modified_siswa_d[$siswa_id][$item->doa_1->nama_nilai] = $item->penilaian_huruf_angka->nilai_angka;
        // }


        $data_kelas = Kelas::all();
        return view('/siswaDoa/indexSiswaDoa', 
        [
            'siswa_d'=>$modified_siswa_d,
            'data_kelas'=>$data_kelas
        ]);
        
        //return response()->json($modified_siswa_d);
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
    public function store(StoreSiswaDoaRequest $request)
    {
        //
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
        foreach ($siswaDoa as $item) {
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
