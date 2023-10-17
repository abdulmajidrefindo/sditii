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
        $siswa_d = SiswaDoa::with('siswa','doa_1','doa_2','doa_3','doa_4','doa_5',
        'doa_6','doa_7','doa_8','doa_9','penilaian_huruf_angka')->get();
        $data_kelas = Kelas::all();
        return view('/siswaDoa/indexSiswaDoa', 
        [
            'siswa_d'=>$siswa_d,
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
    public function show(SiswaDoa $siswaDoa)
    {
        $siswaDoa = SiswaDoa::with('siswa','doa_1','doa_2','doa_3','doa_4','doa_5','doa_6','doa_7','doa_8','doa_9','penilaian_huruf_angka')->where('id', $siswaDoa->id)->firstOrFail();
        return view('/siswaDoa/showSiswaDoa', ['siswaDoa' => $siswaDoa]);
        //return response()->json($siswaDoa);
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
public function update(Request $request, SiswaDoa $siswaDoa)
{
    $messages = [];
    $validator_rules = [];
    $doa_fields = ['doa_1_id', 'doa_2_id', 'doa_3_id', 'doa_4_id', 'doa_5_id', 'doa_6_id', 'doa_7_id', 'doa_8_id', 'doa_9_id'];

    foreach ($doa_fields as $field) {
        $messages[$field.'.integer'] = 'Doa '.substr($field, -4, 1).' harus berupa angka.';
        $messages[$field.'.min'] = 'Doa '.substr($field, -4, 1).' tidak boleh kurang dari 0.';
        $messages[$field.'.max'] = 'Doa '.substr($field, -4, 1).' tidak boleh lebih dari 100.';
        $validator_rules[$field] = 'integer|min:0|max:100';
    }

    $validator = Validator::make($request->all(), $validator_rules, $messages);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 422);
    }

    foreach ($doa_fields as $field) {
        $siswaDoa->$field = $request->input($field);
    }

    if ($siswaDoa->save()) {
        return response()->json(['success' => 'Data berhasil diupdate!', 'status' => '200']);
    } else {
        return response()->json(['error' => 'Data gagal diupdate!']);
    }
    
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SiswaDoa  $siswaDoa
     * @return \Illuminate\Http\Response
     */
    public function destroy(SiswaDoa $siswaDoa)
    {
        if ($siswaDoa->delete()) {
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
