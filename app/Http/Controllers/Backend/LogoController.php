<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Logo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoController extends Controller
{
    public function view(){
        $data['countLogo'] = Logo::count();
        $data['allData'] = Logo::all();
        return view('backend.logo.view-logo', $data);
    }

    public function add(){
        return view('backend.logo.add-logo');
    }

    public function store(Request $request){

        $data = new Logo();
        $data->created_by = Auth::user()->id;
        if($request->file('image')){
            $file = $request->file('image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/logo_images/'), $filename);
            $data['image'] = $filename;
        }
        $data->save();

        return redirect()->route('logos.view')->with('success', 'Data inserted sucessfully!');
    }

    public function edit($id){
        $editData = Logo::findOrFail($id);
        return view('backend.logo.edit-logo', compact('editData'));
    }
    public function delete($id){
        $deleteData = Logo::findOrFail($id);

        if(file_exists('public/upload/logo_images/'.$deleteData->image) AND ! empty($deleteData->image)){
            unlink('public/upload/logo_images/'.$deleteData->image);
        }

        $deleteData->delete();
        return redirect()->route('logos.view')->with('success', 'Data deleted successfully!');
    }

    public function update($id, Request $request){
        $data = Logo::find($id);
        $data->updated_by = Auth::user()->id;
        if($request->file('image')){
            $file = $request->file('image');
            unlink(public_path('upload/logo_images/'.$data->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/logo_images/'), $filename);
            $data['image'] = $filename;
        }
        $data->save();

        return redirect()->route('logos.view')->with('success', 'Data updated sucessfully!');
    }
}
