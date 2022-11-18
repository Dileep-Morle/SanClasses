<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use PDF;
// use Session;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {
       
        $search = $request->input('search');
        $data = User::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->orderBy('id','desc')
            ->paginate(5);
        $userLength = User::query('id', $request->id)->get();
        $length = count($userLength);
        return view('admin.user.index',['users'=>$data, 'arrayLength'=>$length]);
    }
    public function create()
    {
        return view('admin.user.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'is_instructor'=>'required',
            'password'=>'required|confirmed|min:5|max:12',
            'password_confirmation'=>'required'
            
        ]);
       $userdata = new User();
       $userdata->name = $request->name;
       $userdata->email = $request->email;
       $userdata->is_instructor = $request->is_instructor;
       $userdata->password = Hash::make($request->password);
       $userdata->save();
       return redirect()->route('users')->with('status', 'User Register succesfully!!');

       
    }
    public function edit($id)
    {
        $userdata = User::find($id);
        return view('admin.user.edit', ['user'=>$userdata]);
    }
    public function update(Request $request, $id)
    {
        $updateData = User::find($id);
        $updateData->name = $request->name;
        $updateData->email = $request->email;
        $updateData->is_instructor = $request->is_instructor;
        $updateData->password = Hash::make($request->password);
        $updateData->save();
        return redirect()->route('users')->with('status', 'User Update succesfully!!');
    }
    
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('users')->with('status', 'User Deleted succesfully!!');
    }
    
}
