<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactDetails;
use App\Models\SocialLinks;

class ContactDetailsController extends Controller
{
    //
    public function save_contact_details(Request $request){
        $request->validate([
            'address' => 'required|max:208',
            'phone' => 'required|max:48',
            'email' => 'required|max:148|email',
            'get_in_touch_text' => 'required|max:548',
        ]);
        $contactDetails = ContactDetails::where('id', 1)->first();

        $contactDetails->address = $request->address;
        $contactDetails->phone = $request->phone;
        $contactDetails->email = $request->email;
        $contactDetails->get_in_touch_text = $request->get_in_touch_text;

        $contactDetails->save();

        return redirect()->back()->with('success','Info Updated');
    }

    public function update_social(Request $request){
        $request->validate([
            'name' => 'required|max:20',
            'link' => 'required|max:148',
            'status' => 'required|max:148',
        ]);

        $update = SocialLinks::where('name', $request->name)->first();

        $update->link = $request->link;
        $update->status = $request->status;
        $update->save();

        return redirect()->back()->with('success','Info Updated');
    }
}
