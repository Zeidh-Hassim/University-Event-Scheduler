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

<h1 class="text-center mb-3 text-white">FAS Assistant Registrar</h1>

<div class="container mt-5">
    <h4 class="text-white">University Level Union/Society Pending Requests</h4>

    @if($pendingEvents->isEmpty())
        <p class="text-center text-white">No Pending Events Available.</p>
    @else
        @foreach($pendingEvents as $event)
         <a href="#" class="event-detail-link text-decoration-none" data-bs-toggle="modal" data-bs-target="#eventModal{{ $event->id }}">
                        
        <div class="card mb-3 p-3 d-flex flex-row justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div>
                    {{-- <h6 class="mb-0">{{ $event->event_name }} organized by {{ $event->society }}</h6> --}}
                   <h6 class="mb-0 text-primary">{{ $event->event_name }} organized by {{ $event->society }}</h6>
                         <small class="text-muted">{{ $event->applicant }} wants to book {{ $event->venue }} on {{ $event->date }} at {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }} : {{ \Carbon\Carbon::parse($event->end_time)->format('g:i A') }} </small>
                
                    


                   </div>
            </div>
            <div>
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
            </div>
        </div>
        @endforeach
        </a>
                                <!-- Modal -->
<div class="modal fade" id="eventModal{{ $event->id }}" tabindex="-1" aria-labelledby="eventModalLabel{{ $event->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content text-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel{{ $event->id }}">{{ $event->event_name }} Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center g-1">

                    <!-- Event Details -->
                    <div class="card shadow-sm col-md-5 m-2" style="opacity: 0.95;">
                <p><strong>Event Name:</strong> {{ $event->event_name }}</p>
                <p><strong>Organized by:</strong> {{ $event->society }}</p>
                {{-- <p><strong>Event Type:</strong> {{ $event->event_Type }}</p> --}}
                <p><strong>Date:</strong> {{ $event->date }}</p>
                <p><strong>Time:</strong> {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($event->end_time)->format('g:i A') }}</p>
                {{-- <p><strong>Faculty:</strong> {{ $event->faculty ?? 'N/A' }}</p> --}}
                <p><strong>Venue:</strong> {{ $event->venue }}</p>
                <p><strong>Participants:</strong> {{ $event->participants }}</p>
                    </div>
                    <div class="card shadow-sm col-md-5 m-2" style="opacity: 0.95;">
                
                <p><strong>Applicant:</strong> {{ $event->applicant }}</p>
                <p><strong>Registration Number:</strong> {{ $event->registration_number }}</p>
                <p><strong>Contact Number:</strong> {{ $event->contact ?? 'N/A' }}</p>
                <p><strong>Contact Email:</strong> {{ $event->email ?? 'N/A' }}</p>
                    </div>

                
                {{-- <p><strong>Status:</strong> {{ $event->status }}</p> --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

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
        </div>
        @endforeach
    @endif
</div>

{{-- <div class="container mt-5">
    <h4 class="text-white">Faculty Union Pending Requests</h4>

    @if($pendingUnionEvents->isEmpty())
        <p class="text-center text-white">No Pending Events Available.</p>
    @else
        @foreach($pendingUnionEvents as $event)
        <div class="card mb-3 p-3 d-flex flex-row justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div>
                    <h6 class="mb-0">{{ $event->event_name }} ({{ $event->society }})</h6>
                    <small class="text-muted">{{ $event->person_id }} wants to book {{ $event->venue }} on {{ $event->date }} at {{ $event->time }}</small>
                </div>
            </div> --}}

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

        {{-- </div>
        @endforeach
    @endif
</div>  --}}

<div class="container mt-5">
    <h4 class="text-white">Statuses of All University Level Events</h4>

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
                    </tr>
                    @endforeach


            </tbody>
        </table>
    </div>
    @endif
</div>





<div class="text-center mt-5">
    <a href="{{route('home') }}" class="btn btn-secondary">Back</a>
</div>