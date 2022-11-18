<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeachingPlan;
// use App\Models\User;
use Str;
use File;
// use PDF;
Use Storage;
use strip_tags;
class TeachingPlanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $data = TeachingPlan::query()
            ->where('days', 'LIKE', "%{$search}%")
            ->where('price', 'LIKE', "%{$search}%")
            ->orderBy('id','desc')
            ->paginate(5);
        $countLength = TeachingPlan::query('id', $request->id)->get();
        $length = count($countLength);
        return view('admin.teaching-plan.index',['teachingplan'=>$data, 'arrayLength'=>$length]);
        
    }

    public function create()
    {
        return view('admin.teaching-plan.create');
    }

     public function store(Request $request)
    {
        $request->validate([
        'minute' => 'required',
        'days' => 'required',
        ]);

        $teachplanAdd             = new TeachingPlan();
        $teachplanAdd->minute     = $request->minute;
        $teachplanAdd->days       = $request->days;
        $teachplanAdd->save();

        return redirect()->route('teaching-plan')->with('status', 'Teaching Plan added succesfully!!');

       
    }
    public function edit($id)
    {
        $teachplan = TeachingPlan::find($id);
        return view('admin.teaching-plan.edit', ['teachplanedit'=>$teachplan]);
    }
    public function update(Request $request, $id)
    {
        $updateData             = TeachingPlan::find($id);
        $updateData->minute       = $request->minute;
        $updateData->days       = $request->days;
       $updateData->save();
        return redirect()->route('teaching-plan')->with('status', 'Teaching Plan Update succesfully!!');
    }
    public function destroy($id)
    {
        TeachingPlan::destroy($id);
        return redirect()->route('teaching-plan')->with('status', 'Teaching Plan Deleted succesfully!!');
    }
}
