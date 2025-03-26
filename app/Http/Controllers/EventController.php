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

        // Generate PDF
        $pdf = Pdf::loadView('pdf.event_details', compact('event'));

        // Return PDF for download
        return $pdf->download('event_details.pdf');
    }

}