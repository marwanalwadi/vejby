<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function contact()
    {
        return "test";
    }
    public function contactSubmit(Request $request)
    {
        Mail::send('emails.contactmail', [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'msg' => $request->msg
        ], function ($mail) use ($request) {
            $mail->from(env('MAIL_FROM_ADDRESS'), $request->name);
            $mail->to('vejbyresturang@gmail.com')->subject('Contact us message');
        });
        return 'message sent successfully';
    }
}