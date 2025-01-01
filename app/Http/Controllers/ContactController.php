<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Facades\ContactRepositoryFacade;
// use Illuminate\Routing\Controllers\HasMiddleware;
// use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;


class ContactController extends Controller //implements HasMiddleware
{
    // public static function middleware(): array
    // {
    //     return [
    //         new Middleware ('permission:view contacts', only: ['index']),
    //         new Middleware ('permission:edit contacts', only: ['edit']),
    //         new Middleware ('permission:create contacts', only: ['create']),
    //         new Middleware ('permission:delete contacts', only: ['destroy']),
    //     ];
    // }

    public function index()
{
    $user = Auth::user();

    if ($user->hasRole('admin') || $user->hasRole('superadmin')) {
        // Admins and Superadmins can view all contacts
        $contacts = ContactRepositoryFacade::getAllContacts(5);
    } else {
        // Regular users can only view their own contacts
        $contacts = ContactRepositoryFacade::getUserContacts($user->id, 5);
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