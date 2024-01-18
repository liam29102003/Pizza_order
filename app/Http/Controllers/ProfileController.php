<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function changePassword()
    {
        return view('admin.profile.changePassword');
    }
    public function updatePassword(Request $request)
    {
        // dd($request->all());
        $this->validatePassword($request);
        $id = Auth::user()->id;
        $dbpassword = User::select('password')->where('id',$id)->first()->password;
        if(Hash::check($request->oldPassword,$dbpassword))
        {
            User::where('id',$id)->update([
                'password'=>Hash::make($request->confirmPassword),
            ]);
            return redirect()->route('admin#changePassword')->with(['passwordSuccess'=>'Password changed successfuly']);
        };
        return redirect()->route('admin#changePassword')->with(['notMatch'=>'Wrong password']);

    }
    public function profile()
    {
        return view('admin.profile.detail');
    }
    public function editprofile()
    {
        return view('admin.profile.editprofile');
    }
    public function updateprofile($id,Request $request)
    {
        $this->updateProfileValidation($request);
        $data = $this->updateProfileData($request);
    if(isset($request->image))
    {
        $dbImage = User::where('id',$id)->first();
        $dbImage = $dbImage->image;
        if($dbImage != null)
        {
            Storage::delete('public/'.$dbImage);
        }

            $filename=uniqid().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$filename);
        $data['image']=$filename;
    }

    User::where('id',$id)->update($data);
    return redirect()->route('admin#profile')->with(['updateSuccess' => 'Profile updated successfully']);

    }
    private function updateProfileData($request)
    {
         return['name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'gender'=>$request->gender,
                'address'=>$request->address];
    }
    private function updateProfileValidation($request)
    {
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'address'=>'required',
            'image'=>'mimes:png,jpg,jpeg|file'
        ])->validate();
    }
    private function validatePassword($request)
    {

        Validator::make($request->all(),[
            'oldPassword' => 'required|min:6',
            'newPassword' => 'required|min:6|different:oldPassword',
            'confirmPassword'=> 'required|min:6|same:newPassword'
        ])->validate();

    }

    }

