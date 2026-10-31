@extends('layouts.app')

@section('title', 'Create Account | StudySpace')

@section('content')
<div style="max-width: 480px; margin: 45px auto;">
    <div class="page-heading" style="text-align: center;">
        <p style="color: var(--accent); font-weight: 700; letter-spacing: 2px; font-size: 11px;">
            JOIN STUDYSPACE
        </p>
        <h1 style="font-size: 32px; margin-top: 12px;">Create your account</h1>
        <p>Start organising your learning resources today.</p>
    </div>

    <div class="card">
        <form action="{{ url('/register') }}" method="POST">
            @csrf

            <label for="name">Full Name</label>
            <input type="text" id="name" name="name"
                   value="{{ old('name') }}"
                   placeholder="Enter your full name" required>
            @error('name')
                <p class="error-message">{{ $message }}</p>
            @enderror

            <label for="email">Email Address</label>
            <input type="email" id="email" name="email"
                   value="{{ old('email') }}"
                   placeholder="name@example.com" required>
            @error('email')
                <p class="error-message">{{ $message }}</p>
            @enderror

            <label for="password">Password</label>
            <input type="password" id="password" name="password"
                   placeholder="Minimum 8 characters" required>
            @error('password')
                <p class="error-message">{{ $message }}</p>
            @enderror

            <label for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation"
                   name="password_confirmation"
                   placeholder="Re-enter your password" required>

            <button type="submit" class="btn"
                    style="width: 100%; margin-top: 28px;">
                Create Account
            </button>
        </form>

        <p style="text-align: center; color: var(--muted); font-size: 13px; margin-top: 24px;">
            Already have an account?
            <a href="{{ url('/login') }}"
               style="color: var(--accent); text-decoration: none; font-weight: 600;">
                Login
            </a>
        </p>
    </div>
</div>
@endsection
