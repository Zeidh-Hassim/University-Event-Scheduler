@extends('nav.navbar')
<div class="container">
    <div class="row">
        <div class="col-md-5" style="padding-top:15%">
            <h3 class="text-center">Login</h3>
        </div>
        <div class="col-md-7" style="padding:10%">
            <form action="{{ route('loginsubmit') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="username" class="form-control" id="email" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn btn-danger w-100">Login</button>
            </form>
        </div>
    </div>
</div>