<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use Str;
use File;
Use Storage;
use strip_tags;
use Image;
use Session;
class TeamController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $data = Team::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('descreption', 'LIKE', "%{$search}%")
            ->orderBy('id','desc')
            ->paginate(5);
        $countLength = Team::query('id', $request->id)->get();
        $length = count($countLength);
        return view('admin.team.index',['addteam'=>$data, 'arrayLength'=>$length]);
    }

    public function create()
    {
        return view('admin.team.create');
    }

     public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'descreption' => 'required',
            'photo' => 'image|mimes:png,jpg,jpeg'
        ]);
         $teamAdd              = new Team();
         $teamAdd->name       = $request->name;
         $teamAdd->descreption     = strip_tags($request->descreption);
         if($request->hasfile('photo')){
            $file      = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $filename  = time().'.'.$extension;
            $file->move('public/team-image/', $filename);
            $teamAdd['photo']= $filename;
         }
         $teamAdd->save();
        return redirect()->route('team')->with('status', 'Team added succesfully!!');
        
       
     }
    public function edit($id)
    {
        $team = Team::find($id);
        return view('admin.team.edit', ['teamedit'=>$team]);
    }
    public function update(Request $request, $id)
    {
        $updateData            = Team::find($id);
        $updateData->name      = $request->name;
        $updateData->descreption   = strip_tags($request->descreption);
        if($request->hasfile('photo')){
            $destination = 'public/team-image/'.$updateData->photo;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file      = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $filename  = time().'.'.$extension;
            $file->move('public/team-image/', $filename);
            $updateData['photo']= $filename;
        }
        $updateData->save();
        return redirect()->route('team')->with('status', 'Team Update succesfully!!');
    }
  
    public function destroy($id)
    {
        Team::destroy($id);
        return redirect()->route('team')->with('status', 'Team Deleted succesfully!!');
    }
}
