<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\SubKelas;
use App\Models\User;
use App\Models\Guru;
use App\Http\Requests\StoreKelasRequest;
use App\Http\Requests\UpdateKelasRequest;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Utilities\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = SubKelas::with('kelas')->get();
        $data_kelas = Kelas::all()->except(7);
        $data_guru = Guru::all();
        return view('/dataKelas/indexDataKelas',
        [
            'kelas'=>$kelas,
            'data_kelas'=>$data_kelas,
            'data_guru'=>$data_guru
        ]);
        // return response()->json([
        //     'kelas' => $kelas,
        // ]);
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
     * @param  \App\Http\Requests\StoreKelasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKelasRequest $request)
    {
        $validator = $request->validate([
            'kelas' => 'required',
            'nama_sub_kelas' => 'required|max:255|unique:sub_kelas,nama_sub_kelas',
            'wali_kelas' => 'required',
        ],
        [
            'kelas.required' => 'Kelas harus diisi',
            'nama_sub_kelas.required' => 'Nama Sub Kelas harus diisi',
            'nama_sub_kelas.max' => 'Nama Sub Kelas maksimal 255 karakter',
            'nama_sub_kelas.unique' => 'Nama Sub Kelas sudah ada',
            'wali_kelas.required' => 'Wali Kelas harus diisi',
        ]);


        $kelas = new SubKelas();
        $kelas->nama_sub_kelas = $request->nama_sub_kelas;
        $kelas->kelas_id = $request->kelas;
        $kelas->guru_id = $request->wali_kelas == 0 ? null : $request->wali_kelas;

        $kelas->save();
        

        if ($kelas) {
            return response()->json(['success' => 'Data berhasil disimpan!']);
        } else {
            return response()->json(['error' => 'Data gagal disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKelasRequest  $request
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKelasRequest $request, Kelas $kelas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kelas)
    {
        //
    }

    /**
     * Get Table Data For Ajax Request
     */
    public function getTable(Request $request){
        if ($request->ajax()) {
            // $userRole = UserRoles::all();
            // $role = Role::all();
            // $concat = $user->concat($userRole)->concat($role);
            // $data = $concat->all();
            $guru = SubKelas::with('kelas', 'guru')->get();
            return DataTables::of($guru)
            // ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a href="'. route('dataKelas.show', $row) .'" data-toggle="tooltip"  data-id="' . $row . '" data-original-title="Detail" class="btn btn-sm btn-success mx-1 shadow detail"><i class="fas fa-sm fa-fw fa-eye"></i> Detail</a>';
                // $btn = '<a action="{{ url('/') }}/editGuru" method="post" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="btn btn-sm btn-primary mx-1 shadow edit"><i class="fas fa-sm fa-fw fa-edit"></i> Edit</a>';
                $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-sm btn-danger mx-1 shadow delete"><i class="fas fa-sm fa-fw fa-trash"></i> Delete</a>';
                
                return $btn;
            })
            // modify column guru.nama_guru, if null then show '-'
            ->editColumn('guru.nama_guru', function ($row) {
                if ($row->guru) {
                    return $row->guru->nama_guru;
                } else {
                    return '<span class="badge badge-danger">Belum Atur Wali Kelas</span>';
                }
            })
            ->rawColumns(['action', 'guru.nama_guru'])
            ->make(true);
        }
    }
}
