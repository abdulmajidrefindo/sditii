<?php

namespace App\Http\Controllers;

use App\Models\UserRoles;
use App\Http\Requests\StoreUserRolesRequest;
use App\Http\Requests\UpdateUserRolesRequest;

class UserRolesController extends Controller
{
    public function index()
    {
        $userRoles = UserRoles::all();
        return view('dataUser/indexUser',
        [
            'data'=>$userRoles
        ]);
    }
}
