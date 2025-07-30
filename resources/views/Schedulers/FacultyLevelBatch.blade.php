{{-- @extends('nav.navbar')

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
            <p>University-level events/activities organized by the Students' Union/approved student societies</p>
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
                    <form action="{{ route('scheduleUniEvent') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-2">
                            <label for="event_name" class="form-label">Event Name:</label>
                            <input type="text" id="event_name" name="event_name" class="form-control" required>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label for="date" class="form-label">Date:</label>
                                <input type="date" id="date" name="date" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="participants" class="form-label">Participants:</label>
                                <select id="participants" name="participants" class="form-control" required>
                                    <option value="" disabled selected>Select Type</option>
                                    <option value="University Students Only">University Students Only</option>
                                    <option value="Outside Visitors Only">Outside Visitors Only</option>
                                    <option value="University Students and Outside Visitors">Both</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="venue" class="form-label">Time:</label>

                            <div class="col-md-6">   
                                <label for="starttime" class="form-label">Start Time:</label>
                                <input type="time" id="starttime" name="starttime" class="form-control" required>
                            </div>

                            <div class="col-md-6">   
                                <label for="endtime" class="form-label">End Time:</label>
                                <input type="time" id="endtime" name="endtime" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="venue" class="form-label">Venue:</label>

                            <div class="col-md-6">
                                <select name="faculty_for_venue" id="facultyForVenue" class="form-control" required>
                                    <option value="" disabled selected>Select Faculty</option>
                                    @foreach($faculties as $faculty)
                                        <option value="{{ $faculty->code }}">{{ $faculty->code }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <select id="hall" name="hall" class="form-control" required>
                                    <option value="" disabled selected>Select Hall</option>
                                </select>
                            </div>   
                        </div>

                        

                        <div class="mb-2" id="reasonField">
                            <label for="reason" class="form-label">Reason for Booking on other day except Wednesday:</label>
                            <input type="text" id="reason" name="reason" class="form-control" required>
                        </div>
                </div>
            </div>

            <!-- Booking Person Details -->
            <div class="card shadow-sm col-md-5 m-2" style="opacity: 0.95;">
                <div class="card-header text-white text-center" style="background-color:#670047;">
                    <h3>Applicant Details</h3>
                </div>

                <div class="card-body">

                    <div class="mb-2">
                        <label for="society" class="form-label">Name of Society:</label>
                        <input type="text" id="society" name="society" class="form-control" required>
                    </div>

                    <div class="mb-3 row">
    <div class="col-md-6">
        <label for="position" class="form-label">Position:</label>
        <select id="position" name="position" class="form-control" required>
            <option value="" disabled selected>Select position</option>
            <option value="President">President</option>
            <option value="Secretary">Secretary</option>
        </select>
    </div>

    <div class="col-md-6">
        <label for="applicant" class="form-label">Name:</label>
        <input type="text" id="applicant" name="applicant" class="form-control" required>
    </div>
</div>


                    <div class="mb-2">
                        <label for="reg_no" class="form-label">Registration No:</label>
                        <input type="text" id="reg_no" name="reg_no" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label for="contact" class="form-label">Contact:</label>
                        <input type="text" id="contact" name="contact" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
    <label for="event_image" class="form-label">Upload Event Poster/Image (optional):</label>
    <input type="file" class="form-control" id="event_image" name="event_image" accept="image/*">
</div>

                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-success px-4">Submit & Download Receipt</button>
                    </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('home') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const facultyDropdown = document.getElementById('facultyForVenue');
        const hallDropdown = document.getElementById('hall');
        const dateInput = document.getElementById('date');
        const startTimeInput = document.getElementById('starttime');
        const endTimeInput = document.getElementById('endtime');
        const reasonField = document.getElementById('reasonField');
        const reasonInput = document.getElementById('reason');

        // Set minimum selectable date to today + 7 days
        const today = new Date();
        const minDate = new Date(today.setDate(today.getDate() + 7)).toISOString().split('T')[0];
        dateInput.min = minDate;

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

        dateInput.addEventListener('change', function () {
            const selectedDate = new Date(dateInput.value);

            // Wednesday logic
            if (selectedDate.getDay() === 3) {
                reasonField.style.display = 'none';
                reasonInput.value = 'It is a Wednesday';
                reasonInput.required = false;
            } else {
                reasonField.style.display = 'block';
                reasonInput.value = '';
                reasonInput.required = true;
            }

            // Time input restriction logic
            const now = new Date();
            if (selectedDate.toDateString() === new Date().toDateString()) {
                const currentTime = now.toTimeString().slice(0, 5);
                startTimeInput.min = currentTime;
                endTimeInput.min = currentTime;
            } else {
                startTimeInput.removeAttribute('min');
                endTimeInput.removeAttribute('min');
            }
        });

        startTimeInput.addEventListener('change', function () {
            const startTime = startTimeInput.value;
            endTimeInput.min = startTime;
            if (endTimeInput.value && endTimeInput.value <= startTime) {
                endTimeInput.value = '';
                alert('End time must be after start time.');
            }
        });

        endTimeInput.addEventListener('change', function () {
            const startTime = startTimeInput.value;
            const endTime = endTimeInput.value;
            if (endTime <= startTime) {
                alert('End time must be after start time.');
                endTimeInput.value = '';
            }
        });
    });
</script>

@endsection --}}



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
            <p>Faculty-level events/activities organized by a particular batch of Students</p>
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
                    <form action="{{ route('scheduleBatchEvent') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                            <div class="col-md-6">
                                <select name="faculty_for_venue" id="facultyForVenue" class="form-control" required>
                                    <option value="" disabled selected>Select Union</option>
                                    @foreach($faculties as $faculty)
                                        <option value="{{ $faculty->code }}">{{ $faculty->code }}</option>
                                    @endforeach
                                </select>
                            </div>

                        <div class="mb-2">
                            <label for="event_name" class="form-label">Event Name:</label>
                            <input type="text" id="event_name" name="event_name" class="form-control" required>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label for="date" class="form-label">Date:</label>
                                <input type="date" id="date" name="date" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="participants" class="form-label">Participants:</label>
                                <select id="participants" name="participants" class="form-control" required>
                                    <option value="" disabled selected>Select Type</option>
                                    <option value="University Students Only">University Students Only</option>
                                    <option value="Outside Visitors Only">Outside Visitors Only</option>
                                    <option value="University Students and Outside Visitors">Both</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="venue" class="form-label">Time:</label>

                            <div class="col-md-6">   
                                <label for="starttime" class="form-label">Start Time:</label>
                                <input type="time" id="starttime" name="starttime" class="form-control" required>
                            </div>

                            <div class="col-md-6">   
                                <label for="endtime" class="form-label">End Time:</label>
                                <input type="time" id="endtime" name="endtime" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="venue" class="form-label">Venue:</label>
{{-- 
                            <div class="col-md-6">
                                <select name="faculty_for_venue" id="facultyForVenue" class="form-control" required>
                                    <option value="" disabled selected>Select Faculty</option>
                                    @foreach($faculties as $faculty)
                                        <option value="{{ $faculty->code }}">{{ $faculty->code }}</option>
                                    @endforeach
                                </select>
                            </div> --}}

                            <div class="col-md-6">
                                <select id="hall" name="hall" class="form-control" required>
                                    <option value="" disabled selected>Select Hall</option>
                                </select>
                            </div>   
                        </div>

                        <div class="mb-2" id="reasonField">
                            <label for="reason" class="form-label">Reason for Booking on other day except Wednesday:</label>
                            <input type="text" id="reason" name="reason" class="form-control" required>
                        </div>
                </div>
            </div>

            <!-- Booking Person Details -->
            <div class="card shadow-sm col-md-5 m-2" style="opacity: 0.95;">
                <div class="card-header text-white text-center" style="background-color:#670047;">
                    <h3>Applicant Details</h3>
                </div>

                <div class="card-body">

                    {{-- <div class="mb-2">
                        <label for="society" class="form-label">Name of Society:</label>
                        <input type="text" id="society" name="society" class="form-control" required>
                    </div> --}}


                    <div class="mb-2">
                        <label for="society" class="form-label">Name of Society:</label>
                        <select id="society" name="society" class="form-control" required>
                            <option value="">-- Select Level --</option>
                            <option value="Level 1">Level 1</option>
                            <option value="Level 2">Level 2</option>
                            <option value="Level 3">Level 3</option>
                            <option value="Level 4">Level 4</option>
                        </select>
                    </div>


                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label for="position" class="form-label">Position:</label>
                            <select id="position" name="position" class="form-control" required>
                                <option value="" disabled selected>Select position</option>
                                <option value="President">President</option>
                                <option value="Secretary">Secretary</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="applicant" class="form-label">Name:</label>
                            <input type="text" id="applicant" name="applicant" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-2">
                        <label for="reg_no" class="form-label">Registration No:</label>
                        <input type="text" id="reg_no" name="reg_no" class="form-control" 
                            required 
                            pattern="^\d{4}\/[A-Z]{2,3}\/[1-9]\d{0,2}$"
                            placeholder="2023/CSC/123"
                            title="Format: YYYY/ABC/1–999 (e.g., 2023/CSC/123)">
                    </div>


                    <div class="mb-2">
                        <label for="contact" class="form-label">Contact:</label>
                        <input type="text" id="contact" name="contact" class="form-control" 
                            required 
                            pattern="^07\d{8}$"
                            placeholder="0771234567"
                            title="Enter a valid 10-digit mobile number (e.g., 0771234567)">
                    </div>

                    <div class="mb-2">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" id="email" name="email" class="form-control"  placeholder="abc@gmail.com" required>
                    </div>

                    <div class="mb-3">
                        <label for="event_image" class="form-label">Upload Event Poster/Image (optional):</label>
                        <input type="file" class="form-control" id="event_image" name="event_image" accept="image/*">
                    </div>

                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-success px-4">Submit & Download Receipt</button>
                    </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('home') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const facultyDropdown = document.getElementById('facultyForVenue');
        const hallDropdown = document.getElementById('hall');
        const dateInput = document.getElementById('date');
        const startTimeInput = document.getElementById('starttime');
        const endTimeInput = document.getElementById('endtime');
        const reasonField = document.getElementById('reasonField');
        const reasonInput = document.getElementById('reason');

        // Set min date to today + 7 days
        const today = new Date();
        const minDate = new Date(today.setDate(today.getDate() + 7)).toISOString().split('T')[0];
        dateInput.min = minDate;

        // Auto hide/show reason field for Wednesdays
        dateInput.addEventListener('change', function () {
            const selectedDate = new Date(dateInput.value);

            if (selectedDate.getDay() === 3) { // Wednesday
                reasonField.style.display = 'none';
                reasonInput.value = 'It is a Wednesday';
                reasonInput.required = false;
            } else {
                reasonField.style.display = 'block';
                reasonInput.value = '';
                reasonInput.required = true;
            }

            updateAvailableHalls(); // Refresh hall list on date change
        });

        startTimeInput.addEventListener('change', function () {
            const startTime = startTimeInput.value;
            endTimeInput.min = startTime;
            if (endTimeInput.value && endTimeInput.value <= startTime) {
                endTimeInput.value = '';
                alert('End time must be after start time.');
            }
            updateAvailableHalls(); // Refresh hall list on time change
        });

        endTimeInput.addEventListener('change', function () {
            const startTime = startTimeInput.value;
            const endTime = endTimeInput.value;
            if (endTime <= startTime) {
                alert('End time must be after start time.');
                endTimeInput.value = '';
            }
            updateAvailableHalls(); // Refresh hall list on time change
        });

        facultyDropdown.addEventListener('change', updateAvailableHalls);

        function updateAvailableHalls() {
            const faculty = facultyDropdown.value;
            const date = dateInput.value;
            const start = startTimeInput.value;
            const end = endTimeInput.value;

            if (!faculty || !date || !start || !end) return;

            fetch(`/get-available-halls/${faculty}/${date}/${start}/${end}`)
    .then(response => response.json())
    .then(data => {
        hallDropdown.innerHTML = '<option value="" disabled selected>Select Hall</option>';

        const hallsArray = Object.values(data); // ✅ Convert object to array

        if (hallsArray.length === 0) {
            hallDropdown.innerHTML += '<option disabled>No available halls</option>';
            return;
        }

        hallsArray.forEach(hall => {
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
        }
    });

    
</script>

@endsection
