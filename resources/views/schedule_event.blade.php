@extends('nav.navbar')


@section('content')

<div class="container">
   <div class="d-flex justify-content-center align-items-center vh-0.025">
    <div class="card shadow-lg p-0.25 col-md-5 m-4 mt-1 text-center">
        <h1>Welcome to University of Vauniya Event Schedule System</h1>
    </div>
</div>


    <div class="row mt-5 ms-5" >
        <div class="card shadow-lg p-4 col-md-5 m-4" style="opacity: 0.85">
            <div class="card-header text-white text-center" style="background-color:#670047 ;">
                <h3>Schedule your Event Date</h3>
            </div>
            @if(session('success'))
                <p style="color: green;">{{ session('success') }}</p>
            @endif
            <div class="card-body">
            <form action="{{route('schedule-event')}}" method="POST">
                @csrf
                <div class="mb-3">
                <label for="date" class="form-label">Date:</label>
                <input type="date" id="date" name="date" class="form-control" required><br>
                </div>
                <div class="mb-3">
                <labelfor="venue" class="form-label" >Venue:</label>
                <input type="text" name="venue"class="form-control" required><br>
                </div>
                <div class="mb-3">
                <label for="time" class="form-label">Time:</label>
                <input type="time" name="time" class="form-control" required><br>
                </div>
        
            </div>
        </div>

        <div class="card shadow-lg p-4 col-md-5 m-4" style="opacity: 0.85">
            <div class="card-header text-white text-center" style="background-color:#670047 ;">
            <h3>Booking Person Details:</h3>
            </div>
            
            <label>ID:</label>
            <input class="form-control" type="text" name="person_id" required><br>

            <label>Contact:</label>
            <input class="form-control" type="text" name="contact" required><br>

            <label>Email:</label>
            <input class="form-control" type="email" name="email" required><br>

            <label>Reg No:</label>
            <input class="form-control" type="text" name="reg_no" required><br>

            <label>Faculty:</label>
            <input class="form-control" type="text" name="faculty" required><br>

            <div class="text-center">
            <button type="submit" class="btn btn-success">Submit & download letter</button>
                            
            </div>
        </form>


    </div>

</div>
@endsection
