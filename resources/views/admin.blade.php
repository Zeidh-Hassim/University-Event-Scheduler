@extends('nav.navbar')

<h1>Hello I am admin</h1>

<div class="container mt-5">
    <h4>Pending Requests</h4>

    @foreach($pendingEvents as $event)
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
</div>
