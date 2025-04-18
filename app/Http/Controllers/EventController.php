<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Event;


class EventController extends Controller
{
    public function index()
    {
        return view('schedule_event');
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

        // Flash success message to session
        return redirect()->route('sheduler')->with('success', 'Event successfully saved!');

        // Generate PDF
        //$pdf = Pdf::loadView('pdf.event_details', compact('event'));

        // Return PDF for download
        //return $pdf->download('event_details.pdf');
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