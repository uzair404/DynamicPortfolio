<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;
use Illuminate\Support\Facades\File;

class WorkController extends Controller
{
    //
    public function save_work(request $request){
        $request->validate([
            'file' => 'required|max:4048',
            'heading' => 'required|max:100',
            'link' => 'required|max:504',
            'category' => 'required|max:504',
            'date' => 'required|max:504',
        ]);
        
        $work_section = new Work();

        if($request->file){
            $file_name = time().'work_image.'.$request->file->getClientOriginalExtension();
            $request->file->move(public_path('uploads/herosection'), $file_name);
            $work_section->file = $file_name;
        }

        $work_section->heading = $request->heading;
        $work_section->category = $request->category;
        $work_section->link = $request->link;
        $work_section->date = $request->date;
        $work_section->save();
        
   
        return redirect()->back()
            ->with('success','Work created');
    }
    //
    public function edit_work(request $request){
        $request->validate([
            'id' => 'required',
            'heading' => 'required|max:100',
            'link' => 'required|max:504',
            'category' => 'required|max:504',
            'date' => 'required|max:504',
        ]);
        $id = $request->id;
        $work_section = Work::where('id', $id)->first();

        
        if($request->file){
            if (File::exists(public_path('uploads/herosection/'.$work_section->file))) {
                File::delete(public_path('uploads/herosection/'.$work_section->file));
            }
            $file_name = time().'work_image.'.$request->file->getClientOriginalExtension();
            $request->file->move(public_path('uploads/herosection'), $file_name);
            $work_section->file = $file_name;
        }

        $work_section->heading = $request->heading;
        $work_section->category = $request->category;
        $work_section->link = $request->link;
        $work_section->date = $request->date;
        $work_section->save();
        
   
        return redirect()->back()
            ->with('success','Info Updated');
    }
    //
    public function delete_work($id){
        $work_section = Work::where('id', $id)->first();
        if (File::exists(public_path('uploads/herosection/'.$work_section->file))) {
            File::delete(public_path('uploads/herosection/'.$work_section->file));
        }
        Work::where('id', $id)->delete();
    
        return redirect()->back()
            ->with('success','Work deleted');
    }
}
