@extends('nav.navbar')

@section('content')

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

<div class="container my-5">

    <div class="d-flex justify-content-center align-items-center vh-25">
        <div class="card shadow-lg p-3 col-md-8 m-4 text-center">
            <h1>Welcome to University of Vauniya Event Schedule System</h1>
        </div>
    </div>

    <div class="row justify-content-center">

        <div class="card shadow-lg p-4 col-md-5 m-4" style="opacity: 0.85;">
            <div class="card-header text-white text-center" style="background-color:#670047;">
                <h3>Schedule your Event Date</h3>
            </div>

            @if(session('success'))
                <p class="text-success text-center my-3">{{ session('success') }}</p>
            @endif

            <div class="card-body">
                <form action="{{ route('schedule-event') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="society" class="form-label">Society:</label>
                        <input type="text" id="society" name="society" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="event_name" class="form-label">Event Name:</label>
                        <input type="text" id="event_name" name="event_name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label">Date:</label>
                        <input type="date" id="date" name="date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="venue" class="form-label">Venue:</label>
                        <input type="text" id="venue" name="venue" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="time" class="form-label">Time:</label>
                        <input type="time" id="time" name="time" class="form-control" required>
                    </div>
            </div>
        </div>

        <div class="card shadow-lg p-4 col-md-5 m-4" style="opacity: 0.85;">
            <div class="card-header text-white text-center" style="background-color:#670047;">
                <h3>Booking Person Details:</h3>
            </div>

            <div class="card-body">

                <div class="mb-3">
                    <label for="person_id" class="form-label">ID:</label>
                    <input type="text" id="person_id" name="person_id" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="contact" class="form-label">Contact:</label>
                    <input type="text" id="contact" name="contact" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="reg_no" class="form-label">Reg No:</label>
                    <input type="text" id="reg_no" name="reg_no" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="faculty" class="form-label">Faculty:</label>
                    <input type="text" id="faculty" name="faculty" class="form-control" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success px-5">Submit & Download Letter</button>
                </div>
            </form>
            </div>
        </div>

    </div> <!-- row -->

    <div class="text-center mt-5">
        <button type="button" class="btn btn-secondary" onclick="history.back()">Back</button>
    </div>

</div> <!-- container -->

@endsection
