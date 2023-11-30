<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\SiswaBidangStudi;
use App\Models\Siswa;
use App\Models\Periode;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\SubKelas;
use App\Http\Requests\StoreBidangStudiRequest;
use App\Http\Requests\UpdateBidangStudiRequest;


use Yajra\DataTables\DataTables;
use Yajra\DataTables\Utilities\Request;

class BidangStudiController extends Controller
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
            $siswa = Mapel::where('periode_id', $periode->id)->get();
        } else {
            $siswa = Mapel::where('kelas_id', $kelas_id)->where('periode_id', $periode->id)->get();
        }

        

        return view('dataBidangStudi.indexBidangStudi', compact('siswa', 'data_kelas', 'kelas_id', 'data_guru'));
        
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
        $semester = Periode::where('status', 'aktif')->first()->id;
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
            $bidang_studi->periode_id = $semester;
            if ($bidang_studi->save()) {
                $berhasil++;
                $new_bidang_studi_id[] = $bidang_studi->id;
            }
            $processed++;
        }

        $sub_kelas_id = SubKelas::where('kelas_id', $kelas_id)->pluck('id')->toArray();

        // Add siswaBidangStudi with nilai 0 for all siswa in kelas_id
        $siswas = Siswa::whereIn('sub_kelas_id', $sub_kelas_id)->get();
        foreach ($siswas as $siswa) {
            foreach ($new_bidang_studi_id as $value) {
                $siswaBidangStudi = new SiswaBidangStudi;
                $siswaBidangStudi->siswa_id = $siswa->id;
                $siswaBidangStudi->mapel_id = $value;
                $siswaBidangStudi->profil_sekolah_id = 1;
                $siswaBidangStudi->periode_id = Periode::where('status', 'aktif')->first()->id;
                $siswaBidangStudi->rapor_siswa_id = 1;
                $siswaBidangStudi->nilai_uh_1 = 101;
                $siswaBidangStudi->nilai_uh_2 = 101;
                $siswaBidangStudi->nilai_uh_3 = 101;
                $siswaBidangStudi->nilai_uh_4 = 101;
                $siswaBidangStudi->nilai_tugas_1 = 101;
                $siswaBidangStudi->nilai_tugas_2 = 101;
                $siswaBidangStudi->nilai_uts = 101;
                $siswaBidangStudi->nilai_pas = 101;
                $siswaBidangStudi->nilai_akhir = 101;
                if ($siswaBidangStudi->save()) {
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
    public function show(Mapel $dataBidangStudi)
    {
        $data_bidang_studi = Mapel::with('kelas','periode','guru')->where('id', $dataBidangStudi->id)->first();
        $data_kelas = Kelas::all()->except(7);
        $data_guru = Guru::all();
        $data_periode = Periode::all();
        return view('dataBidangStudi.showBidangStudi', compact('data_bidang_studi', 'data_kelas', 'data_guru', 'data_periode'));
        //return response()->json($data_bidang_studi);
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

    public function update(Mapel $dataBidangStudi, UpdateBidangStudiRequest $request)
    {
        $validator_rules = [];
        if ($dataBidangStudi->kelas_id != $request->kelas_id) {
            $validator_rules['nama_mapel'] = 'required|unique:mapels,nama_mapel,' . $dataBidangStudi->id . ',id,kelas_id,' . $request->kelas_id;
        }
        elseif ($dataBidangStudi->nama_mapel != $request->nama_mapel) {
            $validator_rules['nama_mapel'] = 'required|unique:mapels,nama_mapel,' . $dataBidangStudi->id;
        }
        else {
            $validator_rules['nama_mapel'] = 'required';
        }
        $validator_rules['guru_id'] = 'required';
        $validator_rules['kelas_id'] = 'required';

        $messages = [];
        $messages['nama_mapel.required'] = 'Nama bidang studi tidak boleh kosong!';
        $messages['nama_mapel.unique'] = 'Nama bidang studi sudah ada di kelas ini!';
        $messages['guru_id.required'] = 'Guru tidak boleh kosong!';
        $messages['kelas_id.required'] = 'Kelas tidak boleh kosong!';

        $request->validate($validator_rules, $messages);

        $dataBidangStudi->nama_mapel = $request->nama_mapel;
        $dataBidangStudi->guru_id = $request->guru_id;
        
        if($dataBidangStudi->kelas_id != $request->kelas_id){
            $dataBidangStudi->kelas_id = $request->kelas_id;
            $siswa_bidang_studi = SiswaBidangStudi::where('mapel_id', $dataBidangStudi->id)->get();
            foreach ($siswa_bidang_studi as $value) {
                $value->delete();
            }
            $sub_kelas_id = SubKelas::where('kelas_id', $request->kelas_id)->pluck('id')->toArray();
            $siswas = Siswa::whereIn('sub_kelas_id', $sub_kelas_id)->get();
            foreach ($siswas as $siswa) {
                $siswaBidangStudi = new SiswaBidangStudi;
                $siswaBidangStudi->siswa_id = $siswa->id;
                $siswaBidangStudi->mapel_id = $dataBidangStudi->id;
                $siswaBidangStudi->profil_sekolah_id = 1;
                $siswaBidangStudi->periode_id = Periode::where('status', 'aktif')->first()->id;
                $siswaBidangStudi->rapor_siswa_id = 1;
                $siswaBidangStudi->nilai_uh_1 = 101;
                $siswaBidangStudi->nilai_uh_2 = 101;
                $siswaBidangStudi->nilai_uh_3 = 101;
                $siswaBidangStudi->nilai_uh_4 = 101;
                $siswaBidangStudi->nilai_tugas_1 = 101;
                $siswaBidangStudi->nilai_tugas_2 = 101;
                $siswaBidangStudi->nilai_uts = 101;
                $siswaBidangStudi->nilai_pas = 101;
                $siswaBidangStudi->nilai_akhir = 101;
                $siswaBidangStudi->save();
            }
        }

        try {
            $dataBidangStudi->save();
            return response()->json(['success' => 'Data berhasil disimpan!', 'status' => '200']);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Data gagal disimpan!']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBidangStudiRequest  $request
     * @param  \App\Models\BidangStudi  $bidangStudi
     * @return \Illuminate\Http\Response
     */
    public function update_data_bidang_studi(Request $request)
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
    public function destroy(Mapel $dataBidangStudi)
    {
        try {
            $dataBidangStudi->delete();
            return response()->json(['success' => 'Data berhasil dihapus!', 'status' => '200']);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Data gagal dihapus!']);
        }
    }


    public function getTable(Request $request){
        if ($request->ajax()) {
            $periode = Periode::where('status','aktif')->first();
            if ($request->kelas_id == null) {
                $data = Mapel::with('kelas','periode','guru')->where('periode_id',$periode->id)->get();
            } else {
                $data = Mapel::with('kelas','periode','guru')->where('kelas_id', $request->kelas_id)->where('periode_id',$periode->id)->get();
            }
            
            return DataTables::of($data)
            ->addColumn('action', function ($row) {
                $btn = '<a href="'. route('dataBidangStudi.show', $row) .'" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Detail" class="btn btn-sm btn-success mx-1 shadow detail"><i class="fas fa-sm fa-fw fa-eye"></i> Detail</a>';
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
