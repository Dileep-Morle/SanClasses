<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testmonial;
use Str;
use File;
use PDF;
Use Storage;
use strip_tags;
class TestmonialController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $data = Testmonial::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('comment', 'LIKE', "%{$search}%")
            ->orderBy('id','desc')
            ->paginate(5);
        $countLength = Testmonial::query('id', $request->id)->get();
        $length = count($countLength);
        return view('admin.testmonial.index',['addtestmonial'=>$data, 'arrayLength'=>$length ]);
    }

    public function create()
    {
        return view('admin.testmonial.create');
    }

     public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'comment' => 'required',
            'profile' => 'image|mimes:png,jpg,jpeg'
        ]);

            $testmonialAdd              = new Testmonial();
            $testmonialAdd->name       = $request->name;
            $testmonialAdd->rating       = $request->rating;
            $testmonialAdd->comment     = strip_tags($request->comment);
            $file      = $request->file('profile');
            $extension = $file->getClientOriginalExtension();
            $image_parts = explode(";base64,", $file);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[0];
            $image_base64 = base64_encode($image_parts[0]);
            $filename  = time().$image_base64.'.'.$extension;
            // dd($filename);
            $file->move('public/testmonial-image/', $filename);
            $testmonialAdd['profile']= $filename;
            $testmonialAdd->save();
            return redirect()->route('testmonial')->with('status', 'Testmonial added succesfully!!');
       
     }
  
    public function edit($id)
    {
        $testmonial = Testmonial::find($id);
        return view('admin.testmonial.edit', ['testmonialedit'=>$testmonial]);
    }
    public function update(Request $request, $id)
    {
        $updateData            = Testmonial::find($id);
        $updateData->name      = $request->name;
        $updateData->comment   = strip_tags($request->comment);
        $updateData->rating = $request->rating;
        if($request->hasfile('profile')){
            $destination = 'public/testmonial-image/'.$updateData->profile;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file      = $request->file('profile');
            $extension = $file->getClientOriginalExtension();
            $filename  = time().'.'.$extension;
            $file->move('public/testmonial-image/', $filename);
            $updateData['profile']= $filename;
        }
        $updateData->save();
        return redirect()->route('testmonial')->with('status', 'Testmonial Update succesfully!!');
    }
  
    public function destroy($id)
    {
        Testmonial::destroy($id);
        return redirect()->route('testmonial')->with('status', 'Testmonial Deleted succesfully!!');
    }
}
