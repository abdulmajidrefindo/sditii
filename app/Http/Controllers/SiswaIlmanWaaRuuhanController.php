<?php

namespace App\Http\Controllers;

use App\Models\SiswaIlmanWaaRuuhan;
use App\Models\IlmanWaaRuuhan;
use App\Models\Kelas;
use App\Models\SubKelas;
use App\Models\Periode;
use App\Models\PenilaianDeskripsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreSiswaIlmanWaaRuuhanRequest;
use App\Http\Requests\UpdateSiswaIlmanWaaRuuhanRequest;

//export excel
use App\Exports\SiswaIlmanWaaRuuhanExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SiswaIlmanWaaRuuhanImport;

class SiswaIlmanWaaRuuhanController extends Controller
{
    public function index(Request $request)
    {
        $periode = Periode::where('status','aktif')->first();
        $kelas = Kelas::all()->except(Kelas::all()->last()->id);
        
        $data_sub_kelas = SubKelas::with('kelas')->where('periode_id', $periode->id)->get();
        foreach ($data_sub_kelas as $key => $value) {
            $value->nama_kelas = $value->kelas->nama_kelas . " " . $value->nama_sub_kelas;
        }

        $kelas_id = $request->kelas_id;
        if ($kelas_id == null) {
            $kelas_id = 1;
        }

        $siswa_i = SiswaIlmanWaaRuuhan::with('siswa','ilman_waa_ruuhan','penilaian_huruf_angka')->where('periode_id',$periode->id)->whereHas('siswa', function ($query) use ($kelas_id) {
            $query->where('sub_kelas_id', $kelas_id);
        })->get();

        $kelas_aktif = null;
        if ($kelas_id != null) {
            $kelas_aktif = SubKelas::with('kelas')->where('id', $kelas_id)->first();
        }

        return view('/siswaIWR/indexSiswaIWR', 
        [
            'siswa_i'=>$siswa_i,
            'data_kelas'=>$kelas,
            'data_sub_kelas'=>$data_sub_kelas,
            'kelas_aktif'=>$kelas_aktif,
        ]);
    }

    public function show($data)
    {
        $catch_id = decrypt($data);
        $siswaIlmanWaaRuuhan = SiswaIlmanWaaRuuhan::with('siswa','ilman_waa_ruuhan','penilaian_huruf_angka')->where('id',$catch_id)->first();
        $penilaian_deskripsi = PenilaianDeskripsi::all();
        return view('/siswaIWR/showSiswaIWR', 
        [
            'siswaIlmanWaaRuuhan'=>$siswaIlmanWaaRuuhan,
            'penilaian_deskripsi'=>$penilaian_deskripsi
        ]);
    }

    public function update(Request $request, SiswaIlmanWaaRuuhan $siswaIlmanWaaRuuhan)
    {
        $messages = [];
        $validator_rules = [];
        $nilai_fields = ['ilman_waa_ruuhan_jilid', 'ilman_waa_ruuhan_halaman', 'ilman_waa_ruuhan_nilai'];
    
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

        $siswaIlmanWaaRuuhan->jilid = $request->ilman_waa_ruuhan_jilid;
        $siswaIlmanWaaRuuhan->halaman = $request->ilman_waa_ruuhan_halaman;
        $siswaIlmanWaaRuuhan->penilaian_huruf_angka_id = $request->ilman_waa_ruuhan_nilai;
    
        if ($siswaIlmanWaaRuuhan->save()) {
            return response()->json(['success' => 'Data berhasil diupdate!', 'status' => '200']);
        } else {
            return response()->json(['error' => 'Data gagal diupdate!']);
        }
    }

    public function destroy(SiswaIlmanWaaRuuhan $siswaIlmanWaaRuuhan)
    {

        $siswaIlmanWaaRuuhan = SiswaIlmanWaaRuuhan::find($siswaIlmanWaaRuuhan->id);
        $siswaIlmanWaaRuuhan->jilid = '0';
        $siswaIlmanWaaRuuhan->halaman = '0';
        $siswaIlmanWaaRuuhan->penilaian_deskripsi_id = 5;
        $siswaIlmanWaaRuuhan->penilaian_huruf_angka_id = 101;

        if ($siswaIlmanWaaRuuhan->save()) {
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
        $tahun_ajaran = str_replace('/', '-', $tahun_ajaran);
        $nama_file = 'Nilai Ilman Waa Ruuhan ' . $kelas . ' ' . $nama_sub_kelas . ' Semester ' . $semester . ' ' . $tahun_ajaran . '.xlsx';

        $kode = "FileNilaiIlmanWaaRuuhan";
        $file_identifier = encrypt($kode);

        $informasi = [
            'judul' => 'REKAP NILAI ILMAN WAA RUUHAN SDIT IRSYADUL \'IBAD',
            'nama_kelas' => $kelas . ' ' . $nama_sub_kelas,
            'wali_kelas' => $wali_kelas,
            'tahun_ajaran' => $tahun_ajaran,
            'semester' => $semester,
            'tanggal' => date('d-m-Y'),
            'file_identifier' => $file_identifier,
        ];

        return Excel::download(new SiswaIlmanWaaRuuhanExport($sub_kelas_id, $informasi), $nama_file);
    }

    public function import_excel(Request $request)
    {
        $file = $request->file('file_nilai_excel');
        $file_name = $file->getClientOriginalName();
        $kode = "FileNilaiIlmanWaaRuuhan";
        $import = new SiswaIlmanWaaRuuhanImport($kode);
        Excel::import($import, $file);

        if ($import->hasError()) {
            $errors = $import->getMessages();
            return redirect()->back()->with('upload_error', $errors);
        } else {
            $message = $import->getMessages();
            return redirect()->back()->with('upload_success', $message);
        }
    }
}
