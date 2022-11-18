<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vocabulary;
use App\Models\User;
use Str;
use File;
use PDF;
Use Storage;
use strip_tags;

class VocabularyController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $data= Vocabulary::query()
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('content', 'LIKE', "%{$search}%")
            ->orderBy('id','desc')
            ->paginate(5);
        $countLength = Vocabulary::query('id', $request->id)->get();
        $length = count($countLength);
        return view('admin.vocabulary.index',['addvocabulary'=>$data, 'arrayLength'=>$length]);
    }

    public function create()
    {
        return view('admin.vocabulary.create');
    }

     public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'feature_image' => 'image|mimes:png,jpg,jpeg',
            'doc_pdf'        =>'required|mimes:pdf,xlx,csv|max:2048'
        ]);

            $vocabularyAdd              = new Vocabulary();
            $vocabularyAdd->title       = $request->title;
            $vocabularyAdd->slug    = Str::slug($request->title);
            $vocabularyAdd->content     = strip_tags($request->content);
            if($request->hasfile('feature_image')){
                $file      = $request->file('feature_image');
                $extension = $file->getClientOriginalExtension();
                $filename  = time().'.'.$extension;
                $file->move('public/image/', $filename);
                $vocabularyAdd['feature_image']= $filename;
            }
            if($request->hasfile('doc_pdf')){
                $file      = $request->file('doc_pdf');
                $extension = $file->getClientOriginalExtension();
                $filename  = time().'.'.$extension;
                $file->move('public/document/', $filename);
                $vocabularyAdd['doc_pdf']= $filename;
            }
            $vocabularyAdd->save();

            return redirect()->route('vocabulary')->with('status', 'Vocabulary added succesfully!!');

       
     }
    public function edit($id)
    {
        $vocabulary = Vocabulary::find($id);
        return view('admin.vocabulary.edit', ['vocabularyedit'=>$vocabulary]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'feature_image' => 'image|mimes:png,jpg,jpeg',
            'doc_pdf'        =>'mimes:pdf,xlx,csv|max:2048'
        ]);
        $updateData = Vocabulary::find($id);
        $updateData->title = $request->title;
        $updateData->content = strip_tags($request->content);
        if($request->hasfile('feature_image')){
            $destination = 'public/image/'.$updateData->img;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file      = $request->file('feature_image');
            $extension = $file->getClientOriginalExtension();
            $filename  = time().'.'.$extension;
            $file->move('public/image/', $filename);
            $updateData['feature_image']= $filename;
        }
        if($request->hasfile('doc_pdf')){
            $destination = 'public/document/'.$updateData->img;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file      = $request->file('doc_pdf');
            $extension = $file->getClientOriginalExtension();
            $filename  = time().'.'.$extension;
            $file->move('public/document/', $filename);
            $updateData['doc_pdf']= $filename;
        }
        $updateData->save();
        return redirect()->route('vocabulary')->with('status', 'Vocabulary Update succesfully!!');
    }
  
    public function downloadPDF($id)
    {
        $show['showdata'] = Vocabulary::find($id);
        $pdf = PDF::loadView('admin.vocabulary.view', $show);
        return $pdf->download('vocabulary.pdf');
    }
    public function destroy($id)
    {
        Vocabulary::destroy($id);
        return redirect()->route('vocabulary')->with('status', 'Vocabulary Deleted succesfully!!');
    }
}
