<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Event;
use App\Models\Faculty;
use App\Models\Venue;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function admin()
    {
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
                return redirect()->route('ar.pending.requests');
            } elseif ($user->designation === 'Marshal') {
                return redirect()->route('marshall.pending.requests');
            } elseif ($user->designation === 'Proctor') {
                return redirect()->route('proctor.pending.requests');
            } elseif ($user->designation === 'Vice Chancellor') {
                return redirect()->route('vice_chancellor.pending.requests');
            } elseif ($user->designation === 'Administrator') {
                return redirect()->route('admin');
            } 
        }

        return redirect()->back()->with('error', 'Invalid credentials');
    }

    /////

    public function loginpage()
    {
        return view('auth.login');
    }

    public function signpage()
    {
        return view('auth.sign');
    }

    public function sign(Request $request)
    {
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

        return redirect()->route('loginpage')->with('success', 'User created successfully');
    }

    // public function pendingEvents()
    // {
    //     $pendingEvents = Event::where('status', 'pending')->get();
    //     return view('admin', compact('pendingEvents'));
    // }

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

    

    public function pendingEvents()
    {
        $venues = Venue::all();
        $faculties = Faculty::all();
        $pendingEvents = Event::where('status', 'pending')->get();

        return view('admin', compact('pendingEvents', 'faculties',  'venues'));
    }

    public function FacultyDestroy($id)
    {
        $faculty = Faculty::findOrFail($id);
        $faculty->delete();

        return redirect()->back()->with('success', 'Faculty deleted successfully.');
    }

    public function FacultyStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:faculties,code',
        ]);

        Faculty::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return redirect()->back()->with('success', 'Faculty added successfully.');
    }

    public function VenueDestroy($id)
    {
        $venues = Venue::findOrFail($id);
        $venues->delete();

        return redirect()->back()->with('success', 'Venue deleted successfully.');
    }

    public function VenueStore(Request $request)
    {
        $request->validate([
            'FacultyCode' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:faculties,code',
        ]);

        Venue::create([
            'faculty' => $request->FacultyCode,
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return redirect()->back()->with('success', 'Venue added successfully.');
    }

}