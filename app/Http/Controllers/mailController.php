<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\feedback;
use App\Models\contact;


class mailController extends Controller
{
    public function sendMail(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ]);

        contact::create($validated);

        Mail::to('vagheladevang123@gmail.com')->queue(new feedback($validated));

        return back()->with('success','Thank You For Messaging');
    }
}
