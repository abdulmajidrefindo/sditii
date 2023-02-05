<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Roles;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $roles = User::with('roles')->get();
        // $roles = User::all()->roles;
        // foreach($users->roles as $role)
        // {

        // }
        return view('dataUser/indexUser',
        [
                "user"=>$users,
                "role"=>$roles
        ]);
    }
    public function show(User $user)
    {
        //$id = $user->id;
        
        //return view('dataUser/indexUser',compact('user'));
    }
}
