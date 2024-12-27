<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Facades\ContactRepositoryFacade;

class ContactController extends Controller
{
<<<<<<< HEAD
    protected $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

=======
>>>>>>> 3d6ff3b (Facades Pattern and Pagination Added)
    public function index()
    {
        $contacts = ContactRepositoryFacade::getAllContacts(5);
        return view('contacts.index', ['contacts' => $contacts]);
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function store(StoreContactRequest $request)
    {
        ContactRepositoryFacade::createContact($request->all());
        return redirect()->route('contacts.index')->with('success', 'Contact Added successfully.');
    }

    public function show($id)
    {
        $contact = ContactRepositoryFacade::findContactById($id);
        return view('contacts.show', ['contact' => $contact]);
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