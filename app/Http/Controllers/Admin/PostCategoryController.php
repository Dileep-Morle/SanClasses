<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostCategory;
use App\Models\User;
use Str;
Use Storage;
use File;
use PDF;
use strip_tags;
class PostCategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $data = PostCategory::query()
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('content', 'LIKE', "%{$search}%")
            ->orderBy('id','desc')
            ->paginate(5);
        $countLength = PostCategory::query('id', $request->id)->get();
        $length = count($countLength);
        return view('admin.blogcategory.index',['blogcategory'=>$data, 'arrayLength'=>$length]);
    }
    public function create()
    {
        return view('admin.blogcategory.create');
    }
     public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'img' => 'image|mimes:png,jpg,jpeg'
        ]);

        $user                 = $request->user();
        $categoryAdd          = new PostCategory();
        $categoryAdd->user_id = $user->id;
        $categoryAdd->title   = $request->title;
        $categoryAdd->parent_id   = $request->parent_id;
        $categoryAdd->slug    = Str::slug($request->title);
        $categoryAdd->content = strip_tags($request->content);
        if($request->hasfile('img')){
            $file      = $request->file('img');
            $extension = $file->getClientOriginalExtension();
            $filename  = time().'.'.$extension;
            $file->move('public/image/', $filename);
            $categoryAdd['img']= $filename;
        }
        $categoryAdd->save();

        return redirect()->route('blog-categories')->with('status', 'Blog Category added succesfully!!');

       
     }
    public function edit($id)
    {
        $post = PostCategory::find($id);
        return view('admin.blogcategory.edit', ['category'=>$post]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'img' => 'image|mimes:png,jpg,jpeg'
        ]);
        $updateData          = PostCategory::find($id);
        $updateData->title   = $request->title;
        $updateData->content = strip_tags($request->content);
        if($request->hasfile('img')){
            $desination = 'public/image/'.$updateData->img;
            if (File::exists($desination)) {
               File::delete($desination);
            }
            $file      = $request->file('img');
            $extension = $file->getClientOriginalExtension();
            $filename  = time().'.'.$extension;
            $file->move('public/image/', $filename);
            $updateData['img']= $filename;
        }
        $updateData->save();

        return redirect()->route('blog-categories')->with('status', 'Blog Category added succesfully!!');
        
    }

    // public function show()
    // {
    //     $data['users'] = User::orderBy('id','desc')->paginate(5);
    //     return view('admin.user.index',$data);
    // }
    public function categorydownloadPDF($id)
    {
        $show['categorydata'] = PostCategory::find($id);
        $pdf = PDF::loadView('admin.blogcategory.blogcategorypdf', $show);
        return $pdf->download('blogcategory.pdf');
    }
    public function destroy(Request $request, $id)
    {
        Storage::delete('public/image/' . $request->img);
        PostCategory::destroy($id);
        return redirect()->route('blog-categories')->with('status', 'Blog category Deleted succesfully!!');
    }
}
