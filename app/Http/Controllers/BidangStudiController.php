<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\SiswaBidangStudi;
use App\Models\Siswa;
use App\Models\Periode;
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
    public function store(Request $request)
    {
        //kelas_bidang_studi_tambah,tambah_bidang_studi_1,tambah_bidang_studi_2,tambah_bidang_studi_guru_1,tambah_bidang_studi_guru_2 etc

        //validation
        $fields = [];
        $fields[] = 'kelas_bidang_studi_tambah';
        $messages = [];
        $messages['kelas_bidang_studi_tambah.required'] = 'Kolom kelas_bidang_studi_tambah tidak boleh kosong!';
        $validator_rules = [];
        $validator_rules['kelas_bidang_studi_tambah'] = 'required';

        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'tambah_bidang_studi_') !== false && strpos($key, 'tambah_bidang_studi_guru_') === false) {
                $fields[] = $key;
            }
        }
        foreach ($fields as $key) {
            $messages[$key.'.required'] = 'Kolom '.$key.' tidak boleh kosong!';
            $validator_rules[$key] = 'required';
            if (strpos($key, 'tambah_bidang_studi_') !== false && strpos($key, 'tambah_bidang_studi_guru_') === false) {
                $index = str_replace('tambah_bidang_studi_', '', $key);
                $messages['tambah_bidang_studi_guru_'.$index.'.required'] = 'Kolom tambah_bidang_studi_guru_'.$index.' tidak boleh kosong!';
                $validator_rules['tambah_bidang_studi_guru_'.$index] = 'required';
            }
        }

        $request->validate($validator_rules, $messages);


        $kelas_id = $request->input('kelas_bidang_studi_tambah');
        $new_bidang_studi = [];
        $new_bidang_studi_guru = [];
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'tambah_bidang_studi_guru_') !== false) {
                $new_bidang_studi_guru[str_replace('tambah_bidang_studi_guru_', '', $key)] = $value;
            }
            else if (strpos($key, 'tambah_bidang_studi_') !== false) {
                $new_bidang_studi[str_replace('tambah_bidang_studi_', '', $key)] = $value;
            }
        }

        $berhasil = 0;
        $processed = 0;
        $new_bidang_studi_id = [];
        foreach ($new_bidang_studi as $key => $value) {
            $bidang_studi = new Mapel;
            $bidang_studi->kelas_id = $kelas_id;
            $bidang_studi->nama_mapel = $value;
            $bidang_studi->guru_id = $new_bidang_studi_guru[$key];
            if ($bidang_studi->save()) {
                $berhasil++;
                $new_bidang_studi_id[] = $bidang_studi->id;
            }
            $processed++;
        }

        // Add siswaDoa with nilai 0 for all siswa in kelas_id
        $siswas = Siswa::where('kelas_id', $kelas_id)->get(); 
        foreach ($siswas as $siswa) {
            foreach ($new_bidang_studi_id as $value) {
                $siswaDoa = new SiswaBidangStudi;
                $siswaDoa->siswa_id = $siswa->id;
                $siswaDoa->mapel_id = $value;
                $siswaDoa->profil_sekolah_id = 1;
                $siswaDoa->periode_id = Periode::where('status', 'aktif')->first()->id;
                $siswaDoa->rapor_siswa_id = 1;
                $siswaDoa->nilai_uh_1 = 101;
                $siswaDoa->nilai_uh_2 = 101;
                $siswaDoa->nilai_uh_3 = 101;
                $siswaDoa->nilai_uh_4 = 101;
                $siswaDoa->nilai_tugas_1 = 101;
                $siswaDoa->nilai_tugas_2 = 101;
                $siswaDoa->nilai_uts = 101;
                $siswaDoa->nilai_pas = 101;
                if ($siswaDoa->save()) {
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
