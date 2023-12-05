<?php

namespace App\Http\Controllers;

use App\Models\SiswaHadist;
use App\Models\Hadist1;
use App\Models\Kelas;
use App\Models\SubKelas;
use App\Models\Guru;
use App\Models\Periode;
use App\Http\Requests\StoreSiswaHadistRequest;
use App\Http\Requests\UpdateSiswaHadistRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

//export excel
use App\Exports\SiswaHadistExport;
use Maatwebsite\Excel\Facades\Excel;

class SiswaHadistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        
        $periode = Periode::where('status','aktif')->first();
        $kelas_id = $request->kelas_id;
        $data_sub_kelas = SubKelas::with('kelas')->where('periode_id', $periode->id)->get();
        foreach ($data_sub_kelas as $key => $value) {
            $value->nama_kelas = $value->kelas->nama_kelas . " " . $value->nama_sub_kelas;
        }

        $data_kelas = Kelas::all()->except(Kelas::all()->last()->id);
        $data_guru = Guru::all();

        if ($kelas_id == null) {
            $kelas_id = 1;
        }

        $siswa_h = SiswaHadist::with('siswa','hadist_1','penilaian_huruf_angka')->where('periode_id',$periode->id)->whereHas('siswa', function ($query) use ($kelas_id) {
            $query->where('sub_kelas_id', $kelas_id);
        })->get();
        $modified_siswa_h = $siswa_h->groupBy(['siswa_id'])->map(function ($item) {
            $result = [];
            $result['siswa_id'] = $item[0]->siswa_id;
            $result['nama_siswa'] = $item[0]->siswa->nama_siswa;
            $result['nisn'] = $item[0]->siswa->nisn;
            foreach ($item as $hadist_siswa) {
                $result[$hadist_siswa->hadist_1->nama_nilai] = $hadist_siswa->penilaian_huruf_angka->nilai_angka;
            }
            return $result;
        });
        // return view('/siswaHadist/indexSiswaHadist', 
        // [
        //     'siswa_h'=>$siswa_h
        // ]);

        if ($kelas_id != null) {
            $kelas_aktif = SubKelas::with('kelas')->where('id', $kelas_id)->first();
        }
        
        return view('/siswaHadist/indexSiswaHadist', 
        [
            'siswa_h'=>$modified_siswa_h,
            'data_kelas'=>$data_kelas,
            'data_sub_kelas'=>$data_sub_kelas,
            'kelas_aktif'=>$kelas_aktif,
            'data_guru'=>$data_guru,
        ]);
    }

    public function kelas_hadist($kelas_id){
        $semester = Periode::where('status','aktif')->first();
        $data_hadist = Hadist1::where('kelas_id', $kelas_id)->where('periode_id', $semester->id)->get();
        return response()->json($data_hadist);
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
     * @param  \App\Http\Requests\StoreSiswaHadistRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSiswaHadistRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SiswaHadist  $siswaHadist
     * @return \Illuminate\Http\Response
     */
    public function show($siswa_id)
    {
        $siswaHadist = SiswaHadist::where('siswa_id', $siswa_id)->get();
        return view('/siswaHadist/showSiswaHadist', 
        [
            'siswaHadist'=>$siswaHadist
        ]);

        // return response()->json($siswaHadist);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SiswaHadist  $siswaHadist
     * @return \Illuminate\Http\Response
     */
    public function edit(SiswaHadist $siswaHadist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSiswaHadistRequest  $request
     * @param  \App\Models\SiswaHadist  $siswaHadist
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $siswa_id)
    {
        $messages = [];
        $hadist_fields = [];
        $validator_rules = [];

        foreach ($request->all() as $key => $value) {
            $hadist_fields[] = $key;
        }

        foreach ($hadist_fields as $field) {
            $messages[$field.'.integer'] = 'Nilai hadist harus berupa angka.';
            $messages[$field.'.min'] = 'Nilai hadist tidak boleh kurang dari 0.';
            $messages[$field.'.max'] = 'Nilai hadist tidak boleh lebih dari 100.';
            $validator_rules[$field] = 'integer|min:0|max:100';
        }

        $validator = Validator::make($request->all(), $validator_rules, $messages);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $berhasil = 0;
        foreach($request->all() as $key => $value) {
            $id = str_replace('hadist_', '', $key);
            $siswahadist = SiswaHadist::find($id);
            $value = ($value == 0) ? 101 : $value;
            $siswahadist->penilaian_huruf_angka_id = $value;
            if ($siswahadist->save()) {
                $berhasil++;
            }
        }
        $count_request = count($request->all());
        if ($berhasil > 0 && $berhasil == $count_request) {
            return response()->json(['success' => 'Data berhasil diupdate!', 'status' => '200']);
        } else {
            return response()->json(['error' => 'Data gagal diupdate!']);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SiswaHadist  $siswaHadist
     * @return \Illuminate\Http\Response
     */
    public function destroy($siswa_id)
    {
        $siswaHadist = SiswaHadist::where('siswa_id', $siswa_id)->get();
        $berhasil = 0;
        foreach ($siswaHadist as $item) {
            // if ($item->delete()) {
            //     $berhasil++;
            // }
            $item->penilaian_huruf_angka_id = 101; // 101 = 0
            if ($item->save()) {
                $berhasil++;
            }
        }

        if ($berhasil > 0) {
            return response()->json(['success' => 'Data berhasil dihapus!', 'status' => '200']);
        } else {
            return response()->json(['error' => 'Data gagal dihapus!']);
        }
    }

    public function export_excel(Request $request)
    {
        $sub_kelas_id = $request->sub_kelas_id;
        $sub_kelas = SubKelas::with('kelas','guru')->where('id', $sub_kelas_id)->first();
        $kelas = $sub_kelas->kelas->nama_kelas;
        $nama_sub_kelas = $sub_kelas->nama_sub_kelas;
        $wali_kelas = $sub_kelas->guru->nama_guru;
        $periode = Periode::where('status','aktif')->first();
        $semester = $periode->semester  == 1 ? 'Ganjil' : 'Genap';
        $tahun_ajaran = $periode->tahun_ajaran;
        //clean tahun ajaran remove '/'
        $tahun_ajaran = str_replace('/', '-', $tahun_ajaran);
        $nama_file = 'Nilai Hadist ' . $kelas . ' ' . $nama_sub_kelas . ' Semester ' . $semester . ' ' . $tahun_ajaran . '.xlsx';

        $kode = "FileNilaiHadist";
        $file_identifier = encrypt($kode);

        $informasi = [
            'judul' => 'REKAP NILAI HADIST SDIT IRSYADUL \'IBAD',
            'nama_kelas' => $kelas . ' ' . $nama_sub_kelas,
            'wali_kelas' => $wali_kelas,
            'tahun_ajaran' => $tahun_ajaran,
            'semester' => $semester,
            'tanggal' => date('d-m-Y'),
            'file_identifier' => $file_identifier,
        ];

        return Excel::download(new SiswaHadistExport($sub_kelas_id, $informasi), $nama_file);
    }

}
