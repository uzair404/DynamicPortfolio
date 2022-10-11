<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    //
    public function contact(Request $request){
        $request->validate([
            'name' => 'required|max:48',
            'email' => 'required|email|max:148',
            'subject' => 'required|max:88',
            'message' => 'required|max:3000',
        ]);
        
        $name = $request->name;
        $email = $request->email;
        $subject = $request->subject;
        $message = $request->message;

        $data = array(
            'names'=>$name,
            'emails'=>$email,
            'subjects'=>$subject,
            'messages'=>$message,
            );
   
        Mail::send('mails.mail', $data, function($message) use ($data) {
           $message->to($data['emails'], 'Contact')->subject
              ($data['subjects']);
           $message->from('admin@createmyprotfolio.com','Dynamic Protfolio');
        });
        Mail::send(['text'=>'mails.admin'], $data, function($message) use ($data) {
           $message->to('admin@createmyprotfolio.com', 'Contact')->subject
              ('You have Received a Message On Dynamic Protfolio');
           $message->from('admin@createmyprotfolio.com','Dynamic Protfolio');
        });
        // echo "Message Sent";
        return redirect()->back()->with('success','Message Successfully Sent');
    }
}
