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
        $user = User::all();
        $roles = Roles::all('id', 'role_name');
        return view('dataUser/indexUser', compact('user','roles'));
    }
    public function show(User $user)
    {
        //$id = $user->id;
        
        //return view('dataUser/indexUser',compact('user'));
    }
}
