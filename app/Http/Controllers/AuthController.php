<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;


class AuthController extends Controller
{
    public function admin(){
        return view('admin');
    }

    // public function login(Request $request){
    //     $request->validate([
    //         'email' => 'required|string|max:255',
    //         'password' => 'required|string|min:8',
    //     ]);

    //     if(Auth::attempt($request->only('email','password'))){
    //         return redirect()->route('admin')->with('success','Login successful');
    //     }else{
    //         return redirect()->back()->with('error','Invalid credentials');
    //     }
    
    // }


    //////

    public function login(Request $request): RedirectResponse
{
    $request->validate([
        'email' => 'required|string|max:255',
        'password' => 'required|string|min:8',
    ]);

    if (Auth::attempt($request->only('email', 'password'))) {
        $request->session()->regenerate();

        $user = Auth::user();

        // Redirect based on user role
        if ($user->designation === 'Assistant Registrar') {
            return redirect()->route('ar.page');
        } elseif ($user->designation === 'Marshal') {
            return redirect()->route('marshall.page');
        }elseif ($user->designation === 'Proctor') {
            return redirect()->route('proctor.page');
        }elseif ($user->designation === 'Vice Chancellor') {
            return redirect()->route('vice_chancellor.page');
        }elseif ($user->designation === 'Administrator') {
            return redirect()->route('admin');
        } 
    }

    return redirect()->back()->with('error','Invalid credentials');
}









    /////

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
