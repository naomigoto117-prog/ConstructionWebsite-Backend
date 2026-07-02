<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'nullable',
            'service' => 'nullable',
            'message' => 'required'
        ]);

        Mail::raw(
            "Name: ".$request->name."\n".
            "Email: ".$request->email."\n".
            "Phone: ".$request->phone."\n".
            "Service: ".$request->service."\n\n".
            "Message:\n".$request->message,

            function($mail) use ($request){

                $mail->to("naomi.goto117@gmail.com")
                     ->subject("New Contact Form")
                     ->replyTo($request->email);

            }

        );

        return response()->json([
            "success"=>true,
            "message"=>"Email sent successfully."
        ]);

    }
}