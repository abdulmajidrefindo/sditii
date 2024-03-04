<?php

namespace App\Http\Controllers;

use App\Models\SiswaTahfidz;
use App\Models\Tahfidz1;
use App\Models\Kelas;
use App\Models\SubKelas;
use App\Models\Guru;
use App\Models\Periode;
use App\Http\Requests\StoreSiswaTahfidzRequest;
use App\Http\Requests\UpdateSiswaTahfidzRequest;
use App\Models\PenilaianHurufAngka;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

//export excel
use App\Exports\SiswaTahfidzExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SiswaTahfidzImport;

class SiswaTahfidzController extends Controller
{
    public function index(Request $request)
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

        $siswa_t = SiswaTahfidz::with('siswa','tahfidz_1','penilaian_huruf_angka')->where('periode_id',$periode->id)->whereHas('siswa', function ($query) use ($kelas_id) {
            $query->where('sub_kelas_id', $kelas_id);
        })->get();

        $modified_siswa_t = $siswa_t->groupBy(['siswa_id'])->map(function ($item) {
            $result = [];
            $result['siswa_id'] = $item[0]->siswa_id;
            $result['nama_siswa'] = $item[0]->siswa->nama_siswa;
            $result['nisn'] = $item[0]->siswa->nisn;
            foreach ($item as $tahfidz_siswa) {
                $result[$tahfidz_siswa->tahfidz_1->nama_nilai] = $tahfidz_siswa->penilaian_huruf_angka->nilai_angka;
            }
            return $result;
        });

        $kelas_aktif = null;
        if ($kelas_id != null) {
            $kelas_aktif = SubKelas::with('kelas')->where('id', $kelas_id)->first();
        }

        return view('/siswaTahfidz/indexSiswaTahfidz', 
        [
            'siswa_t'=>$modified_siswa_t,
            'data_kelas'=>$data_kelas,
            'kelas_aktif'=>$kelas_aktif,
            'data_sub_kelas'=>$data_sub_kelas,
            'data_guru'=>$data_guru,
        ]);
    }

    public function kelas_tahfidz($kelas_id){
        $semester = Periode::where('status','aktif')->first();
        $data_tahfidz = Tahfidz1::where('kelas_id', $kelas_id)->where('periode_id', $semester->id)->get();
        return response()->json($data_tahfidz);
    }

    public function show($siswa_id)
    {
        $siswaTahfidz = SiswaTahfidz::where('siswa_id', $siswa_id)->get();
        return view('/siswaTahfidz/showSiswaTahfidz', 
        [
            'siswaTahfidz'=>$siswaTahfidz,
        ]);
    }

    public function update(Request $request, $siswa_id)
    {
        $messages = [];
        $tahfidz_fields = [];
        $validator_rules = [];

        foreach ($request->all() as $key => $value) {
            $tahfidz_fields[] = $key;
        }

        foreach ($tahfidz_fields as $field) {
            $messages[$field.'.integer'] = 'Nilai tahfidz harus berupa angka.';
            $messages[$field.'.min'] = 'Nilai tahfidz tidak boleh kurang dari 0.';
            $messages[$field.'.max'] = 'Nilai tahfidz tidak boleh lebih dari 100.';
            $validator_rules[$field] = 'integer|min:0|max:100';
        }

        $validator = Validator::make($request->all(), $validator_rules, $messages);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $berhasil = 0;
        foreach($request->all() as $key => $value) {
            $id = str_replace('tahfidz_', '', $key);
            $siswatahfidz = SiswaTahfidz::find($id);
            $value = ($value == 0) ? 101 : $value; 
            $siswatahfidz->penilaian_huruf_angka_id = $value;
            if ($siswatahfidz->save()) {
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

    public function destroy($siswa_id)
    {
        $siswaTahfidz = SiswaTahfidz::where('siswa_id', $siswa_id)->get();
        $berhasil = 0;
        $processed = 0;
        foreach ($siswaTahfidz as $item) {
            $processed++;

            $item->penilaian_huruf_angka_id = 101; // 101 = 0
            if ($item->save()) {
                $berhasil++;
            }
        }

        if ($berhasil > 0 && $berhasil == $processed) {
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
        $nama_file = 'Nilai Tahfidz ' . $kelas . ' ' . $nama_sub_kelas . ' Semester ' . $semester . ' ' . $tahun_ajaran . '.xlsx';

        $kode = "FileNilaiTahfidz";
        $file_identifier = encrypt($kode);

        $informasi = [
            'judul' => 'REKAP NILAI TAHFIDZ SDIT IRSYADUL \'IBAD',
            'nama_kelas' => $kelas . ' ' . $nama_sub_kelas,
            'wali_kelas' => $wali_kelas,
            'tahun_ajaran' => $tahun_ajaran,
            'semester' => $semester,
            'tanggal' => date('d-m-Y'),
            'file_identifier' => $file_identifier,
        ];

        return Excel::download(new SiswaTahfidzExport($sub_kelas_id, $informasi), $nama_file);
    }

    public function import_excel(Request $request)
    {
        $file = $request->file('file_nilai_excel');
        $file_name = $file->getClientOriginalName();
        $kode = "FileNilaiTahfidz";
        $import = new SiswaTahfidzImport($kode);
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
