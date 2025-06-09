<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Venue;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Event;
use App\Models\UniversityEventApproval;
use Carbon\Carbon;

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

     public function store(Request $request)
        {
            $request->validate([
            'event_name' => 'required|string',
            'society' => 'required|string',
            'date' => 'required|date',
            'hall' => 'required|string', // validate `hall`, not `venue`
            'time' => 'required',
            'person_id' => 'required|string',
            'contact' => 'required|string',
            'email' => 'required|email',
            'reg_no' => 'required|string',
            'faculty' => 'required|string',
        ]);

        // Combine faculty and hall to make venue like "FAS:LH1"
        $venue = $request->faculty . ' : ' . $request->hall;

        $event = Event::create([
            'event_name' => $request->event_name,
            'society' => $request->society,
            'date' => $request->date,
            'venue' => $venue,
            'time' => $request->time,
            'person_id' => $request->person_id,
            'contact' => $request->contact,
            'email' => $request->email,
            'reg_no' => $request->reg_no,
            'faculty' => $request->faculty,
        ]);

        // Save event details in the database
        // $event = Event::create($request->all());

        // UniversityEventApproval::create([
        // 'event_id' => $event->id,
        // other default approval statuses will be defaulted by DB
        // ]);

        // Flash success message to session
        //return redirect()->route('sheduler')->with('success', 'Event successfully saved!');

        // Generate PDF
        $pdf = Pdf::loadView('pdf.event_details', compact('event'));

        // Return PDF for download
        return $pdf->download('event_details.pdf');
    }


}



