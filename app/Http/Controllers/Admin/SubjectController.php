<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use Str;
use File;
use PDF;
Use Storage;
use strip_tags;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $data = Subject::query()
            ->where('subject_name', 'LIKE', "%{$search}%")
            ->orderBy('id','desc')
            ->paginate(5);
        $countLength = Subject::query('id', $request->id)->get();
        $length = count($countLength);
        return view('admin.subject.index',['addsubject'=>$data, 'arrayLength'=>$length ]);
    }

    public function create()
    {
        return view('admin.subject.create');
    }

     public function store(Request $request)
    {
        $request->validate([
            'subject_name' => 'required',
        ]);

        $subjectAdd              = new Subject();
        $subjectAdd->subject_name       = $request->subject_name;
        $subjectAdd->save();
        return redirect()->route('subject')->with('status', 'subject added succesfully!!');
       
     }
  
    public function edit($id)
    {
        $subject = Subject::find($id);
        return view('admin.subject.edit', ['subjectedit'=>$subject]);
    }
    public function update(Request $request, $id)
    {
        $updateData            = Subject::find($id);
        $updateData->subject_name      = $request->subject_name;
        $updateData->save();
        return redirect()->route('subject')->with('status', 'subject Update succesfully!!');
    }
  
    public function destroy($id)
    {
        Subject::destroy($id);
        return redirect()->route('subject')->with('status', 'subject Deleted succesfully!!');
    }
}
