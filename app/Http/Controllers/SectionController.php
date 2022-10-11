<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\sections;
use Illuminate\Support\Facades\Validator;


class SectionController extends Controller
{
    //
    public function manage_section(request $request){
        $ids = $request->id;
        foreach($ids as $index=>$id){  
            $section = sections::where('id', $id)->first();
            // $section->name = $request->name;
            $section->status = $request->status[$index];
            $section->save();     
        }
        return redirect()->back()->with('success','Info Updated');
    }
    
    public function add_section(request $request){
        // return $request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required|integer',
        ]);

        if ($validator->passes()){
            $section = new sections();
            $section->name = $request->name;
            $section->status = $request->status;
            $section->save();

        return response()->json(['status'=>'success','msg'=>'section added']);
        }


        return response()->json(['status'=>'fail','error'=>$validator->errors()->all()]);

    }
}
