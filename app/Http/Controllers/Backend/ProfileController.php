<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function view(){
        $user = Auth::user();
        return view('backend.user.view-profile', compact('user'));
    }
    public function edit($id){
        $editUser = User::findOrFail($id);

        return view('backend.user.edit-profile', compact('editUser'));
    }
    public function update($id, Request $request){
        $data = User::findOrFail($id);

        $data->name = $request->name;
        $data->mobile = $request->mobile;
        $data->address = $request->address;
        $data->email = $request->email;
        $data->gender = $request->gender;

        if($request->file('image')){
            $file = $request->file('image');
            @unlink(public_path('upload/user_images'.$data->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $filename);
            $data['image'] = $filename;
        }

        $data->save();

        return redirect()->route('profiles.view')->with('success', 'Profile updated sucessfully!');
    }

    public function passwordView(){
        return view('backend.user.edit-password');
    }
    public function passwordUpdate(Request $request){
         if(Hash::check($request->old_password, Auth::user()->getAuthPassword())){
             $user = User::find(Auth::user()->id);
             $user->password = bcrypt($request->new_password);
             $user->save();

             return redirect()->route('profiles.view')->with('success', 'Password changed successfully');
         }else{
             return redirect()->back()->with('error', 'Sorry! your current password does not match');
         }


        /*if(Auth::user()->getAuthPassword() == $request->old_password){
            dd('ok');
        } else{
            return redirect()->back()->with('error', 'Sorry! Current password does not match!');
        }*/
    }
}
