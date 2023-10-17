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
    $messages = [
        'doa_1_id.integer' => 'Doa 1 harus berupa angka.',
        'doa_2_id.integer' => 'Doa 2 harus berupa angka.',
        'doa_3_id.integer' => 'Doa 3 harus berupa angka.',
        'doa_4_id.integer' => 'Doa 4 harus berupa angka.',
        'doa_5_id.integer' => 'Doa 5 harus berupa angka.',
        'doa_6_id.integer' => 'Doa 6 harus berupa angka.',
        'doa_7_id.integer' => 'Doa 7 harus berupa angka.',
        'doa_8_id.integer' => 'Doa 8 harus berupa angka.',
        'doa_9_id.integer' => 'Doa 9 harus berupa angka.',
        'doa_1_id.min' => 'Doa 1 tidak boleh kurang dari 0.',
        'doa_2_id.min' => 'Doa 2 tidak boleh kurang dari 0.',
        'doa_3_id.min' => 'Doa 3 tidak boleh kurang dari 0.',
        'doa_4_id.min' => 'Doa 4 tidak boleh kurang dari 0.',
        'doa_5_id.min' => 'Doa 5 tidak boleh kurang dari 0.',
        'doa_6_id.min' => 'Doa 6 tidak boleh kurang dari 0.',
        'doa_7_id.min' => 'Doa 7 tidak boleh kurang dari 0.',
        'doa_8_id.min' => 'Doa 8 tidak boleh kurang dari 0.',
        'doa_9_id.min' => 'Doa 9 tidak boleh kurang dari 0.',
        'doa_1_id.max' => 'Doa 1 tidak boleh lebih dari 100.',
        'doa_2_id.max' => 'Doa 2 tidak boleh lebih dari 100.',
        'doa_3_id.max' => 'Doa 3 tidak boleh lebih dari 100.',
        'doa_4_id.max' => 'Doa 4 tidak boleh lebih dari 100.',
        'doa_5_id.max' => 'Doa 5 tidak boleh lebih dari 100.',
        'doa_6_id.max' => 'Doa 6 tidak boleh lebih dari 100.',
        'doa_7_id.max' => 'Doa 7 tidak boleh lebih dari 100.',
        'doa_8_id.max' => 'Doa 8 tidak boleh lebih dari 100.',
        'doa_9_id.max' => 'Doa 9 tidak boleh lebih dari 100.',
    ];

    $validator = Validator::make($request->all(), [
        'doa_1_id' => 'integer|min:0|max:100',
        'doa_2_id' => 'integer|min:0|max:100',
        'doa_3_id' => 'integer|min:0|max:100',
        'doa_4_id' => 'integer|min:0|max:100',
        'doa_5_id' => 'integer|min:0|max:100',
        'doa_6_id' => 'integer|min:0|max:100',
        'doa_7_id' => 'integer|min:0|max:100',
        'doa_8_id' => 'integer|min:0|max:100',
        'doa_9_id' => 'integer|min:0|max:100',
    ], $messages);

    

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 422);
    }

    $doa_1_id = $request->input('doa_1_id');
    $doa_2_id = $request->input('doa_2_id');
    $doa_3_id = $request->input('doa_3_id');
    $doa_4_id = $request->input('doa_4_id');
    $doa_5_id = $request->input('doa_5_id');
    $doa_6_id = $request->input('doa_6_id');
    $doa_7_id = $request->input('doa_7_id');
    $doa_8_id = $request->input('doa_8_id');
    $doa_9_id = $request->input('doa_9_id');

    $siswaDoa->doa_1_id = $doa_1_id;
    $siswaDoa->doa_2_id = $doa_2_id;
    $siswaDoa->doa_3_id = $doa_3_id;
    $siswaDoa->doa_4_id = $doa_4_id;
    $siswaDoa->doa_5_id = $doa_5_id;
    $siswaDoa->doa_6_id = $doa_6_id;
    $siswaDoa->doa_7_id = $doa_7_id;
    $siswaDoa->doa_8_id = $doa_8_id;
    $siswaDoa->doa_9_id = $doa_9_id;

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
