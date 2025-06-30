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

    html {
        scroll-behavior: smooth;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">Event Scheduler</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#university-level-union-society">University Level</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#faculty-union">Faculty Union</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#faculty-level-society">Faculty Level Society</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#faculty-level-batch">Faculty Level Batch</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<h1 class="text-center mb-3 text-white">FBS Assistant Registrar</h1>

<div class="container mt-5" id="university-level-union-society">
    <h3 class="text-center text-white">University Level Union/Society</h3>

    {{-- Pending Requests --}}
    <h4 class="text-white">Pending Requests</h4>
    @if($pendingEvents->isEmpty())
        <p class="text-center text-white">No Pending Events Available.</p>
    @else
        @foreach($pendingEvents as $event)
            <div class="card mb-3 p-3 d-flex flex-row justify-content-between align-items-center">
                <a href="#" class="event-detail-link text-decoration-none text-reset" data-bs-toggle="modal" data-bs-target="#eventModal{{ $event->id }}">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0 text-primary">{{ $event->event_name }} organized by {{ $event->society }}</h6>
                            <small class="text-muted">
                                {{ $event->applicant ?? $event->person_id }} wants to book {{ $event->venue }} on {{ $event->date }} at 
                                {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }} : 
                                {{ \Carbon\Carbon::parse($event->end_time)->format('g:i A') }}
                            </small>
                        </div>
                    </div>
                </a>
                <div>
                    {{-- <div> --}}
                    {!! renderImageButton($event->image_path) !!}
                    {{-- </div> --}}
                    <form action="{{ route('fbsar.accept', $event->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-success btn-sm me-2">Accept</button>
                    </form>
                    <form action="{{ route('fbsar.reject', $event->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $event->id }}">
                            Reject
                        </button>
                        <!-- Reject Modal (styled like eventModal) -->
                        <div class="modal fade" id="rejectModal{{ $event->id }}" tabindex="-1" aria-labelledby="rejectModalLabel{{ $event->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content text-dark">
                                    <div class="modal-header justify-content-center">
                                        <h5 class="modal-title" id="rejectModalLabel{{ $event->id }}">Reject {{ $event->event_name }}</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mt-4">
                                            <label for="reason{{ $event->id }}" class="form-label"><strong>Reason for Rejection</strong></label>
                                            <textarea class="form-control" id="reason{{ $event->id }}" name="reason" rows="3" required></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button type="submit" class="btn btn-danger">Submit Rejection</button>
                                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Event Modal  -->
            <div class="modal fade" id="eventModal{{ $event->id }}" tabindex="-1" aria-labelledby="eventModalLabel{{ $event->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content text-dark">
                        <div class="modal-header justify-content-center">
                            <h5 class="modal-title" id="eventModalLabel{{ $event->id }}">{{ $event->event_name }} Details</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row justify-content-center g-4">
                                <div class="card col-md-5 shadow-sm border-0 p-3" style="background-color: #f9f9f9;">
                                    <h6 class="text-primary mb-3 border-bottom pb-1">📅 Event Details</h6>
                                    <ul class="list-unstyled mb-0">
                                        <li><strong>Event Name:</strong> {{ $event->event_name }}</li>
                                        <li><strong>Organized by:</strong> {{ $event->society }}</li>
                                        <li><strong>Date:</strong> {{ $event->date }}</li>
                                        <li><strong>Time:</strong> {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }} – {{ \Carbon\Carbon::parse($event->end_time)->format('g:i A') }}</li>
                                        <li><strong>Venue:</strong> {{ $event->venue }}</li>
                                        <li><strong>Participants:</strong> {{ $event->participants ?? 'N/A' }}</li>
                                    </ul>
                                </div>
                                <div class="card col-md-5 shadow-sm border-0 p-3" style="background-color: #f9f9f9;">
                                    <h6 class="text-success mb-3 border-bottom pb-1">👤 Applicant Details</h6>
                                    <ul class="list-unstyled mb-0">
                                        <li><strong>Name:</strong> {{ $event->applicant ?? $event->person_id }}</li>
                                        <li><strong>Registration No:</strong> {{ $event->registration_number ?? $event->reg_no }}</li>
                                        <li><strong>Contact Number:</strong> {{ $event->contact ?? 'N/A' }}</li>
                                        <li><strong>Email:</strong> {{ $event->email ?? 'N/A' }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    {{-- Approved Requests --}}
    <h4 class="text-white mt-5">Approved Requests</h4>
    @if($approvedEvents->isEmpty())
        <p class="text-center text-white">No Approved Events Available.</p>
    @else
        @foreach($approvedEvents as $event)
            <div class="card mb-3 p-3 d-flex flex-row justify-content-between align-items-center">
                <a href="#" class="event-detail-link text-decoration-none" data-bs-toggle="modal" data-bs-target="#eventModalApproved{{ $event->id }}">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0 text-primary text-reset">{{ $event->event_name }} organized by {{ $event->society }}</h6>
                            <small class="text-muted">
                                {{ $event->applicant ?? $event->person_id }} wants to book {{ $event->venue }} on {{ $event->date }} at 
                                {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }} : 
                                {{ \Carbon\Carbon::parse($event->end_time)->format('g:i A') }}
                            </small>
                        </div>
                    </div>
                </a>
                <div>
                    {!! renderImageButton($event->image_path) !!}
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="eventModalApproved{{ $event->id }}" tabindex="-1" aria-labelledby="eventModalLabelApproved{{ $event->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content text-dark">
                        <div class="modal-header justify-content-center">
                            <h5 class="modal-title" id="eventModalLabelApproved{{ $event->id }}">{{ $event->event_name }} Details</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row justify-content-center g-4">
                                <div class="card col-md-5 shadow-sm border-0 p-3" style="background-color: #f9f9f9;">
                                    <h6 class="text-primary mb-3 border-bottom pb-1">📅 Event Details</h6>
                                    <ul class="list-unstyled mb-0">
                                        <li><strong>Event Name:</strong> {{ $event->event_name }}</li>
                                        <li><strong>Organized by:</strong> {{ $event->society }}</li>
                                        <li><strong>Date:</strong> {{ $event->date }}</li>
                                        <li><strong>Time:</strong> {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }} – {{ \Carbon\Carbon::parse($event->end_time)->format('g:i A') }}</li>
                                        <li><strong>Venue:</strong> {{ $event->venue }}</li>
                                        <li><strong>Participants:</strong> {{ $event->participants ?? 'N/A' }}</li>
                                    </ul>
                                </div>
                                <div class="card col-md-5 shadow-sm border-0 p-3" style="background-color: #f9f9f9;">
                                    <h6 class="text-success mb-3 border-bottom pb-1">👤 Applicant Details</h6>
                                    <ul class="list-unstyled mb-0">
                                        <li><strong>Name:</strong> {{ $event->applicant ?? $event->person_id }}</li>
                                        <li><strong>Registration No:</strong> {{ $event->registration_number ?? $event->reg_no }}</li>
                                        <li><strong>Contact Number:</strong> {{ $event->contact ?? 'N/A' }}</li>
                                        <li><strong>Email:</strong> {{ $event->email ?? 'N/A' }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    {{-- Rejected Requests --}}
    <h4 class="text-white mt-5">Rejected Requests</h4>
    @if($rejectedEvents->isEmpty())
        <p class="text-center text-white">No Rejected Events Available.</p>
    @else
        @foreach($rejectedEvents as $event)
            <div class="card mb-3 p-3 d-flex flex-row justify-content-between align-items-center">
                <a href="#" class="event-detail-link text-decoration-none" data-bs-toggle="modal" data-bs-target="#eventModalRejected{{ $event->id }}">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0 text-primary text-reset">{{ $event->event_name }} organized by {{ $event->society }}</h6>
                            <small class="text-muted">
                                {{ $event->applicant ?? $event->person_id }}'s booking {{ $event->venue }} on {{ $event->date }} at 
                                {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }} : 
                                {{ \Carbon\Carbon::parse($event->end_time)->format('g:i A') }} is rejected
                            </small>
                        </div>
                    </div>
                </a>
                <div>
                    {!! renderImageButton($event->image_path) !!}
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="eventModalRejected{{ $event->id }}" tabindex="-1" aria-labelledby="eventModalLabelRejected{{ $event->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content text-dark">
                        <div class="modal-header justify-content-center">
                            <h5 class="modal-title" id="eventModalLabelRejected{{ $event->id }}">{{ $event->event_name }} Details</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row justify-content-center g-4">
                                <div class="card col-md-5 shadow-sm border-0 p-3" style="background-color: #f9f9f9;">
                                    <h6 class="text-primary mb-3 border-bottom pb-1">📅 Event Details</h6>
                                    <ul class="list-unstyled mb-0">
                                        <li><strong>Event Name:</strong> {{ $event->event_name }}</li>
                                        <li><strong>Organized by:</strong> {{ $event->society }}</li>
                                        <li><strong>Date:</strong> {{ $event->date }}</li>
                                        <li><strong>Time:</strong> {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }} – {{ \Carbon\Carbon::parse($event->end_time)->format('g:i A') }}</li>
                                        <li><strong>Venue:</strong> {{ $event->venue }}</li>
                                        <li><strong>Participants:</strong> {{ $event->participants ?? 'N/A' }}</li>
                                    </ul>
                                </div>
                                <div class="card col-md-5 shadow-sm border-0 p-3" style="background-color: #f9f9f9;">
                                    <h6 class="text-success mb-3 border-bottom pb-1">👤 Applicant Details</h6>
                                    <ul class="list-unstyled mb-0">
                                        <li><strong>Name:</strong> {{ $event->applicant ?? $event->person_id }}</li>
                                        <li><strong>Registration No:</strong> {{ $event->registration_number ?? $event->reg_no }}</li>
                                        <li><strong>Contact Number:</strong> {{ $event->contact ?? 'N/A' }}</li>
                                        <li><strong>Email:</strong> {{ $event->email ?? 'N/A' }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    {{-- Status Table --}}
    <h4 class="text-white mt-5">Statuses of All University Level Events</h4>
    @if($allEventApprovals->isEmpty())
        <p class="text-white text-center">No event approvals found.</p>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped bg-white text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Event Name</th>
                        <th>AR Status</th>
                        <th>Marshall Status</th>
                        <th>Proctor Status</th>
                        <th>VC Status</th>
                        <th>Reject Reason</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allEventApprovals as $approval)
                        <tr>
                            <td>{{ $approval->event->event_name ?? 'N/A' }}</td>
                            <td>
                                @php
                                    if ($approval->fasar_status !== null) {
                                        $arValue = $approval->fasar_status;
                                        $arSource = 'fasar_status';
                                    } elseif ($approval->fbsar_status !== null) {
                                        $arValue = $approval->fbsar_status;
                                        $arSource = 'fbsar_status';
                                    } elseif ($approval->ftsar_status !== null) {
                                        $arValue = $approval->ftsar_status;
                                        $arSource = 'ftsar_status';
                                    } else {
                                        $arValue = 'N/A';
                                        $arSource = '';
                                    }
                                @endphp
                                {{ $arValue }} @if($arSource) ({{ $arSource }}) @endif
                            </td>
                            <td>{{ $approval->marshall_status ?? 'N/A' }}</td>
                            <td>{{ $approval->proctor_status ?? 'N/A' }}</td>
                            <td>{{ $approval->vc_status ?? 'N/A' }}</td>
                            <td>{{ $approval->rejection_reason ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<div class="container mt-5" id="faculty-union">
    <h3 class="text-center text-white">Faculty Level Union</h3>
</div>

<div class="container mt-5" id="faculty-level-society">
    <h3 class="text-center text-white">Faculty Level Society</h3>
</div>

<div class="container mt-5" id="faculty-level-batch">
    <h3 class="text-center text-white">Faculty Level Batch</h3>
</div>

<div class="text-center mt-5">
    <a href="{{ route('home') }}" class="btn btn-secondary">Back</a>
</div>


@php
    function renderImageButton($imagePath) {
        if ($imagePath) {
            return '<a href="' . asset('storage/' . $imagePath) . '" target="_blank" class="btn btn-info btn-sm me-2">View</a>';
        }
        return '';
    }
@endphp