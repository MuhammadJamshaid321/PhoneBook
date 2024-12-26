<?php

namespace App\Repositories;

use App\Models\Contact;

class ContactRepository
{
    public function getAllContacts()
    {
        return Contact::all();
    }

    public function findContactById($id)
    {
        return Contact::find($id);
    }

    public function createContact(array $data)
    {
        $contact = new Contact();
        $contact->fill($data);
        $contact->save();
        return $contact;
    }

    public function updateContact($id, array $data)
    {
        $contact = Contact::find($id);
        $contact->fill($data);
        $contact->save();
        return $contact;
    }

    public function deleteContact($id)
    {
        $contact = Contact::find($id);
        $contact->delete();
    }
}
