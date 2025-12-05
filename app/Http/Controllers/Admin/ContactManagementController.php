<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactManagementController extends Controller
{
    public function index()
    {
        $contacts = \App\Models\Contact::latest()->paginate(20);
        return view('admin.contacts.index', compact('contacts'));
    }

    public function read($id)
    {
        $contact = \App\Models\Contact::findOrFail($id);
        $contact->update(['is_read' => true]);
        return redirect()->back()->with('success', 'تم تحديث حالة الرسالة');
    }
}
