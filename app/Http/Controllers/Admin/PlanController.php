<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
// use App\Models\User;
use Str;
use File;
// use PDF;
Use Storage;
use strip_tags;

class PlanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $data = Plan::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->where('price', 'LIKE', "%{$search}%")
            ->orWhere('descreption', 'LIKE', "%{$search}%")
            ->orderBy('id','desc')
            ->paginate(5);
        $countLength = Plan::query('id', $request->id)->get();
        $length = count($countLength);
        return view('admin.plan.index',['addplan'=>$data, 'arrayLength'=>$length]);
        
    }

    public function create()
    {
        return view('admin.plan.create');
    }

     public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'validity' => 'required',
            'descreption' => 'required'
        ]);

            $planAdd              = new Plan();
            $planAdd->name       = $request->name;
            $planAdd->price       = $request->price;
            $planAdd->validity       = $request->validity;
            $planAdd->descreption     = strip_tags($request->descreption);
            $planAdd->save();

            return redirect()->route('plan')->with('status', 'Plan added succesfully!!');

       
     }
    public function edit($id)
    {
        $plan = Plan::find($id);
        return view('admin.plan.edit', ['planedit'=>$plan]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'validity' => 'required',
            'descreption' => 'required'
        ]);

        $updateData             = Plan::find($id);
        $updateData->name       = $request->name;
        $updateData->price      = $request->price;
        $updateData->validity   = $request->validity;
        $updateData->descreption    = strip_tags($request->descreption);
        $updateData->save();
        return redirect()->route('plan')->with('status', 'Plan Update succesfully!!');
    }
    public function destroy($id)
    {
        Plan::destroy($id);
        return redirect()->route('plan')->with('status', 'Plan Deleted succesfully!!');
    }
}
