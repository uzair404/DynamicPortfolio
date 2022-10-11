<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\nav_section;
use Illuminate\Support\Facades\Validator;


class NavController extends Controller
{
    //
    
    public function navbar_heading(request $request){
        $request->validate([
            'fav_icon' => 'mimes:jpeg,gif,png,webp,jpg|max:4048',
            'top_heading' => 'required|max:48',
        ]);
        $nav_section = nav_section::where('id',1)->first();
        if($request->fav_icon){
            $file_name = time().'fav_icon.'.$request->fav_icon->getClientOriginalExtension();
            $request->fav_icon->move(public_path('uploads/herosection'), $file_name);
            $nav_section->fav_icon = $file_name;
        }
        
        $nav_section->heading = $request->top_heading;
        $nav_section->save();  
   
        return redirect()->back()
            ->with('success','Info Updated');
    }

    
    public function add_nav(request $request){
        // return $request->all();
        $validator = Validator::make($request->all(), [
            'display' => 'required',
            'order' => 'required|integer',
            'link' => 'required',
        ]);

        if ($validator->passes()){
            $nav_count = count(nav_section::all());
            if ($nav_count<7) {
                $nav_section = new nav_section();
                $nav_section->order = $request->order;
                $nav_section->heading = $request->display;
                $nav_section->link = $request->link;
                $nav_section->save();
            }else{
                return response()->json(['status'=>'fail','error'=>'you cannot make more than 6 nav links']);
            }

        $nav_section = nav_section::orderby('order', 'ASC')->paginate(7);
        $elem = '';
        foreach ($nav_section as $nav) {
            $elem .= '<div class="input-group mb-3"><span class="input-group-text dark">Order</span><input disabled id="order" type="text" value="'.$nav->order.'" class="form-control"><span class="input-group-text dark">display</span><input disabled type="text" value="'.$nav->heading.'" class="form-control"><span class="input-group-text dark">link</span><input type="text" disabled id="link" value="'.$nav->link.'" class="form-control"><button onclick="delete_nav(this.id)" class="btn btn-outline-secondary" type="button" id="'.$nav->id.'">remove</button></div>';
        }

        return response()->json(['status'=>'success','msg'=>'navlink added', 'elem'=>$elem]);
        }


        return response()->json(['status'=>'fail','error'=>$validator->errors()->all()]);

    }
    
    public function delete_nav(request $request){
        // return $request->all();
        $validator = Validator::make($request->all(), [
            'nav_id' => 'required',
        ]);

        if ($validator->passes()){

        $query = nav_section::where('id', $request->nav_id)->delete();

        $nav_section = nav_section::orderby('order', 'ASC')->paginate(7);
        $elem = '';
        foreach ($nav_section as $nav) {
            $elem .= '<div class="input-group mb-3"><span class="input-group-text dark">Order</span><input disabled id="order" type="text" value="'.$nav->order.'" class="form-control"><span class="input-group-text dark">display</span><input disabled type="text" value="'.$nav->heading.'" class="form-control"><span class="input-group-text dark">link</span><input type="text" disabled id="link" value="'.$nav->link.'" class="form-control"><button class="btn btn-outline-secondary" onclick="delete_nav(this.id)" type="button" id="'.$nav->id.'">remove</button></div>';
        }

        return response()->json(['status'=>'success','msg'=>'nav link deleted', 'elem'=>$elem, 'query'=>$query]);
        }


        return response()->json(['status'=>'fail','error'=>$validator->errors()->all()]);

    }
    
}
