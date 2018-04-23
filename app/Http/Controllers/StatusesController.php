<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Status;
use Auth;
class StatusesController extends Controller
{
    //权限控制
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'content'=>'required|max:140'
        ]);

        Auth::user()->statuse()->create([
            'content'=>$request['content']
        ]);

        return redirect()->back();
    }

    public function destroy(Status $status)
    {
        $this->authorize('destroy',$status);
        $status->delete();
        session()->flash('success','微博已被成功删除!!');
        return redirect()->back();
    }
}
