<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\UniversityEventApproval;
use Carbon\Carbon;


class EventController extends Controller
{
    public function schedule()
    {
        return view('Schedulers.schedule_event');
    }

    public function home()
    {
        $today = Carbon::today()->toDateString(); // "2025-05-15"
        //$eventCount = Event::whereDate('date', $today)->count();
        $eventCount = Event::whereDate('date', $today)->where('status', 'accepted')->count();

        return view('welcome', compact('today', 'eventCount'));
    }

        

    public function store(Request $request)
    {
        $request->validate([
            'event_name' => 'required|string',
            'society' => 'required|string',
            'date' => 'required|date',
            'venue' => 'required|string',
            'time' => 'required',
            'person_id' => 'required|string',
            'contact' => 'required|string',
            'email' => 'required|email',
            'reg_no' => 'required|string',
            'faculty' => 'required|string',
        ]);

        // Save event details in the database
        $event = Event::create($request->all());

        UniversityEventApproval::create([
        'event_id' => $event->id,
        // other default approval statuses will be defaulted by DB
        ]);

        // Flash success message to session
        //return redirect()->route('sheduler')->with('success', 'Event successfully saved!');

        // Generate PDF
        $pdf = Pdf::loadView('pdf.event_details', compact('event'));

        // Return PDF for download
        return $pdf->download('event_details.pdf');
    }

        public function scheduledEvents()
    {
        $events = Event::all(); // or filtered/sorted
        return view('scheduled_events', compact('events'));
    }

    public function showSchedule(Request $request)
    {
        $status = $request->query('status'); // get filter from dropdown

        $events = Event::when($status && $status !== 'all', function ($query) use ($status) {
            $query->where('status', $status);
        })->get();

        return view('scheduled_events', compact('events', 'status'));
    }

}