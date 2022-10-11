<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\skill;
use App\Models\about_section;
use Illuminate\Support\Facades\Validator;

class AboutController extends Controller
{
    //
    
    public function add_skill(request $request){
        // return $request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'percent' => 'required|integer|max:100',
        ]);

        if ($validator->passes()){
            $section = new skill();
            $section->name = $request->name;
            $section->percent = $request->percent;
            $section->save();

        $skill_section = skill::paginate();
        $elem = '';
        foreach ($skill_section as $skill) {
            $elem .= '<div class="input-group mb-3"><span class="input-group-text dark">Name</span><input disabled type="text" value="'.$skill->name.'" class="form-control"><span class="input-group-text dark">Percent</span><input type="text" disabled id="link" value="'.$skill->percent.'" class="form-control"><button onclick="delete_skill(this.id)" class="btn btn-outline-secondary" type="button" id="'.$skill->id.'">remove</button></div>';
        }
    

        return response()->json(['status'=>'success','msg'=>'skill added', 'elem'=>$elem]);
        }


        return response()->json(['status'=>'fail','error'=>$validator->errors()->all()]);

    }

    public function delete_skill(request $request){
        // return $request->all();
        $validator = Validator::make($request->all(), [
            'skill_id' => 'required',
        ]);

        if ($validator->passes()){

        $query = skill::where('id', $request->skill_id)->delete();

        $skill_section = skill::paginate();
        $elem = '';
        foreach ($skill_section as $skill) {
            $elem .= '<div class="input-group mb-3"><span class="input-group-text dark">Name</span><input disabled type="text" value="'.$skill->name.'" class="form-control"><span class="input-group-text dark">Percent</span><input type="text" disabled id="link" value="'.$skill->percent.'" class="form-control"><button onclick="delete_skill(this.id)" class="btn btn-outline-secondary" type="button" id="'.$skill->id.'">remove</button></div>';
        }

        return response()->json(['status'=>'success','msg'=>'skill deleted', 'elem'=>$elem, 'query'=>$query]);
        }


        return response()->json(['status'=>'fail','error'=>$validator->errors()->all()]);

    }

    public function save_about(request $request){
        $request->validate([
            'about_image' => 'mimes:jpeg,gif,png,webp,jpg|max:2048',
            'name' => 'required|max:48',
            'profile' => 'required|max:48',
            'email' => 'required|max:48',
            'phone' => 'required|max:48',
            'about_me' => 'required',
        ]);
        $about_section = about_section::where('id',1)->first();
        if($request->about_image){
            $file_name = time().'about_image.'.$request->about_image->getClientOriginalExtension();
            $request->about_image->move(public_path('uploads/aboutsection'), $file_name);
            $about_section->about_file = $file_name;
        }
        
        $about_section->name = $request->name;
        $about_section->profile = $request->profile;
        $about_section->email = $request->email;
        $about_section->phone = $request->phone;
        $about_section->about_me = $request->about_me;
        $about_section->save();
        
   
        return redirect()->back()
            ->with('success','Info Updated');
    }

}
