<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo ;

    protected function authenticated(Request $request, $user)
    {
        // Check if user has no role assigned
        if (!$user->roles()->exists()) {
            // Assign default role
            $defaultRole = 'user'; // Define your default role
            $role = Role::firstOrCreate(['name' => $defaultRole]);
            $user->assignRole($role);
        }

        return redirect()->intended('/home');
    }


    public function logout(Request $request)
    {
       Auth::logout();
       return redirect('/login'); // Redirects to login after logout
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
        $this->redirectTo = route('dashboard.home');
    }
}
