<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\FacultyUnionEventApproval;
use App\Models\Venue;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Event;


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

        // Set the correct AR status based on faculty_for_venue
        $approvalData = ['event_id' => $event->id];

        switch (strtoupper($request->faculty_for_venue)) {
            case 'FAS':
                $approvalData['fasar_status'] = 'Pending';
                break;
            case 'FBS':
                $approvalData['fbsar_status'] = 'Pending';
                break;
            case 'FTS':
                $approvalData['ftsar_status'] = 'Pending';
                break;
        }
        // Create approval entry
        FacultyUnionEventApproval::create($approvalData);

        // Generate PDF
            $pdf = Pdf::loadView('pdf.ReceiptFacultyUnion', compact('event'));

        // Return PDF for download
            return $pdf->download('faculty_event_details.pdf');
        // return redirect()->back()->with('success', 'Event scheduled successfully!');
    }

    // For FAS Assistant Registrar 
    public function showPendingFASARUnionRequests()
    {
        $pendingUnionEvents = Event::whereHas('facultyUnionEventApproval', function ($query) {
            $query->where('fasar_status', 'Pending');
        })->get();
        // dd($pendingUnionEvents);

        return view('Users.fas_ar', compact('pendingUnionEvents'));
    }
    public function FASArUnionAccept($id)
    {
        $approval = FacultyUnionEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fasar_status = 'Approved';
            $approval->fasdp_status = 'Pending';
            $approval->save();
        }

        return redirect()->back()->with('success', 'Request accepted.');
    }

    public function FASArUnionReject($id)
    {
        $approval = FacultyUnionEventApproval::where('event_id', $id)->first();

        
        if ($approval) {
            $approval->fasar_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->save();

            // Automatically update the related Event status
             $this->update_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected.');
    }



















































    public function update_event($eventId)
    {
        $approval = FacultyUnionEventApproval::where('event_id', $eventId)->first();

        if ($approval) {
            $event = Event::find($eventId);

            if ($event) {
                if ($approval->final_status === 'Approved') {
                    $event->status = 'accepted';
                } elseif ($approval->final_status === 'Rejected') {
                    $event->status = 'rejected';
                }

                $event->save();
            }
        }
    }
}



