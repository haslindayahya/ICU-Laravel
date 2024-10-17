<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signup()
    {
        return view('pages.auth.signup');
    }

    public function signin()
    {
        return view('pages.auth.signin');
    }

    public function storeUser(Request $request)
    {

        $validated_request=$request->validate([
            'name'=>'required',
            'email'=>'required | email',
            'password'=>'required | min:6',
        ]);

        $user = User::where('email',$request->email)->first();
        if($user){
            return back()->withErrors([
                'email'=> 'The provided email is already registered',
            ])->withInput();

        }

        // User::create($validated_request);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('auth.signin');

    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {

            
            $request->session()->regenerate();
 
            return redirect()->intended('feeds');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function signOut(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect()->route('auth.signin');
    }





}
