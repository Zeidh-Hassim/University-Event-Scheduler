<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\TestMail;

class MailController extends Controller
{
    /**
     * Show the form for sending a test email.
     */
    public function index()
    {
        Mail::to('zeidhcamp@gmail.com')->send(new TestMail());
        dd('Test email sent successfully!');
    }

    /**
     * Send a test email.
     */
    public function sendTestEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        Mail::to($request->input('email'))->send(new \App\Mail\TestMail());

        return redirect()->back()->with('success', 'Test email sent successfully!');
    }
}
