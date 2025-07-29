@extends('nav.navbar')
{{-- <div class="container">
    <div class="row">
        <div class="col-md-5" style="padding-top:15%">
            <h3 class="text-center">Login</h3>
        </div>
        <div class="col-md-7" style="padding:10%">
            <form action="{{ route('loginsubmit') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn btn-danger w-100">Login</button>
            </form>
        </div>
    </div>
</div> --}}

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="row w-100 justify-content-center">
        <div class="col-md-6 col-lg-5">
            <form action="{{ route('loginsubmit') }}" method="POST" class="border p-4 shadow rounded bg-white">
                @csrf
                <h4 class="mb-4 text-center">Login</h4>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required>
                </div>
               <button type="submit" class="btn btn-danger w-100">Login</button>

                <button type="#" class="btn btn-danger w-100 mt-2">Reset Password</button>

            </form>
        </div>
    </div>
</div>


<div class="text-center mt-5">
    <a href="{{route('home') }}" class="btn btn-secondary">Back</a>
</div>