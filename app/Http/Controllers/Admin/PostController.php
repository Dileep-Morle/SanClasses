<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Str;
use File;
use PDF;
Use Storage;
use strip_tags;
class PostController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Search in the title and body columns from the posts table
        $data = Post::query()
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('content', 'LIKE', "%{$search}%")
            ->orderBy('id','desc')
            ->paginate(5);
        $countLength = Post::query('id', $request->id)->get();
        $length = count($countLength); 
        return view('admin.blog.index',['blogs'=>$data, 'arrayLength'=>$length]);
    }

    public function create()
    {
        return view('admin.blog.create');
    }

     public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'img' => 'required|image|mimes:png,jpg,jpeg'
        ]);

            $user                 = $request->user();
            $blogAdd              = new Post();
            $blogAdd->user_id     = $user->id;
            $blogAdd->title       = $request->title;
            $blogAdd->parent_id   = $request->parent_id;
            $blogAdd->slug        = Str::slug($request->title);
            $blogAdd->meta_tag   = $request->meta_tag;
            $blogAdd->content     = strip_tags($request->content);
            if($request->hasfile('img')){
                $file      = $request->file('img');
                $extension = $file->getClientOriginalExtension();
                $filename  = time().'.'.$extension;
                $file->move('public/image/', $filename);
                $blogAdd['img']= $filename;
            }
            $blogAdd->save();

            return redirect()->route('blogs')->with('status', 'Blog added succesfully!!');

       
     }
    public function edit($id)
    {
        $post = Post::find($id);
        return view('admin.blog.edit', ['blogedit'=>$post]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'img' => 'required|image|mimes:png,jpg,jpeg'
        ]);
        $updateData = Post::find($id);
        $updateData->title = $request->title;
        $updateData->parent_id   = $request->parent_id;
        $updateData->meta_tag   = $request->meta_tag;
        $updateData->content = strip_tags($request->content);
        if($request->hasfile('img') !=''){
            $destination = 'public/image/'.$updateData->img;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file      = $request->file('img');
            $extension = $file->getClientOriginalExtension();
            $filename  = time().'.'.$extension;
            $file->move('public/image/', $filename);
            $updateData['img']= $filename;
        }
        $updateData->save();
        return redirect()->route('blogs')->with('status', 'Blog Update succesfully!!');
    }
    // public function show()
    // {
    //     $data['users'] = User::orderBy('id','desc')->paginate(5);
    //     return view('admin.user.index',$data);
    // }
    public function blogdownloadPDF($id)
    {
        $show['blogdata'] = Post::find($id);
        $pdf = PDF::loadView('admin.blog.blogpdf', $show);
        return $pdf->download('blog.pdf');
    }
    public function destroy($id)
    {
        Post::destroy($id);
        return redirect()->route('blogs')->with('status', 'Blog Deleted succesfully!!');
    }

}
