<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Facades\ContactRepositoryFacade;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller 
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $search = $request->query('search');
    
        if ($user->hasRole('admin') || $user->hasRole('superadmin')) {
            // Admins and Superadmins can view all contacts
            $contacts = $search 
                ? ContactRepositoryFacade::search($search) 
                : ContactRepositoryFacade::getAllContacts();
        } else {
            // Regular users can only view their own contacts
            $contacts = $search 
                ? ContactRepositoryFacade::searchUserContacts($user->id, $search) 
                : ContactRepositoryFacade::getUserContacts($user->id, 5);
        }
    
        return view('contacts.index', ['contacts' => $contacts]);
    }


    public function create()
    {
        return view('contacts.create');
    }

    public function store(StoreContactRequest $request)
    {
        if(Auth::check()) {
            $request->merge(['user_id' => Auth::user()->id]);
        }
        ContactRepositoryFacade::createContact($request->all());
        return redirect()->route('contacts.index')->with('success', 'Contact Added successfully.');
    }

    public function show($id)
{
    $user = Auth::user();
    $contact = ContactRepositoryFacade::findContactById($id);

    if ($user->hasRole('admin') || $user->hasRole('superadmin') || $contact->user_id == $user->id) {
        return view('contacts.show', ['contact' => $contact]);
    } else {
        abort(403, 'Unauthorized action.');
    }
}


    public function edit($id)
    {
        $contact = ContactRepositoryFacade::findContactById($id);
        return view('contacts.edit', ['contact' => $contact]);
    }

    public function update(UpdateContactRequest $request, $id)
    {
        ContactRepositoryFacade::updateContact($id, $request->all());
        return redirect()->route('contacts.index')->with('update', 'Contact updated successfully.');
    }

    public function destroy($id)
    {
        ContactRepositoryFacade::deleteContact($id);
        return redirect()->route('contacts.index')->with('delete', 'Contact deleted successfully.');
    }
}