<?php

namespace App\Http\Controllers;

use App\Models\Hadist1;
use App\Models\SiswaHadist;
use App\Models\Siswa;
use App\Models\Periode;
use App\Http\Requests\StoreHadistRequest;
use App\Http\Requests\UpdateHadistRequest;

use Illuminate\Http\Request;

class HadistController extends Controller
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
     * @param  \App\Http\Requests\StoreHadistRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //kelas_hadist_tambah,tambah_hadist_1,tambah_hadist_2,tambah_hadist_guru_1,tambah_hadist_guru_2 etc

        //validation
        $fields = [];
        $fields[] = 'kelas_hadist_tambah';
        $messages = [];
        $messages['kelas_hadist_tambah.required'] = 'Kolom kelas_hadist_tambah tidak boleh kosong!';
        $validator_rules = [];
        $validator_rules['kelas_hadist_tambah'] = 'required';

        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'tambah_hadist_') !== false && strpos($key, 'tambah_hadist_guru_') === false) {
                $fields[] = $key;
            }
        }
        foreach ($fields as $key) {
            $messages[$key.'.required'] = 'Kolom '.$key.' tidak boleh kosong!';
            $validator_rules[$key] = 'required';
            if (strpos($key, 'tambah_hadist_') !== false && strpos($key, 'tambah_hadist_guru_') === false) {
                $index = str_replace('tambah_hadist_', '', $key);
                $messages['tambah_hadist_guru_'.$index.'.required'] = 'Kolom tambah_hadist_guru_'.$index.' tidak boleh kosong!';
                $validator_rules['tambah_hadist_guru_'.$index] = 'required';
            }
        }

        $request->validate($validator_rules, $messages);


        $kelas_id = $request->input('kelas_hadist_tambah');
        $new_hadist = [];
        $new_hadist_guru = [];
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'tambah_hadist_guru_') !== false) {
                $new_hadist_guru[str_replace('tambah_hadist_guru_', '', $key)] = $value;
            }
            else if (strpos($key, 'tambah_hadist_') !== false) {
                $new_hadist[str_replace('tambah_hadist_', '', $key)] = $value;
            }
        }

        $berhasil = 0;
        $processed = 0;
        $new_hadist_id = [];
        foreach ($new_hadist as $key => $value) {
            $hadist = new Hadist1;
            $hadist->kelas_id = $kelas_id;
            $hadist->nama_nilai = $value;
            $hadist->guru_id = $new_hadist_guru[$key];
            if ($hadist->save()) {
                $berhasil++;
                $new_hadist_id[] = $hadist->id;
            }
            $processed++;
        }

        // Add siswaHadist with nilai 0 for all siswa in kelas_id
        $siswas = Siswa::where('kelas_id', $kelas_id)->get(); 
        foreach ($siswas as $siswa) {
            foreach ($new_hadist_id as $value) {
                $siswaHadist = new SiswaHadist;
                $siswaHadist->siswa_id = $siswa->id;
                $siswaHadist->hadist_1_id = $value;
                $siswaHadist->profil_sekolah_id = 1;
                $siswaHadist->periode_id = Periode::where('status', 'aktif')->first()->id;
                $siswaHadist->rapor_siswa_id = 1;
                $siswaHadist->penilaian_huruf_angka_id = 101; // Nilai -Kosong-
                if ($siswaHadist->save()) {
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
     * @param  \App\Models\Hadist  $hadist
     * @return \Illuminate\Http\Response
     */
    public function show(Hadist $hadist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hadist  $hadist
     * @return \Illuminate\Http\Response
     */
    public function edit(Hadist $hadist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHadistRequest  $request
     * @param  \App\Models\Hadist  $hadist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //return response()->json($request->all());
        $hadist_fields = [];
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'hadist_') !== false || strpos($key, 'delete_') !== false) {
                $hadist_fields[$key] = $value;
            }
        }

        // Update Hadist if containt hadist_(id) and delete if containt delete_(id)
        $berhasil = 0;
        $processed = 0;
        foreach ($hadist_fields as $field => $value) {
            if (strpos($field, 'hadist_') !== false) {
                $id = str_replace('hadist_', '', $field);
                $hadist = Hadist1::find($id);
                $hadist->nama_nilai = $value;
                if ($hadist->save()) {
                    $berhasil++;
                }
                $processed++;
            } else if (strpos($field, 'delete_') !== false) {
                $id = str_replace('delete_', '', $field);
                $hadist = Hadist1::find($id);
                if ($hadist->delete()) {
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
     * @param  \App\Models\Hadist  $hadist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hadist $hadist)
    {
        //
    }
}
