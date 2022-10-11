<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Services;

class ServicesController extends Controller
{
    //
    public function save_services(request $request){
        $request->validate([
            'icon' => 'max:2048',
            'heading' => 'required|max:68',
            'text' => 'required|max:68',
        ]);
        
        $services_section = new Services();

        $services_section->icon = $request->icon;
        $services_section->heading = $request->heading;
        $services_section->text = $request->text;
        $services_section->save();
        
   
        return redirect()->back()
            ->with('success','Service created');
    }
    //
    public function edit_service(request $request){
        $request->validate([
            'id' => 'required',
            'icon' => 'max:2048|required',
            'heading' => 'required|max:68',
            'text' => 'required|max:68',
        ]);
        $id = $request->id;
        $services_section = Services::where('id', $id)->first();

        $services_section->icon = $request->icon;
        $services_section->heading = $request->heading;
        $services_section->text = $request->text;
        $services_section->save();
        
   
        return redirect()->back()
            ->with('success','Info Updated');
    }
    //
    public function delete_service($id){
        Services::where('id', $id)->delete();
    
        return redirect()->back()
            ->with('success','Service deleted');
    }
}
