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

<h1 class="text-center mb-3 text-white">Administrator</h1>


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

{{-- Display All Users --}}
<div class="container mt-5">
    
    <h3 class="text-center mb-3 text-white">Users</h3>

    @if($users->isEmpty())
        <p>No faculties available.</p>
    @else
        @foreach($users as $user)
            <div class="card mb-3 p-3 d-flex flex-row justify-content-between align-items-center">
                <div>
                    <h6 class="mb-1">{{ $user->designation }}</h6>
                    <small class="text-muted">Email: {{ $user->email }}</small>
                </div>
                <div>
                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif

    {{-- Add User Form  --}}
     <div class="card mt-4 p-4">
        <h5 class="text-center mb-3 text-black">Add New User</h5>
        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="designation" class="form-label">Designation</label>
                <input type="text" name="designation" id="designation" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Add User</button>
            </div>
        </form>
    </div>
</div>

{{-- Back Button --}}
<div class="text-center mt-5">
    <a href="{{ route('home') }}" class="btn btn-secondary">Back</a>
</div>
