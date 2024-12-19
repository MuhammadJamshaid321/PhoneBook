<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all(); 
        return view('contacts.index', ['contacts' => $contacts]);
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:15',
            'email' => 'required|email',
            'phone' => 'required|string|max:11',
        ],[

            'name.required' => 'Name field is Required',
            'email.required' => 'Email field is Required',
            'phone.required' => 'Phone field is Required',
            
            
         ]);
          

        $contact = new Contact();
        $contact->name = $request->input('name');
        $contact->email = $request->input('email');
        $contact->phone = $request->input('phone');
        $contact->save(); 

        return redirect()->route('contacts.index')->with('success', 'Contact Added successfully.');
    }

    public function show($id)
    {
        $contact = Contact::find($id); 
        return view('contacts.show', ['contact' => $contact]);
    }

    public function edit($id)
    {
        $contact = Contact::find($id); 
        return view('contacts.edit', ['contact' => $contact]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:15',
            'email' => 'required|email',
            'phone' => 'required|string|max:11',
        ],[

            'name.required' => 'Name field is Required',
            'email.required' => 'Email field is Required',
            'phone.required' => 'Phone field is Required',
            'name.string' => 'Please enter valid name max lenght could be 15.',
            'email.email' => 'Please enter valid email address.',
            'phone.string' => 'Please valid phone number.',
        ]
    );

        $contact = Contact::find($id); 
        $contact->name = $request->input('name');
        $contact->email = $request->input('email');
        $contact->phone = $request->input('phone');
        $contact->save(); 

        return redirect()->route('contacts.index')->with('update', 'Contact updated successfully.');
    }

    public function destroy($id)
    {
        $contact = Contact::find($id); 
        $contact->delete();

        return redirect()->route('contacts.index')->with('delete', 'Contact deleted successfully.');
    }
}
