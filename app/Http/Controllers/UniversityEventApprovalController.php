<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\UniversityEventApproval;
use App\Models\Faculty;
use App\Models\Venue;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class UniversityEventApprovalController extends Controller
{
    public function store(Request $request)
    {
        // Validate the form inputs
        $request->validate([
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
            'event_name'    => $request->event_name,
            'event_Type'    => 'University Level Union/Society', // Assuming this is a university-level event
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
            'faculty'       => 'University', // Assuming this is a university-level event
        ]);

        UniversityEventApproval::create([
            'event_id' => $event->id,
            // other default approval statuses will be defaulted by DB
            ]);

        // Generate PDF
            $pdf = Pdf::loadView('pdf.ReceiptUniversityLevel', compact('event'));

        // Return PDF for download
            return $pdf->download('event_details.pdf');
        // return redirect()->back()->with('success', 'Event scheduled successfully!');
    }
    
    // For Assistant Registrar 
    public function showPendingARRequests()
    {
        $pendingEvents = Event::whereHas('universityEventApproval', function ($query) {
            $query->where('ar_status', 'Pending');
        })->get();

        return view('Users.ar', compact('pendingEvents'));
    }
    public function ArAccept($id)
    {
        $approval = UniversityEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->ar_status = 'Approved';
            $approval->marshall_status = 'Pending';
            $approval->save();
        }

        return redirect()->back()->with('success', 'Request accepted.');
    }

    public function ArReject($id)
    {
        $approval = UniversityEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->ar_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->save();

            // Automatically update the related Event status
             $this->update_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected.');
    }


   
    
    // For Marshall 
    public function showPendingMarshallRequests()
    {
        $pendingEvents = Event::whereHas('universityEventApproval', function ($query) {
            $query->where('marshall_status', 'Pending');
        })->get();

        return view('Users.marshall', compact('pendingEvents'));
    }

    public function MarshallAccept($id)
    {
        $approval = UniversityEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->marshall_status = 'Approved';
            $approval->proctor_status = 'Pending';
            $approval->save();
        }

        return redirect()->back()->with('success', 'Request accepted.');
    }

    public function MarshallReject($id)
    {
        $approval = UniversityEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->marshall_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->save();

            // Automatically update the related Event status
            $this->update_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected.');
    } 
    
    
    // For Proctor 
    public function showPendingProctorRequests()
    {
        $pendingEvents = Event::whereHas('universityEventApproval', function ($query) {
            $query->where('proctor_status', 'Pending');
        })->get();

        return view('Users.proctor', compact('pendingEvents'));
    }

    public function ProctorAccept($id)
    {
        $approval = UniversityEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->proctor_status = 'Approved';
            $approval->vc_status = 'Pending';
            $approval->save();
        }

        return redirect()->back()->with('success', 'Request accepted.');
    }

    public function ProctorReject($id)
    {
        $approval = UniversityEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->proctor_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->save();

            // Automatically update the related Event status
            $this->update_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected.');
    }


    // For Vice Chancellor 
    public function showPendingVcRequests()
    {
        $pendingEvents = Event::whereHas('universityEventApproval', function ($query) {
            $query->where('vc_status', 'Pending');
        })->get();

        return view('Users.vice_chancellor', compact('pendingEvents'));
    }

    public function VcAccept($id)
    {
        $approval = UniversityEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->vc_status = 'Approved';
            $approval->final_status = 'Approved';
            $approval->save();

            // Automatically update the related Event status
            $this->update_event($id);
        }

        return redirect()->back()->with('success', 'Request accepted.');
    }



    public function VcReject($id)
    {
        $approval = UniversityEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->vc_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->save();

            // Automatically update the related Event status
            $this->update_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected.');
    }

    public function update_event($eventId)
    {
        $approval = UniversityEventApproval::where('event_id', $eventId)->first();

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

    public function showUnionForm()
    {
        $faculties = Faculty::all(); // Or use ->pluck('name', 'id') if needed
        return view('Schedulers.schedule_event', compact('faculties'));
    }

    public function getHalls($facultyCode)
    {
        $halls = Venue::where('faculty', $facultyCode)->get(['name']);
        return response()->json($halls);
    }
}
