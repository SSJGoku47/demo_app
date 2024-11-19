<!-- resources/views/Auth/password-reset.blade.php -->
@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow" style="border-radius: 1rem;">
                    <div class="card-header d-flex justify-content-center align-items-center">
                        <h3 class="mb-4">Reset Password</h3>
                      </div>
                    <div class="card-body p-5 text-center">
                    
                        <form action="{{ route('password.reset') }}" method="POST">
                            @csrf

                            <div class="form-group mb-3 d-flex align-items-center">
                                <label for="email" class="me-3 mb-0" style="width: 150px; text-align: left;">Email:</label>
                                <input type="email" name="email" id="email" required class="form-control" placeholder="Enter email">
                            </div>
                            
                            <div class="form-group mb-3 d-flex align-items-center">
                                <label for="password" class="me-3 mb-0" style="width: 150px; text-align: left;">Password:</label>
                                <input type="password" name="password" id="password" required class="form-control" placeholder="Enter password">
                            </div>
                    
                            <div class="form-group mb-3 d-flex align-items-center">
                                <label for="confirm_password" class="me-3 mb-0" style="width: 150px; text-align: left;">Confirm Password:</label>
                                <input type="password" name="confirm_password" id="confirm_password" required class="form-control" placeholder="Confirm password">
                            </div>
                            <button class="btn btn-primary btn-lg btn-block mb-3 mt-5" type="submit">Reset</button>
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('login') }}" class="btn btn-secondary btn-md">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
