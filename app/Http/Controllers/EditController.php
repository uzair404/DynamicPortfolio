<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Models\hero_section;
use App\Models\about_section;
use App\Models\nav_section;
use App\Models\sections;
use App\Models\skill;
use App\Models\ContactDetails;
use App\Models\SocialLinks;
use App\Models\Services;
use App\Models\Work;
use App\Models\views;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;


class EditController extends Controller
{
    //
    public function index(views $views, Request $request){
        $data['services'] = Services::all();
        $data['works'] = Work::all();
        $data['sections'] = sections::all();
        $data['nav_heading'] = nav_section::where('id',1)->first();
        $data['nav_section'] = nav_section::orderby('order', 'ASC')->paginate(7);
        $data['hero_section'] = hero_section::where('id',1)->first();
        $data['about_section'] = about_section::where('id',1)->first();
        $data['contact_section'] = ContactDetails::where('id',1)->first();
        $data['social_links'] = SocialLinks::paginate(4);
        $data['skills'] = skill::paginate();

    if(! Auth::check()){//guest user identified by ip
        $cookie_name = (Str::replace('.','',($request->ip())).'-'. $views->id);
    } else {
        
        $cookie_name = (Auth::user()->id.'-'. $views->id);//logged in user
    }
    if(Cookie::get($cookie_name) == ''){//check if cookie is set
            $minutes = 60;
            Cookie::queue(Cookie::make($cookie_name, '1', $minutes));
            $views->incrementviewCount(); //count the view
            return view('index', $data); //store the cookie
        } else {
            return view('index', $data);//this view is not counted
        }
    }
    public function edit(){
        $data['services'] = Services::all();
        $data['works'] = Work::all();
        $data['views'] = views::where('id','1')->first();
        $data['sections'] = sections::all();
        $data['nav_heading'] = nav_section::where('id',1)->first();
        $data['nav_section'] = nav_section::orderby('order', 'ASC')->paginate(7);
        $data['hero_section'] = hero_section::where('id',1)->first();
        $data['about_section'] = about_section::where('id',1)->first();
        $data['contact_section'] = ContactDetails::where('id',1)->first();
        $data['social_links'] = SocialLinks::paginate(4);
        $data['skills'] = skill::paginate();
        return view('edit', $data);
    }

    public function save_hero(request $request){
        $request->validate([
            'hero_image' => 'mimes:jpeg,gif,png,webp,jpg|max:2048',
            'main_heading' => 'required|max:48',
            'sub_heading' => 'required|max:148',
        ]);
        $hero_section = hero_section::where('id',1)->first();
        if($request->hero_image){
            $file_name = time().'hero_image.'.$request->hero_image->getClientOriginalExtension();
            $request->hero_image->move(public_path('uploads/herosection'), $file_name);
            $hero_section->file = $file_name;
        }
        
        $hero_section->heading = $request->main_heading;
        $hero_section->sub_heading = $request->sub_heading;
        $hero_section->save();
        
   
        return redirect()->back()
            ->with('success','Info Updated');
    }
    
}
