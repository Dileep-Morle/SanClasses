<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use Str;
use File;
use PDF;
Use Storage;
use strip_tags;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $data = Course::query()
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('descreption', 'LIKE', "%{$search}%")
            ->orderBy('id','desc')
            ->paginate(5);
        $countLength = Course::query('id', $request->id)->get();
        $length = count($countLength);
        return view('admin.course.index',['addcourse'=>$data, 'arrayLength'=>$length]);
    }

    public function create()
    {
        return view('admin.course.create');
    }

     public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'descreption' => 'required',
            
        ]);

            $courseAdd              = new Course();
            $courseAdd->title       = $request->title;
            $courseAdd->slug    = Str::slug($request->title);
            $courseAdd->descreption = strip_tags($request->descreption);
            if($request->hasfile('feature_image')){
                $file      = $request->file('feature_image');
                $extension = $file->getClientOriginalExtension();
                $filename  = time().'.'.$extension;
                $file->move('public/course-image/', $filename);
                $courseAdd['feature_image']= $filename;
            }
            if($request->hasfile('banner')){
                $file      = $request->file('banner');
                $extension = $file->getClientOriginalExtension();
                $filename  = time().'.'.$extension;
                $file->move('public/banner/', $filename);
                $courseAdd['banner']= $filename;
            }
            $courseAdd->banner_type = $extension;
           $courseAdd->save();
           return redirect()->route('lessons-create',$courseAdd->id)->with('status', 'Course added succesfully!!');

       
     }
    public function edit($id)
    {
        $course = Course::find($id);
        return view('admin.course.edit', ['editcourse'=>$course]);
    }
    public function update(Request $request, $id)
    {
       
        $updateData = Course::find($id);
        $updateData->title = $request->title;
        $updateData->descreption = strip_tags($request->descreption);
        if($request->hasfile('feature_image')){
            $destination = 'public/course-image/'.$updateData->feature_image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file      = $request->file('feature_image');
            $extension = $file->getClientOriginalExtension();
            $filename  = time().'.'.$extension;
            $file->move('public/course-image/', $filename);
            $updateData['feature_image']= $filename;
        }
        if($request->hasfile('banner')){
            $destination = 'public/banner/'.$updateData->banner;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file      = $request->file('banner');
            $extension = $file->getClientOriginalExtension();
            $filename  = time().'.'.$extension;
            $file->move('public/banner/', $filename);
            $updateData['banner']= $filename;
            $updateData->banner_type = $extension;
        }
        $updateData->save();
        return redirect()->route('course')->with('status', 'Course Update succesfully!!');
    }
   
    public function destroy($id)
    {
       Course::destroy($id);
       return redirect()->route('course')->with('status', 'Course Deleted succesfully!!');
    }
}
