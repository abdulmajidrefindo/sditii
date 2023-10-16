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
    public function store(StoreSiswaRequest $request)
    {
        $siswa = Siswa::create([
            'nisn' => $request->get('nisn'),
            'nama_siswa' => $request->get('nama_siswa'),
            'orangtuawali_siswa' => $request->get('orangtuawali_siswa')
        ]);
        if ($siswa) {
            return response()->json(['success' => 'Data berhasil disimpan!']);
        } else {
            return response()->json(['errors' => 'Data gagal disimpan!']);
        }
    }

    public function show(Siswa $dataSiswa)
    {
        $siswa_id = $dataSiswa->id;
        $siswa = Siswa::all();
        $kelas_id = $dataSiswa->kelas_id;
        $kelas_siswa = Kelas::all()->where('id',$kelas_id)->first();
        return view('dataGuru/showGuru',
        [
            'siswa'=>$siswa,
            'siswa_id'=>$siswa_id,
            'kelas_id'=>$kelas_id,
            'kelas_siswa'=>$kelas_siswa
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
    public function update(UpdateSiswaRequest $request, Siswa $siswa)
    {
        $siswa->update([
            'nisn' => $request->get('nisn'),
            'nama_siswa' => $request->get('nama_siswa'),
            'orangtuawali_siswa' => $request->get('orangtuawali_siswa')
        ]);

        if ($siswa) {
            return response()->json(['success' => 'Data berhasil disimpan!']);
        } else {
            return response()->json(['errors' => 'Data gagal disimpan!']);
        }
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return response()->json(['success' => 'Data berhasil dihapus!']);
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
            ->rawColumns(['action'])
            ->make(true);
        }
    }
}
