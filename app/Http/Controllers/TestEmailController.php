<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TestEmailController extends Controller
{
    public function create()
    {
        // Replace with your email creation logic.
        $details = [
            'title' => 'Test Email from Laravel',
            'body' => 'This is a test email generated for testing purposes.'
        ];

        Mail::to('devanshu.briskbrain@gmail.com')->send(new \App\Mail\TestEmail($details));

        return response()->json(['message' => 'Test email has been sent.']);
    }
}
