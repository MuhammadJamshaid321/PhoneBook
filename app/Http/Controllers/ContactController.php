<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Repositories\ContactRepository;

class ContactController extends Controller
{
    protected $contactRepository;

    public function __construct()
    {
        $this->contactRepository = ContactRepository::getInstance();
    }

    public function index()
    {
        $contacts = $this->contactRepository->getAllContacts();
        return view('contacts.index', ['contacts' => $contacts]);
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function store(StoreContactRequest $request)
    {
        $this->contactRepository->createContact($request->all());
        return redirect()->route('contacts.index')->with('success', 'Contact Added successfully.');
    }

    public function show($id)
    {
        $contact = $this->contactRepository->findContactById($id);
        return view('contacts.show', ['contact' => $contact]);
    }

    public function edit($id)
    {
        $contact = $this->contactRepository->findContactById($id);
        return view('contacts.edit', ['contact' => $contact]);
    }

    public function update(UpdateContactRequest $request, $id)
    {
        $this->contactRepository->updateContact($id, $request->all());
        return redirect()->route('contacts.index')->with('update', 'Contact updated successfully.');
    }

    public function destroy($id)
    {
        $this->contactRepository->deleteContact($id);
        return redirect()->route('contacts.index')->with('delete', 'Contact deleted successfully.');
    }
}
