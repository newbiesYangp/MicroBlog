<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Auth;
class UsersController extends Controller
{
    //注册表单
    public function create()
    {
        return view('users.create');
    }

    //展示个人信息
    public function show(User $user)
    {

        return view('users.show', compact('user'));
    }

    //添加
    public function store(Request $request)
    {
        $this->validate($request,[
                'name'      => 'bail|required|min:3|max:50',
                'email'     => 'bail|required|email|unique:users|max:255',
                'password'  => 'bail|required|confirmed|min:6'
        ]);

        $user = User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => bcrypt($request->password),
        ]);
        Auth::login($user);
        session()->flash('success','欢迎，注册成功！');
        return redirect()->route('users.show',[$user]);
    }
}
