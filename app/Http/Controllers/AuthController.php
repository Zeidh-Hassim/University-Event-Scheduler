<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        if(Auth::attempt($request->only('email','password'))){
            return redirect()->route('admin')->with('success','Login successful');
        }
    
    }

    public function loginpage(){
        return view('auth.login');
    }
}
