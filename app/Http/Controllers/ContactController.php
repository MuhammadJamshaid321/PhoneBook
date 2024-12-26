<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;


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

    public function store(StoreContactRequest $request)
    {
        $contact = new Contact();
        $contact->fill($request->all());
    
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

    public function update(UpdateContactRequest $request, $id)
    {
        $contact = Contact::find($id); 
        $contact->fill($request->all());
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
