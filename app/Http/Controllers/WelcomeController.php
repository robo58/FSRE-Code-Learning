<?php

namespace App\Http\Controllers;


use App\Mail\ContactUsMail;
use Illuminate\Support\Facades\Mail;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        // Send an email

        Mail::to('branimir.raguz@students.fsre.ba', 'robert.sliskovic@student.fsre.ba')->send(new ContactUsMail($data));

        return redirect('welcome');
    }
}
