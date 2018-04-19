<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    //注册表单
    public function create()
    {
        return view('users.create');
    }
}
