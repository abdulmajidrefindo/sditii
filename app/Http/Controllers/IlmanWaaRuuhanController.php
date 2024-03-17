<?php

namespace App\Http\Controllers;

use App\Models\IlmanWaaRuuhan;
use App\Models\Siswa;
use App\Models\SiswaIlmanWaaRuuhan;
use App\Models\Kelas;
use App\Models\SubKelas;
use App\Models\Guru;
use App\Models\Periode;

use App\Http\Requests\StoreIlmanWaaRuuhanRequest;
use App\Http\Requests\UpdateIlmanWaaRuuhanRequest;

use Yajra\DataTables\DataTables;
use Yajra\DataTables\Utilities\Request;

class IlmanWaaRuuhanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        $data_guru = Guru::all();
        $data_kelas = Kelas::all()->except(7);

        $kelas_id = $request->kelas_id;
        $periode = Periode::where('status','aktif')->first();
        if ($kelas_id == null) {
            $siswa = IlmanWaaRuuhan::where('periode_id',$periode->id)->get();
        } else {
            $siswa = IlmanWaaRuuhan::where('kelas_id', $kelas_id)->where('periode_id',$periode->id)->get();
        }

        

        return view('dataIlmanWaaRuuhan.indexIlmanWaaRuuhan', compact('siswa', 'data_kelas', 'data_guru'));
        
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
     * @param  \App\Http\Requests\StoreIlmanWaaRuuhanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIlmanWaaRuuhanRequest $request)
    {
        //kelas_iwr_tambah,tambah_iwr_1,tambah_iwr_2,tambah_iwr_guru_1,tambah_iwr_guru_2 etc
        $semester = Periode::where('status', 'aktif')->first()->id;
        //validation
        $fields = [];
        $fields[] = 'kelas_iwr_tambah';
        $messages = [];
        $messages['kelas_iwr_tambah.required'] = 'Kolom kelas_iwr_tambah tidak boleh kosong!';
        $validator_rules = [];
        $validator_rules['kelas_iwr_tambah'] = 'required';

        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'tambah_iwr_') !== false && strpos($key, 'tambah_iwr_guru_') === false) {
                $fields[] = $key;
            }
        }
        foreach ($fields as $key) {
            $messages[$key.'.required'] = 'Kolom '.$key.' tidak boleh kosong!';
            $validator_rules[$key] = 'required';
            if (strpos($key, 'tambah_iwr_') !== false && strpos($key, 'tambah_iwr_guru_') === false) {
                $index = str_replace('tambah_iwr_', '', $key);
                $messages['tambah_iwr_guru_'.$index.'.required'] = 'Kolom tambah_iwr_guru_'.$index.' tidak boleh kosong!';
                $validator_rules['tambah_iwr_guru_'.$index] = 'required';
            }
        }

        $request->validate($validator_rules, $messages);


        $kelas_id = $request->input('kelas_iwr_tambah');
        $new_iwr = [];
        $new_iwr_guru = [];
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'tambah_iwr_guru_') !== false) {
                $new_iwr_guru[str_replace('tambah_iwr_guru_', '', $key)] = $value;
            }
            else if (strpos($key, 'tambah_iwr_') !== false) {
                $new_iwr[str_replace('tambah_iwr_', '', $key)] = $value;
            }
        }

        $berhasil = 0;
        $processed = 0;
        $new_iwr_id = [];
        foreach ($new_iwr as $key => $value) {
            $iwr = new IlmanWaaRuuhan;
            $iwr->kelas_id = $kelas_id;
            $iwr->pencapaian = $value;
            $iwr->guru_id = $new_iwr_guru[$key];
            $iwr->periode_id = $semester;
            if ($iwr->save()) {
                $berhasil++;
                $new_iwr_id[] = $iwr->id;
            }
            $processed++;
        }

        $sub_kelas_id = SubKelas::where('kelas_id', $kelas_id)->where('periode_id', $semester)->pluck('id')->toArray();

        // Add siswaIlmanWaaRuuhan with nilai 0 for all siswa in kelas_id
        $siswas = Siswa::whereIn('sub_kelas_id', $sub_kelas_id)->get();
        foreach ($siswas as $siswa) {
            foreach ($new_iwr_id as $value) {
                $siswaIlmanWaaRuuhan = new SiswaIlmanWaaRuuhan;
                $siswaIlmanWaaRuuhan->siswa_id = $siswa->id;
                $siswaIlmanWaaRuuhan->ilman_waa_ruuhan_id = $value;
                $siswaIlmanWaaRuuhan->profil_sekolah_id = 1;
                $siswaIlmanWaaRuuhan->periode_id = $semester;
                $siswaIlmanWaaRuuhan->rapor_siswa_id = 1;
                $siswaIlmanWaaRuuhan->penilaian_deskripsi_id = 5; // 5 = Kosong
                $siswaIlmanWaaRuuhan->penilaian_huruf_angka_id = 101; // 101 = 0
                $siswaIlmanWaaRuuhan->jilid = 0;
                $siswaIlmanWaaRuuhan->halaman = 0;
                if ($siswaIlmanWaaRuuhan->save()) {
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
     * @param  \App\Models\IlmanWaaRuuhan  $ilmanWaaRuuhan
     * @return \Illuminate\Http\Response
     */
    public function show($data)
    {
        $catch_id = decrypt($data);
        $data_guru = Guru::all();
        $data_iwr = IlmanWaaRuuhan::with('kelas','guru')->where('id', $catch_id)->first();
        return view('dataIlmanWaaRuuhan.showIlmanWaaRuuhan', compact('data_iwr', 'data_guru'));
        //return response()->json($data_iwr);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IlmanWaaRuuhan  $ilmanWaaRuuhan
     * @return \Illuminate\Http\Response
     */
    public function edit(IlmanWaaRuuhan $ilmanWaaRuuhan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIlmanWaaRuuhanRequest  $request
     * @param  \App\Models\IlmanWaaRuuhan  $ilmanWaaRuuhan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIlmanWaaRuuhanRequest $request, IlmanWaaRuuhan $dataIlmanWaaRuuhan)
    {
        $rules = [
            'pencapaian' => 'required',
            'guru_id' => 'required',
        ];
        $messages = [
            'pencapaian.required' => 'Pencapaian tidak boleh kosong',
            'guru_id.required' => 'Guru tidak boleh kosong',
        ];
        $request->validate($rules, $messages);

        try {
            $dataIlmanWaaRuuhan->update([
                'pencapaian' => $request->pencapaian,
                'guru_id' => $request->guru_id,
            ]);
            return response()->json(['success' => 'Data berhasil disimpan!', 'status' => '200']);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Data gagal disimpan!', 'status' => '500']);
        }
    }

    public function update_data_iwr(){}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IlmanWaaRuuhan  $ilmanWaaRuuhan
     * @return \Illuminate\Http\Response
     */
    public function destroy(IlmanWaaRuuhan $dataIlmanWaaRuuhan)
    {
        try {
            $dataIlmanWaaRuuhan->delete();
            return response()->json(['success' => 'Data berhasil dihapus!', 'status' => '200']);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Data gagal dihapus!', 'status' => '500']);
        }
    }

    public function getTable(Request $request){
        if ($request->ajax()) {
            $periode = Periode::where('status','aktif')->first();
            if ($request->kelas_id == null) {
                $data = IlmanWaaRuuhan::with('kelas','guru')->where('periode_id',$periode->id)->get();
            } else {
                $data = IlmanWaaRuuhan::with('kelas','guru')->where('kelas_id', $request->kelas_id)->where('periode_id',$periode->id)->get();
            }
            
            return DataTables::of($data)
            ->addColumn('action', function ($row) {
                $encodedId = encrypt($row->id);
                $btn = '<a href="'. route('dataIlmanWaaRuuhan.show', $encodedId) .'" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Detail" class="btn btn-sm btn-success mx-1 shadow detail"><i class="fas fa-sm fa-fw fa-eye"></i> Detail</a>';
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
