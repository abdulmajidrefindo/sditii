<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreSiswaBidangStudiRequest;
use App\Http\Requests\UpdateSiswaBidangStudiRequest;
use App\Models\SiswaBidangStudi;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\SubKelas;
use App\Models\Guru;
use App\Models\Periode;


//export excel
use App\Exports\SiswaBidangStudiExport;
use Maatwebsite\Excel\Facades\Excel;

class SiswaBidangStudiController extends Controller
{
    public function choose(){
        $data_mapel=Mapel::all();
        $data_kelas=Kelas::all();
        return view('/siswaBidangStudi/indexSiswaBidangStudi', 
        [
            'data_mapel'=>$data_mapel,
            'data_kelas'=>$data_kelas
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $periode = Periode::where('status','aktif')->first();
        $data_kelas=Kelas::all()->except(Kelas::all()->last()->id);

        $data_sub_kelas = SubKelas::with('kelas')->where('periode_id', $periode->id)->get();
        foreach ($data_sub_kelas as $key => $value) {
            $value->nama_kelas = $value->kelas->nama_kelas . " " . $value->nama_sub_kelas;
        }

        $data_guru = Guru::all();
        $mapel=$request->mapel_id;

        $kelas_id=$request->kelas_id;

        $siswa_bs = SiswaBidangStudi::with('siswa','uh_1','uh_2','uh_3','uh_4','tugas_1','tugas_2','uts','pas')->where('mapel_id',$mapel)->where('periode_id',$periode->id)->whereHas('siswa', function ($query) use ($kelas_id) {
            $query->where('sub_kelas_id', $kelas_id);
        })->get();

        $kelas_aktif = null;
        $data_mapel= null;
        if ($kelas_id != null) {
            $kelas_aktif = SubKelas::with('kelas')->where('id', $kelas_id)->first();
            $data_mapel=Mapel::where('kelas_id',$kelas_aktif->kelas->id)->where('periode_id',$periode->id)->get();
        }

        return view('/siswaBidangStudi/indexSiswaBidangStudi', 
        [
            'data_mapel'=>$data_mapel,
            'data_kelas'=>$data_kelas,
            'kelas_aktif'=>$kelas_aktif,
            'data_sub_kelas'=>$data_sub_kelas,
            'siswa_bs'=>$siswa_bs,
            'data_guru'=>$data_guru,
        ]);

        //return response()->json($siswa_bs);
    }

    public function kelas_mapel($kelas_id){
        $semester = Periode::where('status','aktif')->first();
        $mapel = Mapel::where('kelas_id',$kelas_id)->where('periode_id',$semester->id)->get();
        return response()->json($mapel);
    }

    public function sub_kelas_mapel($sub_kelas_id){
        $semester = Periode::where('status','aktif')->first();
        $kelas_id = SubKelas::with('kelas')->where('id', $sub_kelas_id)->first()->kelas_id;
        $mapel = Mapel::where('kelas_id',$kelas_id)->where('periode_id',$semester->id)->get();
        return response()->json($mapel);
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
     * @param  \App\Http\Requests\StoreSiswaBidangStudiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSiswaBidangStudiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SiswaMapel  $siswaMapel
     * @return \Illuminate\Http\Response
     */
    public function show(SiswaBidangStudi $siswaBidangStudi)
    {
        $siswaBidangStudi = SiswaBidangStudi::with('siswa','uh_1','uh_2','uh_3','uh_4','tugas_1','tugas_2','uts','pas')->where('id',$siswaBidangStudi->id)->first();
        return view('/siswaBidangStudi/showSiswaBidangStudi', 
        [
            'siswaBidangStudi'=>$siswaBidangStudi
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SiswaMapel  $siswaMapel
     * @return \Illuminate\Http\Response
     */
    public function edit(SiswaBidangStudi $siswaBidangStudi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSiswaMapelRequest  $request
     * @param  \App\Models\SiswaMapel  $siswaMapel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SiswaBidangStudi $siswaBidangStudi)
    {

        $messages = [];
        $validator_rules = [];
        $nilai_fields = [];

        foreach ($request->all() as $key => $value) {
            $nilai_fields[] = $key;
        }
    
        foreach ($nilai_fields as $field) {
            $messages[$field.'.integer'] = 'Nilai harus berupa angka.';
            $messages[$field.'.min'] = 'Nilai tidak boleh kurang dari 0.';
            $messages[$field.'.max'] = 'Nilai tidak boleh lebih dari 100.';
            $validator_rules[$field] = 'integer|min:0|max:100';
        }
    
        $validator = Validator::make($request->all(), $validator_rules, $messages);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $nilai_akhir = ($request->nilai_uh_1 + $request->nilai_uh_2 + $request->nilai_uh_3 + $request->nilai_uh_4 + $request->nilai_tugas_1 + $request->nilai_tugas_2 + $request->nilai_uts + $request->nilai_pas)/8;
        foreach ($request->all() as $key => $value) {
            $value = $value == 0 ? 101 : $value;
            $siswaBidangStudi->$key = $value;
        }
        $siswaBidangStudi->nilai_akhir = round($nilai_akhir, 0);
    
        if ($siswaBidangStudi->save()) {
            return response()->json(['success' => 'Data berhasil diupdate!', 'status' => '200']);
        } else {
            return response()->json(['error' => 'Data gagal diupdate!']);
        }

        //return response()->json($request->all());
        
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SiswaMapel  $siswaMapel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswaBidangStudi = SiswaBidangStudi::find($id);
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
        $semester = $periode->semester  == 1 ? 'Ganjil' : 'Genap';
        $tahun_ajaran = $periode->tahun_ajaran;
        //clean tahun ajaran remove '/'
        $tahun_ajaran = str_replace('/', '-', $tahun_ajaran);
        $nama_file = 'Nilai Bidang Studi ' . $kelas . ' ' . $nama_sub_kelas . ' Semester ' . $semester . ' ' . $tahun_ajaran . '.xlsx';

        $kode = "FileNilaiBidangStudi";
        $file_identifier = encrypt($kode);

        $informasi = [
            'judul' => 'REKAP NILAI BIDANG STUDI SDIT IRSYADUL \'IBAD',
            'nama_kelas' => $kelas . ' ' . $nama_sub_kelas,
            'wali_kelas' => $wali_kelas,
            'tahun_ajaran' => $tahun_ajaran,
            'semester' => $semester,
            'tanggal' => date('d-m-Y'),
            'file_identifier' => $file_identifier,
        ];

        return Excel::download(new SiswaBidangStudiExport($sub_kelas_id, $informasi), $nama_file);
    }

}
