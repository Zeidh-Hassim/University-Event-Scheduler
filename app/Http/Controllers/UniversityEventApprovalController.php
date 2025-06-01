<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\UniversityEventApproval;
use Illuminate\Http\Request;

class UniversityEventApprovalController extends Controller
{
    // For Assistant Registrar 
    public function showPendingARRequests()
    {
        $pendingEvents = Event::whereHas('universityEventApproval', function ($query) {
            $query->where('ar_status', 'Pending');
        })->get();

        return view('University_Level.ar', compact('pendingEvents'));
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

        return view('University_Level.marshall', compact('pendingEvents'));
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

        return view('University_Level.proctor', compact('pendingEvents'));
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

        return view('University_Level.vice_chancellor', compact('pendingEvents'));
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



}
