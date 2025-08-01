<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\UniversityEventApproval;
use App\Models\Faculty;
use App\Models\Venue;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\FacultyUnionEventApproval;
use App\Models\FacultySocietyEventApproval;
use App\Models\FacultyBatchEventApproval;

class UniversityEventApprovalController extends Controller
{
    //store function for university level events
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
            'reason' => 'required|string',
            'position' => 'required|string',

            'society' => 'required|string|max:255',
            'applicant' => 'required|string|max:255',
            'reg_no' => 'required', 'regex:/^\d{4}\/[A-Z]{2,3}\/[1-9]\d{0,2}$/',
            'contact' => 'required','regex:^07\d{8}$',
            'email' => 'required|email|max:255',
            'event_image' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        // Combine faculty and hall to create the venue string
        $venue = $request->faculty_for_venue . ' : ' . $request->hall;
        $applicantname = $request->position . ' - ' . $request->applicant;

        $imagePath = null;
        if ($request->hasFile('event_image')) {
            $imagePath = $request->file('event_image')->store('event_images', 'public');
        }

        // Create and save the event
        $event = Event::create([
            'event_name' => strtoupper($request->event_name),
            'event_Type' => 'University Level Union/Society',
            'date' => $request->date,
            'venue' => $venue,
            'start_time' => $request->starttime,
            'end_time' => $request->endtime,
            'participants' => $request->participants,
            'reason' => $request->reason,
            'society' => $request->society,
            'applicant' => $applicantname,
            'registration_number' => $request->reg_no,
            'contact' => $request->contact,
            'email' => $request->email,
            'status' => 'Pending',
            'faculty' => 'University',
            'image_path' => $imagePath,
            'faculty_for_venue' => $request->faculty_for_venue,
            'halls' => $request->hall,
        ]);

        // Create approval entry with correct AR based on faculty
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

        UniversityEventApproval::create($approvalData);

        // Generate PDF
        $pdf = Pdf::loadView('pdf.ReceiptUniversityLevel', compact('event'));

        // Return PDF for download
        return $pdf->download('event_details.pdf');
    }



    //store function for Union events
    public function storeUnion(Request $request)
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
            'reason' => 'required|string',
            'position' => 'required|string',

            'society' => 'required|string|max:255',
            'applicant' => 'required|string|max:255',
            'reg_no' => 'required', 'regex:/^\d{4}\/[A-Z]{2,3}\/[1-9]\d{0,2}$/',
            'contact' => 'required','regex:^07\d{8}$',
            'email' => 'required|email|max:255',
            'event_image' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        // Combine faculty and hall to create the venue string
        $venue = $request->faculty_for_venue . ' : ' . $request->hall;
        $applicantname = $request->position . ' - ' . $request->applicant;

        $imagePath = null;
        if ($request->hasFile('event_image')) {
            $imagePath = $request->file('event_image')->store('event_images', 'public');
        }

        // Create and save the event
        $event = Event::create([
            'event_name' => strtoupper($request->event_name),
            'event_Type' => 'Faculty Level Students Union',
            'date' => $request->date,
            'venue' => $venue,
            'start_time' => $request->starttime,
            'end_time' => $request->endtime,
            'participants' => $request->participants,
            'reason' => $request->reason,
            'society' => $request->society,
            'applicant' => $applicantname,
            'registration_number' => $request->reg_no,
            'contact' => $request->contact,
            'email' => $request->email,
            'status' => 'Pending',
            'faculty' => $request->faculty_for_venue,
            'image_path' => $imagePath,
            'faculty_for_venue' => $request->faculty_for_venue,
            'halls' => $request->hall,
        ]);

        // Create approval entry with correct AR based on faculty
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

        FacultyUnionEventApproval::create($approvalData);

        // Generate PDF
        $pdf = Pdf::loadView('pdf.ReceiptUniversityLevel', compact('event'));

        // Return PDF for download
        return $pdf->download('event_details.pdf');
    }



    //store function for Society events
    public function storeSociety(Request $request)
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
            'reason' => 'required|string',
            'position' => 'required|string',

            'society' => 'required|string|max:255',
            'applicant' => 'required|string|max:255',
            'reg_no' => 'required', 'regex:/^\d{4}\/[A-Z]{2,3}\/[1-9]\d{0,2}$/',
            'contact' => 'required','regex:^07\d{8}$',
            'email' => 'required|email|max:255',
            'event_image' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        // Combine faculty and hall to create the venue string
        $venue = $request->faculty_for_venue . ' : ' . $request->hall;
        $applicantname = $request->position . ' - ' . $request->applicant;

        $imagePath = null;
        if ($request->hasFile('event_image')) {
            $imagePath = $request->file('event_image')->store('event_images', 'public');
        }

        // Create and save the event
        $event = Event::create([
            'event_name' => strtoupper($request->event_name),
            'event_Type' => 'Faculty Level Approved Societies',
            'date' => $request->date,
            'venue' => $venue,
            'start_time' => $request->starttime,
            'end_time' => $request->endtime,
            'participants' => $request->participants,
            'reason' => $request->reason,
            'society' => $request->society,
            'applicant' => $applicantname,
            'registration_number' => $request->reg_no,
            'contact' => $request->contact,
            'email' => $request->email,
            'status' => 'Pending',
            'faculty' => $request->faculty_for_venue,
            'image_path' => $imagePath,
            'faculty_for_venue' => $request->faculty_for_venue,
            'halls' => $request->hall,
        ]);

        // Create approval entry with correct AR based on faculty
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

        FacultySocietyEventApproval::create($approvalData);

        // Generate PDF
        $pdf = Pdf::loadView('pdf.ReceiptUniversityLevel', compact('event'));

        // Return PDF for download
        return $pdf->download('event_details.pdf');
    }


        //store function for Batch events
    public function storeBatch(Request $request)
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
            'reason' => 'required|string',
            'position' => 'required|string',

            'society' => 'required|string|max:255',
            'applicant' => 'required|string|max:255',
            'reg_no' => 'required', 'regex:/^\d{4}\/[A-Z]{2,3}\/[1-9]\d{0,2}$/',
            'contact' => 'required','regex:^07\d{8}$',
            'email' => 'required|email|max:255',
            'event_image' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        // Combine faculty and hall to create the venue string
        $venue = $request->faculty_for_venue . ' : ' . $request->hall;
        $applicantname = $request->position . ' - ' . $request->applicant;

        $imagePath = null;
        if ($request->hasFile('event_image')) {
            $imagePath = $request->file('event_image')->store('event_images', 'public');
        }

        // Create and save the event
        $event = Event::create([
            'event_name' => strtoupper($request->event_name),
            'event_Type' => 'Faculty Level Batch',
            'date' => $request->date,
            'venue' => $venue,
            'start_time' => $request->starttime,
            'end_time' => $request->endtime,
            'participants' => $request->participants,
            'reason' => $request->reason,
            'society' => $request->society,
            'applicant' => $applicantname,
            'registration_number' => $request->reg_no,
            'contact' => $request->contact,
            'email' => $request->email,
            'status' => 'Pending',
            'faculty' => $request->faculty_for_venue,
            'image_path' => $imagePath,
            'faculty_for_venue' => $request->faculty_for_venue,
            'halls' => $request->hall,
        ]);

        // Create approval entry with correct AR based on faculty
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

        FacultyBatchEventApproval::create($approvalData);

        // Generate PDF
        $pdf = Pdf::loadView('pdf.ReceiptUniversityLevel', compact('event'));

        // Return PDF for download
        return $pdf->download('event_details.pdf');
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

    // This function updates the event status based on the approval status
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


    public function updateUnion_event($eventId)
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

    public function updateSociety_event($eventId)
    {
        $approval = FacultySocietyEventApproval::where('event_id', $eventId)->first();

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

    public function updateBatch_event($eventId)
    {
        $approval = FacultyBatchEventApproval::where('event_id', $eventId)->first();

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

    // Show the form for scheduling an event
    public function showUnionForm()
    {
        $faculties = Faculty::all(); // Or use ->pluck('name', 'id') if needed
        return view('Schedulers.schedule_event', compact('faculties'));
    }

    public function showUnionFormUnion()
    {
        $faculties = Faculty::all(); // Or use ->pluck('name', 'id') if needed
        return view('Schedulers.FacultyLevelUnion', compact('faculties'));
    }
    

        public function showUnionFormSociety()
    {
        $faculties = Faculty::all(); // Or use ->pluck('name', 'id') if needed
        return view('Schedulers.FacultyLevelSocieties', compact('faculties'));
    }

    public function showUnionFormBatch()
    {
        $faculties = Faculty::all(); // Or use ->pluck('name', 'id') if needed
        return view('Schedulers.FacultyLevelBatch', compact('faculties'));
    }
    




    // Get halls based on faculty code
    public function getHalls($facultyCode)
    {
        $halls = Venue::where('faculty', $facultyCode)->get(['name']);
        return response()->json($halls);
    }

    // Get available halls based on faculty, date, start time, and end time
    public function getAvailableHalls($faculty, $date, $start, $end)
{
    // Get all halls (venues) for the selected faculty
    $allHalls = Venue::where('faculty', $faculty)->get();

    // Get already booked halls for the given date and time
    $bookedHalls = Event::where('faculty_for_venue', $faculty)
        ->where('status', 'Accepted')
        ->where('date', $date)
        ->where(function ($query) use ($start, $end) {
            $query->whereBetween('start_time', [$start, $end])
                  ->orWhereBetween('end_time', [$start, $end])
                  ->orWhere(function ($q) use ($start, $end) {
                      $q->where('start_time', '<=', $start)
                        ->where('end_time', '>=', $end);
                  });
        })
        ->pluck('halls') // Must match your field name in DB exactly
        ->toArray();

    // Filter out the booked halls
    $availableHalls = $allHalls->filter(function ($hall) use ($bookedHalls) {
        return !in_array($hall->name, $bookedHalls); // 'name' is the hall name in Venue table
    });
    // dd($availableHalls);

    return response()->json($availableHalls);
}











    

    












    // For FAS Assistant Registrar 
   public function showPendingFASARRequests()
{
    $pendingEvents = Event::with('universityEventApproval')
        ->whereHas('universityEventApproval', function ($query) {
            $query->where('fasar_status', 'Pending');
        })->get();

    $approvedEvents = Event::with('universityEventApproval')
        ->whereHas('universityEventApproval', function ($query) {
            $query->where('fasar_status', 'Approved');
        })->get();

    $rejectedEvents = Event::with('universityEventApproval')
        ->whereHas('universityEventApproval', function ($query) {
            $query->where('fasar_status', 'Rejected');
        })->get();

    $allEventApprovals = UniversityEventApproval::with('event')->get();

    
    $pendingUnionEvents = Event::with('FacultyUnionEventApproval')
        ->whereHas('FacultyUnionEventApproval', function ($query) {
            $query->where('fasar_status', 'Pending');
        })->get();

    $approvedUnionEvents = Event::with('FacultyUnionEventApproval')
        ->whereHas('FacultyUnionEventApproval', function ($query) {
            $query->where('fasar_status', 'Approved');
        })->get();

    $rejectedUnionEvents = Event::with('FacultyUnionEventApproval')
        ->whereHas('FacultyUnionEventApproval', function ($query) {
            $query->where('fasar_status', 'Rejected');
        })->get();

    $allUnionEventApprovals = FacultyUnionEventApproval::with('event')->get();

    $pendingSocietyEvents = Event::with('FacultySocietyEventApproval')
        ->whereHas('FacultySocietyEventApproval', function ($query) {
            $query->where('fasar_status', 'Pending');
        })->get();

    $approvedSocietyEvents = Event::with('FacultySocietyEventApproval')
        ->whereHas('FacultySocietyEventApproval', function ($query) {
            $query->where('fasar_status', 'Approved');
        })->get();

    $rejectedSocietyEvents = Event::with('FacultySocietyEventApproval')
        ->whereHas('FacultySocietyEventApproval', function ($query) {
            $query->where('fasar_status', 'Rejected');
        })->get();

    $allSocietyEventApprovals = FacultySocietyEventApproval::with('event')->get();

    $pendingBatchEvents = Event::with('FacultyBatchEventApproval')
        ->whereHas('FacultyBatchEventApproval', function ($query) {
            $query->where('fasar_status', 'Pending');
        })->get();

    $approvedBatchEvents = Event::with('FacultyBatchEventApproval')
        ->whereHas('FacultyBatchEventApproval', function ($query) {
            $query->where('fasar_status', 'Approved');
        })->get();

    $rejectedBatchEvents = Event::with('FacultyBatchEventApproval')
        ->whereHas('FacultyBatchEventApproval', function ($query) {
            $query->where('fasar_status', 'Rejected');
        })->get();

    $allBatchApprovals = FacultyBatchEventApproval::with('event')->get();

    return view('Users.fas_ar', compact(
        'pendingEvents',
        'approvedEvents',
        'rejectedEvents',
        'allEventApprovals',
        'pendingUnionEvents',
        'approvedUnionEvents',
        'rejectedUnionEvents',
        'allUnionEventApprovals',
        'pendingSocietyEvents',
        'approvedSocietyEvents',
        'rejectedSocietyEvents',
        'allSocietyEventApprovals',
        'pendingBatchEvents',
        'approvedBatchEvents',
        'rejectedBatchEvents',
        'allBatchApprovals',

    ));
}

    public function FASArAccept($id)
    {
        $approval = UniversityEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fasar_status = 'Approved';
            $approval->marshall_status = 'Pending';
            $approval->save();
        }

        return redirect()->back()->with('success', 'Request accepted.');
    }

    public function FASArReject(Request $request, $id)
    {
        $approval = UniversityEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fasar_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->rejection_reason = $request->input('reason'); // Save the reason
            $approval->save();

            // Automatically update the related Event status
            $this->update_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected with reason.');
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


    public function FASArUnionReject(Request $request, $id)
    {
        $approval = FacultyUnionEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fasar_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->rejection_reason = $request->input('reason'); // Save the reason
            $approval->save();

            // Automatically update the related Event status
            $this->updateUnion_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected with reason.');
    }




    public function FASArSocietyAccept($id)
    {
        $approval = FacultySocietyEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fasar_status = 'Approved';
            $approval->fashod_status = 'Pending';
            $approval->save();
        }

        return redirect()->back()->with('success', 'Request accepted.');
    }


    public function FASArSocietyReject(Request $request, $id)
    {
        $approval = FacultySocietyEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fasar_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->rejection_reason = $request->input('reason'); // Save the reason
            $approval->save();

            // Automatically update the related Event status
            $this->updateSociety_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected with reason.');
    }

        public function FASArBatchAccept($id)
    {
        $approval = FacultyBatchEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fasar_status = 'Approved';
            $approval->fasdp_status = 'Pending';
            $approval->save();
        }

        return redirect()->back()->with('success', 'Request accepted.');
    }


    public function FASArBatchReject(Request $request, $id)
    {
        $approval = FacultyBatchEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fasar_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->rejection_reason = $request->input('reason'); // Save the reason
            $approval->save();

            // Automatically update the related Event status
            $this->updateBatch_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected with reason.');
    }
















// FBS Assistant Registrar
    public function showPendingFBSARRequests()
    {
        $pendingEvents = Event::with('universityEventApproval')
            ->whereHas('universityEventApproval', function ($query) {
                $query->where('fbsar_status', 'Pending');
            })->get();

        $approvedEvents = Event::with('universityEventApproval')
            ->whereHas('universityEventApproval', function ($query) {
                $query->where('fbsar_status', 'Approved');
            })->get();

        $rejectedEvents = Event::with('universityEventApproval')
            ->whereHas('universityEventApproval', function ($query) {
                $query->where('fbsar_status', 'Rejected');
            })->get();

        $allEventApprovals = UniversityEventApproval::with('event')->get();



        $pendingUnionEvents = Event::with('FacultyUnionEventApproval')
            ->whereHas('FacultyUnionEventApproval', function ($query) {
                $query->where('fbsar_status', 'Pending');
            })->get();

        $approvedUnionEvents = Event::with('FacultyUnionEventApproval')
            ->whereHas('FacultyUnionEventApproval', function ($query) {
                $query->where('fbsar_status', 'Approved');
            })->get();

        $rejectedUnionEvents = Event::with('FacultyUnionEventApproval')
            ->whereHas('FacultyUnionEventApproval', function ($query) {
                $query->where('fbsar_status', 'Rejected');
            })->get();

        $allUnionEventApprovals = FacultyUnionEventApproval::with('event')->get();

        $pendingSocietyEvents = Event::with('FacultySocietyEventApproval')
            ->whereHas('FacultySocietyEventApproval', function ($query) {
                $query->where('fbsar_status', 'Pending');
            })->get();

        $approvedSocietyEvents = Event::with('FacultySocietyEventApproval')
            ->whereHas('FacultySocietyEventApproval', function ($query) {
                $query->where('fbsar_status', 'Approved');
            })->get();

        $rejectedSocietyEvents = Event::with('FacultySocietyEventApproval')
            ->whereHas('FacultySocietyEventApproval', function ($query) {
                $query->where('fbsar_status', 'Rejected');
            })->get();

        $allSocietyEventApprovals = FacultySocietyEventApproval::with('event')->get();

        $pendingBatchEvents = Event::with('FacultyBatchEventApproval')
            ->whereHas('FacultyBatchEventApproval', function ($query) {
                $query->where('fbsar_status', 'Pending');
            })->get();

        $approvedBatchEvents = Event::with('FacultyBatchEventApproval')
            ->whereHas('FacultyBatchEventApproval', function ($query) {
                $query->where('fbsar_status', 'Approved');
            })->get();

        $rejectedBatchEvents = Event::with('FacultyBatchEventApproval')
            ->whereHas('FacultyBatchEventApproval', function ($query) {
                $query->where('fbsar_status', 'Rejected');
            })->get();

        $allBatchApprovals = FacultyBatchEventApproval::with('event')->get();

        return view('Users.fbs_ar', compact(
            'pendingEvents',
            'approvedEvents',
            'rejectedEvents',
            'allEventApprovals',
            'pendingUnionEvents',
            'approvedUnionEvents',
            'rejectedUnionEvents',
            'allUnionEventApprovals',
            'pendingSocietyEvents',
            'approvedSocietyEvents',
            'rejectedSocietyEvents',
            'allSocietyEventApprovals',
            'pendingBatchEvents',
            'approvedBatchEvents',
            'rejectedBatchEvents',
            'allBatchApprovals',

        ));
    }
    public function FBSArAccept($id)
    {
        $approval = UniversityEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fbsar_status = 'Approved';
            $approval->marshall_status = 'Pending';
            $approval->save();
        }

        return redirect()->back()->with('success', 'Request accepted.');
    }
    public function FBSArReject(Request $request, $id)
    {
        $approval = UniversityEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fbsar_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->rejection_reason = $request->input('reason'); // Save the reason
            $approval->save();

            // Automatically update the related Event status
             $this->update_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected.');
    }

        public function FBSArUnionAccept($id)
    {
        $approval = FacultyUnionEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fbsar_status = 'Approved';
            $approval->fbsdp_status = 'Pending';
            $approval->save();
        }

        return redirect()->back()->with('success', 'Request accepted.');
    }


    public function FBSArUnionReject(Request $request, $id)
    {
        $approval = FacultyUnionEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fbsar_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->rejection_reason = $request->input('reason'); // Save the reason
            $approval->save();

            // Automatically update the related Event status
            $this->updateUnion_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected with reason.');
    }

        public function FBSArSocietyAccept($id)
    {
        $approval = FacultySocietyEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fbsar_status = 'Approved';
            $approval->fbshod_status = 'Pending';
            $approval->save();
        }

        return redirect()->back()->with('success', 'Request accepted.');
    }


    public function FBSArSocietyReject(Request $request, $id)
    {
        $approval = FacultySocietyEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fbsar_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->rejection_reason = $request->input('reason'); // Save the reason
            $approval->save();

            // Automatically update the related Event status
            $this->updateSociety_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected with reason.');
    }

        public function FBSArBatchAccept($id)
    {
        $approval = FacultyBatchEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fbsar_status = 'Approved';
            $approval->fbsdp_status = 'Pending';
            $approval->save();
        }

        return redirect()->back()->with('success', 'Request accepted.');
    }


    public function FBSArBatchReject(Request $request, $id)
    {
        $approval = FacultyBatchEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fbsar_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->rejection_reason = $request->input('reason'); // Save the reason
            $approval->save();

            // Automatically update the related Event status
            $this->updateBatch_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected with reason.');
    }




    // FTS Assistant Registrar
    public function showPendingFTSARRequests()
    {
        $pendingEvents = Event::with('universityEventApproval')
        ->whereHas('universityEventApproval', function ($query) {
            $query->where('ftsar_status', 'Pending');
        })->get();

        $approvedEvents = Event::with('universityEventApproval')
            ->whereHas('universityEventApproval', function ($query) {
                $query->where('ftsar_status', 'Approved');
            })->get();

        $rejectedEvents = Event::with('universityEventApproval')
            ->whereHas('universityEventApproval', function ($query) {
                $query->where('ftsar_status', 'Rejected');
            })->get();

        $allEventApprovals = UniversityEventApproval::with('event')->get();

        $pendingUnionEvents = Event::with('FacultyUnionEventApproval')
            ->whereHas('FacultyUnionEventApproval', function ($query) {
                $query->where('ftsar_status', 'Pending');
            })->get();

        $approvedUnionEvents = Event::with('FacultyUnionEventApproval')
            ->whereHas('FacultyUnionEventApproval', function ($query) {
                $query->where('ftsar_status', 'Approved');
            })->get();

        $rejectedUnionEvents = Event::with('FacultyUnionEventApproval')
            ->whereHas('FacultyUnionEventApproval', function ($query) {
                $query->where('ftsar_status', 'Rejected');
            })->get();

        $allUnionEventApprovals = FacultyUnionEventApproval::with('event')->get();

            $pendingSocietyEvents = Event::with('FacultySocietyEventApproval')
        ->whereHas('FacultySocietyEventApproval', function ($query) {
            $query->where('ftsar_status', 'Pending');
        })->get();

    $approvedSocietyEvents = Event::with('FacultySocietyEventApproval')
        ->whereHas('FacultySocietyEventApproval', function ($query) {
            $query->where('ftsar_status', 'Approved');
        })->get();

    $rejectedSocietyEvents = Event::with('FacultySocietyEventApproval')
        ->whereHas('FacultySocietyEventApproval', function ($query) {
            $query->where('ftsar_status', 'Rejected');
        })->get();

    $allSocietyEventApprovals = FacultySocietyEventApproval::with('event')->get();

    

    $pendingBatchEvents = Event::with('FacultyBatchEventApproval')
        ->whereHas('FacultyBatchEventApproval', function ($query) {
            $query->where('ftsar_status', 'Pending');
        })->get();

    $approvedBatchEvents = Event::with('FacultyBatchEventApproval')
        ->whereHas('FacultyBatchEventApproval', function ($query) {
            $query->where('ftsar_status', 'Approved');
        })->get();

    $rejectedBatchEvents = Event::with('FacultyBatchEventApproval')
        ->whereHas('FacultyBatchEventApproval', function ($query) {
            $query->where('ftsar_status', 'Rejected');
        })->get();

    $allBatchApprovals = FacultyBatchEventApproval::with('event')->get();

    return view('Users.fts_ar', compact(
        'pendingEvents',
        'approvedEvents',
        'rejectedEvents',
        'allEventApprovals',
        'pendingUnionEvents',
        'approvedUnionEvents',
        'rejectedUnionEvents',
        'allUnionEventApprovals',
        'pendingSocietyEvents',
        'approvedSocietyEvents',
        'rejectedSocietyEvents',
        'allSocietyEventApprovals',
        'pendingBatchEvents',
        'approvedBatchEvents',
        'rejectedBatchEvents',
        'allBatchApprovals',

    ));
    }

    public function FTSArAccept($id)
    {
        $approval = UniversityEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->ftsar_status = 'Approved';
            $approval->marshall_status = 'Pending';
            $approval->save();
        }

        return redirect()->back()->with('success', 'Request accepted.');
    }

    public function FTSArReject(Request $request, $id)
    {
        $approval = UniversityEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->ftsar_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->rejection_reason = $request->input('reason'); // Save the reason
            $approval->save();

            // Automatically update the related Event status
            $this->update_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected with reason.');
    }

    public function FTSArUnionAccept($id)
    {
        $approval = FacultyUnionEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->ftsar_status = 'Approved';
            $approval->ftsdp_status = 'Pending';
            $approval->save();
        }

        return redirect()->back()->with('success', 'Request accepted.');
    }


    public function FTSArUnionReject(Request $request, $id)
    {
        $approval = FacultyUnionEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->ftsar_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->rejection_reason = $request->input('reason'); // Save the reason
            $approval->save();

            // Automatically update the related Event status
            $this->updateUnion_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected with reason.');
    }

    public function FTSArSocietyAccept($id)
    {
        $approval = FacultySocietyEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->ftsar_status = 'Approved';
            $approval->ftshod_status = 'Pending';
            $approval->save();
        }

        return redirect()->back()->with('success', 'Request accepted.');
    }


    public function FTSArSocietyReject(Request $request, $id)
    {
        $approval = FacultySocietyEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->ftsar_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->rejection_reason = $request->input('reason'); // Save the reason
            $approval->save();

            // Automatically update the related Event status
            $this->updateSociety_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected with reason.');
    }

        public function FTSArBatchAccept($id)
    {
        $approval = FacultyBatchEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->ftsar_status = 'Approved';
            $approval->ftsdp_status = 'Pending';
            $approval->save();
        }

        return redirect()->back()->with('success', 'Request accepted.');
    }


    public function FTSArBatchReject(Request $request, $id)
    {
        $approval = FacultyBatchEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->ftsar_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->rejection_reason = $request->input('reason'); // Save the reason
            $approval->save();

            // Automatically update the related Event status
            $this->updateBatch_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected with reason.');
    }


     // For Marshall 
    public function showPendingMarshallRequests()
    {
        // Fetch events with their university event approvals where marshall_status is Pending, Approved, or Rejected
        $pendingEvents = Event::with('universityEventApproval')
            ->whereHas('universityEventApproval', function ($query) {
                $query->where('marshall_status', 'Pending');
            })->get();

        $approvedEvents = Event::with('universityEventApproval')
            ->whereHas('universityEventApproval', function ($query) {
                $query->where('marshall_status', 'Approved');
            })->get();

        $rejectedEvents = Event::with('universityEventApproval')
            ->whereHas('universityEventApproval', function ($query) {
                $query->where('marshall_status', 'Rejected');
            })->get();

        $allEventApprovals = UniversityEventApproval::with('event')->get();

        $pendingUnionEvents = Event::with('FacultyUnionEventApproval')
            ->whereHas('FacultyUnionEventApproval', function ($query) {
                $query->where('marshall_status', 'Pending');
            })->get();

        $approvedUnionEvents = Event::with('FacultyUnionEventApproval')
            ->whereHas('FacultyUnionEventApproval', function ($query) {
                $query->where('marshall_status', 'Approved');
            })->get();

        $rejectedUnionEvents = Event::with('FacultyUnionEventApproval')
            ->whereHas('FacultyUnionEventApproval', function ($query) {
                $query->where('marshall_status', 'Rejected');
            })->get();

        $allUnionEventApprovals = FacultyUnionEventApproval::with('event')->get();

        $pendingBatchEvents = Event::with('FacultyBatchEventApproval')
            ->whereHas('FacultyBatchEventApproval', function ($query) {
                $query->where('marshall_status', 'Pending');
            })->get();

        $approvedBatchEvents = Event::with('FacultyBatchEventApproval')
            ->whereHas('FacultyBatchEventApproval', function ($query) {
                $query->where('marshall_status', 'Approved');
            })->get();

        $rejectedBatchEvents = Event::with('FacultyBatchEventApproval')
            ->whereHas('FacultyBatchEventApproval', function ($query) {
                $query->where('marshall_status', 'Rejected');
            })->get();

        $allBatchApprovals = FacultyBatchEventApproval::with('event')->get();

        return view('Users.marshall', compact(
            'pendingEvents',
            'approvedEvents',
            'rejectedEvents',
            'allEventApprovals',
            'pendingUnionEvents',
            'approvedUnionEvents',
            'rejectedUnionEvents',
            'allUnionEventApprovals',
            'pendingBatchEvents',
            'approvedBatchEvents',
            'rejectedBatchEvents',
            'allBatchApprovals'
        ));
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

    public function MarshallReject(Request $request, $id)
    {
       
        $approval = UniversityEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->marshall_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->rejection_reason = $request->input('reason'); // Save the reason
            $approval->save();

            // Automatically update the related Event status
            $this->update_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected with reason.');
    }

public function MarshallUnionAccept($id)
{
    // Fetch the event
    $event = Event::find($id);

    if (!$event) {
        return redirect()->back()->with('error', 'Event not found.');
    }

    // Try to fetch existing approval
    $approval = FacultyUnionEventApproval::where('event_id', $id)->first();

    // If not found, create a new approval entry
    if (!$approval) {
        $approvalData = ['event_id' => $id];

        switch (strtoupper($event->faculty_for_venue)) {
            case 'FAS':
                $approvalData['fasdean_status'] = 'Pending';
                break;
            case 'FBS':
                $approvalData['fbsdean_status'] = 'Pending';
                break;
            case 'FTS':
                $approvalData['ftsdean_status'] = 'Pending';
                break;
        }

        $approval = FacultyUnionEventApproval::create($approvalData);
    }

    // Update statuses
    $approval->marshall_status = 'Approved';

    switch (strtoupper($event->faculty_for_venue)) {
        case 'FAS':
            $approval->fasdean_status = 'Pending';
            break;
        case 'FBS':
            $approval->fbsdean_status = 'Pending';
            break;
        case 'FTS':
            $approval->ftsdean_status = 'Pending';
            break;
    }

    $approval->save();

    return redirect()->back()->with('success', 'Request accepted.');
}



    public function MarshallUnionReject(Request $request, $id)
    {
        $approval = FacultyUnionEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->marshall_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->rejection_reason = $request->input('reason'); // Save the reason
            $approval->save();

            // Automatically update the related Event status
            $this->updateUnion_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected with reason.');
    }

    public function MarshallBatchAccept($id)
{
    // Fetch the event
    $event = Event::find($id);

    if (!$event) {
        return redirect()->back()->with('error', 'Event not found.');
    }

    // Try to fetch existing approval
    $approval = FacultyBatchEventApproval::where('event_id', $id)->first();

    // If not found, create a new approval entry
    if (!$approval) {
        $approvalData = ['event_id' => $id];

        switch (strtoupper($event->faculty_for_venue)) {
            case 'FAS':
                $approvalData['fasdean_status'] = 'Pending';
                break;
            case 'FBS':
                $approvalData['fbsdean_status'] = 'Pending';
                break;
            case 'FTS':
                $approvalData['ftsdean_status'] = 'Pending';
                break;
        }

        $approval = FacultyBatchEventApproval::create($approvalData);
    }

    // Update statuses
    $approval->marshall_status = 'Approved';

    switch (strtoupper($event->faculty_for_venue)) {
        case 'FAS':
            $approval->fasdean_status = 'Pending';
            break;
        case 'FBS':
            $approval->fbsdean_status = 'Pending';
            break;
        case 'FTS':
            $approval->ftsdean_status = 'Pending';
            break;
    }

    $approval->save();

    return redirect()->back()->with('success', 'Request accepted.');
}



    public function MarshallBatchReject(Request $request, $id)
    {
        $approval = FacultyBatchEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->marshall_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->rejection_reason = $request->input('reason'); // Save the reason
            $approval->save();

            // Automatically update the related Event status
            $this->updateBatch_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected with reason.');
    }



    // For Proctor 
    public function showPendingProctorRequests()
    {
        // Fetch events with their university event approvals where proctor_status is Pending, Approved, or Rejected
         $pendingEvents = Event::with('universityEventApproval')
            ->whereHas('universityEventApproval', function ($query) {
            $query->where('proctor_status', 'Pending');
        })->get();

        $approvedEvents = Event::with('universityEventApproval')
            ->whereHas('universityEventApproval', function ($query) {
                $query->where('proctor_status', 'Approved');
            })->get();

        $rejectedEvents = Event::with('universityEventApproval')
            ->whereHas('universityEventApproval', function ($query) {
                $query->where('proctor_status', 'Rejected');
            })->get();

        $allEventApprovals = UniversityEventApproval::with('event')->get();

        return view('Users.proctor', compact(
            'pendingEvents',
            'approvedEvents',
            'rejectedEvents',
            'allEventApprovals'
        ));




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

    public function ProctorReject(Request $request, $id)
    {
       
        $approval = UniversityEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->proctor_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->rejection_reason = $request->input('reason'); // Save the reason
            $approval->save();

            // Automatically update the related Event status
            $this->update_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected with reason.');
    }


    // For Vice Chancellor 
    public function showPendingVcRequests()
    {
        // Fetch events with their university event approvals where vc_status is Pending, Approved, or Rejected

         $pendingEvents = Event::with('universityEventApproval')
            ->whereHas('universityEventApproval', function ($query) {
            $query->where('vc_status', 'Pending');
        })->get();

        $approvedEvents = Event::with('universityEventApproval')
            ->whereHas('universityEventApproval', function ($query) {
                $query->where('vc_status', 'Approved');
            })->get();

        $rejectedEvents = Event::with('universityEventApproval')
            ->whereHas('universityEventApproval', function ($query) {
                $query->where('vc_status', 'Rejected');
            })->get();

        $allEventApprovals = UniversityEventApproval::with('event')->get();

        return view('Users.vice_chancellor', compact(
            'pendingEvents',
            'approvedEvents',
            'rejectedEvents',
            'allEventApprovals'
        ));


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



    public function VcReject(Request $request, $id)
    {
        $approval = UniversityEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->vc_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->rejection_reason = $request->input('reason'); // Save the reason
            $approval->save();

            // Automatically update the related Event status
            $this->update_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected with reason.');    
    }

























//FAS Deputy proctor
    public function showPendingFASDPRequests()
    {
    $pendingUnionEvents = Event::with('FacultyUnionEventApproval')
        ->whereHas('FacultyUnionEventApproval', function ($query) {
            $query->where('fasdp_status', 'Pending');
        })->get();

    $approvedUnionEvents = Event::with('FacultyUnionEventApproval')
        ->whereHas('FacultyUnionEventApproval', function ($query) {
            $query->where('fasdp_status', 'Approved');
        })->get();

    $rejectedUnionEvents = Event::with('FacultyUnionEventApproval')
        ->whereHas('FacultyUnionEventApproval', function ($query) {
            $query->where('fasdp_status', 'Rejected');
        })->get();

    $allUnionEventApprovals = FacultyUnionEventApproval::with('event')->get();


        $pendingBatchEvents = Event::with('FacultyBatchEventApproval')
        ->whereHas('FacultyBatchEventApproval', function ($query) {
            $query->where('fasdp_status', 'Pending');
        })->get();

    $approvedBatchEvents = Event::with('FacultyBatchEventApproval')
        ->whereHas('FacultyBatchEventApproval', function ($query) {
            $query->where('fasdp_status', 'Approved');
        })->get();

    $rejectedBatchEvents = Event::with('FacultyBatchEventApproval')
        ->whereHas('FacultyBatchEventApproval', function ($query) {
            $query->where('fasdp_status', 'Rejected');
        })->get();

    $allBatchEventApprovals = FacultyBatchEventApproval::with('event')->get();

        return view('Users.fas_dp', compact(
            'pendingUnionEvents',
            'approvedUnionEvents',
            'rejectedUnionEvents',
            'allUnionEventApprovals',
            'pendingBatchEvents',
            'approvedBatchEvents',
            'rejectedBatchEvents',
            'allBatchEventApprovals',
        ));
    }

    public function FASDPUnionAccept($id)
    {
        $approval = FacultyUnionEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fasdp_status = 'Approved';
            $approval->marshall_status = 'Pending';
            $approval->save();
        }

        return redirect()->back()->with('success', 'Request accepted.');
    }


    public function FASDPUnionReject(Request $request, $id)
    {
        $approval = FacultyUnionEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fasdp_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->rejection_reason = $request->input('reason'); // Save the reason
            $approval->save();

            // Automatically update the related Event status
            $this->updateUnion_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected with reason.');
    }

        public function FASDPBatchAccept($id)
    {
        $approval = FacultyBatchEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fasdp_status = 'Approved';
            $approval->marshall_status = 'Pending';
            $approval->save();
        }

        return redirect()->back()->with('success', 'Request accepted.');
    }


    public function FASDPBatchReject(Request $request, $id)
    {
        $approval = FacultyBatchEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fasdp_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->rejection_reason = $request->input('reason'); // Save the reason
            $approval->save();

            // Automatically update the related Event status
            $this->updateBatch_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected with reason.');
    }


    //FBS Deputy proctor
    public function showPendingFBSDPRequests()
    {
    $pendingUnionEvents = Event::with('FacultyUnionEventApproval')
        ->whereHas('FacultyUnionEventApproval', function ($query) {
            $query->where('fbsdp_status', 'Pending');
        })->get();

    $approvedUnionEvents = Event::with('FacultyUnionEventApproval')
        ->whereHas('FacultyUnionEventApproval', function ($query) {
            $query->where('fbsdp_status', 'Approved');
        })->get();

    $rejectedUnionEvents = Event::with('FacultyUnionEventApproval')
        ->whereHas('FacultyUnionEventApproval', function ($query) {
            $query->where('fbsdp_status', 'Rejected');
        })->get();

    $allUnionEventApprovals = FacultyUnionEventApproval::with('event')->get();

        $pendingBatchEvents = Event::with('FacultyBatchEventApproval')
        ->whereHas('FacultyBatchEventApproval', function ($query) {
            $query->where('fbsdp_status', 'Pending');
        })->get();

    $approvedBatchEvents = Event::with('FacultyBatchEventApproval')
        ->whereHas('FacultyBatchEventApproval', function ($query) {
            $query->where('fbsdp_status', 'Approved');
        })->get();

    $rejectedBatchEvents = Event::with('FacultyBatchEventApproval')
        ->whereHas('FacultyBatchEventApproval', function ($query) {
            $query->where('fbsdp_status', 'Rejected');
        })->get();

    $allBatchEventApprovals = FacultyBatchEventApproval::with('event')->get();

        return view('Users.fbs_dp', compact(
            'pendingUnionEvents',
            'approvedUnionEvents',
            'rejectedUnionEvents',
            'allUnionEventApprovals',
            'pendingBatchEvents',
            'approvedBatchEvents',
            'rejectedBatchEvents',
            'allBatchEventApprovals',
        ));
    }

    public function FBSDPUnionAccept($id)
    {
        $approval = FacultyUnionEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fbsdp_status = 'Approved';
            $approval->marshall_status = 'Pending';
            $approval->save();
        }

        return redirect()->back()->with('success', 'Request accepted.');
    }


    public function FBSDPUnionReject(Request $request, $id)
    {
        $approval = FacultyUnionEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fbsdp_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->rejection_reason = $request->input('reason'); // Save the reason
            $approval->save();

            // Automatically update the related Event status
            $this->updateUnion_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected with reason.');
    }

    public function FBSDPBatchAccept($id)
    {
        $approval = FacultyBatchEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fbsdp_status = 'Approved';
            $approval->marshall_status = 'Pending';
            $approval->save();
        }

        return redirect()->back()->with('success', 'Request accepted.');
    }


    public function FBSDPBatchReject(Request $request, $id)
    {
        $approval = FacultyBatchEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fbsdp_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->rejection_reason = $request->input('reason'); // Save the reason
            $approval->save();

            // Automatically update the related Event status
            $this->updateBatch_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected with reason.');
    }




//FTS Deputy proctor
    public function showPendingFTSDPRequests()
    {
    $pendingUnionEvents = Event::with('FacultyUnionEventApproval')
        ->whereHas('FacultyUnionEventApproval', function ($query) {
            $query->where('ftsdp_status', 'Pending');
        })->get();

    $approvedUnionEvents = Event::with('FacultyUnionEventApproval')
        ->whereHas('FacultyUnionEventApproval', function ($query) {
            $query->where('ftsdp_status', 'Approved');
        })->get();

    $rejectedUnionEvents = Event::with('FacultyUnionEventApproval')
        ->whereHas('FacultyUnionEventApproval', function ($query) {
            $query->where('ftsdp_status', 'Rejected');
        })->get();

    $allUnionEventApprovals = FacultyUnionEventApproval::with('event')->get();

        $pendingBatchEvents = Event::with('FacultyBatchEventApproval')
        ->whereHas('FacultyBatchEventApproval', function ($query) {
            $query->where('ftsdp_status', 'Pending');
        })->get();

    $approvedBatchEvents = Event::with('FacultyBatchEventApproval')
        ->whereHas('FacultyBatchEventApproval', function ($query) {
            $query->where('ftsdp_status', 'Approved');
        })->get();

    $rejectedBatchEvents = Event::with('FacultyBatchEventApproval')
        ->whereHas('FacultyBatchEventApproval', function ($query) {
            $query->where('ftsdp_status', 'Rejected');
        })->get();

    $allBatchEventApprovals = FacultyBatchEventApproval::with('event')->get();

        return view('Users.fts_dp', compact(
            'pendingUnionEvents',
            'approvedUnionEvents',
            'rejectedUnionEvents',
            'allUnionEventApprovals',
            'pendingBatchEvents',
            'approvedBatchEvents',
            'rejectedBatchEvents',
            'allBatchEventApprovals',
        ));
    }

    public function FTSDPUnionAccept($id)
    {
        $approval = FacultyUnionEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->ftsdp_status = 'Approved';
            $approval->marshall_status = 'Pending';
            $approval->save();
        }

        return redirect()->back()->with('success', 'Request accepted.');
    }


    public function FTSDPUnionReject(Request $request, $id)
    {
        $approval = FacultyUnionEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->ftsdp_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->rejection_reason = $request->input('reason'); // Save the reason
            $approval->save();

            // Automatically update the related Event status
            $this->updateUnion_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected with reason.');
    }

    public function FTSDPBatchAccept($id)
    {
        $approval = FacultyBatchEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->ftsdp_status = 'Approved';
            $approval->marshall_status = 'Pending';
            $approval->save();
        }

        return redirect()->back()->with('success', 'Request accepted.');
    }


    public function FTSDPBatchReject(Request $request, $id)
    {
        $approval = FacultyBatchEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->ftsdp_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->rejection_reason = $request->input('reason'); // Save the reason
            $approval->save();

            // Automatically update the related Event status
            $this->updateBatch_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected with reason.');
    }


    // FAS DEAN 
        public function showPendingFASDeanRequests()
    {
    $pendingUnionEvents = Event::with('FacultyUnionEventApproval')
        ->whereHas('FacultyUnionEventApproval', function ($query) {
            $query->where('fasdean_status', 'Pending');
        })->get();

    $approvedUnionEvents = Event::with('FacultyUnionEventApproval')
        ->whereHas('FacultyUnionEventApproval', function ($query) {
            $query->where('fasdean_status', 'Approved');
        })->get();

    $rejectedUnionEvents = Event::with('FacultyUnionEventApproval')
        ->whereHas('FacultyUnionEventApproval', function ($query) {
            $query->where('fasdean_status', 'Rejected');
        })->get();

    $allUnionEventApprovals = FacultyUnionEventApproval::with('event')->get();


    $pendingUnionEvents = Event::with('FacultyUnionEventApproval')
        ->whereHas('FacultyUnionEventApproval', function ($query) {
            $query->where('fasdean_status', 'Pending');
        })->get();

    $approvedUnionEvents = Event::with('FacultyUnionEventApproval')
        ->whereHas('FacultyUnionEventApproval', function ($query) {
            $query->where('fasdean_status', 'Approved');
        })->get();

    $rejectedUnionEvents = Event::with('FacultyUnionEventApproval')
        ->whereHas('FacultyUnionEventApproval', function ($query) {
            $query->where('fasdean_status', 'Rejected');
        })->get();

    $allUnionEventApprovals = FacultyUnionEventApproval::with('event')->get();





    $pendingBatchEvents = Event::with('FacultyBatchEventApproval')
        ->whereHas('FacultyBatchEventApproval', function ($query) {
            $query->where('fasdean_status', 'Pending');
        })->get();

    $approvedBatchEvents = Event::with('FacultyBatchEventApproval')
        ->whereHas('FacultyBatchEventApproval', function ($query) {
            $query->where('fasdean_status', 'Approved');
        })->get();

    $rejectedBatchEvents = Event::with('FacultyBatchEventApproval')
        ->whereHas('FacultyBatchEventApproval', function ($query) {
            $query->where('fasdean_status', 'Rejected');
        })->get();

    $allBatchEventApprovals = FacultyBatchEventApproval::with('event')->get();

        $pendingSocietyEvents = Event::with('FacultySocietyEventApproval')
        ->whereHas('FacultySocietyEventApproval', function ($query) {
            $query->where('fasdean_status', 'Pending');
        })->get();

    $approvedSocietyEvents = Event::with('FacultySocietyEventApproval')
        ->whereHas('FacultySocietyEventApproval', function ($query) {
            $query->where('fasdean_status', 'Approved');
        })->get();

    $rejectedSocietyEvents = Event::with('FacultySocietyEventApproval')
        ->whereHas('FacultySocietyEventApproval', function ($query) {
            $query->where('fasdean_status', 'Rejected');
        })->get();

    $allSocietyEventApprovals = FacultySocietyEventApproval::with('event')->get();


        return view('Users.fas_dean', compact(
            'pendingUnionEvents',
            'approvedUnionEvents',
            'rejectedUnionEvents',
            'allUnionEventApprovals',          
    'pendingSocietyEvents',
        'approvedSocietyEvents',
        'rejectedSocietyEvents',
        'allSocietyEventApprovals',
            'pendingBatchEvents',
            'approvedBatchEvents',
            'rejectedBatchEvents',
            'allBatchEventApprovals',
        ));
    }

    public function FASDeanUnionAccept($id)
    {
        $approval = FacultyUnionEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fasdean_status = 'Approved';
            $approval->final_status = 'Approved';
            $approval->save();

            $this->updateUnion_event($id);
        }

        return redirect()->back()->with('success', 'Request accepted.');
    }


    public function FASDeanUnionReject(Request $request, $id)
    {
        $approval = FacultyUnionEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fasdean_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->rejection_reason = $request->input('reason'); // Save the reason
            $approval->save();

            // Automatically update the related Event status
            $this->updateUnion_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected with reason.');
    }



        public function FASDeanBatchAccept($id)
    {
        $approval = FacultyBatchEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fasdean_status = 'Approved';
            $approval->final_status = 'Approved';
            $approval->save();

            $this->updateBatch_event($id);
        }

        return redirect()->back()->with('success', 'Request accepted.');
    }


    public function FASDeanBatchReject(Request $request, $id)
    {
        $approval = FacultyBatchEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fasdean_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->rejection_reason = $request->input('reason'); // Save the reason
            $approval->save();

            // Automatically update the related Event status
            $this->updateBatch_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected with reason.');
    }


           public function FASDeanSocietyAccept($id)
    {
        $approval = FacultySocietyEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fasdean_status = 'Approved';
            $approval->final_status = 'Approved';
            $approval->save();

            $this->updateSociety_event($id);
        }

        return redirect()->back()->with('success', 'Request accepted.');
    }


    public function FASDeanSocietyReject(Request $request, $id)
    {
        $approval = FacultySocietyEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fasdean_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->rejection_reason = $request->input('reason'); // Save the reason
            $approval->save();

            // Automatically update the related Event status
            $this->updateSociety_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected with reason.');
    }



    // FBS DEAN 
        public function showPendingFBSDeanRequests()
    {
    $pendingUnionEvents = Event::with('FacultyUnionEventApproval')
        ->whereHas('FacultyUnionEventApproval', function ($query) {
            $query->where('fbsdean_status', 'Pending');
        })->get();

    $approvedUnionEvents = Event::with('FacultyUnionEventApproval')
        ->whereHas('FacultyUnionEventApproval', function ($query) {
            $query->where('fbsdean_status', 'Approved');
        })->get();

    $rejectedUnionEvents = Event::with('FacultyUnionEventApproval')
        ->whereHas('FacultyUnionEventApproval', function ($query) {
            $query->where('fbsdean_status', 'Rejected');
        })->get();

    $allUnionEventApprovals = FacultyUnionEventApproval::with('event')->get();

 $pendingBatchEvents = Event::with('FacultyBatchEventApproval')
        ->whereHas('FacultyBatchEventApproval', function ($query) {
            $query->where('fbsdean_status', 'Pending');
        })->get();

    $approvedBatchEvents = Event::with('FacultyBatchEventApproval')
        ->whereHas('FacultyBatchEventApproval', function ($query) {
            $query->where('fbsdean_status', 'Approved');
        })->get();

    $rejectedBatchEvents = Event::with('FacultyBatchEventApproval')
        ->whereHas('FacultyBatchEventApproval', function ($query) {
            $query->where('fbsdean_status', 'Rejected');
        })->get();

    $allBatchEventApprovals = FacultyBatchEventApproval::with('event')->get();

 $pendingSocietyEvents = Event::with('FacultySocietyEventApproval')
        ->whereHas('FacultySocietyEventApproval', function ($query) {
            $query->where('fbsdean_status', 'Pending');
        })->get();

    $approvedSocietyEvents = Event::with('FacultySocietyEventApproval')
        ->whereHas('FacultySocietyEventApproval', function ($query) {
            $query->where('fbsdean_status', 'Approved');
        })->get();

    $rejectedSocietyEvents = Event::with('FacultySocietyEventApproval')
        ->whereHas('FacultySocietyEventApproval', function ($query) {
            $query->where('fbsdean_status', 'Rejected');
        })->get();

    $allSocietyEventApprovals = FacultySocietyEventApproval::with('event')->get();


        return view('Users.fbs_dean', compact(
            'pendingUnionEvents',
            'approvedUnionEvents',
            'rejectedUnionEvents',
            'allUnionEventApprovals',          
    'pendingSocietyEvents',
        'approvedSocietyEvents',
        'rejectedSocietyEvents',
        'allSocietyEventApprovals',
            'pendingBatchEvents',
            'approvedBatchEvents',
            'rejectedBatchEvents',
            'allBatchEventApprovals',
        ));
    }

    public function FBSDeanUnionAccept($id)
    {
        $approval = FacultyUnionEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fbsdean_status = 'Approved';
            $approval->final_status = 'Approved';
            $approval->save();

            $this->updateUnion_event($id);
        }

        return redirect()->back()->with('success', 'Request accepted.');
    }


    public function FBSDeanUnionReject(Request $request, $id)
    {
        $approval = FacultyUnionEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fbsdean_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->rejection_reason = $request->input('reason'); // Save the reason
            $approval->save();

            // Automatically update the related Event status
            $this->updateUnion_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected with reason.');
    }

    public function FBSDeanBatchAccept($id)
    {
        $approval = FacultyBatchEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fbsdean_status = 'Approved';
            $approval->final_status = 'Approved';
            $approval->save();

            $this->updateBatch_event($id);
        }

        return redirect()->back()->with('success', 'Request accepted.');
    }


    public function FBSDeanBatchReject(Request $request, $id)
    {
        $approval = FacultyBatchEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fbsdean_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->rejection_reason = $request->input('reason'); // Save the reason
            $approval->save();

            // Automatically update the related Event status
            $this->updateBatch_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected with reason.');
    }

               public function FBSDeanSocietyAccept($id)
    {
        $approval = FacultySocietyEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fbsdean_status = 'Approved';
            $approval->final_status = 'Approved';
            $approval->save();

            $this->updateSociety_event($id);
        }

        return redirect()->back()->with('success', 'Request accepted.');
    }


    public function FBSDeanSocietyReject(Request $request, $id)
    {
        $approval = FacultySocietyEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fbsdean_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->rejection_reason = $request->input('reason'); // Save the reason
            $approval->save();

            // Automatically update the related Event status
            $this->updateSociety_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected with reason.');
    }


    // FTS DEAN 
        public function showPendingFTSDeanRequests()
    {
    $pendingUnionEvents = Event::with('FacultyUnionEventApproval')
        ->whereHas('FacultyUnionEventApproval', function ($query) {
            $query->where('ftsdean_status', 'Pending');
        })->get();

    $approvedUnionEvents = Event::with('FacultyUnionEventApproval')
        ->whereHas('FacultyUnionEventApproval', function ($query) {
            $query->where('ftsdean_status', 'Approved');
        })->get();

    $rejectedUnionEvents = Event::with('FacultyUnionEventApproval')
        ->whereHas('FacultyUnionEventApproval', function ($query) {
            $query->where('ftsdean_status', 'Rejected');
        })->get();

    $allUnionEventApprovals = FacultyUnionEventApproval::with('event')->get();

    $pendingBatchEvents = Event::with('FacultyBatchEventApproval')
        ->whereHas('FacultyBatchEventApproval', function ($query) {
            $query->where('ftsdean_status', 'Pending');
        })->get();

    $approvedBatchEvents = Event::with('FacultyBatchEventApproval')
        ->whereHas('FacultyBatchEventApproval', function ($query) {
            $query->where('ftsdean_status', 'Approved');
        })->get();

    $rejectedBatchEvents = Event::with('FacultyBatchEventApproval')
        ->whereHas('FacultyBatchEventApproval', function ($query) {
            $query->where('ftsdean_status', 'Rejected');
        })->get();

    $allBatchEventApprovals = FacultyBatchEventApproval::with('event')->get();

 $pendingSocietyEvents = Event::with('FacultySocietyEventApproval')
        ->whereHas('FacultySocietyEventApproval', function ($query) {
            $query->where('ftsdean_status', 'Pending');
        })->get();

    $approvedSocietyEvents = Event::with('FacultySocietyEventApproval')
        ->whereHas('FacultySocietyEventApproval', function ($query) {
            $query->where('ftsdean_status', 'Approved');
        })->get();

    $rejectedSocietyEvents = Event::with('FacultySocietyEventApproval')
        ->whereHas('FacultySocietyEventApproval', function ($query) {
            $query->where('ftsdean_status', 'Rejected');
        })->get();

    $allSocietyEventApprovals = FacultySocietyEventApproval::with('event')->get();


        return view('Users.fts_dean', compact(
            'pendingUnionEvents',
            'approvedUnionEvents',
            'rejectedUnionEvents',
            'allUnionEventApprovals',          
    'pendingSocietyEvents',
        'approvedSocietyEvents',
        'rejectedSocietyEvents',
        'allSocietyEventApprovals',
            'pendingBatchEvents',
            'approvedBatchEvents',
            'rejectedBatchEvents',
            'allBatchEventApprovals',
        ));
    }

    public function FTSDeanUnionAccept($id)
    {
        $approval = FacultyUnionEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->ftsdean_status = 'Approved';
            $approval->final_status = 'Approved';
            $approval->save();

            $this->updateUnion_event($id);
        }

        return redirect()->back()->with('success', 'Request accepted.');
    }


    public function FTSDeanUnionReject(Request $request, $id)
    {
        $approval = FacultyUnionEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->ftsdean_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->rejection_reason = $request->input('reason'); // Save the reason
            $approval->save();

            // Automatically update the related Event status
            $this->updateUnion_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected with reason.');
    }

    public function FTSDeanBatchAccept($id)
    {
        $approval = FacultyBatchEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->ftsdean_status = 'Approved';
            $approval->final_status = 'Approved';
            $approval->save();

            $this->updateBatch_event($id);
        }

        return redirect()->back()->with('success', 'Request accepted.');
    }


    public function FTSDeanBatchReject(Request $request, $id)
    {
        $approval = FacultyBatchEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->ftsdean_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->rejection_reason = $request->input('reason'); // Save the reason
            $approval->save();

            // Automatically update the related Event status
            $this->updateBatch_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected with reason.');
    }

    public function FTSDeanSocietyAccept($id)
    {
        $approval = FacultySocietyEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->ftsdean_status = 'Approved';
            $approval->final_status = 'Approved';
            $approval->save();

            $this->updateSociety_event($id);
        }

        return redirect()->back()->with('success', 'Request accepted.');
    }


    public function FTSDeanSocietyReject(Request $request, $id)
    {
        $approval = FacultySocietyEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->ftsdean_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->rejection_reason = $request->input('reason'); // Save the reason
            $approval->save();

            // Automatically update the related Event status
            $this->updateSociety_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected with reason.');
    }














// For FAS HOD 
   public function showPendingFASHODRequests()
{

    $pendingSocietyEvents = Event::with('FacultySocietyEventApproval')
        ->whereHas('FacultySocietyEventApproval', function ($query) {
            $query->where('fashod_status', 'Pending');
        })->get();

    $approvedSocietyEvents = Event::with('FacultySocietyEventApproval')
        ->whereHas('FacultySocietyEventApproval', function ($query) {
            $query->where('fashod_status', 'Approved');
        })->get();

    $rejectedSocietyEvents = Event::with('FacultySocietyEventApproval')
        ->whereHas('FacultySocietyEventApproval', function ($query) {
            $query->where('fashod_status', 'Rejected');
        })->get();

    $allSocietyEventApprovals = FacultySocietyEventApproval::with('event')->get();
    return view('Users.fas_hod', compact(

        'pendingSocietyEvents',
        'approvedSocietyEvents',
        'rejectedSocietyEvents',
        'allSocietyEventApprovals',
    ));
}
    public function FASHODSocietyAccept($id)
    {
        $approval = FacultySocietyEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fashod_status = 'Approved';
            $approval->fasdean_status = 'Pending';
            $approval->save();
        }

        return redirect()->back()->with('success', 'Request accepted.');
    }


    public function FASHODSocietyReject(Request $request, $id)
    {
        $approval = FacultySocietyEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fashod_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->rejection_reason = $request->input('reason'); // Save the reason
            $approval->save();

            // Automatically update the related Event status
            $this->updateSociety_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected with reason.');
    }

// For FBS HOD 
   public function showPendingFBSHODRequests()
{

    $pendingSocietyEvents = Event::with('FacultySocietyEventApproval')
        ->whereHas('FacultySocietyEventApproval', function ($query) {
            $query->where('fbshod_status', 'Pending');
        })->get();

    $approvedSocietyEvents = Event::with('FacultySocietyEventApproval')
        ->whereHas('FacultySocietyEventApproval', function ($query) {
            $query->where('fbshod_status', 'Approved');
        })->get();

    $rejectedSocietyEvents = Event::with('FacultySocietyEventApproval')
        ->whereHas('FacultySocietyEventApproval', function ($query) {
            $query->where('fbshod_status', 'Rejected');
        })->get();

    $allSocietyEventApprovals = FacultySocietyEventApproval::with('event')->get();
    return view('Users.fbs_hod', compact(

        'pendingSocietyEvents',
        'approvedSocietyEvents',
        'rejectedSocietyEvents',
        'allSocietyEventApprovals',
    ));
}
    public function FBSHODSocietyAccept($id)
    {
        $approval = FacultySocietyEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fbshod_status = 'Approved';
            $approval->fbsdean_status = 'Pending';
            $approval->save();
        }

        return redirect()->back()->with('success', 'Request accepted.');
    }


    public function FBSHODSocietyReject(Request $request, $id)
    {
        $approval = FacultySocietyEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->fbshod_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->rejection_reason = $request->input('reason'); // Save the reason
            $approval->save();

            // Automatically update the related Event status
            $this->updateSociety_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected with reason.');
    }

    // For FBS HOD 
   public function showPendingFTSHODRequests()
{

    $pendingSocietyEvents = Event::with('FacultySocietyEventApproval')
        ->whereHas('FacultySocietyEventApproval', function ($query) {
            $query->where('ftshod_status', 'Pending');
        })->get();

    $approvedSocietyEvents = Event::with('FacultySocietyEventApproval')
        ->whereHas('FacultySocietyEventApproval', function ($query) {
            $query->where('ftshod_status', 'Approved');
        })->get();

    $rejectedSocietyEvents = Event::with('FacultySocietyEventApproval')
        ->whereHas('FacultySocietyEventApproval', function ($query) {
            $query->where('ftshod_status', 'Rejected');
        })->get();

    $allSocietyEventApprovals = FacultySocietyEventApproval::with('event')->get();
    return view('Users.fts_hod', compact(

        'pendingSocietyEvents',
        'approvedSocietyEvents',
        'rejectedSocietyEvents',
        'allSocietyEventApprovals',
    ));
}
    public function FTSHODSocietyAccept($id)
    {
        $approval = FacultySocietyEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->ftshod_status = 'Approved';
            $approval->ftsdean_status = 'Pending';
            $approval->save();
        }

        return redirect()->back()->with('success', 'Request accepted.');
    }


    public function FTSHODSocietyReject(Request $request, $id)
    {
        $approval = FacultySocietyEventApproval::where('event_id', $id)->first();

        if ($approval) {
            $approval->ftshod_status = 'Rejected';
            $approval->final_status = 'Rejected';
            $approval->rejection_reason = $request->input('reason'); // Save the reason
            $approval->save();

            // Automatically update the related Event status
            $this->updateSociety_event($id);
        }

        return redirect()->back()->with('error', 'Request rejected with reason.');
    }





















}