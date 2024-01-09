<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\SubKelas;

use App\Models\Tahfidz1;
use App\Models\SiswaTahfidz;
use App\Models\Doa1;
use App\Models\SiswaDoa;
use App\Models\Hadist1;
use App\Models\SiswaHadist;
use App\Models\IbadahHarian1;
use App\Models\SiswaIbadahHarian;
use App\Models\IlmanWaaRuuhan;
use App\Models\SiswaIlmanWaaRuuhan;
use App\Models\Mapel;
use App\Models\SiswaBidangStudi;
use App\Models\Periode;

use App\Http\Requests\StoreGuruRequest;
use App\Http\Requests\UpdateGuruRequest;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Utilities\Request;
use App\Http\Controllers\Controller;

//export excel
use App\Exports\SiswaExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SiswaImport;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $periode = Periode::where('status','aktif')->first();
        $kelas = SubKelas::with('kelas')->where('periode_id',$periode->id)->get();
        //add sub_kelas.nama_kelas by kelas.nama_kelas + sub_kelas.nama_sub_kelas
        foreach ($kelas as $key => $value) {
            $value->nama_kelas = $value->kelas->nama_kelas . " " . $value->nama_sub_kelas;
        }

        $kelas_id = $request->kelas_id;
        if ($kelas_id == null) {
            $siswa = Siswa::where('periode_id',$periode->id)->get();
        } else {
            $siswa = Siswa::where('sub_kelas_id', $kelas_id)->get();
        }
        // $data = Siswa::select('siswas.id','siswas.nisn','siswas.nama_siswa','siswas.orangtua_wali','siswas.created_at','siswas.updated_at','siswas.kelas_id','kelas.id','kelas.nama_kelas')
        //     ->join('siswas','siswas.kelas_id','=','kelas.id')->get();
        return view('/dataSiswa/indexDataSiswa',
        [
            'siswa'=>$siswa,
            'kelas'=>$kelas,
            // 'data'=>$data
        ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSiswaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $periode = Periode::where('status','aktif')->first();
        $validator=$request->validate([
            'nisn'=>'required|unique:siswas,nisn',
            'nama_siswa'=>'required',
            'orangtua_wali'=>'required',
            'kelas'=>'required'
        ],
        [
            'nisn.required'=>'NISN tidak boleh kosong!',
            'nisn.unique'=>'NISN sudah terdaftar!',
            'nama_siswa.required'=>'Nama siswa tidak boleh kosong!',
            'orangtua_wali.required'=>'Nama orangtua/wali tidak boleh kosong!',
            'kelas.required'=>'Kelas tidak boleh kosong!'
        ]);
        $siswa = Siswa::create([
            'nisn' => $request->get('nisn'),
            'nama_siswa' => $request->get('nama_siswa'),
            'orangtua_wali' => $request->get('orangtua_wali'),
            'sub_kelas_id' => $request->get('kelas'),
            'rapor_siswa_id' => 1,
            'periode_id' => $periode->id,
        ]);

        $kelas_id = SubKelas::find($request->get('kelas'))->kelas_id;

        //Add siswa to SiswaTahfidz
        $tahfidz = Tahfidz1::where('kelas_id', $kelas_id)->where('periode_id',$periode->id)->get();
        if ($tahfidz != null) {
            foreach ($tahfidz as $key => $value) {
                SiswaTahfidz::create([
                    'siswa_id' => $siswa->id,
                    'tahfidz_1_id' => $value->id,
                    'profil_sekolah_id' => 1,
                    'periode_id' => $periode->id,
                    'rapor_siswa_id' => 1,
                    'penilaian_huruf_angka_id' => 101,
                ]);
            }
        }

        //Add siswa to SiswaDoa
        $doa = Doa1::where('kelas_id', $kelas_id)->where('periode_id',$periode->id)->get();
        if ($doa != null) {
            foreach ($doa as $key => $value) {
                SiswaDoa::create([
                    'siswa_id' => $siswa->id,
                    'doa_1_id' => $value->id,
                    'profil_sekolah_id' => 1,
                    'periode_id' => $periode->id,
                    'rapor_siswa_id' => 1,
                    'penilaian_huruf_angka_id' => 101,
                ]);
            }
        }

        //Add siswa to SiswaHadist
        $hadist = Hadist1::where('kelas_id', $kelas_id)->where('periode_id',$periode->id)->get();
        if ($hadist != null) {
            foreach ($hadist as $key => $value) {
                SiswaHadist::create([
                    'siswa_id' => $siswa->id,
                    'hadist_1_id' => $value->id,
                    'profil_sekolah_id' => 1,
                    'periode_id' => $periode->id,
                    'rapor_siswa_id' => 1,
                    'penilaian_huruf_angka_id' => 101,
                ]);
            }
        }

        //Add siswa to SiswaIbadahHarian
        $ibadah_harian = IbadahHarian1::where('kelas_id', $kelas_id)->where('periode_id',$periode->id)->get();
        if ($ibadah_harian != null) {
            foreach ($ibadah_harian as $key => $value) {
                SiswaIbadahHarian::create([
                    'siswa_id' => $siswa->id,
                    'ibadah_harian_1_id' => $value->id,
                    'profil_sekolah_id' => 1,
                    'periode_id' => $periode->id,
                    'rapor_siswa_id' => 1,
                    'penilaian_deskripsi_id' => 5,
                ]);
            }
        }

        //Add siswa to SiswaIlmanWaaRuuhan
        $ilman_waa_ruuhan = IlmanWaaRuuhan::where('kelas_id', $kelas_id)->where('periode_id',$periode->id)->get();
        if ($ilman_waa_ruuhan != null) {
            foreach ($ilman_waa_ruuhan as $key => $value) {
                SiswaIlmanWaaRuuhan::create([
                    'siswa_id' => $siswa->id,
                    'ilman_waa_ruuhan_id' => $value->id,
                    'profil_sekolah_id' => 1,
                    'periode_id' => $periode->id,
                    'rapor_siswa_id' => 1,
                    'penilaian_huruf_angka_id' => 101,
                    'penilaian_deskripsi_id' => 5,
                    'jilid' => 0,
                    'halaman' => 0,
                ]);
            }
        }

        //Add siswa to SiswaBidangStudi
        $mapel = Mapel::where('kelas_id', $kelas_id)->where('periode_id',$periode->id)->get();
        if ($mapel != null) {
            foreach ($mapel as $key => $value) {
                SiswaBidangStudi::create([
                    'siswa_id' => $siswa->id,
                    'mapel_id' => $value->id,
                    'profil_sekolah_id' => 1,
                    'nilai_uh_1' => 101,
                    'nilai_uh_2' => 101,
                    'nilai_uh_3' => 101,
                    'nilai_uh_4' => 101,
                    'nilai_tugas_1' => 101,
                    'nilai_tugas_2' => 101,
                    'nilai_uts' => 101,
                    'nilai_pas' => 101,
                    'nilai_akhir' => 101,
                    'periode_id' => $periode->id,
                    'rapor_siswa_id' => 1,
                ]);
            }
        }
        
        if ($siswa) {
            return response()->json(['success' => 'Data berhasil disimpan!']);
        } else {
            return response()->json(['error' => 'Data gagal disimpan!']);
        }
    }

    public function show(Siswa $dataSiswa)
    {
        $siswa = Siswa::find($dataSiswa->id);
        $kelas = SubKelas::with('kelas')->get();
        //add sub_kelas.nama_kelas by kelas.nama_kelas + sub_kelas.nama_sub_kelas
        foreach ($kelas as $key => $value) {
            $value->nama_kelas = $value->kelas->nama_kelas . " " . $value->nama_sub_kelas;
        }
        return view('dataSiswa.showSiswa',
        [
            'siswa'=>$siswa,
            'kelas'=>$kelas
        ]);
    }

    public function edit(Siswa $siswa)
    {
        $id = $siswa->id;
        $siswa = Siswa::find($id);
        return response()->json($siswa);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSiswaRequest  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Siswa $dataSiswa, Request $request)
    {
        $periode = Periode::where('status','aktif')->first();
        $validator=$request->validate([
            'nisn'=>'required',
            'nama_siswa'=>'required',
            'orangtua_wali'=>'required',
            'kelas'=>'required'
        ],
        [
            'nisn.required'=>'NISN tidak boleh kosong!',
            'nama_siswa.required'=>'Nama siswa tidak boleh kosong!',
            'orangtua_wali.required'=>'Nama orangtua/wali tidak boleh kosong!',
            'kelas.required'=>'Kelas tidak boleh kosong!'
        ]);

        $sub_kelas = SubKelas::find($request->get('kelas'));
        $siswa = Siswa::with('sub_kelas')->find($dataSiswa->id);

        if($sub_kelas->kelas_id != $siswa->sub_kelas->kelas_id){
            //Remove siswa from old SiswaTahfidz
            $tahfidz = Tahfidz1::where('kelas_id', $siswa->sub_kelas->kelas_id)->get();
            if ($tahfidz != null) {
                foreach ($tahfidz as $key => $value) {
                    SiswaTahfidz::where('siswa_id', $siswa->id)->where('tahfidz_1_id', $value->id)->delete();
                }
            }
            //add siswa to new SiswaTahfidz
            $tahfidz = Tahfidz1::where('kelas_id', $sub_kelas->kelas_id)->get();
            if ($tahfidz != null) {
                foreach ($tahfidz as $key => $value) {
                    SiswaTahfidz::create([
                        'siswa_id' => $siswa->id,
                        'tahfidz_1_id' => $value->id,
                        'profil_sekolah_id' => 1,
                        'periode_id' => $periode->id,
                        'rapor_siswa_id' => 1,
                        'penilaian_huruf_angka_id' => 101,
                    ]);
                }
            }

            //Remove siswa from old SiswaDoa
            $doa = Doa1::where('kelas_id', $siswa->sub_kelas->kelas_id)->get();
            if ($doa != null) {
                foreach ($doa as $key => $value) {
                    SiswaDoa::where('siswa_id', $siswa->id)->where('doa_1_id', $value->id)->delete();
                }
            }
            //add siswa to new SiswaDoa
            $doa = Doa1::where('kelas_id', $sub_kelas->kelas_id)->get();
            if ($doa != null) {
                foreach ($doa as $key => $value) {
                    SiswaDoa::create([
                        'siswa_id' => $siswa->id,
                        'doa_1_id' => $value->id,
                        'profil_sekolah_id' => 1,
                        'periode_id' => $periode->id,
                        'rapor_siswa_id' => 1,
                        'penilaian_huruf_angka_id' => 101,
                    ]);
                }
            }

            //Remove siswa from old SiswaHadist
            $hadist = Hadist1::where('kelas_id', $siswa->sub_kelas->kelas_id)->get();
            if ($hadist != null) {
                foreach ($hadist as $key => $value) {
                    SiswaHadist::where('siswa_id', $siswa->id)->where('hadist_1_id', $value->id)->delete();
                }
            }
            //add siswa to new SiswaHadist
            $hadist = Hadist1::where('kelas_id', $sub_kelas->kelas_id)->get();
            if ($hadist != null) {
                foreach ($hadist as $key => $value) {
                    SiswaHadist::create([
                        'siswa_id' => $siswa->id,
                        'hadist_1_id' => $value->id,
                        'profil_sekolah_id' => 1,
                        'periode_id' => $periode->id,
                        'rapor_siswa_id' => 1,
                        'penilaian_huruf_angka_id' => 101,
                    ]);
                }
            }

            //Remove siswa from old SiswaIbadahHarian
            $ibadah_harian = IbadahHarian1::where('kelas_id', $siswa->sub_kelas->kelas_id)->get();
            if ($ibadah_harian != null) {
                foreach ($ibadah_harian as $key => $value) {
                    SiswaIbadahHarian::where('siswa_id', $siswa->id)->where('ibadah_harian_1_id', $value->id)->delete();
                }
            }
            //add siswa to new SiswaIbadahHarian
            $ibadah_harian = IbadahHarian1::where('kelas_id', $sub_kelas->kelas_id)->get();
            if ($ibadah_harian != null) {
                foreach ($ibadah_harian as $key => $value) {
                    SiswaIbadahHarian::create([
                        'siswa_id' => $siswa->id,
                        'ibadah_harian_1_id' => $value->id,
                        'profil_sekolah_id' => 1,
                        'periode_id' => $periode->id,
                        'rapor_siswa_id' => 1,
                        'penilaian_deskripsi_id' => 5,
                    ]);
                }
            }

            //Remove siswa from old SiswaIlmanWaaRuuhan
            $ilman_waa_ruuhan = IlmanWaaRuuhan::where('kelas_id', $siswa->sub_kelas->kelas_id)->get();
            if ($ilman_waa_ruuhan != null) {
                foreach ($ilman_waa_ruuhan as $key => $value) {
                    SiswaIlmanWaaRuuhan::where('siswa_id', $siswa->id)->where('ilman_waa_ruuhan_id', $value->id)->delete();
                }
            }
            //add siswa to new SiswaIlmanWaaRuuhan
            $ilman_waa_ruuhan = IlmanWaaRuuhan::where('kelas_id', $sub_kelas->kelas_id)->get();
            if ($ilman_waa_ruuhan != null) {
                foreach ($ilman_waa_ruuhan as $key => $value) {
                    SiswaIlmanWaaRuuhan::create([
                        'siswa_id' => $siswa->id,
                        'ilman_waa_ruuhan_id' => $value->id,
                        'profil_sekolah_id' => 1,
                        'periode_id' => $periode->id,
                        'rapor_siswa_id' => 1,
                        'penilaian_huruf_angka_id' => 101,
                        'penilaian_deskripsi_id' => 5,
                        'jilid' => 0,
                        'halaman' => 0,
                    ]);
                }
            }

            //Remove siswa from old SiswaBidangStudi
            $mapel = Mapel::where('kelas_id', $siswa->sub_kelas->kelas_id)->get();
            if ($mapel != null) {
                foreach ($mapel as $key => $value) {
                    SiswaBidangStudi::where('siswa_id', $siswa->id)->where('mapel_id', $value->id)->delete();
                }
            }
            //add siswa to new SiswaBidangStudi
            $mapel = Mapel::where('kelas_id', $sub_kelas->kelas_id)->get();
            if ($mapel != null) {
                foreach ($mapel as $key => $value) {
                    SiswaBidangStudi::create([
                        'siswa_id' => $siswa->id,
                        'mapel_id' => $value->id,
                        'profil_sekolah_id' => 1,
                        'nilai_uh_1' => 101,
                        'nilai_uh_2' => 101,
                        'nilai_uh_3' => 101,
                        'nilai_uh_4' => 101,
                        'nilai_tugas_1' => 101,
                        'nilai_tugas_2' => 101,
                        'nilai_uts' => 101,
                        'nilai_pas' => 101,
                        'nilai_akhir' => 101,
                        'periode_id' => $periode->id,
                        'rapor_siswa_id' => 1,
                    ]);
                }
            }
        }


        $siswa->update([
            'nisn' => $request->get('nisn'),
            'nama_siswa' => $request->get('nama_siswa'),
            'orangtua_wali' => $request->get('orangtua_wali'),
            'sub_kelas_id' => $request->get('kelas')
        ]);



        if ($siswa) {
            return response()->json(['success' => 'Data berhasil diupdate!']);
        } else {
            return response()->json(['error' => 'Data gagal diupdate!']);
        }
    }

    public function destroy(Siswa $dataSiswa)
    {

        if ($dataSiswa->delete()) {
            return response()->json(['success' => 'Data berhasil dihapus!']);
        } else {
            return response()->json(['errors' => 'Data gagal dihapus!']);
        }
    }
    
    public function getTable(Request $request){
        if ($request->ajax()) {
            $periode = Periode::where('status','aktif')->first();
            if ($request->kelas_id == null) {
                $data = Siswa::with('sub_kelas')->where('periode_id',$periode->id)->get();
            } else {
                $data = Siswa::with('sub_kelas')->where('sub_kelas_id', $request->kelas_id)->where('periode_id',$periode->id)->get();
            }
            // siswa with kelas
            //$data = Siswa::with('kelas')->get();
            return DataTables::of($data)
            ->addColumn('action', function ($row) {
                $btn = '<a href="'. route('dataSiswa.show', $row) .'" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Detail" class="btn btn-sm btn-success mx-1 shadow detail"><i class="fas fa-sm fa-fw fa-eye"></i> Detail</a>';
                $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-sm btn-danger mx-1 shadow delete"><i class="fas fa-sm fa-fw fa-trash"></i> Delete</a>';
                
                return $btn;
            })
            // modify Kelas column
            ->editColumn('nama_kelas', function ($row) {
                // If kelas is null, then return "Belum Masuk Anggota Kelas"
                if ($row->sub_kelas == null) {
                    return "Belum Masuk Anggota Kelas";
                }
                // If kelas is not null, then return nama_kelas
                else {
                    $kelas = $row->sub_kelas->kelas->nama_kelas;
                    $sub_kelas = $row->sub_kelas->nama_sub_kelas;
                    return $kelas . " " . $sub_kelas;
                }
            })
            ->rawColumns(['action'])
            ->make(true);
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
        $nama_file = 'Data Siswa ' . $kelas . ' ' . $nama_sub_kelas . ' Semester ' . $semester . ' ' . $tahun_ajaran . '.xlsx';

        $kode = "FileDataSiswa";
        $file_identifier = $kode;

        $informasi = [
            'judul' => 'REKAP DATA SISWA SDIT IRSYADUL \'IBAD 2',
            'nama_kelas' => $kelas . ' ' . $nama_sub_kelas,
            'wali_kelas' => $wali_kelas,
            'tahun_ajaran' => $tahun_ajaran,
            'semester' => $semester,
            'tanggal' => date('d-m-Y'),
            'file_identifier' => $file_identifier,
        ];

        return Excel::download(new SiswaExport($sub_kelas_id, $informasi), $nama_file);
    }

    public function import_excel(Request $request)
    {
        $file = $request->file('file_nilai_excel');
        $file_name = $file->getClientOriginalName();
        $kode = "FileDataSiswa";
        $import = new SiswaImport($kode);
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
