@extends('layouts.app')

@section('title', 'Manage Feedback | StudySpace')

@section('content')

<style>
    .feedback-header {
        margin-bottom: 30px;
    }

    .feedback-header h1 {
        font-size: 32px;
        letter-spacing: -1px;
        margin-bottom: 8px;
    }

    .feedback-header p {
        color: var(--muted);
        font-size: 13px;
    }

    .feedback-summary,
    .feedback-card,
    .empty-state {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 12px;
    }

    .feedback-summary {
        padding: 22px 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .feedback-summary h2 {
        font-size: 17px;
        margin-bottom: 6px;
    }

    .feedback-summary p {
        color: var(--muted);
        font-size: 12px;
    }

    .summary-number {
        font-size: 32px;
        font-weight: 700;
        color: var(--accent);
    }

    .feedback-list {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 17px;
    }

    .feedback-card {
        padding: 23px;
    }

    .feedback-card h3 {
        font-size: 17px;
        margin-bottom: 10px;
    }

    .feedback-user {
        color: var(--accent);
        font-size: 12px;
        margin-bottom: 16px;
    }

    .feedback-content {
        color: #C5CAD4;
        font-size: 13px;
        line-height: 1.7;
        overflow-wrap: anywhere;
        white-space: pre-wrap;
        margin-bottom: 18px;
    }

    .feedback-meta {
        color: var(--muted);
        font-size: 11px;
        padding-top: 14px;
        border-top: 1px solid var(--border);
    }

    .feedback-status {
        display: inline-block;
        background: #292E38;
        color: #C3D5FF;
        padding: 6px 9px;
        border-radius: 5px;
        font-size: 10px;
        text-transform: uppercase;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .feedback-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 17px;
    }

    .status-btn {
        background: var(--accent);
        color: #101827;
        border: none;
        border-radius: 7px;
        padding: 10px 14px;
        font-family: inherit;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
    }

    .delete-btn {
        background: #382426;
        color: #FF9999;
        border: none;
        border-radius: 7px;
        padding: 10px 14px;
        font-family: inherit;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
    }

    .empty-state {
        text-align: center;
        padding: 55px 20px;
        grid-column: 1 / -1;
    }

    .empty-state h3 {
        font-size: 18px;
        margin-bottom: 8px;
    }

    .empty-state p {
        color: var(--muted);
        font-size: 13px;
    }

    .success-message {
        background: #193326;
        color: #9BE2B5;
        padding: 13px 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 13px;
    }

    .error-message {
        background: #382426;
        color: #FF9999;
        padding: 13px 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 13px;
    }

    @media(max-width: 700px) {
        .feedback-list {
            grid-template-columns: 1fr;
        }

        .feedback-header h1 {
            font-size: 26px;
        }
    }
</style>

<div class="feedback-header">
    <h1>Manage Feedback</h1>
    <p>Review suggestions and messages submitted by StudySpace users.</p>
</div>

@if(session('success'))
    <div class="success-message">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="error-message">
        @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<div class="feedback-summary">
    <div>
        <h2>Total Feedback</h2>
        <p>All feedback submitted by registered users.</p>
    </div>

    <div class="summary-number">
        {{ $feedbacks->count() }}
    </div>
</div>

<div class="feedback-list">

    @forelse($feedbacks as $feedback)

        <div class="feedback-card">

            <span class="feedback-status">
                {{ $feedback->status }}
            </span>

            <h3>{{ $feedback->subject }}</h3>

            <p class="feedback-user">
                Submitted by:
                {{ $feedback->user->name ?? 'Unknown User' }}
            </p>

            <div class="feedback-content">{{ $feedback->message }}</div>

            <div class="feedback-meta">
                Submitted:
                {{ $feedback->created_at->format('d M Y, h:i A') }}
            </div>

            <div class="feedback-actions">

                <form
                    action="/feedback/{{ $feedback->id }}/status"
                    method="POST"
                >
                    @csrf
                    @method('PUT')

                    <input
                        type="hidden"
                        name="status"
                        value="{{ $feedback->status === 'new' ? 'reviewed' : 'new' }}"
                    >

                    <button type="submit" class="status-btn">
                        {{ $feedback->status === 'new' ? 'Mark as Reviewed' : 'Mark as New' }}
                    </button>
                </form>

                <form
                    action="/feedback/{{ $feedback->id }}"
                    method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this feedback?')"
                >
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="delete-btn">
                        Delete Feedback
                    </button>
                </form>

            </div>

        </div>

    @empty

        <div class="empty-state">
            <h3>No Feedback Yet</h3>
            <p>User feedback will appear here after they submit the form.</p>
        </div>

    @endforelse

</div>

@endsection
