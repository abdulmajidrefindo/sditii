<?php

namespace App\Http\Controllers;

use App\Models\IbadahHarian1;
use App\Models\SiswaIbadahHarian;
use App\Models\Siswa;
use App\Http\Requests\StoreIbadahHarianRequest;
use App\Http\Requests\UpdateIbadahHarianRequest;

use Illuminate\Http\Request;

class IbadahHarianController extends Controller
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
     * @param  \App\Http\Requests\StoreIbadahHarianRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //kelas_ibadah_harian_tambah,tambah_ibadah_harian_1,tambah_ibadah_harian_2,tambah_ibadah_harian_guru_1,tambah_ibadah_harian_guru_2 etc

        //validation
        $fields = [];
        $fields[] = 'kelas_ibadah_harian_tambah';
        $messages = [];
        $messages['kelas_ibadah_harian_tambah.required'] = 'Kolom kelas_ibadah_harian_tambah tidak boleh kosong!';
        $validator_rules = [];
        $validator_rules['kelas_ibadah_harian_tambah'] = 'required';

        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'tambah_ibadah_harian_') !== false && strpos($key, 'tambah_ibadah_harian_guru_') === false) {
                $fields[] = $key;
            }
        }
        foreach ($fields as $key) {
            $messages[$key.'.required'] = 'Kolom '.$key.' tidak boleh kosong!';
            $validator_rules[$key] = 'required';
            if (strpos($key, 'tambah_ibadah_harian_') !== false && strpos($key, 'tambah_ibadah_harian_guru_') === false) {
                $index = str_replace('tambah_ibadah_harian_', '', $key);
                $messages['tambah_ibadah_harian_guru_'.$index.'.required'] = 'Kolom tambah_ibadah_harian_guru_'.$index.' tidak boleh kosong!';
                $validator_rules['tambah_ibadah_harian_guru_'.$index] = 'required';
            }
        }

        $request->validate($validator_rules, $messages);


        $kelas_id = $request->input('kelas_ibadah_harian_tambah');
        $new_ibadah_harian = [];
        $new_ibadah_harian_guru = [];
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'tambah_ibadah_harian_guru_') !== false) {
                $new_ibadah_harian_guru[str_replace('tambah_ibadah_harian_guru_', '', $key)] = $value;
            }
            else if (strpos($key, 'tambah_ibadah_harian_') !== false) {
                $new_ibadah_harian[str_replace('tambah_ibadah_harian_', '', $key)] = $value;
            }
        }

        $berhasil = 0;
        $processed = 0;
        $new_ibadah_harian_id = [];
        foreach ($new_ibadah_harian as $key => $value) {
            $ibadah_harian = new IbadahHarian1;
            $ibadah_harian->kelas_id = $kelas_id;
            $ibadah_harian->nama_kriteria = $value;
            $ibadah_harian->guru_id = $new_ibadah_harian_guru[$key];
            if ($ibadah_harian->save()) {
                $berhasil++;
                $new_ibadah_harian_id[] = $ibadah_harian->id;
            }
            $processed++;
        }

        // Add siswaTahfidz with nilai 0 for all siswa in kelas_id
        $siswas = Siswa::where('kelas_id', $kelas_id)->get(); 
        foreach ($siswas as $siswa) {
            foreach ($new_ibadah_harian_id as $value) {
                $siswaTahfidz = new SiswaIbadahHarian;
                $siswaTahfidz->siswa_id = $siswa->id;
                $siswaTahfidz->ibadah_harian_1_id = $value;
                $siswaTahfidz->profil_sekolah_id = 1;
                $siswaTahfidz->periode_id = 1;
                $siswaTahfidz->rapor_siswa_id = 1;
                $siswaTahfidz->penilaian_deskripsi_id = 5;
                if ($siswaTahfidz->save()) {
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
     * @param  \App\Models\IbadahHarian  $ibadahHarian
     * @return \Illuminate\Http\Response
     */
    public function show(IbadahHarian $ibadahHarian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IbadahHarian  $ibadahHarian
     * @return \Illuminate\Http\Response
     */
    public function edit(IbadahHarian $ibadahHarian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIbadahHarianRequest  $request
     * @param  \App\Models\IbadahHarian  $ibadahHarian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //return response()->json($request->all());
        $ibadah_harian_fields = [];
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'ibadah_harian_') !== false || strpos($key, 'delete_') !== false) {
                $ibadah_harian_fields[$key] = $value;
            }
        }

        // Update Tahfidz if containt ibadah_harian_(id) and delete if containt delete_(id)
        $berhasil = 0;
        $processed = 0;
        foreach ($ibadah_harian_fields as $field => $value) {
            if (strpos($field, 'ibadah_harian_') !== false) {
                $id = str_replace('ibadah_harian_', '', $field);
                $ibadah_harian = IbadahHarian1::find($id);
                $ibadah_harian->nama_kriteria = $value;
                if ($ibadah_harian->save()) {
                    $berhasil++;
                }
                $processed++;
            } else if (strpos($field, 'delete_') !== false) {
                $id = str_replace('delete_', '', $field);
                $ibadah_harian = IbadahHarian1::find($id);
                if ($ibadah_harian->delete()) {
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
     * @param  \App\Models\IbadahHarian  $ibadahHarian
     * @return \Illuminate\Http\Response
     */
    public function destroy(IbadahHarian $ibadahHarian)
    {
        //
    }
}
