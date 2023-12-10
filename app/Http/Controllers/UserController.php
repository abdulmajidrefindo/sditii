<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Roles;
use App\Models\UserRoles;
use App\Models\Guru;
use App\Models\SubKelas;
// use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Utilities\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Queue\Events\Looping;
use Spatie\Permission\Models\Role;
use Symfony\Component\Console\Logger\ConsoleLogger;

class UserController extends Controller
{
    /**
     * Note:
     * Mengenai peran, ada 3 peran yang ada di sistem ini, yaitu:
     * 1. Admin
     * 2. Wali Kelas
     * 3. Guru
     * 
     * Admin punya akses penuh terhadap sistem, termasuk mengubah peran pengguna lain.
     * Wali kelas dapat menjadi admin, guru juga dapat menjadi admin. Begitu juga sebaliknya.
     * Wali kelas tidak dapat menjadi guru, begitu juga sebaliknya. Hal ini untuk menghindari konflik data. 
     * Jika ingin menjadi guru, maka harus udah data kelas terlebih dahulu. Begitu juga untuk menjadi wali kelas.
     * 
     * Admin dapat kembali menjadi wali kelas ataupun guru. Begitu juga sebaliknya.
     * Admin dapat mengubah peran pengguna lain, kecuali akun master. Hal ini untuk menghindari sistem terkunci.
     * Admin tidak dapat mengubah perannya sendiri. Hal ini untuk menghindari user terkunci dari sistem.
     * 
     * Jika user merupakan guru ataupun walikelas, maka user tersebut tidak dapat dihapus. Hal ini untuk menghindari konflik data.
     * Jika ingin menghapus user tersebut, maka harus menghapus data guru terlebih dahulu. 
     * 
     * Setiap user hanya dapat memiliki satu peran saja. Hal ini untuk menghindari programmer menjadi pusing.
     */
    public function index()
    {
        $data = UserRoles::all();
        $user = User::all();
        $roles = Roles::all();
        return view('dataUser/indexUser',
        [
            'data'=>$data->load('user','role'),
            'user'=>$user,
            "role"=>$roles,
            'count'=>0
        ]);
    }
    public function create()
    {
        return view('dataUser/indexUser');
    }
    
    public function show(User $dataUser)
    {
        $id = $dataUser->id;
        $role = Roles::where('id', '!=', 2)->get(); // tidak menampilkan role wali kelas, wali kelas diatur di halaman kelas.
        $user = User::with('role')->where('id', $id)->first();
        $userRole = UserRoles::all()->where('user_id', $id);

        $guru = Guru::where('user_id', $dataUser->id)->first();
        if ($guru != null){
            $sub_kelas = SubKelas::where('guru_id', $guru->id)->first();
            if ($sub_kelas != null){
                $role = Roles::all()->where('id', '!=', 3); // tidak menampilkan role guru, walikelas dapat menjadi admin. Admin dapat menjadi walikelas kembali. Namun tak dapat kembali menjadi guru. Jiak ingin menjadi guru, maka harus udah data kelas terlebih dahulu.
             }
        }

        return view('dataUser/showUser',
        [
            'user'=>$user,
            'role'=>$role,
            'userRole'=>$userRole
        ]);
    }
    
    public function store(StoreUserRequest $request)
    {
        $validator=$request->validate([
            'name'=>'required',
            'email'=>'email|unique:user,email',
            'user_name'=>'required|unique:user,user_name',
            'password'=>'required',
            'role_id'=>'required',
        ],
        [
            'name.required'=>'Nama harus diisi',
            'email.email'=>'Isi dengan format email',
            'email.unique'=>'Email sudah digunakan',
            'user_name.required'=>'Username harus diisi',
            'user_name.unique'=>'Username sudah digunakan',
            'password.required'=>'Password harus diisi',
            'role_id.required'=>'Peran harus diisi'
        ]);
        $p=$request->get('password');
        $securep=bcrypt($p);
        User::create([
            'name'=>$request->get('name'),
            'email'=>$request->get('email'),
            'user_name'=>$request->get('user_name'),
            'password'=>$securep,
            'created_at'=>now()
        ]);
        $new_username = $request->get('user_name');
        $new_user = User::all()->where('user_name', $new_username)->first();
        $new_user_id = $new_user->id;
        $role_ids = $request->get('role_id');
        // $role_ids = json_decode($request->get('role_id'));
        // Log::info('Pesan debugging: Data sebelum operasi', ['data' => $role_ids]);
        // dd($role_ids);
        // $count = count($role_ids);
        // return view('dataUser/indexUser',['count'=>$count]);
        // foreach ($role_ids as $role_id) {}
        $userRole=UserRoles::create([
            'user_id'=>$new_user_id,
            'role_id'=>$role_ids,
            'created_at'=>now()
        ]);
        if ($role_ids == 3){
            Guru::create([
                'nip'=>null,
                'nama_guru'=>$request->get('name'),
                'created_at'=>now(),
                'user_id'=>$new_user_id
            ]);
        }
        if ($userRole){
            return response()->json(['success' => 'Data berhasil disimpan!']);
        }
        else {
            return response()->json(['error' => 'Data gagal disimpan!']);
        }
    }
    
    public function update(User $dataUser, UpdateUserRequest $request)
    {
        $validator=$request->validate([
            'name'=>'required',
            'email'=>'email',
            // 'user_name'=>'required|unique:user,user_name',
            // 'user_name'=>'unique:user,user_name',
            //'role'=>'required',
        ],
        [
            'name.required'=>'Nama harus diisi',
            'email.email'=>'Isi dengan format email',
            // 'user_name.required'=>'Username harus diisi',
            // 'user_name.unique'=>'Username sudah digunakan',
            //'role.required'=>'Peran harus diisi'
        ]);

    


        $role = UserRoles::where('user_id', $dataUser->id)->first();

        // If the user is the master account, then the role cannot be changed. This is to prevent to lock the master account out of the system.
        if($dataUser->id == 1){
            if ($request->get('role') != $role->role_id){
                return response()->json(['error' => 'Gagal mengubah data! Akun master tidak dapat mengubah perannya sendiri!']);
            }
        }

        //if the user id the same as the active user, then the role cannot be changed. This is to prevent to lock the active user out of the system.
        if($dataUser->id == auth()->user()->id){
            if ($request->get('role') != $role->role_id){
                return response()->json(['error' => 'Gagal mengubah data! Anda tidak dapat mengubah peran anda sendiri!']);
            }
        }

         //jika role berubah, sekaligus ignore jika role kosong.
        if ($request->get('role') != $role->role_id && $request->get('role') != null){
            if ($role->role_id == 2){ //wali kelas
                if ($request->get('role') == 3){ //guru
                    return response()->json(['error' => 'Gagal mengubah data! Wali kelas tidak dapat menjadi guru! Silahkan ubah data guru terlebih dahulu']);
                }
            }
            if ($role->role_id == 1){ //admin
                if ($request->get('role') == 3){ //guru
                    $guru = Guru::where('user_id', $dataUser->id)->first();
                    if ($guru != null){
                        $sub_kelas = SubKelas::where('guru_id', $guru->id)->first();
                        if ($sub_kelas != null){
                            return response()->json(['error' => 'Gagal mengubah data! Admin merupakan wali kelas! Silahkan ubah data wali kelas terlebih dahulu']);
                        }
                    }
                }
            }
            $role->role_id = $request->get('role');
            try {
                $role->save();
            } catch (\Throwable $th) {
                return response()->json(['error' => 'Gagal mengubah data!']);
            }
        }

        $dataUser->name = $request->get('name');
        $dataUser->email = $request->get('email');

        try {
            $dataUser->save();
            return response()->json(['success' => 'Data berhasil diubah!']);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Gagal mengubah data!']);
        }
        
    }

    public function destroy(User $dataUser)
    {
        $id = $dataUser->id;
        $active_user = auth()->user()->id;

        // If the user is the master account, then the role cannot be changed. This is to prevent to lock the master account out of the system.
        if($id == 1){
            return response()->json(['error' => 'Gagal menghapus data! Akun master tidak dapat dihapus!']);
        }

        //if the user id the same as the active user, then the role cannot be changed. This is to prevent to lock the active user out of the system.
        if($id == $active_user){
            return response()->json(['error' => 'Gagal menghapus data! Anda tidak dapat menghapus akun anda sendiri!']);
        }

        $guru = Guru::where('user_id', $id)->first();
        if ($guru != null){
            return response()->json(['error' => 'Gagal menghapus data! Akun ini merupakan akun guru! Silahkan hapus data guru terlebih dahulu']);
        }

        try {
            $dataUser->delete();
            return response()->json(['success' => 'Data berhasil dihapus!']);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Gagal menghapus data!']);
        }
    }

    public function getTable(Request $request){
        if ($request->ajax()) {
            // $userRole = UserRoles::all();
            // $role = Role::all();
            // $concat = $user->concat($userRole)->concat($role);
            // $data = $concat->all();
            $user = User::all();
            return DataTables::of($user)
            // ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a href="'. route('dataUser.show', $row) .'" data-toggle="tooltip"  data-id="' . $row . '" data-original-title="Detail" class="btn btn-sm btn-success mx-1 shadow detail"><i class="fas fa-sm fa-fw fa-eye"></i> Detail</a>';
                // $btn = '<a action="{{ url('/') }}/editUser" method="post" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="btn btn-sm btn-primary mx-1 shadow edit"><i class="fas fa-sm fa-fw fa-edit"></i> Edit</a>';
                $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-sm btn-danger mx-1 shadow delete"><i class="fas fa-sm fa-fw fa-trash"></i> Delete</a>';
                
                return $btn;
            })
            ->addColumn('role', function ($row) {
                $role = UserRoles::where('user_id', $row->id)->first();
                $role_name = Roles::where('id', $role->role_id)->first()->role;
                return $role_name;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }
}
