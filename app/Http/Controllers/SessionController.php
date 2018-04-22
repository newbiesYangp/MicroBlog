<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth; //用户身份认证
class SessionController extends Controller
{
    public function __construct()
    {
        //未登录用户可以访问登录页面
        $this->middleware('guest',[
            'only' => ['create']
        ]);
    }
    //显示登录表单
    public function create()
    {
        return view('sessions.create');
    }

    //登录
    public function store(Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials, $request->has('remember'))){ //登录成功
            //用户存在于数据库，且邮箱密码相符合
            session()->flash('success','欢迎回来！！');
            return redirect()->intended(route('users.show',[Auth::user()]));
        } else { //登录失败
            session()->flash('danger','很抱歉，您的邮箱和密码不匹配');
            return redirect()->back()->withInput();
        }
    }

    //退出登录
    public function destroy()
    {
        Auth::logout();
        session()->flash('success','你已成功退出！');
        return redirect('login');
    }
}
