<?php

namespace App\Http\Controllers;

use App\Models\roles;
use App\Http\Requests\StorerolesRequest;
use App\Http\Requests\UpdaterolesRequest;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Roles::all();
        return view('dataUser/indexUser', compact('roles'));
    }
}
