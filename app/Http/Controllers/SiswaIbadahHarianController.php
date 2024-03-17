<?php

namespace App\Http\Controllers;

use App\Models\SiswaIbadahHarian;
use App\Models\Siswa;
use App\Models\IbadahHarian1;
use App\Models\PenilaianDeskripsi;
use App\Models\Kelas;
use App\Models\SubKelas;
use App\Models\Guru;
use App\Models\Periode;
use App\Http\Requests\StoreSiswaIbadahHarianRequest;
use App\Http\Requests\UpdateSiswaIbadahHarianRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

//export excel
use App\Exports\SiswaIbadahHarianExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SiswaIbadahHarianImport;

class SiswaIbadahHarianController extends Controller
{
    public function index(Request  $request)
    {
        
        $periode = Periode::where('status','aktif')->first();
        $kelas_id = $request->kelas_id;
        $data_kelas = Kelas::all()->except(Kelas::all()->last()->id);
        
        $data_sub_kelas = SubKelas::with('kelas')->where('periode_id', $periode->id)->get();
        foreach ($data_sub_kelas as $key => $value) {
            $value->nama_kelas = $value->kelas->nama_kelas . " " . $value->nama_sub_kelas;
        }

        if ($kelas_id == null) {
            $kelas_id = 1;
        }

        $data_guru = Guru::all();
        $siswa_ib = SiswaIbadahHarian::with('siswa','ibadah_harian_1','penilaian_deskripsi')->where('periode_id',$periode->id)->whereHas('siswa', function ($query) use ($kelas_id) {
            $query->where('sub_kelas_id', $kelas_id);
        })->get();

        $modified_siswa_ib = $siswa_ib->groupBy(['siswa_id'])->map(function ($item) {
            $result = [];
            $result['siswa_id'] = $item[0]->siswa_id;
            $result['nama_siswa'] = $item[0]->siswa->nama_siswa;
            $result['nisn'] = $item[0]->siswa->nisn;
            foreach ($item as $ibadah_harian_siswa) {
                $result[$ibadah_harian_siswa->ibadah_harian_1->nama_kriteria] = $ibadah_harian_siswa->penilaian_deskripsi->keterangan;
            }
            return $result;
        });

        $kelas_aktif = null;
        if ($kelas_id != null) {
            $kelas_aktif = SubKelas::with('kelas')->where('id', $kelas_id)->first();
        }

        return view('/siswaIbadahHarian/indexSiswaIbadahHarian', 
        [
            'siswa_ib'=>$modified_siswa_ib,
            'data_kelas'=>$data_kelas,
            'kelas_aktif'=>$kelas_aktif,
            'data_sub_kelas'=>$data_sub_kelas,
            'data_guru'=>$data_guru,
        ]);
    }

    public function kelas_ibadah_harian($kelas_id){
        $semester = Periode::where('status','aktif')->first();
        $data_ibadah_harian = IbadahHarian1::where('kelas_id', $kelas_id)->where('periode_id', $semester->id)->get();
        return response()->json($data_ibadah_harian);
    }

    public function show($data)
    {
        $siswa_id = decrypt($data);
        $siswaIbadahHarian = SiswaIbadahHarian::where('siswa_id', $siswa_id)->get();
        $penilaian_deskripsi = PenilaianDeskripsi::all();
        return view('/siswaIbadahHarian/showSiswaIbadahHarian', 
        [
            'siswaIbadahHarian'=>$siswaIbadahHarian,
            'penilaian_deskripsi'=>$penilaian_deskripsi
        ]);
    }

    public function update(Request $request, $siswa_id)
    {
        $messages = [];
        $ibadah_harian_fields = [];
        $validator_rules = [];

        foreach ($request->all() as $key => $value) {
            $ibadah_harian_fields[] = $key;
        }
    
        foreach ($ibadah_harian_fields as $field) {
            $messages[$field.'.integer'] = 'Ibadah harian tak boleh kosong.';
            $messages[$field.'.min'] = 'Ibadah harian tidak boleh diluar pilihan.';
            $messages[$field.'.max'] = 'Ibadah harian tidak boleh diluar pilihan.';
            $validator_rules[$field] = 'integer|min:1|max:4';
        }
    
        $validator = Validator::make($request->all(), $validator_rules, $messages);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $berhasil = 0;
        $processed = 0;
        foreach($request->all() as $key => $value) {
            $id = str_replace('ibadah_harian_', '', $key);
            $siswaibadahharian = SiswaIbadahHarian::find($id);
            $siswaibadahharian->penilaian_deskripsi_id = $value;
            $processed++;
            if ($siswaibadahharian->save()) {
                $berhasil++;
            }
        }
        if ($berhasil > 0 && $berhasil == $processed) {
            return response()->json(['success' => 'Data berhasil diupdate!', 'status' => '200']);
        } else {
            return response()->json(['error' => 'Data gagal diupdate!']);
        }
    }
    
    public function destroy($siswa_id)
    {
        $siswa_ib = SiswaIbadahHarian::where('siswa_id', $siswa_id)->get();
        $berhasil = 0;
        $processed = 0;
        foreach ($siswa_ib as $ibadah_harian_siswa) {
            $processed++;

            $ibadah_harian_siswa->penilaian_deskripsi_id = 5;
            if ($ibadah_harian_siswa->save()) {
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
        $nama_file = 'Nilai Ibadah Harian ' . $kelas . ' ' . $nama_sub_kelas . ' Semester ' . $semester . ' ' . $tahun_ajaran . '.xlsx';

        $kode = "FileNilaiIbadahHarian";
        $file_identifier = encrypt($kode);

        $informasi = [
            'judul' => 'REKAP NILAI IBADAH HARIAN SDIT IRSYADUL \'IBAD',
            'nama_kelas' => $kelas . ' ' . $nama_sub_kelas,
            'wali_kelas' => $wali_kelas,
            'tahun_ajaran' => $tahun_ajaran,
            'semester' => $semester,
            'tanggal' => date('d-m-Y'),
            'file_identifier' => $file_identifier,
        ];

        return Excel::download(new SiswaIbadahHarianExport($sub_kelas_id, $informasi), $nama_file);
    }

    public function import_excel(Request $request)
    {
        $file = $request->file('file_nilai_excel');
        $file_name = $file->getClientOriginalName();
        $kode = "FileNilaiIbadahHarian";
        $import = new SiswaIbadahHarianImport($kode);
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
