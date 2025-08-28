<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\UniversityEventApproval;
use Carbon\Carbon;
use App\Models\FacultySocietyEventApproval;
use App\Models\FacultyUnionEventApproval;
use App\Models\FacultyBatchEventApproval;


class EventController extends Controller
{
    public function schedule()
    {
        return view('Schedulers.schedule_event');
    }

    // public function home()
    // {
    //     $today = Carbon::today()->toDateString(); // "2025-05-15"
    //     //$eventCount = Event::whereDate('date', $today)->count();
    //     $eventCount = Event::whereDate('date', $today)->where('status', 'accepted')->count();

    //     return view('welcome', compact('today', 'eventCount'));
    // }

//     public function home()
// {
//     $today = Carbon::today()->toDateString();
//     $eventCount = Event::whereDate('date', $today)->where('status', 'accepted')->count();

//     // Get current month date range
//     $startOfMonth = Carbon::today()->startOfMonth();
//     $endOfMonth = Carbon::today()->endOfMonth();

//     // Get all accepted event dates in this month
//     $eventDates = Event::whereBetween('date', [$startOfMonth, $endOfMonth])
//                     ->where('status', 'accepted')
//                     ->pluck('date')
//                     ->map(function ($date) {
//                         return \Carbon\Carbon::parse($date)->format('Y-m-d');
//                     })
//                     ->toArray();

//     return view('welcome', compact('today', 'eventCount', 'eventDates'));
// }

// public function home()
// {
//     $today = Carbon::today()->toDateString();
//     $eventCount = Event::whereDate('date', $today)->where('status', 'accepted')->count();

//     // Get current year range
//     $startOfYear = Carbon::today()->startOfYear();
//     $endOfYear = Carbon::today()->endOfYear();

//     // Get all accepted events in the year
//     $events = Event::whereBetween('date', [$startOfYear, $endOfYear])
//                 ->where('status', 'accepted')
//                 ->select('date', 'event_name')
//                 ->get();

//     // Extract dates for quick lookup
//     $eventDates = $events->pluck('date')->map(function ($date) {
//         return \Carbon\Carbon::parse($date)->format('Y-m-d');
//     })->toArray();

//     // Group event names by date
//     $eventMap = [];
//     foreach ($events as $event) {
//         $formattedDate = \Carbon\Carbon::parse($event->date)->format('Y-m-d');
//         if (!isset($eventMap[$formattedDate])) {
//             $eventMap[$formattedDate] = [];
//         }
//         $eventMap[$formattedDate][] = $event->event_name;
//     }

//     return view('welcome', compact('today', 'eventCount', 'eventDates', 'eventMap'));
// }

// public function home()
// {
//     $today = Carbon::today()->toDateString();

//     // Count today's accepted events
//     $eventCount = Event::whereDate('date', $today)
//         ->where('status', 'accepted')
//         ->count();

//     // Define the year range
//     $startOfYear = Carbon::now()->startOfYear();
//     $endOfYear = Carbon::now()->endOfYear();

//     // Fetch accepted events in the year
//     $events = Event::whereBetween('date', [$startOfYear, $endOfYear])
//         ->where('status', 'accepted')
//         ->select('date', 'event_name')
//         ->get();

//     // Initialize map and date list
//     // $eventMap = [];
    
//     // foreach ($events as $event) {
//     //     $formattedDate = Carbon::parse($event->date)->format('Y-m-d');
//     //     $eventMap[$formattedDate][] = $event->event_name;
//     // }

//     $eventMap = [];

// foreach ($events as $event) {
//     $dateKey = \Carbon\Carbon::parse($event->date)->format('Y-m-d');
//     $eventMap[$dateKey][] = $event; // Group events by date
// }


//     // Ensure eventDates is synced with eventMap keys
//     $eventDates = array_keys($eventMap);

//     return view('welcome', compact('today', 'eventCount', 'eventDates', 'eventMap'));
// }

public function home()
{
    $today = Carbon::today()->toDateString();

    // Count today's accepted events
    $eventCount = Event::whereDate('date', $today)
        ->where('status', 'accepted')
        ->count();

    // Define the year range
    $startOfYear = Carbon::now()->startOfYear();
    $endOfYear = Carbon::now()->endOfYear();

    // Fetch accepted events in the year with all necessary fields
    $events = Event::whereBetween('date', [$startOfYear, $endOfYear])
        ->where('status', 'accepted')
        ->get();  // <-- get all fields, no select clause limiting fields

    // Group events by date
    $eventMap = [];
    foreach ($events as $event) {
        $dateKey = \Carbon\Carbon::parse($event->date)->format('Y-m-d');
        $eventMap[$dateKey][] = $event;
    }

    // Get all event dates (keys)
    $eventDates = array_keys($eventMap);

    return view('welcome', compact('today', 'eventCount', 'eventDates', 'eventMap'));
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
        // Get all approvals indexed by event_id
        $approval_statuses = UniversityEventApproval::all()->keyBy('event_id');
        $approval_Societystatuses = FacultySocietyEventApproval::all()->keyBy('event_id');
        $approval_Unionstatuses = FacultyUnionEventApproval::all()->keyBy('event_id');
        $approval_Batchstatuses = FacultyBatchEventApproval::all()->keyBy('event_id');
        return view('scheduled_events', compact('events','approval_statuses', 'approval_Societystatuses', 'approval_Unionstatuses', 'approval_Batchstatuses'));
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