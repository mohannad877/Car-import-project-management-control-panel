<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string|max:1000',
        ]);

        \App\Models\Contact::create($validated);

        return redirect()->route('contact.create')->with('contact_success', 'شكراً لتواصلك معنا! سنرد عليك في أقرب وقت.');
    }
}
