<?php

namespace App\Repositories;

use App\Models\Contact;

class ContactRepository
{
    private static $instance = null;

    // Private constructor
    private function __construct() {}

    // Prevent cloning
    private function __clone() {
        throw new \Exception("Cloning is not allowed for Singleton instances.");
    }

    // Get the Singleton instance
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

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
