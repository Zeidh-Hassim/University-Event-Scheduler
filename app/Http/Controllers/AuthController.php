<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function admin(){
        return view('admin');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        if(Auth::attempt($request->only('email','password'))){
            return redirect()->route('admin')->with('success','Login successful');
        }else{
            return redirect()->back()->with('error','Invalid credentials');
        }
    
    }

    public function loginpage(){
        return view('auth.login');
    }

    public function signpage(){
        return view('auth.sign');
    }

    public function sign(Request $request){
        $request->validate([
            'designation' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        //create user
        User::create([
            'designation' => $request->designation,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('loginpage')->with('success','User created successfully');
    }

        public function pendingEvents()
    {
        $pendingEvents = Event::where('status', 'pending')->get();
        return view('admin', compact('pendingEvents'));
    }

    public function accept($id)
{
    $event = Event::findOrFail($id);
    $event->status = 'accepted';
    $event->save();

    return redirect()->route('admin')->with('success', 'Event accepted.');
}

public function reject($id)
{
    $event = Event::findOrFail($id);
    $event->status = 'rejected';
    $event->save();

    return redirect()->route('admin')->with('success', 'Event rejected.');
}


}
