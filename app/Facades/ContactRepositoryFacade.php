<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
use App\Models\Contact;


class ContactRepositoryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Repositories\ContactRepository::class;
    }
    public static function getUserContacts($userId, $pagination = 5)
{
    return Contact::where('user_id', $userId)->paginate($pagination);
}

}
