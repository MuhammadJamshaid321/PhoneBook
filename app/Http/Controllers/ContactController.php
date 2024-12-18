<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    
    public function index()
    {
        $contacts = DB::table('contacts')->get();
        return view('contacts.index', ['contacts' => $contacts]);
    }

   
    public function create()
    {
        return view('contacts.create');
    }


    public function store()
    {
        
        DB::table('contacts')->insert([
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'phone' =>$_POST['phone'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/');
    }

    
    public function show($id)
    {
        $contact = DB::table('contacts')->where('id', $id)->first();
        return view('contacts.show', ['contact' => $contact]);
    }

    
    public function edit($id)
    {
        
        $contact = DB::table('contacts')->where('id', $id)->first();
        return view('contacts.edit', ['contact' => $contact]);
    }

   
    public function update(Request $request, $id)
    {
    
        DB::table('contacts')->where('id', $id)->update([
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'updated_at' => now(),
        ]);

        return redirect('/');
    }

    
    public function destroy($id)
    {
        
        DB::table('contacts')->where('id', $id)->delete();
        return redirect('/');
    }
}
