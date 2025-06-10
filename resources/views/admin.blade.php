@extends('nav.navbar')

<style>
    a.btn.custom {
        background-color: white !important;
        color: black !important;
        padding: 15px 30px !important;
        font-size: 18px !important;
        border: none !important;
        cursor: pointer;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
    }

    a.btn.custom:hover {
        background-color: lightgray !important;
    }
</style>

<h1 class="text-center mb-3 text-white">Administrator</h1>

{{-- Display Pending Requests --}}
<div class="container mt-5">
    <h3 class="text-center mb-3 text-white">Pending Requests</h3>

    @php
        $showAll = request()->has('show_all');
        $eventsToShow = $showAll ? $pendingEvents : $pendingEvents->take(5);
    @endphp

    @if($eventsToShow->isEmpty())
        <p class="text-center text-white">No Pending Events Available.</p>
    @else
        @foreach($eventsToShow as $event)
            <div class="card mb-3 p-3 d-flex flex-row justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">{{ $event->event_name }} ({{ $event->society }})</h6>
                        <small class="text-muted">{{ $event->person_id }} wants to book {{ $event->venue }} on {{ $event->date }} at {{ $event->time }}</small>
                    </div>
                </div>
                <div>
                    <form action="{{ route('admin.accept', $event->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-success btn-sm me-2">Accept</button>
                    </form>

                    <form action="{{ route('admin.reject', $event->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-danger btn-sm">Reject</button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif

    {{-- Show More / Show Less Button --}}
    @if($pendingEvents->count() > 5)
        <div class="text-center mt-3">
            @if($showAll)
                <a href="{{ route('admin') }}" class="btn btn-secondary">Show Less</a>
            @else
                <a href="{{ route('admin', ['show_all' => 1]) }}" class="btn btn-secondary">Show All</a>
            @endif
        </div>
    @endif
</div>


{{-- Display All Faculties --}}
<div class="container mt-5">
    
    <h3 class="text-center mb-3 text-white">Faculties</h3>

    @if($faculties->isEmpty())
        <p>No faculties available.</p>
    @else
        @foreach($faculties as $faculty)
            <div class="card mb-3 p-3 d-flex flex-row justify-content-between align-items-center">
                <div>
                    <h6 class="mb-1">{{ $faculty->name }}</h6>
                    <small class="text-muted">Code: {{ $faculty->code }}</small>
                </div>
                <div>
                    <form action="{{ route('faculties.destroy', $faculty->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif

    {{-- Add Faculty Form --}}
    <div class="card mt-4 p-4">
        <h5 class="text-center mb-3 text-black">Add New Faculty</h5>
        <form action="{{ route('faculties.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Faculty Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="code" class="form-label">Faculty Code</label>
                <input type="text" name="code" id="code" class="form-control" required>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Add Faculty</button>
            </div>
        </form>
    </div>
</div>


{{-- Display All Venues --}}
<div class="container mt-5">
    <h3 class="text-center mb-3 text-white">Venues</h3>

    @php
        $showAllVenues = request()->has('show_all_venues');
        $venuesToShow = $showAllVenues ? $venues : $venues->take(5);
    @endphp

    @if($venues->isEmpty())
        <p>No Venues available.</p>
    @else
        @foreach($venuesToShow as $venue)
            <div class="card mb-3 p-3 d-flex flex-row justify-content-between align-items-center">
                <div>
                    <h6 class="mb-1">{{ $venue->name }}</h6>
                    <small class="text-muted">Faculty: {{ $venue->faculty }}</small>
                </div>
                <div>
                    <form action="{{ route('venues.destroy', $venue->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach

        {{-- Show All / Show Less Button --}}
        <div class="text-center mt-3">
            @if($venues->count() > 5)
                @if($showAllVenues)
                    <a href="{{ route('admin') }}" class="btn btn-secondary">Show Less</a>
                @else
                    <a href="{{ route('admin', ['show_all_venues' => 1]) }}" class="btn btn-secondary">Show All</a>
                @endif
            @endif
        </div>
    @endif



    {{-- Add Venue Form --}}
    <div class="card mt-4 p-4">
        <h5 class="text-center mb-3 text-black">Add New Venue</h5>
        <form action="{{ route('venues.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="FacultyCode" class="form-label">Faculty</label>
                <input type="text" name="FacultyCode" id="FacultyCode" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Venue Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="code" class="form-label">Venue Code</label>
                <input type="text" name="code" id="code" class="form-control" required>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Add Venue</button>
            </div>
        </form>
    </div>
</div>

{{-- Back Button --}}
<div class="text-center mt-5">
    <a href="{{ route('home') }}" class="btn btn-secondary">Back</a>
</div>
