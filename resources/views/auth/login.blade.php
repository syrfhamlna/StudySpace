@extends('layouts.app')

@section('title', 'Login | StudySpace')

@section('content')
<div style="max-width: 480px; margin: 55px auto;">
    <div class="page-heading" style="text-align: center;">
        <p style="color: var(--accent); font-weight: 700; letter-spacing: 2px; font-size: 11px;">
            WELCOME BACK
        </p>
        <h1 style="font-size: 32px; margin-top: 12px;">Login to StudySpace</h1>
        <p>Continue your learning journey.</p>
    </div>

    <div class="card">
        <form action="{{ url('/login') }}" method="POST">
            @csrf

            <label for="email">Email Address</label>
            <input type="email" id="email" name="email"
                   value="{{ old('email') }}"
                   placeholder="name@example.com" required autofocus>

            @error('email')
                <p class="error-message">{{ $message }}</p>
            @enderror

            <label for="password">Password</label>
            <input type="password" id="password" name="password"
                   placeholder="Enter your password" required>

            <button type="submit" class="btn"
                    style="width: 100%; margin-top: 28px;">
                Login
            </button>
        </form>

        <p style="text-align: center; color: var(--muted); font-size: 13px; margin-top: 24px;">
            Don't have an account?
            <a href="{{ url('/register') }}"
               style="color: var(--accent); text-decoration: none; font-weight: 600;">
                Sign Up
            </a>
        </p>
    </div>
</div>
@endsection
