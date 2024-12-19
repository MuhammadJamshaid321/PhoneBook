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
        $contact = new Contact();
        $contact->name = $request->input('name');
        $contact->email = $request->input('email');
        $contact->phone = $request->input('phone');
        $contact->save(); 

        return redirect('/');
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
        $contact = Contact::find($id); 
        $contact->name = $request->input('name');
        $contact->email = $request->input('email');
        $contact->phone = $request->input('phone');
        $contact->save(); 

        return redirect('/');
    }

    public function destroy($id)
    {
        $contact = Contact::find($id); 
        $contact->delete();

        return redirect('/');
    }
}
