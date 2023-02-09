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


class UserController extends Controller
{
    public function index()
    {
        $data = UserRoles::all();
        $users = User::all();
        $roles = Roles::all();
        // $roles = User::all()->roles;
        // foreach($users->roles as $role)
        // {

        // }
        return view('dataUser/indexUser',
        [
                'data'=>$data->load('user','role'),
                // "user"=>$users,
                // "role"=>$roles
        ]);
    }
    public function show(User $user)
    {
        //$id = $user->id;
        
        //return view('dataUser/indexUser',compact('user'));
    }
}
