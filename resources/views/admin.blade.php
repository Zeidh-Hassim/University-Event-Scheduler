@extends('nav.navbar')
<h1>Hello I am admin</h1>
<div class="container mt-5">
    <h4>Pending Requests</h4>
    <div class="card mb-3 p-3 d-flex flex-row justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            {{-- <img src="https://via.placeholder.com/50" class="rounded-circle me-3" alt="User"> --}}
            <div>
                <h6 class="mb-0">John Doe</h6>
                <small class="text-muted">wants to book a venue</small>
            </div>
        </div>
        <div>
            <button class="btn btn-success btn-sm me-2">Accept</button>
            <button class="btn btn-danger btn-sm">Delete</button>
        </div>
    </div>

    <div class="card mb-3 p-3 d-flex flex-row justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            {{-- <img src="https://via.placeholder.com/50" class="rounded-circle me-3" alt="User"> --}}
            <div>
                <h6 class="mb-0">Jane Smith</h6>
                <small class="text-muted">requested an event slot</small>
            </div>
        </div>
        <div>
            <button class="btn btn-success btn-sm me-2">Accept</button>
            <button class="btn btn-danger btn-sm">Delete</button>
        </div>
    </div>
</div>
