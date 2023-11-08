<?php

namespace App\Http\Controllers;

use App\Models\Tahfidz1;
use App\Models\SiswaTahfidz;
use App\Models\Siswa;
use App\Http\Requests\StoreTahfidzRequest;
use App\Http\Requests\UpdateTahfidzRequest;

use Illuminate\Http\Request;


class TahfidzController extends Controller
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
     * @param  \App\Http\Requests\StoreTahfidzRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //kelas_tahfidz_tambah,tambah_tahfidz_1,tambah_tahfidz_2,tambah_tahfidz_guru_1,tambah_tahfidz_guru_2 etc

        //validation
        $fields = [];
        $fields[] = 'kelas_tahfidz_tambah';
        $messages = [];
        $messages['kelas_tahfidz_tambah.required'] = 'Kolom kelas_tahfidz_tambah tidak boleh kosong!';
        $validator_rules = [];
        $validator_rules['kelas_tahfidz_tambah'] = 'required';

        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'tambah_tahfidz_') !== false && strpos($key, 'tambah_tahfidz_guru_') === false) {
                $fields[] = $key;
            }
        }
        foreach ($fields as $key) {
            $messages[$key.'.required'] = 'Kolom '.$key.' tidak boleh kosong!';
            $validator_rules[$key] = 'required';
            if (strpos($key, 'tambah_tahfidz_') !== false && strpos($key, 'tambah_tahfidz_guru_') === false) {
                $index = str_replace('tambah_tahfidz_', '', $key);
                $messages['tambah_tahfidz_guru_'.$index.'.required'] = 'Kolom tambah_tahfidz_guru_'.$index.' tidak boleh kosong!';
                $validator_rules['tambah_tahfidz_guru_'.$index] = 'required';
            }
        }

        $request->validate($validator_rules, $messages);


        $kelas_id = $request->input('kelas_tahfidz_tambah');
        $new_tahfidz = [];
        $new_tahfidz_guru = [];
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'tambah_tahfidz_guru_') !== false) {
                $new_tahfidz_guru[str_replace('tambah_tahfidz_guru_', '', $key)] = $value;
            }
            else if (strpos($key, 'tambah_tahfidz_') !== false) {
                $new_tahfidz[str_replace('tambah_tahfidz_', '', $key)] = $value;
            }
        }

        $berhasil = 0;
        $processed = 0;
        $new_tahfidz_id = [];
        foreach ($new_tahfidz as $key => $value) {
            $tahfidz = new Tahfidz1;
            $tahfidz->kelas_id = $kelas_id;
            $tahfidz->nama_nilai = $value;
            $tahfidz->guru_id = $new_tahfidz_guru[$key];
            if ($tahfidz->save()) {
                $berhasil++;
                $new_tahfidz_id[] = $tahfidz->id;
            }
            $processed++;
        }

        // Add siswaTahfidz with nilai 0 for all siswa in kelas_id
        $siswas = Siswa::where('kelas_id', $kelas_id)->get(); 
        foreach ($siswas as $siswa) {
            foreach ($new_tahfidz_id as $value) {
                $siswaTahfidz = new SiswaTahfidz;
                $siswaTahfidz->siswa_id = $siswa->id;
                $siswaTahfidz->tahfidz_1_id = $value;
                $siswaTahfidz->profil_sekolah_id = 1;
                $siswaTahfidz->periode_id = 1;
                $siswaTahfidz->rapor_siswa_id = 1;
                $siswaTahfidz->penilaian_huruf_angka_id = 101; // Nilai -Kosong-
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
     * @param  \App\Models\Tahfidz  $tahfidz
     * @return \Illuminate\Http\Response
     */
    public function show(Tahfidz $tahfidz)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tahfidz  $tahfidz
     * @return \Illuminate\Http\Response
     */
    public function edit(Tahfidz $tahfidz)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTahfidzRequest  $request
     * @param  \App\Models\Tahfidz  $tahfidz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //return response()->json($request->all());
        $tahfidz_fields = [];
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'tahfidz_') !== false || strpos($key, 'delete_') !== false) {
                $tahfidz_fields[$key] = $value;
            }
        }

        // Update Tahfidz if containt tahfidz_(id) and delete if containt delete_(id)
        $berhasil = 0;
        $processed = 0;
        foreach ($tahfidz_fields as $field => $value) {
            if (strpos($field, 'tahfidz_') !== false) {
                $id = str_replace('tahfidz_', '', $field);
                $tahfidz = Tahfidz1::find($id);
                $tahfidz->nama_nilai = $value;
                if ($tahfidz->save()) {
                    $berhasil++;
                }
                $processed++;
            } else if (strpos($field, 'delete_') !== false) {
                $id = str_replace('delete_', '', $field);
                $tahfidz = Tahfidz1::find($id);
                if ($tahfidz->delete()) {
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
     * @param  \App\Models\Tahfidz  $tahfidz
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tahfidz $tahfidz)
    {
        //
    }
}
