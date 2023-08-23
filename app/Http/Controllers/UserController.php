<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Roles;
use App\Models\UserRoles;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Console\View\Components\Alert;
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
                // "user"=>$users,
                "role"=>$roles
        ]);
    }
    public function create()
    {
        return view('dataUser/indexUser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTugasMapelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $validator=$request->validate([
            'name'=>'required',
            'email'=>'email',
            'user_name'=>'required|unique:user,user_name',
            'password'=>'required',
            'role_id'=>'required',
        ],
        [
            'name.required'=>'Nama harus diisi',
            'email.email'=>'Isi dengan format email',
            'user_name.required'=>'Username harus diisi',
            'user_name.unique'=>'Username sudah digunakan',
            'password.required'=>'Password harus diisi',
            'role_id.required'=>'Peran harus diisi'
        ]);

        $users=User::create([
            'name'=>$request->get('name'),
            'email'=>$request->get('email'),
            'user_name'=>$request->get('user_name'),
            'password'=>$request->get('password'),
            'created_at'=>now()
        ]);
        $user_id = User::all('id')->latest();
        $userRole=UserRoles::create([
            'user_id'=>$user_id,
            'role_id'=>$request->get('role_id'),
            'created_at'=>now()
        ]);
        
        if ($users && $userRole) {
            return response()->json(['errors' => 'Data gagal disimpan!']);
        } else {
            return response()->json(['success' => 'Data berhasil disimpan!']);
        }
    }
    public function show(User $user)
    {
        //$id = $user->id;
        
        //return view('dataUser/indexUser',compact('user'));
    }
}
