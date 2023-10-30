<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\User;
use App\Http\Requests\StoreGuruRequest;
use App\Http\Requests\UpdateGuruRequest;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Utilities\Request;
use App\Http\Controllers\Controller;



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
        $kelas = Kelas::all();
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
        $kelas = Kelas::all();
        $guru = Guru::all()->where('id',$guru_id)->first();
        $guru_kelas = Kelas::all()->where('guru_id',$guru_id)->first();
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
            'kelas'=>'required'
        ],
        [
            'user.required'=>'User harus dipilih',
            'nip.required'=>'NIP harus diisi',
            'kelas.required'=>'Kelas harus diisi'
        ]);
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
        $target_kelas = Kelas::all()->where('id',$selected_kelas)->first();
        if ($selected_kelas==0) {
            #do nothing
        }
        else{
            $target_kelas->guru_id = $new_guru_id;
        }

        if ($guru){
            return response()->json(['success' => 'Data berhasil disimpan!']);
        }
        else {
            return response()->json(['error' => 'Data gagal disimpan!']);
        }
    }
    
    public function update(User $dataUser, UpdateGuruRequest $request)
    {
        $validator=$request->validate([
            'name'=>'required',
            'email'=>'email',
            // 'user_name'=>'required|unique:user,user_name',
            // 'user_name'=>'unique:user,user_name',
            // 'role_id'=>'required',
        ],
        [
            'name.required'=>'Nama harus diisi',
            'email.email'=>'Isi dengan format email',
            // 'user_name.required'=>'Username harus diisi',
            // 'user_name.unique'=>'Username sudah digunakan',
            // 'role_id.required'=>'Peran harus diisi'
        ]);
        // $p=$request->get('password');
        // $securep=bcrypt($p);
        $dataUser->updated([
            'name'=>$request->get('name'),
            'email'=>$request->get('email'),
            // 'user_name'=>$request->get('user_name'),
            // 'password'=>$securep,
            // 'updated_at'=>now()
        ]);
        // $user->update($request->only(['name', 'email', 'user_name']));
        // $id = $user->id;
        
        // $deletedUserRole = UserRoles::where('user_id', $id)->get();
        // $deletedUserRole->delete();
        
        // $userRoles=UserRoles::create([
        //     'user_id'=>$id,
        //     'role_id'=>$request->get('role_id'),
        //     'created_at'=>now()
        // ]);
        
        // $userRoles->create([
        //     'user_id'=>$id,
        //     'role_id'=>$request->get('role_id')
        // ]);
        if ($dataUser) {
            return response()->json(['success' => 'Data berhasil diupdate!']);
            // if($userRoles){
            //     return response()->json(['success' => 'Data berhasil diupdate!']);
            // }
            // else {
            //     return response()->json(['success' => 'Data berhasil diupdate!']);
            // }
        }
        // else if ($userRoles) {
        //     return response()->json(['success' => 'Peran berhasil diupdate!']);
        // }
        else{
            return response()->json(['error' => 'Data gagal diupdate!']);
        }
    }

    public function destroy(Guru $guru)
    {
        $guru->delete();
        //return response()->json('Berhasil Dihapur');

        return response()->json(['success' => 'Data berhasil dihapus!']);
    }

    public function getTable(Request $request){
        if ($request->ajax()) {
            // $userRole = UserRoles::all();
            // $role = Role::all();
            // $concat = $user->concat($userRole)->concat($role);
            // $data = $concat->all();
            $guru = Guru::all();
            return DataTables::of($guru)
            // ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a href="'. route('dataGuru.show', $row) .'" data-toggle="tooltip"  data-id="' . $row . '" data-original-title="Detail" class="btn btn-sm btn-success mx-1 shadow detail"><i class="fas fa-sm fa-fw fa-eye"></i> Detail</a>';
                // $btn = '<a action="{{ url('/') }}/editGuru" method="post" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="btn btn-sm btn-primary mx-1 shadow edit"><i class="fas fa-sm fa-fw fa-edit"></i> Edit</a>';
                $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-sm btn-danger mx-1 shadow delete"><i class="fas fa-sm fa-fw fa-trash"></i> Delete</a>';
                
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }
}
