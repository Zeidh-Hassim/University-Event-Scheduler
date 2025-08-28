@extends('nav.navbar')
<head>
    <meta charset="UTF-8">
    <title>Scheduled</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #fff;
            color: #2d3c2d;
        }

        .schedule-title {
            font-weight: bold;
            text-align: center;
            margin: 40px 0 10px;
        }

        .filter-select {
            margin-bottom: 20px;
            font-size: 14px;
            color: #2d3c2d;
        }

        .event-item {
            border-top: 1px solid #4c5c4c;
            padding: 15px 0;
        }

        .event-time {
            font-size: 14px;
            color: #2d3c2d;
            width: 180px;
        }

        .event-title {
            font-weight: bold;
            font-size: 16px;
        }

        .event-location {
            font-size: 14px;
            color: #6c757d;
        }

        .day-header {
            border-bottom: 2px solid #4c5c4c;
            margin: 30px 0 10px;
            padding-bottom: 5px;
            font-weight: bold;
            font-size: 16px;
        }

        .btn-tickets {
            background-color: #4c5c4c;
            color: white;
            border-radius: 10px;
            padding: 8px 18px;
            margin-bottom: 30px;
        }

        .btn-tickets:hover {
            background-color: #3b4b3b;
        }

        .schedule-wrapper {
            background-color: white;
            max-width: 900px;
            margin: 50px auto;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        }

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
</head>
<body>
    <div class="container">
                <h1 class="text-center mb-3 text-white">Events Statuses</h1>
        <div class="schedule-wrapper">
            <div class="container">

                {{-- <h1 class="schedule-title">Schedule</h1> --}}
                {{-- <div class="text-center">
                    <button class="btn btn-tickets">Get Tickets</button>
                </div> --}}

                <div class="filter-select mb-4">
                    <form method="GET" action="{{ route('schedule') }}">
                        <label for="status">Filter By Status: </label>
                        <select name="status" class="form-select d-inline w-auto" onchange="this.form.submit()">
                            <option value="all" {{ ($status ?? '') == 'all' ? 'selected' : '' }}>All</option>
                            <option value="pending" {{ ($status ?? '') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="accepted" {{ ($status ?? '') == 'accepted' ? 'selected' : '' }}>Accepted</option>
                            <option value="rejected" {{ ($status ?? '') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </form>
                </div>

                <!-- Event Items -->
                @if($events->count())
                    @foreach($events as $event)
                        <a href="#" class="event-detail-link text-decoration-none text-reset" data-bs-toggle="modal" data-bs-target="#eventModal{{ $event->id }}">
                        <div class="event-item d-flex align-items-center">
                            <div class="pe-4 text-nowrap">
                                <div class="event-date">{{ \Carbon\Carbon::parse($event->date)->format('D, M d Y') }}</div>
                                <div class="event-time">{{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }} : {{ \Carbon\Carbon::parse($event->end_time)->format('g:i A') }}</div>
                            </div>
                            <div>
                                <div class="event-title">{{ $event->event_name }}</div>
                                <div class="event-location">📍 {{ $event->venue }}</div>
                                <div class="text-muted small">Status: {{ ucfirst($event->status) }}</div>
                            </div>
                        </div>
                        @php
                            $approval = null;

                            if ($event->event_Type == 'University Level Union/Society') {
                                $approval = $approval_statuses[$event->id] ?? null;
                            } elseif ($event->event_Type == 'Faculty Level Students Union') {
                                $approval = $approval_Societystatuses[$event->id] ?? null;
                            } elseif ($event->event_Type == 'Faculty Level Batch Faculty Level Approved Societies') {
                                $approval = $approval_Unioinstatuses[$event->id] ?? null;
                            } elseif ($event->event_Type == 'Faculty Level Approved Societies') {
                                $approval = $approval_Batchstatuses[$event->id] ?? null;
                            }
                        @endphp

                        </a>
                        @if($event->event_Type == 'University Level Union/Society')
                            <!-- Event Modal -->
                            <div class="modal fade" id="eventModal{{ $event->id }}" tabindex="-1" aria-labelledby="eventModalLabel{{ $event->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-sm">
                                    <div class="modal-content text-dark">
                                        <div class="modal-header justify-content-center">
                                            <h5 class="modal-title" id="eventModalLabel{{ $event->id }}">{{ $event->event_name }} Details</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row justify-content-center g-4">
                                                <div class="card col-12 shadow-sm border-0 p-3" style="background-color: #f9f9f9;">
                                                    <h6 class="text-primary mb-3 border-bottom pb-1">📅 Event Status</h6>
                                                    <ul class="list-unstyled mb-0">
                                                        <li><strong>EventType :</strong> {{ $event->event_Type }} </li>
                                                        <li><strong>AR Status:</strong>
                                                            @php
                                                                $arValue = 'N/A';
                                                                $arSource = '';

                                                                if ($approval) {
                                                                    if ($approval->fasar_status !== null) {
                                                                        $arValue = $approval->fasar_status;
                                                                        $arSource = 'fasar_status';
                                                                    } elseif ($approval->fbsar_status !== null) {
                                                                        $arValue = $approval->fbsar_status;
                                                                        $arSource = 'fbsar_status';
                                                                    } elseif ($approval->ftsar_status !== null) {
                                                                        $arValue = $approval->ftsar_status;
                                                                        $arSource = 'ftsar_status';
                                                                    }
                                                                }
                                                            @endphp
                                                            {{ $arValue }} @if($arSource) ({{ $arSource }}) @endif
                                                        </li>
                                                        <li><strong>Marshall Status:</strong> {{ $approval->marshall_status ?? 'N/A' }} </li>
                                                        <li><strong>Proctor Status:</strong> {{ $approval->proctor_status ?? 'N/A' }}</li>
                                                        <li><strong>VC Status:</strong> {{ $approval->vc_status ?? 'N/A' }}</li>
                                                        <li><strong>Reject Reason:</strong> {{ $approval->rejection_reason ?? 'N/A' }}</li>
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
                        
                        @elseif($event->event_Type == 'Faculty Level Students Union')
                            <!-- Event Modal -->
                            <div class="modal fade" id="eventModal{{ $event->id }}" tabindex="-1" aria-labelledby="eventModalLabel{{ $event->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-sm">
                                    <div class="modal-content text-dark">
                                        <div class="modal-header justify-content-center">
                                            <h5 class="modal-title" id="eventModalLabel{{ $event->id }}">{{ $event->event_name }} Details</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row justify-content-center g-4">
                                                <div class="card col-12 shadow-sm border-0 p-3" style="background-color: #f9f9f9;">
                                                    <h6 class="text-primary mb-3 border-bottom pb-1">📅 Event Status</h6>
                                                    <ul class="list-unstyled mb-0">
                                                        <li><strong>EventType :</strong> {{ $event->event_Type }} </li>
                                                        <li><strong>AR Status:</strong>
                                                            @php
                                                                $arValue = 'N/A';
                                                                $arSource = '';

                                                                if ($approval) {
                                                                    if ($approval->fasar_status !== null) {
                                                                        $arValue = $approval->fasar_status;
                                                                        $arSource = 'fasar_status';
                                                                    } elseif ($approval->fbsar_status !== null) {
                                                                        $arValue = $approval->fbsar_status;
                                                                        $arSource = 'fbsar_status';
                                                                    } elseif ($approval->ftsar_status !== null) {
                                                                        $arValue = $approval->ftsar_status;
                                                                        $arSource = 'ftsar_status';
                                                                    }
                                                                }
                                                            @endphp
                                                            {{ $arValue }} @if($arSource) ({{ $arSource }}) @endif
                                                        </li>
                        
                                                        <li><strong>Deputy Proctor Status:</strong> @php
                                                                $dpValue = 'N/A';
                                                                $dpSource = '';

                                                                if ($approval) {
                                                                    if ($approval->fasdp_status !== null) {
                                                                        $dpValue = $approval->fasdp_status;
                                                                        $dpSource = 'fasdp_status';
                                                                    } elseif ($approval->fbsdp_status !== null) {
                                                                        $dpValue = $approval->fbsdp_status;
                                                                        $dpSource = 'fbsdp_status';
                                                                    } elseif ($approval->fbsdp_status !== null) {
                                                                        $dpValue = $approval->fbsdp_status;
                                                                        $dpSource = 'fbsdp_status';
                                                                    }
                                                                }
                                                            @endphp
                                                            {{ $dpValue }} @if($dpSource) ({{ $dpSource }}) @endif</li>
                                                         <li><strong>Marshall Status:</strong> {{ $approval->marshall_status ?? 'N/A' }} </li>
                                                        <li><strong>Dean Status:</strong> {{ $approval->vc_status ?? 'N/A' }}</li>
                                                        <li><strong>Reject Reason:</strong> {{ $approval->rejection_reason ?? 'N/A' }}</li>
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
                        {{-- @elseif(strtolower($event->event_name) == 'department') --}}
                        @elseif($event->event_Type == 'Faculty Level Batch')
                            <!-- Event Modal -->
                            <div class="modal fade" id="eventModal{{ $event->id }}" tabindex="-1" aria-labelledby="eventModalLabel{{ $event->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-sm">
                                    <div class="modal-content text-dark">
                                        <div class="modal-header justify-content-center">
                                            <h5 class="modal-title" id="eventModalLabel{{ $event->id }}">{{ $event->event_name }} Details</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row justify-content-center g-4">
                                                <div class="card col-12 shadow-sm border-0 p-3" style="background-color: #f9f9f9;">
                                                    <h6 class="text-primary mb-3 border-bottom pb-1">📅 Event Status</h6>
                                                    <ul class="list-unstyled mb-0">
                                                        <li><strong>EventType :</strong> {{ $event->event_Type }} </li>
                                                        <li><strong>AR Status:</strong>
                                                            @php
                                                                $arValue = 'N/A';
                                                                $arSource = '';

                                                                if ($approval) {
                                                                    if ($approval->fasar_status !== null) {
                                                                        $arValue = $approval->fasar_status;
                                                                        $arSource = 'fasar_status';
                                                                    } elseif ($approval->fbsar_status !== null) {
                                                                        $arValue = $approval->fbsar_status;
                                                                        $arSource = 'fbsar_status';
                                                                    } elseif ($approval->ftsar_status !== null) {
                                                                        $arValue = $approval->ftsar_status;
                                                                        $arSource = 'ftsar_status';
                                                                    }
                                                                }
                                                            @endphp
                                                            {{ $arValue }} @if($arSource) ({{ $arSource }}) @endif
                                                        </li>
                        
                                                        <li><strong>Deputy Proctor Status:</strong> @php
                                                                $dpValue = 'N/A';
                                                                $dpSource = '';

                                                                if ($approval) {
                                                                    if ($approval->fasdp_status !== null) {
                                                                        $dpValue = $approval->fasdp_status;
                                                                        $dpSource = 'fasdp_status';
                                                                    } elseif ($approval->fbsdp_status !== null) {
                                                                        $dpValue = $approval->fbsdp_status;
                                                                        $dpSource = 'fbsdp_status';
                                                                    } elseif ($approval->fbsdp_status !== null) {
                                                                        $dpValue = $approval->fbsdp_status;
                                                                        $dpSource = 'fbsdp_status';
                                                                    }
                                                                }
                                                            @endphp
                                                            {{ $dpValue }} @if($dpSource) ({{ $dpSource }}) @endif
                                                        </li>
                                                         <li><strong>Marshall Status:</strong> {{ $approval->marshall_status ?? 'N/A' }} </li>
                                                        <li><strong>Dean Status:</strong>@php
                                                                $deanValue = 'N/A';
                                                                $deanSource = '';

                                                                if ($approval) {
                                                                    if ($approval->fasdean_status !== null) {
                                                                        $deanValue = $approval->fasdean_status;
                                                                        $deanSource = 'fasdean_status';
                                                                    } elseif ($approval->fbsdean_status !== null) {
                                                                        $deanValue = $approval->fbsdean_status;
                                                                        $deanSource = 'fbsdean_status';
                                                                    } elseif ($approval->ftsdean_status !== null) {
                                                                        $deanValue = $approval->ftsdean_status;
                                                                        $deanSource = 'ftsdean_status';
                                                                    }
                                                                }
                                                            @endphp
                                                            {{ $deanValue }} @if($dpSource) ({{ $dpSource }}) @endif
                                                        </li>
                                                        <li><strong>Reject Reason:</strong> {{ $approval->rejection_reason ?? 'N/A' }}</li>
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
                        
                        @elseif($event->event_Type == 'Faculty Level Approved Societies')
                            <!-- Event Modal -->
                            <div class="modal fade" id="eventModal{{ $event->id }}" tabindex="-1" aria-labelledby="eventModalLabel{{ $event->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-sm">
                                    <div class="modal-content text-dark">
                                        <div class="modal-header justify-content-center">
                                            <h5 class="modal-title" id="eventModalLabel{{ $event->id }}">{{ $event->event_name }} Details</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row justify-content-center g-4">
                                                <div class="card col-12 shadow-sm border-0 p-3" style="background-color: #f9f9f9;">
                                                    <h6 class="text-primary mb-3 border-bottom pb-1">📅 Event Status</h6>
                                                    <ul class="list-unstyled mb-0">
                                                        <li><strong>EventType :</strong> {{ $event->event_Type }} </li>
                                                        <li><strong>AR Status:</strong>
                                                            @php
                                                                $arValue = 'N/A';
                                                                $arSource = '';

                                                                if ($approval) {
                                                                    if ($approval->fasar_status !== null) {
                                                                        $arValue = $approval->fasar_status;
                                                                        $arSource = 'fasar_status';
                                                                    } elseif ($approval->fbsar_status !== null) {
                                                                        $arValue = $approval->fbsar_status;
                                                                        $arSource = 'fbsar_status';
                                                                    } elseif ($approval->ftsar_status !== null) {
                                                                        $arValue = $approval->ftsar_status;
                                                                        $arSource = 'ftsar_status';
                                                                    }
                                                                }
                                                            @endphp
                                                            {{ $arValue }} @if($arSource) ({{ $arSource }}) @endif
                                                        </li>
                        
                                                        <li><strong>HOD Status:</strong> @php
                                                                $hodValue = 'N/A';
                                                                $hodSource = '';

                                                                if ($approval) {
                                                                    if ($approval->fashod_status !== null) {
                                                                        $hodValue = $approval->fashod_status;
                                                                        $hodSource = 'fashod_status';
                                                                    } elseif ($approval->fbshod_status !== null) {
                                                                        $hodValue = $approval->fbshod_status;
                                                                        $hodSource = 'fbshod_status';
                                                                    } elseif ($approval->ftshod_status !== null) {
                                                                        $hodValue = $approval->ftshod_status;
                                                                        $hodSource = 'fshod_status';
                                                                    }
                                                                }
                                                            @endphp
                                                            {{ $hodValue }} @if($dpSource) ({{ $dpSource }}) @endif</li>
                                                         <li><strong>Dean Status:</strong>@php
                                                                $deanValue = 'N/A';
                                                                $deanSource = '';

                                                                if ($approval) {
                                                                    if ($approval->fasdean_status !== null) {
                                                                        $deanValue = $approval->fasdean_status;
                                                                        $deanSource = 'fasdean_status';
                                                                    } elseif ($approval->fbsdean_status !== null) {
                                                                        $deanValue = $approval->fbsdean_status;
                                                                        $deanSource = 'fbsdean_status';
                                                                    } elseif ($approval->ftsdean_status !== null) {
                                                                        $deanValue = $approval->ftsdean_status;
                                                                        $deanSource = 'ftsdean_status';
                                                                    }
                                                                }
                                                            @endphp
                                                            {{ $deanValue }} @if($dpSource) ({{ $dpSource }}) @endif
                                                        </li>
                                                        <li><strong>Reject Reason:</strong> {{ $approval->rejection_reason ?? 'N/A' }}</li>
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
                        {{-- @elseif(strtolower($event->event_name) == 'department') --}}
                        @endif
                    @endforeach
                @else
                    <p class="text-center">No events found.</p>
                @endif

            </div>
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('home') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

</body>
</html>