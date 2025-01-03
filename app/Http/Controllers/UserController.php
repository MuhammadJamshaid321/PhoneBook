<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller 
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(5);
        return view('users.list',[
            'users' => $users

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::orderBy('name','ASC')->get(); 
        return view('users.create',[
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $validator = Validator::make($request->all(),[
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:5|same:confirm_password',
        'confirm_password' => 'required'

       ]);
       if ($validator->fails()) {
          return redirect()->route('users.create')->withInput()->withErrors($validator);
       } 
       $user = new User();
       $user->name = $request->name;
       $user->email = $request->email;
       $user->password = Hash::make($request->email);
       $user->save();

       $user->syncRoles($request->role);
       return redirect()->route('users.index')->with('success','User Added successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $roles = Role::orderBy('name','ASC')->get(); 

        $hasRoles = $user->roles->pluck('id');
        return view('users.edit',[
            'user' => $user,
            'roles' => $roles,
            'hasRoles' => $hasRoles
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
       $validator = Validator::make($request->all(),[
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users,email,'.$id.',id'
       ]);
       if ($validator->fails()) {
          return redirect()->route('users.edit', $id)->withInput()->withErrors($validator);
       } 

       $user->name = $request->name;
       $user->email = $request->email;
       $user->save();

       $user->syncRoles($request->role);
       return redirect()->route('users.index')->with('success','User updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = User::find($request->id);
        if ($user == null) {
            session()->flash('error','User not found');
            return response()->json([
                'status' => false
            ]);
        }
        $user->delete();

        session()->flash('success','User deleted successully.');
        return response()->json([
            'status' => true
        ]);
    }
}
