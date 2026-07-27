<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ContactStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\CreateContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact()
    {
        return view('home.contact');
    }


    public function store(CreateContactRequest $request)
    {
        Contact::storeContact($request);
        return redirect()->route('home')->with('success', __('messages.contact.created'));
    }


    // admin
    public function index()
    {
        $title = "لیست تماس با ما";
        $contacts = Contact::getAllContact();
        return view('admin.contact.contacts',compact('contacts','title'));
    }

    public function  read(Request $request, string $id)
    {
        $contact = Contact::getContact($id);
        $contact->update([
            'status' => ContactStatus::read->value,
        ]);

        return redirect()->back()->with('success', __('messages.contact.read'));
    }
}
