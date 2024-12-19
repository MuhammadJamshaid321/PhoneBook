<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContactController;

Route::controller(ContactController::class)->group(function () {
    Route::get('/contacts', 'index')->name('contacts.index');
    Route::get('/contact/create', 'create')->name('contacts.create');
    Route::post('/contact', 'store')->name('contacts.store');
    Route::get('/contact/{id}/edit', 'edit')->name('contacts.edit');
    Route::put('/contact/{id}', 'update')->name('contacts.update');
    Route::delete('/contact/{id}', 'destroy')->name('contacts.destroy');
    Route::get('/contact/{id}', 'show')->name('contacts.show');
});
