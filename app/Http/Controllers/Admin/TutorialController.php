<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tutorial;
use Str;
use File;
use PDF;
Use Storage;
use strip_tags;

class TutorialController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $data = Tutorial::query()
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('content', 'LIKE', "%{$search}%")
            ->orderBy('id','desc')
            ->paginate(5);
        $countLength = Tutorial::query('id', $request->id)->get();
        $length = count($countLength);
        return view('admin.tutorial.index',['addtutorial'=>$data, 'arrayLength'=>$length]);
    }

    public function create()
    {
        return view('admin.tutorial.create');
    }

     public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'feature_image' => 'image|mimes:png,jpg,jpeg',
            'video'        => 'max:20000|mimes:mp4,3gp,flv,mkv'
        ]);

            $tutorialAdd              = new Tutorial();
            $tutorialAdd->title       = $request->title;
            $tutorialAdd->slug    = Str::slug($request->title);
            $tutorialAdd->content     = strip_tags($request->content);
            if($request->hasfile('feature_image')){
                $file      = $request->file('feature_image');
                $extension = $file->getClientOriginalExtension();
                $filename  = time().'.'.$extension;
                $file->move('public/tutorial-image/', $filename);
                $tutorialAdd['feature_image']= $filename;
            }
            if($request->hasfile('video')){
                $file      = $request->file('video');
                $extension = $file->getClientOriginalExtension();
                $filename  = time().'.'.$extension;
                $file->move('public/tut-video/', $filename);
                $tutorialAdd['video']= $filename;
            }
            $tutorialAdd->save();

            return redirect()->route('tutorial')->with('status', 'tutorial added succesfully!!');

       
     }
    public function edit($id)
    {
        $tutorial = Tutorial::find($id);
        return view('admin.tutorial.edit', ['tutorialedit'=>$tutorial]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'feature_image' => 'image|mimes:png,jpg,jpeg',
            'video'        =>'video|mimes:mp4,3gp,flv,mkv'
        ]);
        $updateData = Tutorial::find($id);
        $updateData->title = $request->title;
        $updateData->content = strip_tags($request->content);
        if($request->hasfile('feature_image')){
            $destination = 'public/tutorial-image/'.$updateData->img;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file      = $request->file('feature_image');
            $extension = $file->getClientOriginalExtension();
            $filename  = time().'.'.$extension;
            $file->move('public/tutorial-image/', $filename);
            $updateData['feature_image']= $filename;
        }
        if($request->hasfile('video')){
            $destination = 'public/tut-video/'.$updateData->video;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file      = $request->file('video');
            $extension = $file->getClientOriginalExtension();
            $filename  = time().'.'.$extension;
            $file->move('public/tut-video/', $filename);
            $updateData['video']= $filename;
        }
        $updateData->save();
        return redirect()->route('tutorial')->with('status', 'tutorial Update succesfully!!');
    }
    // public function show()
    // {
    //     $data['users'] = User::orderBy('id','desc')->paginate(5);
    //     return view('admin.user.index',$data);
    // }
    public function tutorialdownloadPDF($id)
    {
        $show['tutorialdata'] = Tutorial::find($id);
        $pdf = PDF::loadView('admin.tutorial.tutorialpdf', $show);
        return $pdf->download('tutorial.pdf');
    }
    public function destroy($id)
    {
        Tutorial::destroy($id);
        return redirect()->route('tutorial')->with('status', 'tutorial Deleted succesfully!!');
    }
}
