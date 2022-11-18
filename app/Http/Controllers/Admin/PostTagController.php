<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostTag;
use App\Models\User;
use PDF;
class PostTagController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $data = PostTag::query()
            ->where('title', 'LIKE', "%{$search}%")
            ->orderBy('id','desc')
            ->paginate(5);
        $countLength = PostTag::query('id', $request->id)->get();
        $length = count($countLength);
        return view('admin.blogtag.index',['blogtag'=>$data, 'arrayLength'=>$length]);
    }
    public function create()
    {
        return view('admin.blogtag.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

            $user             = $request->user();
            $blogtagData          = new PostTag();
            $blogtagData->user_id = $user->id;
            $blogtagData->title   = $request->title;
            $blogtagData->save();

            return redirect()->route('blog-tag')->with('status', 'Blog tag added succesfully!!');

       
     }
    public function edit($id)
    {
        $post = PostTag::find($id);
        return view('admin.blogtag.edit', ['blogtags'=>$post]);
    }
    public function update(Request $request, $id)
    {
        $updateData = PostTag::find($id);
        $updateData->title = $request->title;
        $updateData->save();
        return redirect()->route('blog-tag')->with('status', 'Blog tag update succesfully!!');
    }
    // public function show()
    // {
    //     $data['users'] = User::orderBy('id','desc')->paginate(5);
    //     return view('admin.user.index',$data);
    // }
    public function blogtagdownloadPDF($id)
    {
        $show['blogtagdata'] = PostTag::find($id);
        $pdf = PDF::loadView('admin.blogtag.blogtagpdf', $show);
        return $pdf->download('blogtag.pdf');
    }
    public function destroy($id)
    {
        PostTag::destroy($id);
        return redirect()->route('blog-tag')->with('status', 'Blog tag Deleted succesfully!!');
    }
}

