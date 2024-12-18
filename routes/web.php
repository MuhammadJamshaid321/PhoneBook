<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContactController;

Route::controller(ContactController::class)->group(function () {
    Route::get('/', 'index')->name('contacts.index');
    Route::get('/contacts/create', 'create')->name('contacts.create');
    Route::post('/contacts', 'store')->name('contacts.store');
    Route::get('/contacts/{id}/edit', 'edit')->name('contacts.edit');
    Route::put('/contacts/{id}', 'update')->name('contacts.update');
    Route::delete('/contacts/{id}', 'destroy')->name('contacts.destroy');
    Route::get('/contacts/{id}', 'show')->name('contacts.show');
});
