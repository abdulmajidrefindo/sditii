<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\SiswaTahfidz;
use App\Http\Requests\StoreGuruRequest;
use App\Http\Requests\UpdateGuruRequest;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Utilities\Request;
use App\Http\Controllers\Controller;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = Siswa::all();
        $kelas = Kelas::all();
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
            'kelas_id' => $request->get('kelas')
        ]);

        if ($siswa) {
            return response()->json(['success' => 'Data berhasil disimpan!']);
        } else {
            return response()->json(['error' => 'Data gagal disimpan!']);
        }

    }

    public function show(Siswa $dataSiswa)
    {
        $siswa = Siswa::find($dataSiswa->id);
        $kelas = Kelas::all();
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

        $siswa = Siswa::find($dataSiswa->id);
        $siswa->update([
            'nisn' => $request->get('nisn'),
            'nama_siswa' => $request->get('nama_siswa'),
            'orangtua_wali' => $request->get('orangtua_wali'),
            'kelas_id' => $request->get('kelas')
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
            // siswa with kelas
            $data = Siswa::with('kelas')->get();
            return DataTables::of($data)
            ->addColumn('action', function ($row) {
                $btn = '<a href="'. route('dataSiswa.show', $row) .'" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Detail" class="btn btn-sm btn-success mx-1 shadow detail"><i class="fas fa-sm fa-fw fa-eye"></i> Detail</a>';
                $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-sm btn-danger mx-1 shadow delete"><i class="fas fa-sm fa-fw fa-trash"></i> Delete</a>';
                
                return $btn;
            })
            // modify Kelas column
            ->editColumn('nama_kelas', function ($row) {
                // If kelas is null, then return "Belum Masuk Anggota Kelas"
                if ($row->kelas == null) {
                    return "Belum Masuk Anggota Kelas";
                }
                // If kelas is not null, then return nama_kelas
                else {
                    return $row->kelas->nama_kelas;
                }
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }
}
