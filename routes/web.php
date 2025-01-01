<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

Auth::routes();

Route::middleware(['auth'])->group(function () {
    // Contacts Routes
    Route::middleware(['can:view contacts'])->group(function () {
        Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
        Route::get('/contact/{id}', [ContactController::class, 'show'])->name('contacts.show');
    });
    Route::middleware(['can:create contacts'])->group(function () {
        Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');
        Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
    });
    Route::middleware(['can:edit contacts'])->group(function () {
        Route::get('/contacts/{id}/edit', [ContactController::class, 'edit'])->name('contacts.edit');
        Route::put('/contacts/{id}', [ContactController::class, 'update'])->name('contacts.update');
    });
    Route::middleware(['can:delete contacts'])->group(function () {
        Route::delete('/contact/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');
    });

    // Permissions Routes
    Route::middleware(['can:view permissions'])->group(function () {
        Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    });
    Route::middleware(['can:create permissions'])->group(function () {
        Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
        Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
    });
    Route::middleware(['can:edit permissions'])->group(function () {
        Route::get('/permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
        Route::post('/permissions/{id}', [PermissionController::class, 'update'])->name('permissions.update');
    });
    Route::middleware(['can:delete permissions'])->group(function () {
        Route::delete('/permissions', [PermissionController::class, 'destroy'])->name('permissions.destroy');
    });

    // Roles Routes
    Route::middleware(['can:view roles'])->group(function () {
        Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    });
    Route::middleware(['can:create roles'])->group(function () {
        Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
        Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    });
    Route::middleware(['can:edit roles'])->group(function () {
        Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
        Route::post('/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
    });
    Route::middleware(['can:delete roles'])->group(function () {
        Route::delete('/roles', [RoleController::class, 'destroy'])->name('roles.destroy');
    });

    // Users Routes
    Route::middleware(['can:view users'])->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
    });
    Route::middleware(['can:create users'])->group(function () {
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
    });
    Route::middleware(['can:edit users'])->group(function () {
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::post('/users/{id}', [UserController::class, 'update'])->name('users.update');
    });
    Route::middleware(['can:delete users'])->group(function () {
        Route::delete('/users', [UserController::class, 'destroy'])->name('users.destroy');
    });

    // Home Route
    Route::view('/home', 'home')->name('dashboard.home');
});
