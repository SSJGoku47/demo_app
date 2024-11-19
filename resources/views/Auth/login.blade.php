<!-- resources/views/Auth/login.blade.php -->
@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card shadow" style="border-radius: 1rem;">
                    <div class="card-header d-flex justify-content-center align-items-center">
                        <h3 class="mb-4">Login</h3>
                      </div>
                    <div class="card-body p-5 text-center">
                    
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form-outline mb-4">
                                <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="Email" required />
                            </div>
                    
                            <div class="form-outline mb-4">
                                <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Password" required />
                            </div>

                            <div class="d-flex justify-content-between mb-5">
                                <a href="{{ route('register') }}" class="text-primary me-3 text-decoration-none">New User?</a>
                                <a href="{{ route('password.reset') }}" class="text-primary text-decoration-none">Forgot Password?</a>
                            </div>

                            <button class="btn btn-primary btn-lg btn-block mb-3" type="submit">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
