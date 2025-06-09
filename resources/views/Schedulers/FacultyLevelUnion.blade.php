@extends('nav.navbar')

@section('content')

<style>
    a.btn.custom {
        background-color: white !important;
        color: black !important;
        padding: 10px 20px !important;
        font-size: 16px !important;
        border: none !important;
        cursor: pointer;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
    }

    a.btn.custom:hover {
        background-color: lightgray !important;
    }

    .card {
        padding: 15px !important;
    }

    .card-header h3,
    .card h1 {
        font-size: 20px !important;
        margin: 10px 0 !important;
    }

    .form-label {
        font-size: 14px !important;
        margin-bottom: 4px;
    }

    .form-control {
        padding: 6px 10px !important;
        font-size: 14px;
    }

    button.btn {
        padding: 6px 12px;
        font-size: 14px;
    }

    .container {
        padding: 0;
    }

    .vh-full {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .row.g-1 > * {
        padding: 0.25rem;
    }

    .text-center h1 {
        font-size: 22px;
    }

    .btn-secondary {
        margin-top: 10px;
    }
</style>

<div class="vh-full">

    <div class="container">

        <div class="text-center mb-3 text-white">
            <h1>Welcome to University of Vavuniya Event Schedule System</h1>
        </div>

        <div class="row justify-content-center g-1">

            <!-- Event Details -->
            <div class="card shadow-sm col-md-5 m-2" style="opacity: 0.95;">
                <div class="card-header text-white text-center" style="background-color:#670047;">
                    <h3>Schedule your Event Date</h3>
                </div>

                @if(session('success'))
                    <p class="text-success text-center my-2">{{ session('success') }}</p>
                @endif

                <div class="card-body">
                    <form action="{{ route('scheduleUnionEvent') }}" method="POST">
                        @csrf

                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label for="society" class="form-label">Society:</label>
                                <input type="text" id="society" name="society" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label for="faculty" class="form-label">Faculty:</label>
                                <select name="faculty" id="faculty" class="form-control" required>
                                    <option value="" disabled selected>Select Faculty</option>
                                    @foreach($faculties as $faculty)
                                        <option value="{{ $faculty->name }}">{{ $faculty->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="mb-2">
                            <label for="event_name" class="form-label">Event Name:</label>
                            <input type="text" id="event_name" name="event_name" class="form-control" required>
                        </div>

                        <div class="mb-2">
                            <label for="date" class="form-label">Date:</label>
                            <input type="date" id="date" name="date" class="form-control" required>
                        </div>

                        <div class="mb-3 row">
                            <label for="venue" class="form-label">Venue:</label>

                             {{-- Faculty Dropdown --}}
                            <div class="col-md-6">
                                <label for="facultyForVenue" class="form-label">Faculty:</label>
                                <select name="faculty_for_venue" id="facultyForVenue" class="form-control" required>
                                    <option value="" disabled selected>Select Faculty</option>
                                    @foreach($faculties as $faculty)
                                        <option value="{{ $faculty->code }}">{{ $faculty->code }}</option>
                                    @endforeach
                                </select>
                            </div>


                            {{-- Venue Dropdown (Dynamic) --}}
                            <div class="col-md-6">
                                <label for="hall" class="form-label">Hall:</label>
                                <select id="hall" name="hall" class="form-control" required>
                                    <option value="" disabled selected>Select Hall</option>
                                </select>
                            </div>

                            
                        </div>

                        

                        {{-- <div class="mb-2">
                            <label for="venue" class="form-label">Venue:</label>
                            <input type="text" id="venue" name="venue" class="form-control" required>
                        </div> --}}

                        <div class="mb-2">
                            <label for="time" class="form-label">Time:</label>
                            <input type="time" id="time" name="time" class="form-control" required>
                        </div>

                </div>
            </div>

            <!-- Booking Person Details -->
            <div class="card shadow-sm col-md-5 m-2" style="opacity: 0.95;">
                <div class="card-header text-white text-center" style="background-color:#670047;">
                    <h3>Booking Person Details</h3>
                </div>

                <div class="card-body">

                    <div class="mb-2">
                        <label for="person_id" class="form-label">ID:</label>
                        <input type="text" id="person_id" name="person_id" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label for="contact" class="form-label">Contact:</label>
                        <input type="text" id="contact" name="contact" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label for="reg_no" class="form-label">Reg No:</label>
                        <input type="text" id="reg_no" name="reg_no" class="form-control" required>
                    </div>

                    {{-- <div class="mb-2">
                        <label for="faculty" class="form-label">Faculty:</label>
                        <input type="text" id="faculty" name="faculty" class="form-control" required>
                    </div> --}}

                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-success px-4">Submit & Download Receipt</button>
                    </div>

                </form>
                </div>
            </div>

        </div>

        <div class="text-center mt-5">
            <a href="{{route('home') }}" class="btn btn-secondary">Back</a>
        </div>

    </div>

</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    
        const facultyDropdown = document.getElementById('facultyForVenue');
        const hallDropdown = document.getElementById('hall');

        facultyDropdown.addEventListener('change', function () {
            const selectedFaculty = this.value;

            fetch(`/get-halls/${selectedFaculty}`)
                .then(response => response.json())
                .then(data => {
                    hallDropdown.innerHTML = '<option value="" disabled selected>Select Hall</option>';
                    data.forEach(hall => {
                        const option = document.createElement('option');
                        option.value = hall.name;
                        option.textContent = hall.name;
                        hallDropdown.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching halls:', error);
                    hallDropdown.innerHTML = '<option value="" disabled selected>Error loading halls</option>';
                });
        });
    });
</script>
@endsection

