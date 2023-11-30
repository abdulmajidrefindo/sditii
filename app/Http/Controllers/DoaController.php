<?php

namespace App\Http\Controllers;

use App\Models\Doa1;
use App\Models\SiswaDoa;
use App\Models\Siswa;
use App\Models\Periode;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\SubKelas;
use App\Http\Requests\StoreDoaRequest;
use App\Http\Requests\UpdateDoaRequest;

use Yajra\DataTables\DataTables;
use Yajra\DataTables\Utilities\Request;


use Illuminate\Validation\Rule;

class DoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data_guru = Guru::all();
        $periode = Periode::where('status','aktif')->first();
        
        $data_kelas = Kelas::all()->except(7);

        $kelas_id = $request->kelas_id;
        if ($kelas_id == null) {
            $siswa = Doa1::where('periode_id', $periode->id)->get();
        } else {
            $siswa = Doa1::where('kelas_id', $kelas_id)->where('periode_id', $periode->id)->get();
        }


        return view('dataDoa.indexDoa', compact('siswa', 'data_kelas', 'kelas_id', 'data_guru'));
        
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

        $sub_kelas_id = SubKelas::where('kelas_id', $kelas_id)->pluck('id')->toArray();

        // Add siswaDoa with nilai 0 for all siswa in kelas_id
        $siswas = Siswa::whereIn('sub_kelas_id', $sub_kelas_id)->get();
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
    public function show(Doa1 $dataDoa)
    {
        $data_doa = Doa1::with('kelas','periode','guru')->where('id', $dataDoa->id)->first();
        $data_kelas = Kelas::all()->except(7);
        $data_guru = Guru::all();
        $data_periode = Periode::all();
        return view('dataDoa.showDoa', compact('data_doa', 'data_kelas', 'data_guru', 'data_periode'));
        //return response()->json($data_doa);
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

    public function update(Doa1 $dataDoa, UpdateDoaRequest $request)
    {

        $validator_rules = [];
        if ($dataDoa->kelas_id != $request->kelas_id) {
            $validator_rules['nama_nilai'] = 'required|unique:doas_1,nama_nilai,' . $dataDoa->id . ',id,kelas_id,' . $request->kelas_id;
        }
        elseif ($dataDoa->nama_nilai != $request->nama_nilai) {
            $validator_rules['nama_nilai'] = 'required|unique:doas_1,nama_nilai,' . $dataDoa->id;
        }
        else {
            $validator_rules['nama_nilai'] = 'required';
        }
        $validator_rules['guru_id'] = 'required';
        $validator_rules['kelas_id'] = 'required';

        $messages = [];
        $messages['nama_nilai.required'] = 'Nama nilai tidak boleh kosong!';
        $messages['nama_nilai.unique'] = 'Nama nilai sudah ada di kelas ini!';
        $messages['guru_id.required'] = 'Guru tidak boleh kosong!';
        $messages['kelas_id.required'] = 'Kelas tidak boleh kosong!';

        $request->validate($validator_rules, $messages);

        $dataDoa->nama_nilai = $request->nama_nilai;
        $dataDoa->guru_id = $request->guru_id;
        
        if($dataDoa->kelas_id != $request->kelas_id){
            $dataDoa->kelas_id = $request->kelas_id;
            $siswa_doa = SiswaDoa::where('doa_1_id', $dataDoa->id)->get();
            foreach ($siswa_doa as $value) {
                $value->delete();
            }
            $sub_kelas_id = SubKelas::where('kelas_id', $request->kelas_id)->pluck('id')->toArray();
            $siswas = Siswa::whereIn('sub_kelas_id', $sub_kelas_id)->get();
            foreach ($siswas as $siswa) {
                $siswaDoa = new SiswaDoa;
                $siswaDoa->siswa_id = $siswa->id;
                $siswaDoa->doa_1_id = $dataDoa->id;
                $siswaDoa->profil_sekolah_id = 1;
                $siswaDoa->periode_id = Periode::where('status', 'aktif')->first()->id;
                $siswaDoa->rapor_siswa_id = 1;
                $siswaDoa->penilaian_huruf_angka_id = 101; // Nilai -Kosong-
                $siswaDoa->save();
            }
        }

        try {
            $dataDoa->save();
            return response()->json(['success' => 'Data berhasil disimpan!', 'status' => '200']);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Data gagal disimpan!']);
        }
    }

    /**
     * Update data doa dari halaman siswaDoa
     *
     * @param  \App\Http\Requests\UpdateDoaRequest  $request
     * @param  \App\Models\Doa  $doa
     * @return \Illuminate\Http\Response
     */
    public function update_data_doa(Request $request)
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
    public function destroy(Doa1 $dataDoa)
    {
        try {
            $dataDoa->delete();
            return response()->json(['success' => 'Data berhasil dihapus!', 'status' => '200']);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Data gagal dihapus!']);
        }
    }

    public function getTable(Request $request){
        if ($request->ajax()) {

            $periode = Periode::where('status','aktif')->first();

            if ($request->kelas_id == null) {
                $data = Doa1::with('kelas','periode','guru')->where('periode_id', $periode->id)->get();
            } else {
                $data = Doa1::with('kelas','periode','guru')->where('kelas_id', $request->kelas_id)->where('periode_id', $periode->id)->get();
            }
            
            return DataTables::of($data)
            ->addColumn('action', function ($row) {
                $btn = '<a href="'. route('dataDoa.show', $row) .'" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Detail" class="btn btn-sm btn-success mx-1 shadow detail"><i class="fas fa-sm fa-fw fa-eye"></i> Detail</a>';
                $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-sm btn-danger mx-1 shadow delete"><i class="fas fa-sm fa-fw fa-trash"></i> Delete</a>';
                
                return $btn;
            })
            ->editColumn('periode', function ($row) {
                return 'Semester '. $row->periode->semester.' ('.$row->periode->tahun_ajaran.')';
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }

}
