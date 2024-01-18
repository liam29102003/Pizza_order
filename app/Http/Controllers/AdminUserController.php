<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function adminList()
    {
        $data = User::when(request('search'),function($query)
        {
        $query->where('name','like','%'.request('search').'%')
        ->orWhere('email','like','%'.request('search').'%')
        ->orWhere('address','like','%'.request('search').'%')
        ->orWhere('gender','like','%'.request('search').'%');
        })
        ->where('role','admin')->paginate(5);
// dd($data->toArray());
        return view('admin.adminUser.adminlist',compact('data'));
    }

    public function userList()
    {
        
        $data = User::when(request('search'),function($query)
        {
        $query->where('name','like','%'.request('search').'%')
        ->orWhere('email','like','%'.request('search').'%')
        ->orWhere('address','like','%'.request('search').'%')
        ->orWhere('gender','like','%'.request('search').'%');
        })
        ->where('role','user')->paginate(5);

        return view('admin.adminUser.adminlist',compact('data'));
    }
    public function adminListDelete($id)
    {
        User::where('id',$id)->delete();
        return back()->with(['DeleteSuccess'=>'Account Successfully Deleted']);
    }
    public function ChangeRole($id)
    {
        
        $user = User::where('id',$id)->first();
        return view('admin.adminUser.ChangRole',compact('user'));
    }
    public function updateRole($id,Request $request)
    {
         
        User::where('id',$id)->update(['role' => $request->role]);
        if($request->oRole == 'user')
        {
            return redirect()->route('admin#userList')->with(['updateSuccess'=>'Role changes Successfully']);
        }
        elseif($request->oRole == 'admin')
        {
            return redirect()->route('admin#adminList')->with(['updateSuccess'=>'Role changes Successfully']);

        }
    }
}