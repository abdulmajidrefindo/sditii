<?php

namespace App\Http\Controllers;

use App\Models\Doa1;
use App\Models\SiswaDoa;
use App\Http\Requests\StoreDoaRequest;
use App\Http\Requests\UpdateDoaRequest;

use Illuminate\Http\Request;

class DoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreDoaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //kelas_doa_tambah,tambah_doa_1,tambah_doa_2,tambah_doa_guru_1,tambah_doa_guru_2
        $kelas_id = $request->input('kelas_doa_tambah');
        return response()->json($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doa  $doa
     * @return \Illuminate\Http\Response
     */
    public function show(Doa $doa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doa  $doa
     * @return \Illuminate\Http\Response
     */
    public function edit(Doa $doa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDoaRequest  $request
     * @param  \App\Models\Doa  $doa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doa  $doa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doa $doa)
    {
        //
    }
}
