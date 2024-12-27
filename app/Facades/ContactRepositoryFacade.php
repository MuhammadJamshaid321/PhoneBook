<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ContactRepositoryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Repositories\ContactRepository::class;
    }
}
