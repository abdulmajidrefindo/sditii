<?php

namespace App\Http\Controllers;

use App\Models\SiswaDoa;
use App\Models\Doa1;
use App\Models\Kelas;
use App\Models\SubKelas;
use App\Models\Guru;
use App\Models\Periode;
use App\Http\Requests\StoreSiswaDoaRequest;
use App\Http\Requests\UpdateSiwaDoaRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

//export excel
use App\Exports\SiswaDoaExport;
use Maatwebsite\Excel\Facades\Excel;



class SiswaDoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $periode = Periode::where('status','aktif')->first();
        // Main page
        $kelas_id = $request->kelas_id;
        $data_sub_kelas = SubKelas::with('kelas')->where('periode_id', $periode->id)->get();
        $data_kelas = Kelas::all()->except(7);
        //add sub_kelas.nama_kelas by kelas.nama_kelas + sub_kelas.nama_sub_kelas
        foreach ($data_sub_kelas as $key => $value) {
            $value->nama_kelas = $value->kelas->nama_kelas . " " . $value->nama_sub_kelas;
        }
        $data_guru = Guru::all();

        if ($kelas_id == null) {
            $kelas_id = 1;
        }

        $siswa_d = SiswaDoa::with('siswa','doa_1','penilaian_huruf_angka')->where('periode_id',$periode->id)->whereHas('siswa', function ($query) use ($kelas_id) {
            $query->where('sub_kelas_id', $kelas_id);
        })->get();

        $modified_siswa_d = $siswa_d->groupBy(['siswa_id'])->map(function ($item) {
            $result = [];
            $result['siswa_id'] = $item[0]->siswa_id;
            $result['nama_siswa'] = $item[0]->siswa->nama_siswa;
            $result['nisn'] = $item[0]->siswa->nisn;
            foreach ($item as $doa_siswa) {
                $result[$doa_siswa->doa_1->nama_nilai] = $doa_siswa->penilaian_huruf_angka->nilai_angka;
            }
            return $result;
        });

        $kelas_aktif = null;
        if ($kelas_id != null) {
            $kelas_aktif = SubKelas::with('kelas')->where('id', $kelas_id)->first();
        }

        return view('/siswaDoa/indexSiswaDoa', 
        [
            'siswa_d'=>$modified_siswa_d,
            'data_kelas'=>$data_kelas,
            'data_sub_kelas'=>$data_sub_kelas,
            'data_guru'=>$data_guru,
            'kelas_aktif'=>$kelas_aktif,
        ]);
        
        //return response()->json($modified_siswa_d);
    }

    public function kelas_doa($kelas_id){
        $semester = Periode::where('status','aktif')->first();
        $data_doa = Doa1::where('kelas_id', $kelas_id)->where('periode_id', $semester->id)->get();
        return response()->json($data_doa);
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
     * @param  \App\Http\Requests\StoreSiswaDoaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SiswaDoa  $siswaDoa
     * @return \Illuminate\Http\Response
     */
    public function show($siswa_id)
    {
        // Url di route show menggunana siswa_id bukan id siswa_doa
        $siswaDoa = SiswaDoa::where('siswa_id', $siswa_id)->get();
        //return response()->json($siswaDoa);
        return view('/siswaDoa/showSiswaDoa', ['siswaDoa' => $siswaDoa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SiswaDoa  $siswaDoa
     * @return \Illuminate\Http\Response
     */
    public function edit(SiswaDoa $siswaDoa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSiswaDoaRequest  $request
     * @param  \App\Models\SiswaDoa  $siswaDoa
     * @return \Illuminate\Http\Response
     */
public function update(Request $request, $siswa_id)
{
    $messages = [];
    $validator_rules = [];
    $doa_fields = [];

    foreach ($request->all() as $key => $value) {
        $doa_fields[] = $key;
    }

    foreach ($doa_fields as $field) {
        $messages[$field.'.integer'] = 'Nilai doa harus berupa angka.';
        $messages[$field.'.min'] = 'Nilai doa tidak boleh kurang dari 0.';
        $messages[$field.'.max'] = 'Nilai doa tidak boleh lebih dari 100.';
        $validator_rules[$field] = 'integer|min:0|max:100';
    }

    $validator = Validator::make($request->all(), $validator_rules, $messages);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 422);
    }

    $berhasil = 0;
    foreach($request->all() as $key => $value) {
        $id = str_replace('doa_', '', $key);
        $siswaDoa = SiswaDoa::find($id);
        $siswaDoa->penilaian_huruf_angka_id = $value;
        if ($siswaDoa->save()) {
            $berhasil++;
        }
    }
    $count_request = count($request->all());
    if ($berhasil > 0 && $berhasil == $count_request) {
        return response()->json(['success' => 'Data berhasil diupdate!', 'status' => '200']);
    } else {
        return response()->json(['error' => 'Data gagal diupdate!']);
    }

    //return response()->json($validator->validated());
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SiswaDoa  $siswaDoa
     * @return \Illuminate\Http\Response
     */

    public function destroy($siswa_id)
    {
        // Url di route destroy menggunana siswa_id bukan id siswa_doa
        $siswaDoa = SiswaDoa::where('siswa_id', $siswa_id)->get();
        $berhasil = 0;
        $processed = 0;
        foreach ($siswaDoa as $item) {
            // if ($item->delete()) {
            //     $berhasil++;
            // }
            $item->penilaian_huruf_angka_id = 101; // 101 = 0
            if ($item->save()) {
                $berhasil++;
            }
            $processed++;
        }

        if ($berhasil > 0 && $berhasil == $processed) {
            return response()->json(['success' => 'Data berhasil dihapus!', 'status' => '200']);
        } else {
            return response()->json(['error' => 'Data gagal dihapus!']);
        }
    }

    public function export_excel($sub_kelas_id)
    {
        $sub_kelas = SubKelas::with('kelas','guru')->where('id', $sub_kelas_id)->first();
        $kelas = $sub_kelas->kelas->nama_kelas;
        $nama_sub_kelas = $sub_kelas->nama_sub_kelas;
        $wali_kelas = $sub_kelas->guru->nama_guru;
        $periode = Periode::where('status','aktif')->first();
        $semester = $periode->semester  == 1 ? 'ganjil' : 'genap';
        $tahun_ajaran = $periode->tahun_ajaran;
        //clean tahun ajaran remove '/'
        $tahun_ajaran = str_replace('/', '-', $tahun_ajaran);
        $nama_file = 'Nilai Doa ' . $kelas . ' ' . $nama_sub_kelas . ' Semester ' . $semester . ' ' . $tahun_ajaran . '.xlsx';

        $kode = "FileNilaiDoa";
        $file_identifier = encrypt($kode);

        $informasi = [
            'judul' => 'REKAP NILAI DO\'A SDIT IRSYADUL \'IBAD',
            'nama_kelas' => $kelas . ' ' . $nama_sub_kelas,
            'wali_kelas' => $wali_kelas,
            'tahun_ajaran' => $tahun_ajaran,
            'semester' => $semester,
            'tanggal' => date('d-m-Y'),
            'file_identifier' => $file_identifier,
        ];

        return Excel::download(new SiswaDoaExport($sub_kelas_id, $informasi), $nama_file);
    }

    //get siswaDoa table for ajax and delete via sweetalert
    // public function getTable()
    // {
    //     $siswa_d = SiswaDoa::with('siswa','doa_1','doa_2','doa_3','doa_4','doa_5',
    //     'doa_6','doa_7','doa_8','doa_9','penilaian_huruf_angka')->get();
    //     return datatables()->of($siswa_d)
    //         ->addColumn('action', function ($siswa_d) {
    //             $btn = '<a href="'. route('siswaDoa.edit', $siswa_d->id) .'" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>';
    //             $btn .= '&nbsp;&nbsp;';
    //             $btn .= '<button type="button" name="delete" data-id="' . $siswa_d->id . '" class="btn btn-danger btn-sm delete"><i class="fas fa-trash"></i></button>';
    //         })
    //         ->rawColumns(['action'])
    //         ->addIndexColumn()
    //         ->make(true);
    // }
}
