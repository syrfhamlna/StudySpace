@extends('layouts.app')

@section('title', 'Submit Feedback | StudySpace')

@section('content')

<style>
    .feedback-container {
        max-width: 720px;
        margin: 20px auto;
    }

    .feedback-heading {
        margin-bottom: 28px;
    }

    .feedback-heading h1 {
        font-size: 32px;
        letter-spacing: -1px;
        margin-bottom: 9px;
    }

    .feedback-heading p {
        color: var(--muted);
        font-size: 13px;
    }

    .feedback-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 30px;
    }

    .feedback-card label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 9px;
    }

    .feedback-card input,
    .feedback-card textarea {
        width: 100%;
        background: #111318;
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 13px;
        color: #F4F5F7;
        font-family: inherit;
        font-size: 13px;
        outline: none;
        margin-bottom: 22px;
    }

    .feedback-card input:focus,
    .feedback-card textarea:focus {
        border-color: var(--accent);
    }

    .feedback-card textarea {
        min-height: 160px;
        resize: vertical;
    }

    .submit-feedback {
        background: var(--accent);
        color: #101827;
        border: none;
        border-radius: 8px;
        padding: 13px 20px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
    }

    .feedback-message {
        padding: 13px 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 13px;
    }

    .success-message {
        background: #193326;
        color: #9BE2B5;
    }

    .error-message {
        background: #382426;
        color: #FF9999;
    }

    @media(max-width: 600px) {
        .feedback-card {
            padding: 20px;
        }

        .feedback-heading h1 {
            font-size: 26px;
        }
    }
</style>

<div class="feedback-container">

    <div class="feedback-heading">
        <h1>Share Your Feedback</h1>
        <p>Help us improve StudySpace by sharing your thoughts and suggestions.</p>
    </div>

    @if(session('success'))
        <div class="feedback-message success-message">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="feedback-message error-message">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="feedback-card">

        <form action="/feedback" method="POST">
            @csrf

            <label for="subject">Feedback Subject</label>
            <input
                type="text"
                id="subject"
                name="subject"
                value="{{ old('subject') }}"
                placeholder="Enter your feedback subject"
                maxlength="255"
                required
            >

            <label for="message">Your Message</label>
            <textarea
                id="message"
                name="message"
                placeholder="Write your feedback or suggestions here..."
                maxlength="2000"
                required
            >{{ old('message') }}</textarea>

            <button type="submit" class="submit-feedback">
                Submit Feedback
            </button>

        </form>

    </div>

</div>

@endsection
