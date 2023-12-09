<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Roles;
use App\Models\UserRoles;
use App\Models\Guru;
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
        $role = Roles::all();
        $user = User::with('role')->where('id', $id)->first();
        $userRole = UserRoles::all()->where('user_id', $id);
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
            'role'=>'required',
        ],
        [
            'name.required'=>'Nama harus diisi',
            'email.email'=>'Isi dengan format email',
            // 'user_name.required'=>'Username harus diisi',
            // 'user_name.unique'=>'Username sudah digunakan',
            'role.required'=>'Peran harus diisi'
        ]);
        // $p=$request->get('password');
        // $securep=bcrypt($p);

        $dataUser->update([
            'name'=>$request->get('name'),
            'email'=>$request->get('email'),
            // 'user_name'=>$request->get('user_name'),
            // 'password'=>$securep,
            'updated_at'=>now()
        ]);
        // $user->update($request->only(['name', 'email', 'user_name']));
        $id = $dataUser->id;
        
        #update userRoles pivot table
        $userRoles = UserRoles::where('user_id', $id)->first();
        $userRoles->update([
            'role_id'=>$request->get('role')
        ]);

        // $userRoles->create([
        //     'user_id'=>$id,
        //     'role_id'=>$request->get('role_id')
        // ]);
        if ($dataUser) {
            return response()->json(['success' => $request->get('role')]);
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

    public function destroy(User $dataUser)
    {
        // $id = $dataUser->id;
        // $userRoles = UserRoles::where('user_id', $id)->first();
        // $userRoles->delete();
        // $dataUser->delete();
        // if ($dataUser) {
        //     return response()->json(['success' => 'Data berhasil dihapus!']);
        // }
        // else{
        //     return response()->json(['error' => 'Data gagal dihapus!']);
        // }
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
            ->rawColumns(['action'])
            ->make(true);
        }
    }
}
