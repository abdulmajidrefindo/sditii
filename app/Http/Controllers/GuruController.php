<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\SubKelas;
use App\Models\User;
use App\Models\UserRoles;
use App\Http\Requests\StoreGuruRequest;
use App\Http\Requests\UpdateGuruRequest;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Utilities\Request;
use App\Http\Controllers\Controller;

use App\Models\Hadist1;
use App\Models\Doa1;
use App\Models\Tahfidz1;
use App\Models\Mapel;
use App\Models\IlmanWaaRuuhan;
use App\Models\IbadahHarian1;



class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guru = Guru::all();
        $kelas = SubKelas::all();
        foreach ($kelas as $k => $v) {
            $v->nama_kelas = $v->kelas->nama_kelas . " " . $v->nama_sub_kelas;
        }
        $user = User::all();
        return view('/dataGuru/indexDataGuru',
        [
            'guru'=>$guru->load('user'),
            'kelas'=>$kelas,
            'user'=>$user
        ]);
    }

    public function create()
    {
        return view('dataGuru/indexDataGuru');
    }
    
    public function show(Guru $dataGuru)
    {
        $guru_id = $dataGuru->id;
        $kelas = SubKelas::all();
        foreach ($kelas as $k => $v) {
            $v->nama_kelas = $v->kelas->nama_kelas . " " . $v->nama_sub_kelas;
        }
        
        $guru = Guru::all()->where('id',$guru_id)->first();
        $guru_kelas = SubKelas::all()->where('guru_id',$guru_id)->first();
        if ($guru_kelas==null) {
            $guru_kelas = new SubKelas();
            $guru_kelas->nama_kelas = "Bukan Wali Kelas";
            $guru_kelas->id = 0;
        }
        else{
            $guru_kelas->nama_kelas = $guru_kelas->kelas->nama_kelas . " " . $guru_kelas->nama_sub_kelas;
        }
        // $guru_kelas_id = $kelas->id->where('guru_id',$guru_id)->first();
        return view('dataGuru/showGuru',
        [
            'guru'=>$guru,
            'kelas'=>$kelas,
            'guru_kelas'=>$guru_kelas,
            // 'guru_kelas_id'=>$guru_kelas_id
        ]);
    }
    
    public function store(StoreGuruRequest $request)
    {
        $validator=$request->validate([
            'user'=>'required',
            'nip'=>'required|unique:gurus,nip',
            //'kelas'=>'required'
        ],
        [
            'user.required'=>'User harus dipilih',
            'nip.required'=>'NIP harus diisi',
            //'kelas.required'=>'Kelas harus diisi'
        ]);

        //break if validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }
        
        $selected_user_id = $request->user;
        $selected_user = User::all()->where('id',$selected_user_id)->first();
        $selected_user_name = $selected_user->name;
        $guru=Guru::create([
            'nama_guru'=>$selected_user_name,
            'nip'=>$request->get('nip'),
            'created_at'=>now(),
            'user_id'=>$selected_user_id
        ]);

        $new_guru_id = $guru->id;
        $selected_kelas = $request->kelas;

        // if ($selected_kelas==0) {
        //     #do nothing
        // }
        // else{
        //     $target_kelas = SubKelas::all()->where('id',$selected_kelas)->first();
        //     if($target_kelas->guru_id != null){
        //         $old_guru_id = $target_kelas->guru_id;
        //         $old_guru = Guru::all()->where('id',$old_guru_id)->first();
        //         $old_guru_user_role = UserRoles::all()->where('user_id',$old_guru->user_id)->first();
        //         $old_guru_user_role->role_id = 3; //guru
        //         $old_guru_user_role->save();

                
        //     }
        //     $target_kelas->guru_id = $new_guru_id;
        //     $target_kelas->save();
        //     $new_guru_user_role = UserRoles::all()->where('user_id',$selected_user_id)->first();
        //     $new_guru_user_role->role_id = 2; //wali kelas
        //     $new_guru_user_role->save();
            
        // }



        if ($guru){
            return response()->json(['success' => 'Data berhasil disimpan!']);
        }
        else {
            return response()->json(['error' => 'Data gagal disimpan!']);
        }
    }
    
    public function update(Guru $dataGuru, UpdateGuruRequest $request)
    {
        $validator=$request->validate([
            'nama_guru'=>'required',
            'nip'=>'required|unique:gurus,nip,'.$dataGuru->id,
            //'kelas'=>'required'
        ],
        [
            'nama_guru.required'=>'Nama Guru harus diisi',
            'nip.required'=>'NIP harus diisi',
            //'kelas.required'=>'Kelas harus diisi'
        ]);
        
        // $selected_user_id = $request->user;
        // $selected_user = User::all()->where('id',$selected_user_id)->first();
        // $selected_user_name = $selected_user->name;
        $dataGuru->nama_guru = $request->get('nama_guru');
        $dataGuru->nip = $request->get('nip');
        $dataGuru->updated_at = now();
        $dataGuru->save();

        // $selected_kelas = $request->kelas;
        // if ($selected_kelas==0) {
        //     $old_guru_user_role = UserRoles::all()->where('user_id',$dataGuru->user_id)->first();
        //     $old_guru_user_role->role_id = 3; //guru
        //     $old_guru_user_role->save();  

        //     $target_kelas = SubKelas::all()->where('guru_id',$dataGuru->id)->first();
        //     $target_kelas->guru_id = NUll;
        //     $target_kelas->save();

        // }
        // else{
        //     $target_kelas = SubKelas::all()->where('id',$selected_kelas)->first();
        //     $target_kelas->guru_id = $dataGuru->id;
        //     $target_kelas->save();
        //     $new_guru_user_role = UserRoles::all()->where('user_id',$dataGuru->user_id)->first();
        //     $new_guru_user_role->role_id = 2; //wali kelas
        //     $new_guru_user_role->save();
        // }

        if ($dataGuru){
            return response()->json(['success' => 'Data berhasil disimpan!']);
        }
        else {
            return response()->json(['error' => 'Data gagal disimpan!']);
        }
    }

    public function destroy(Guru $dataGuru)
    {
        // if guru is wali kelas and others course have guru id, then fail 
        $kelas = SubKelas::all()->where('guru_id',$dataGuru->id)->first();
        $mapel = Mapel::all()->where('guru_id',$dataGuru->id)->first();
        $tahfidz = Tahfidz1::all()->where('guru_id',$dataGuru->id)->first();
        $doa = Doa1::all()->where('guru_id',$dataGuru->id)->first();
        $hadist = Hadist1::all()->where('guru_id',$dataGuru->id)->first();
        $ibadah_harian = IbadahHarian1::all()->where('guru_id',$dataGuru->id)->first();
        $ilman_waa_ruuhan = IlmanWaaRuuhan::all()->where('guru_id',$dataGuru->id)->first();
        if ($mapel != null || $tahfidz != null || $doa != null || $hadist != null || $ibadah_harian != null || $ilman_waa_ruuhan != null) {
            $pelajaran = "";
            if ($mapel != null) {
                $pelajaran .= "Bidang Studi, ";
            }
            if ($tahfidz != null) {
                $pelajaran .= "Tahfidz, ";
            }
            if ($doa != null) {
                $pelajaran .= "Doa, ";
            }
            if ($hadist != null) {
                $pelajaran .= "Hadist, ";
            }
            if ($ibadah_harian != null) {
                $pelajaran .= "Ibadah Harian, ";
            }
            if ($ilman_waa_ruuhan != null) {
                $pelajaran .= "Ilman Waa Ruuhan, ";
            }
            return response()->json(['error' => 'Guru masih mengajar di ' . $pelajaran . '. Silahkan atur atau hapus data terkait terlebih dahulu.']);
        }
        elseif ($kelas != null) {
            return response()->json(['error' => 'Guru masih menjadi wali kelas! Silahkan atur atau hapus data terkait terlebih dahulu.']);
        }
        else{
            $user_id = $dataGuru->user_id;
            $dataGuru->delete();
            return response()->json(['success' => 'Data berhasil dihapus!']);
        }
    }

    public function getTable(Request $request){
        if ($request->ajax()) {
            // $userRole = UserRoles::all();
            // $role = Role::all();
            // $concat = $user->concat($userRole)->concat($role);
            // $data = $concat->all();
            $guru = Guru::with('sub_kelas')->get();
            return DataTables::of($guru)
            // ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a href="'. route('dataGuru.show', $row) .'" data-toggle="tooltip"  data-id="' . $row . '" data-original-title="Detail" class="btn btn-sm btn-success mx-1 shadow detail"><i class="fas fa-sm fa-fw fa-eye"></i> Detail</a>';
                // $btn = '<a action="{{ url('/') }}/editGuru" method="post" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="btn btn-sm btn-primary mx-1 shadow edit"><i class="fas fa-sm fa-fw fa-edit"></i> Edit</a>';
                $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-sm btn-danger mx-1 shadow delete"><i class="fas fa-sm fa-fw fa-trash"></i> Delete</a>';
                
                return $btn;
            })
            //edit nip column if null
            ->editColumn('nip', function ($row) {
                if ($row->nip == null) {
                    return '<span class="badge badge-danger">Belum diatur, silahkan perbarui</span>';
                }
                else{
                    return $row->nip;
                }
            })
            ->addColumn('kelas', function ($row) {
                if ($row->sub_kelas) {
                    $kelas = "";
                    foreach ($row->sub_kelas as $k => $v) {
                        $v->nama_kelas = $v->kelas->nama_kelas . " " . $v->nama_sub_kelas;
                        $kelas .= $v->nama_kelas . ", ";
                    }
                    if ($kelas == "") {
                        return '<span class="badge badge-danger">Bukan Wali Kelas</span>';
                    }
                    else{
                        return $kelas;
                    }
                } else {
                    return '<span class="badge badge-danger">Bukan Wali Kelas</span>';
                }
            })
            ->rawColumns(['action', 'nip', 'kelas'])
            ->make(true);
        }
    }
}
