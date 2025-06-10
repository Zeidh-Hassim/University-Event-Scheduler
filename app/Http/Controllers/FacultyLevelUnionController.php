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
        // Validate the form inputs
        $request->validate([
            'faculty' => 'required|string|max:255',
            'event_name' => 'required|string|max:255',
            'date' => 'required|date',
            'faculty_for_venue' => 'required|string',
            'hall' => 'required|string',
            'starttime' => 'required',
            'endtime' => 'required|after:starttime',
            'participants' => 'required|string',

            'society' => 'required|string|max:255',
            'applicant' => 'required|string|max:255',
            'reg_no' => 'required|string|max:100',
            'contact' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        // Combine faculty and hall to create the venue string
        $venue = $request->faculty_for_venue . ' : ' . $request->hall;

        // Create and save the event
        $event=Event::create([
            'faculty'       => $request->faculty, 
            'event_name'    => $request->event_name,
            'event_Type'    => 'Faculty Union',
            'date'          => $request->date,
            'venue'         => $venue,
            'start_time'    => $request->starttime,
            'end_time'      => $request->endtime,
            'participants'  => $request->participants,
            'society'       => $request->society,
            'applicant'     => $request->applicant,
            'registration_number' => $request->reg_no,
            'contact'       => $request->contact,
            'email'         => $request->email,
            'status'        => 'Pending', // default status
            
        ]);

        // UniversityEventApproval::create([
        //     'event_id' => $event->id,
        //     // other default approval statuses will be defaulted by DB
        //     ]);

        // Generate PDF
            $pdf = Pdf::loadView('pdf.ReceiptFacultyUnion', compact('event'));

        // Return PDF for download
            return $pdf->download('faculty_event_details.pdf');
        // return redirect()->back()->with('success', 'Event scheduled successfully!');
    }
}



