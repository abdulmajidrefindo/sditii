<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Http\Requests\StoreBidangStudiRequest;
use App\Http\Requests\UpdateBidangStudiRequest;

use Illuminate\Http\Request;

class BidangStudiController extends Controller
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
     * @param  \App\Http\Requests\StoreBidangStudiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBidangStudiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BidangStudi  $bidangStudi
     * @return \Illuminate\Http\Response
     */
    public function show(BidangStudi $bidangStudi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BidangStudi  $bidangStudi
     * @return \Illuminate\Http\Response
     */
    public function edit(BidangStudi $bidangStudi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBidangStudiRequest  $request
     * @param  \App\Models\BidangStudi  $bidangStudi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //return response()->json($request->all());
        $bidang_studi_fields = [];
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'bidang_studi_') !== false || strpos($key, 'delete_') !== false) {
                $bidang_studi_fields[$key] = $value;
            }
        }

        //validate
        $messages = [];
        $validator_rules = [];
        foreach ($bidang_studi_fields as $field => $value) {
            if (strpos($field, 'bidang_studi_') !== false) {
                $id = str_replace('bidang_studi_', '', $field);
                $messages["bidang_studi_$id.required"] = 'Bidang Studi tidak boleh kosong!';
                $validator_rules["bidang_studi_$id"] = 'required';
            }
        }

        $validator = \Validator::make($request->all(), $validator_rules, $messages);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Update Doa if containt bidang_studi_(id) and delete if containt delete_(id)
        $berhasil = 0;
        $processed = 0;
        foreach ($bidang_studi_fields as $field => $value) {
            if (strpos($field, 'bidang_studi_') !== false) {
                $id = str_replace('bidang_studi_', '', $field);
                $bidang_studi = Mapel::find($id);
                $bidang_studi->nama_mapel = $value;
                if ($bidang_studi->save()) {
                    $berhasil++;
                }
                $processed++;
            } else if (strpos($field, 'delete_') !== false) {
                $id = str_replace('delete_', '', $field);
                $bidang_studi = Mapel::find($id);
                if ($bidang_studi->delete()) {
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
     * @param  \App\Models\BidangStudi  $bidangStudi
     * @return \Illuminate\Http\Response
     */
    public function destroy(BidangStudi $bidangStudi)
    {
        //
    }
}
