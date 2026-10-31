 @extends('layouts.app')

@section('title', 'Add Course | StudySpace')

@section('content')

<style>
    .form-container {
        max-width: 760px;
        margin: 0 auto;
    }

    .form-heading {
        margin-bottom: 25px;
    }

    .form-heading h1 {
        color: var(--text);
        font-size: 30px;
        letter-spacing: -1px;
        margin-bottom: 9px;
    }

    .form-heading p {
        color: var(--muted);
        font-size: 13px;
        line-height: 1.6;
    }

    .course-form {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 13px;
        padding: 28px;
    }

    .form-section-title {
        color: var(--text);
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .form-section-description {
        color: var(--muted);
        font-size: 12px;
        margin-bottom: 12px;
    }

    .form-group {
        margin-bottom: 19px;
    }

    .form-group label {
        display: block;
        color: #D7DAE2;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        margin-top: 0;
    }

    .form-group textarea {
        resize: vertical;
        min-height: 110px;
    }

    .required {
        color: var(--accent);
    }

    .field-error {
        color: #FF8585;
        font-size: 11px;
        margin-top: 7px;
    }

    .error-summary {
        background: #382426;
        color: #FF9999;
        border: 1px solid #593438;
        padding: 14px 17px;
        border-radius: 8px;
        margin-bottom: 22px;
        font-size: 12px;
    }

    .error-summary ul {
        padding-left: 19px;
        margin-top: 8px;
        line-height: 1.8;
    }

    .form-divider {
        border: none;
        border-top: 1px solid var(--border);
        margin: 24px 0;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 25px;
    }

    .cancel-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #292E38;
        color: var(--text);
        text-decoration: none;
        padding: 12px 19px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
    }

    .cancel-btn:hover {
        background: #363D49;
    }

    @media(max-width: 600px) {
        .course-form {
            padding: 20px;
        }

        .form-heading h1 {
            font-size: 26px;
        }

        .form-actions {
            flex-direction: column-reverse;
        }

        .form-actions a,
        .form-actions button {
            width: 100%;
        }
    }
</style>

<div class="form-container">

    <div class="form-heading">
        <h1>Add New Course</h1>
        <p>Create a new course and organise your learning collection.</p>
    </div>

    <div class="course-form">

        <h2 class="form-section-title">Course Information</h2>
        <p class="form-section-description">
            Complete the details below to register a new course.
        </p>

        @if ($errors->any())
            <div class="error-summary">
                <strong>Please correct the following errors:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/courses" method="POST">
            @csrf

            <div class="form-group">
                <label for="course_code">
                    Course Code <span class="required">*</span>
                </label>

                <input
                    type="text"
                    id="course_code"
                    name="course_code"
                    value="{{ old('course_code') }}"
                    placeholder="Example: CSC1413"
                    required
                >

                @error('course_code')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="course_name">
                    Course Name <span class="required">*</span>
                </label>

                <input
                    type="text"
                    id="course_name"
                    name="course_name"
                    value="{{ old('course_name') }}"
                    placeholder="Enter course name"
                    required
                >

                @error('course_name')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="subject">
                    Subject <span class="required">*</span>
                </label>

                <input
                    type="text"
                    id="subject"
                    name="subject"
                    value="{{ old('subject') }}"
                    placeholder="Enter subject"
                    required
                >

                @error('subject')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="level">Academic Level</label>

                <select id="level" name="level">
                    <option value="">Select level</option>
                    <option value="Beginner" {{ old('level') == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                    <option value="Intermediate" {{ old('level') == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                    <option value="Advanced" {{ old('level') == 'Advanced' ? 'selected' : '' }}>Advanced</option>
                </select>

                @error('level')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="instructor">
                    Instructor <span class="required">*</span>
                </label>

                <input
                    type="text"
                    id="instructor"
                    name="instructor"
                    value="{{ old('instructor') }}"
                    placeholder="Enter instructor name"
                    required
                >

                @error('instructor')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Course Description</label>

                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    placeholder="Write a short description about this course..."
                >{{ old('description') }}</textarea>

                @error('description')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <hr class="form-divider">

            <div class="form-actions">
                <a href="/courses" class="cancel-btn">
                    Cancel
                </a>

                <button type="submit" class="btn">
                    Save Course
                </button>
            </div>

        </form>
    </div>
</div>

@endsection