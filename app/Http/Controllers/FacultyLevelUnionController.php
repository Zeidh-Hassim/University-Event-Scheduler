<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Venue;
use Illuminate\Http\Request;

class FacultyLevelUnionController extends Controller
{
    public function showUnionForm()
    {
        $faculties = Faculty::all(); // Or use ->pluck('name', 'id') if needed
        return view('Schedulers.FacultyLevelUnion', compact('faculties'));
    }

    public function getHalls($facultyCode)
    {
        $halls = Venue::where('faculty', $facultyCode)->get(['name']);
        return response()->json($halls);
    }


}



