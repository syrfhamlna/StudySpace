@extends('layouts.app')

@section('title', 'Courses | StudySpace')

@section('content')

<style>
    .courses-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 18px;
        margin-bottom: 28px;
    }

    .courses-header h1 {
        font-size: 32px;
        color: var(--text);
        letter-spacing: -1px;
        margin-bottom: 8px;
    }

    .courses-header p {
        font-size: 13px;
        color: var(--muted);
        line-height: 1.6;
    }

    .add-course-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: var(--accent);
        color: #101827;
        text-decoration: none;
        padding: 12px 18px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 700;
        transition: .2s;
    }

    .add-course-btn:hover {
        background: #8BB0FF;
    }

    .course-summary {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
    }

    .course-summary h2 {
        font-size: 18px;
        margin-bottom: 7px;
        color: var(--text);
    }

    .course-summary p {
        color: var(--muted);
        font-size: 12px;
    }

    .summary-number {
        font-size: 34px;
        font-weight: 700;
        color: var(--accent);
    }

    .search-panel {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 21px;
        margin-bottom: 28px;
    }

    .search-panel label {
        margin: 0 0 10px;
    }

    .search-row {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .search-row input {
        flex: 1;
        min-width: 200px;
        margin: 0;
    }

    .search-btn, .reset-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 18px;
        border-radius: 8px;
        border: none;
        font-family: inherit;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
    }

    .search-btn {
        background: var(--accent);
        color: #101827;
    }

    .reset-btn {
        background: #292E38;
        color: var(--text);
    }

    .search-btn:hover { background: #8BB0FF; }
    .reset-btn:hover { background: #363D49; }

    .list-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        margin-bottom: 17px;
    }

    .list-heading h2 {
        font-size: 18px;
        color: var(--text);
    }

    .list-heading span {
        font-size: 12px;
        color: var(--muted);
    }

    .course-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 17px;
    }

    .course-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 23px;
        display: flex;
        flex-direction: column;
        transition: border-color .2s;
    }

    .course-card:hover {
        border-color: #46536A;
    }

    .course-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 19px;
    }

    .course-label {
        color: var(--accent);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .course-code {
        background: #292E38;
        color: #C3D5FF;
        padding: 7px 10px;
        border-radius: 6px;
        font-size: 10px;
        font-weight: 700;
    }

    .course-card h3 {
        color: var(--text);
        font-size: 18px;
        line-height: 1.4;
        margin-bottom: 7px;
    }

    .course-subject {
        color: var(--muted);
        font-size: 12px;
        margin-bottom: 19px;
    }

    .course-details {
        border-top: 1px solid var(--border);
        padding-top: 16px;
        margin-bottom: 17px;
        flex-grow: 1;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 12px;
        font-size: 12px;
    }

    .detail-row span:first-child {
        color: var(--muted);
    }

    .detail-row span:last-child {
        color: #DCE0E8;
        font-weight: 600;
        text-align: right;
    }

    .course-description {
        color: var(--muted);
        font-size: 12px;
        line-height: 1.7;
        margin-bottom: 19px;
    }

    .course-actions {
        display: flex;
        gap: 9px;
        border-top: 1px solid var(--border);
        padding-top: 16px;
    }

    .edit-btn, .delete-btn {
        flex: 1;
        text-align: center;
        padding: 10px;
        border-radius: 7px;
        font-family: inherit;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        transition: .2s;
    }

    .edit-btn {
        background: #292E38;
        color: #DCE5F7;
    }

    .edit-btn:hover {
        background: #363D49;
    }

    .delete-btn {
        background: #382426;
        color: #FF9999;
        border: 1px solid #593438;
    }

    .delete-btn:hover {
        background: #4A2B30;
    }

    .empty-state {
        background: var(--surface);
        border: 1px dashed #414957;
        border-radius: 12px;
        text-align: center;
        padding: 55px 20px;
        grid-column: 1 / -1;
    }

    .empty-state h3 {
        color: var(--text);
        margin-bottom: 9px;
        font-size: 18px;
    }

    .empty-state p {
        color: var(--muted);
        font-size: 13px;
        margin-bottom: 20px;
        line-height: 1.6;
    }

    @media(max-width: 700px) {
        .course-grid {
            grid-template-columns: 1fr;
        }

        .courses-header h1 {
            font-size: 26px;
        }

        .course-summary {
            padding: 20px;
        }
    }
</style>

<div class="courses-header">
    <div>
        <h1>Course Management</h1>
        <p>Discover, organise and manage your learning courses.</p>
    </div>

    @if(auth()->user()->role === 'admin')
        <a href="/courses/create" class="add-course-btn">
            + Add New Course
        </a>
    @endif
</div>

<div class="course-summary">
    <div>
        <h2>Your Learning Collection</h2>
        <p>Manage all your courses in one organised space.</p>
    </div>

    <div class="summary-number">
        {{ $courses->count() }}
    </div>
</div>

<div class="search-panel">
    <form action="/courses" method="GET">
        <label>Search Your Courses</label>

        <div class="search-row">
            <input
                type="text"
                name="search"
                placeholder="Enter course name or course code..."
                value="{{ $search ?? '' }}"
            >

            <button type="submit" class="search-btn">
                Search
            </button>

            <a href="/courses" class="reset-btn">
                Reset
            </a>
        </div>
    </form>
</div>

<div class="list-heading">
    <h2>Available Courses</h2>
    <span>{{ $courses->count() }} course(s) found</span>
</div>

<div class="course-grid">

    @forelse ($courses as $course)

        <div class="course-card">

            <div class="course-top">
                <span class="course-label">StudySpace Course</span>

                <span class="course-code">
                    {{ $course->course_code }}
                </span>
            </div>

            <h3>{{ $course->course_name }}</h3>

            <p class="course-subject">
                {{ $course->subject }}
            </p>

            <div class="course-details">

                <div class="detail-row">
                    <span>Academic Level</span>
                    <span>{{ $course->level ?? 'Not specified' }}</span>
                </div>

                <div class="detail-row">
                    <span>Instructor</span>
                    <span>{{ $course->instructor ?: 'Not specified' }}</span>
                </div>

            </div>

            <p class="course-description">
                {{ $course->description ?: 'No course description available.' }}
            </p>

            @if(auth()->user()->role === 'admin')
                <div class="course-actions">

                    <a href="/courses/{{ $course->id }}/edit" class="edit-btn">
                        Edit Course
                    </a>

                    <form
                        action="/courses/{{ $course->id }}"
                        method="POST"
                        style="flex:1;"
                        onsubmit="return confirm('Are you sure you want to delete this course?')"
                    >
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="delete-btn" style="width:100%;">
                            Delete
                        </button>
                    </form>

                </div>
            @endif

        </div>

    @empty

        <div class="empty-state">
            <h3>No Courses Found</h3>

            <p>
                There are no courses available yet.
                Start building your learning collection today.
            </p>

            @if(auth()->user()->role === 'admin')
                <a href="/courses/create" class="add-course-btn">
                    + Add Your First Course
                </a>
            @endif
        </div>

    @endforelse

</div>

@endsection
