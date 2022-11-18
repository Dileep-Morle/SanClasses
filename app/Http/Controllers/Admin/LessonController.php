<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Str;
use File;
use PDF;
use URL;
use Audio;
use Video;
Use Storage;
use strip_tags;
class LessonController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $data = Lesson::query()
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('descreption', 'LIKE', "%{$search}%")
            ->orderBy('id','desc')
            ->paginate(5);
        return view('admin.lesson.create', $data);
    }

    public function create(Request $request)
    {
        $data = Lesson::where('course_id', $request->id)
        ->orderBy('id','desc')
        ->get();
        $countLength = Lesson::query('id', $request->id)->get();
        $length = count($countLength);
        $course = Course::where('id', $request->id)->first();
        return view('admin.lesson.create',['course'=>$course, 'datalesson'=>$data, 'arrayLength'=>$length]);
    }

     public function store(Request $request)
     {   
        $request->validate([
            'title' => 'required',
            'descreption' => 'required',
        ]);
            $lessonAdd              = new Lesson();
            $lessonAdd->course_id   = $request->id;
            $lessonAdd->title       = $request->title;
            $lessonAdd->descreption = strip_tags($request->descreption);
            if($request->hasfile('lesson_file')){
                $file      = $request->file('lesson_file');
                $extension = $file->getClientOriginalExtension();
                $filename  = time().'.'.$extension;
                $file->move('public/lesson/', $filename);
                $lessonAdd['lesson_file']= $filename;
                $lessonAdd->file_type = $extension;

            }
            $lessonAdd->is_paid   = $request->is_paid;
            $lessonAdd->save();
            return redirect()->route('lessons-create',['id'=>$request->id])->with('status', 'lesson added succesfully!!');

       
     }
    public function edit($id)
    {
        $lesson = Lesson::find($id);
        return view('admin.lesson.edit', ['editlesson'=>$lesson]);
    }
    public function update(Request $request, $id)
    {
        $updateData = Lesson::find($id);
        $updateData->title = $request->title;
        $updateData->descreption = strip_tags($request->descreption);
        if($request->hasfile('lesson_file')){
            $destination = 'public/lesson'.$updateData->lesson_file;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file      = $request->file('lesson_file');
            $extension = $file->getClientOriginalExtension();
            $filename  = time().'.'.$extension;
            $file->move('public/lesson', $filename);
            $updateData['lesson_file']= $filename;
            $updateData->file_type = $extension;
        }
        $updateData->is_paid = $request->is_paid;
        $updateData->save();
        return redirect()->route('lessons-create',$updateData->course_id)->with('status', 'lesson Update succesfully!!');
    }
    public function destroy(Request $request, $id)
    {
        $course = Lesson::find($id);
        Lesson::destroy($id);
        return redirect()->route('lessons-create',$course->course_id)->with('status', 'lesson Deleted succesfully!!');
    }
}
