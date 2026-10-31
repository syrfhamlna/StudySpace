
@extends('layouts.app')

@section('title', 'Add Study Material | StudySpace')

@section('content')

<style>
    .form-container {
        max-width: 720px;
        margin: 0 auto;
    }

    .form-header {
        margin-bottom: 28px;
    }

    .form-header h1 {
        font-size: 32px;
        letter-spacing: -1px;
        margin-bottom: 9px;
    }

    .form-header p {
        color: var(--muted);
        font-size: 13px;
        line-height: 1.7;
    }

    .material-form {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 30px;
    }

    .form-description {
        padding-bottom: 22px;
        border-bottom: 1px solid var(--border);
        margin-bottom: 8px;
    }

    .form-description h2 {
        font-size: 17px;
        margin-bottom: 7px;
    }

    .form-description p {
        color: var(--muted);
        font-size: 12px;
        line-height: 1.6;
    }

    .form-group {
        margin-bottom: 21px;
    }

    .form-group label {
        margin-top: 0;
        margin-bottom: 9px;
    }

    .form-group input,
    .form-group select {
        margin-top: 0;
    }

    .form-help {
        color: var(--muted);
        font-size: 11px;
        margin-top: 8px;
    }

    .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 28px;
        padding-top: 22px;
        border-top: 1px solid var(--border);
        flex-wrap: wrap;
    }

    .back-btn {
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

    .back-btn:hover {
        background: #363D49;
    }

    .validation-error {
        color: #FF8585;
        font-size: 12px;
        margin-top: 7px;
    }

    @media(max-width: 600px) {
        .form-header h1 {
            font-size: 26px;
        }

        .material-form {
            padding: 21px;
        }
    }
</style>

<div class="form-container">

    <div class="form-header">
        <h1>Add Study Material</h1>
        <p>Add a new learning resource and connect it to one of your courses.</p>
    </div>

    <div class="material-form">

        <div class="form-description">
            <h2>Material Information</h2>
            <p>Complete the details below to add your study resource.</p>
        </div>

        <form action="/materials" method="POST">
            @csrf

            <div class="form-group">
                <label for="title">Material Title</label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title') }}"
                    placeholder="Enter material title"
                    required
                >

                @error('title')
                    <div class="validation-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="course_id">Select Course</label>
                <select id="course_id" name="course_id" required>
                    <option value="">-- Select Course --</option>

                    @foreach ($courses as $course)
                        <option
                            value="{{ $course->id }}"
                            {{ old('course_id') == $course->id ? 'selected' : '' }}
                        >
                            {{ $course->course_name }}
                        </option>
                    @endforeach
                </select>

                @error('course_id')
                    <div class="validation-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="material_type">Material Type</label>
                <select id="material_type" name="material_type" required>
                    <option value="">-- Select Type --</option>
                    <option value="PDF" {{ old('material_type') == 'PDF' ? 'selected' : '' }}>PDF</option>
                    <option value="Video" {{ old('material_type') == 'Video' ? 'selected' : '' }}>Video</option>
                    <option value="Notes" {{ old('material_type') == 'Notes' ? 'selected' : '' }}>Notes</option>
                    <option value="Slides" {{ old('material_type') == 'Slides' ? 'selected' : '' }}>Slides</option>
                </select>

                @error('material_type')
                    <div class="validation-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="file_path">File Path</label>
                <input
                    type="text"
                    id="file_path"
                    name="file_path"
                    value="{{ old('file_path') }}"
                    placeholder="Example: materials/programming.pdf"
                    required
                >

                <p class="form-help">
                    Enter the file path or resource location.
                </p>

                @error('file_path')
                    <div class="validation-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn">
                    Save Material
                </button>

                <a href="/materials" class="back-btn">
                    Cancel
                </a>
            </div>

        </form>
    </div>
</div>

@endsection
