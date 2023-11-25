<?php

namespace App\Http\Controllers;

use App\Models\Doa1;
use App\Models\SiswaDoa;
use App\Models\Siswa;
use App\Models\Periode;
use App\Models\Kelas;
use App\Models\SubKelas;
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
        //kelas_doa_tambah,tambah_doa_1,tambah_doa_2,tambah_doa_guru_1,tambah_doa_guru_2 etc
        $semester = Periode::where('status', 'aktif')->first()->id;

        //validation
        $fields = [];
        $fields[] = 'kelas_doa_tambah';
        $messages = [];
        $messages['kelas_doa_tambah.required'] = 'Kolom kelas_doa_tambah tidak boleh kosong!';
        $validator_rules = [];
        $validator_rules['kelas_doa_tambah'] = 'required';

        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'tambah_doa_') !== false && strpos($key, 'tambah_doa_guru_') === false) {
                $fields[] = $key;
            }
        }
        foreach ($fields as $key) {
            $messages[$key.'.required'] = 'Kolom '.$key.' tidak boleh kosong!';
            $validator_rules[$key] = 'required';
            if (strpos($key, 'tambah_doa_') !== false && strpos($key, 'tambah_doa_guru_') === false) {
                $index = str_replace('tambah_doa_', '', $key);
                $messages['tambah_doa_guru_'.$index.'.required'] = 'Kolom tambah_doa_guru_'.$index.' tidak boleh kosong!';
                $validator_rules['tambah_doa_guru_'.$index] = 'required';
            }
        }

        $request->validate($validator_rules, $messages);


        $kelas_id = $request->input('kelas_doa_tambah');
        $new_doa = [];
        $new_doa_guru = [];
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'tambah_doa_guru_') !== false) {
                $new_doa_guru[str_replace('tambah_doa_guru_', '', $key)] = $value;
            }
            else if (strpos($key, 'tambah_doa_') !== false) {
                $new_doa[str_replace('tambah_doa_', '', $key)] = $value;
            }
        }

        $berhasil = 0;
        $processed = 0;
        $new_doa_id = [];
        foreach ($new_doa as $key => $value) {
            $doa = new Doa1;
            $doa->kelas_id = $kelas_id;
            $doa->nama_nilai = $value;
            $doa->guru_id = $new_doa_guru[$key];
            $doa->periode_id = $semester;
            if ($doa->save()) {
                $berhasil++;
                $new_doa_id[] = $doa->id;
            }
            $processed++;
        }

        $sub_kelasid = SubKelas::where('kelas_id', $kelas_id)->pluck('id')->toArray();

        // Add siswaDoa with nilai 0 for all siswa in kelas_id
        $siswas = Siswa::whereIn('sub_kelas_id', $sub_kelasid)->get();
        foreach ($siswas as $siswa) {
            foreach ($new_doa_id as $value) {
                $siswaDoa = new SiswaDoa;
                $siswaDoa->siswa_id = $siswa->id;
                $siswaDoa->doa_1_id = $value;
                $siswaDoa->profil_sekolah_id = 1;
                $siswaDoa->periode_id = Periode::where('status', 'aktif')->first()->id;
                $siswaDoa->rapor_siswa_id = 1;
                $siswaDoa->penilaian_huruf_angka_id = 101; // Nilai -Kosong-
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
