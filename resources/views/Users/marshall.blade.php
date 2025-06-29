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

<h1 class="text-center mb-3 text-white">Marshall</h1>

<div class="container mt-5">
    <h4 class="text-white">Pending Requests</h4>

     @if($pendingEvents->isEmpty())
        <p class="text-center text-white">No Pending Events Available.</p>
    @else
        @foreach($pendingEvents as $event)
        <div class="card mb-3 p-3 d-flex flex-row justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div>
                    <h6 class="mb-0">{{ $event->event_name }} ({{ $event->society }})</h6>
                    <small class="text-muted">{{ $event->person_id }} wants to book {{ $event->venue }} on {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }} : {{ \Carbon\Carbon::parse($event->end_time)->format('g:i A') }}</small>
                </div>
            </div>
            <div>
                <form action="{{ route('marshall.accept', $event->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-success btn-sm me-2">Accept</button>
                </form>

                <form action="{{ route('marshall.reject', $event->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-danger btn-sm">Reject</button>
                </form>
            </div>
        </div>
        @endforeach
    @endif
</div>





<div class="container mt-5">
    <h4 class="text-white">University Level Union/Society Approved Requests</h4>

    @if($approvedEvents->isEmpty())
        <p class="text-center text-white">No Approved Events Available.</p>
    @else
        @foreach($approvedEvents as $event)
        <div class="card mb-3 p-3 d-flex flex-row justify-content-between align-items-center">
           <div class="d-flex align-items-center">
                <div>
                    <h6 class="mb-0">{{ $event->event_name }} organized by {{ $event->society }}</h6>
                    <small class="text-muted">{{ $event->applicant }} wants to book {{ $event->venue }} on {{ $event->date }} at {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }} : {{ \Carbon\Carbon::parse($event->end_time)->format('g:i A') }} </small>
                </div>
            </div>
            {{-- <div>
                <form action="{{ route('fasar.accept', $event->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-success btn-sm me-2">Accept</button>
                </form>

                <form action="{{ route('fasar.reject', $event->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-danger btn-sm">Reject</button>
                </form>
            </div> --}}
        </div>
        @endforeach
    @endif
</div>

<div class="container mt-5">
    <h4 class="text-white">University Level Union/Society Rejected Requests</h4>

    @if($rejectedEvents->isEmpty())
        <p class="text-center text-white">No Rejected Events Available.</p>
    @else
        @foreach($rejectedEvents as $event)
        <div class="card mb-3 p-3 d-flex flex-row justify-content-between align-items-center">
           <div class="d-flex align-items-center">
                <div>
                    <h6 class="mb-0">{{ $event->event_name }} organized by {{ $event->society }}</h6>
                    <small class="text-muted">{{ $event->applicant }}'s booking {{ $event->venue }} on {{ $event->date }} at {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }} : {{ \Carbon\Carbon::parse($event->end_time)->format('g:i A') }} is rejected</small>
                </div>
            </div>
            {{-- <div>
                <form action="{{ route('fasar.accept', $event->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-success btn-sm me-2">Accept</button>
                </form>

                <form action="{{ route('fasar.reject', $event->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-danger btn-sm">Reject</button>
                </form>
            </div> --}}
        </div>
        @endforeach
    @endif
</div>












<div class="text-center mt-5">
    <a href="{{route('home') }}" class="btn btn-secondary">Back</a>
</div>
