<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Show register
    public function create(){
        return view('users.register');
    }

    // Store new user
    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => ['required', 'min:6'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6'] //checks for password_confirmation
        ]);
        
        // Hash password
        $formFields['password'] = bcrypt($formFields['password']);

        // Create the user
        $user = User::create($formFields);

        // Login
        auth()->login($user);

        return redirect('/');
    }

    // Logout user
    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    // Login user
    public function login(){
        return view('users.login');
    }

    // Authenticate user
    public function authenticate(Request $request){
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }
}
