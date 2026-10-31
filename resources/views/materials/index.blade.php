@extends('layouts.app')

@section('title', 'Study Materials | StudySpace')

@section('content')

<style>
    .materials-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 25px;
        flex-wrap: wrap;
    }

    .materials-header h1 {
        font-size: 32px;
        letter-spacing: -1px;
        margin-bottom: 8px;
    }

    .materials-header p {
        color: var(--muted);
        font-size: 13px;
    }

    .materials-search {
        display: flex;
        gap: 10px;
        margin-bottom: 25px;
        max-width: 600px;
    }

    .materials-search input {
        flex: 1;
        min-width: 0;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 13px 15px;
        color: #F4F5F7;
        font-family: inherit;
        font-size: 13px;
        outline: none;
    }

    .materials-search input:focus {
        border-color: var(--accent);
    }

    .search-btn,
    .add-material-btn {
        background: var(--accent);
        color: #101827;
        border: none;
        border-radius: 8px;
        padding: 12px 17px;
        font-family: inherit;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }

    .clear-search {
        color: var(--muted);
        font-size: 12px;
        text-decoration: none;
        align-self: center;
    }

    .materials-list {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 17px;
    }

    .material-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 23px;
    }

    .material-type {
        display: inline-block;
        background: #292E38;
        color: var(--accent);
        padding: 6px 9px;
        border-radius: 5px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 14px;
    }

    .material-card h3 {
        font-size: 17px;
        margin-bottom: 10px;
    }

    .material-course {
        color: var(--accent);
        font-size: 12px;
        margin-bottom: 13px;
    }

    .material-file {
        color: var(--muted);
        font-size: 12px;
        overflow-wrap: anywhere;
        margin-bottom: 18px;
    }

    .material-actions {
        display: flex;
        gap: 9px;
        flex-wrap: wrap;
        padding-top: 15px;
        border-top: 1px solid var(--border);
    }

    .edit-btn {
        background: #26364C;
        color: #C3D5FF;
        border: none;
        border-radius: 7px;
        padding: 9px 13px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
    }

    .delete-btn {
        background: #382426;
        color: #FF9999;
        border: none;
        border-radius: 7px;
        padding: 9px 13px;
        font-family: inherit;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
    }

    .empty-state {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 12px;
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
        margin-bottom: 17px;
    }

    .success-message {
        background: #193326;
        color: #9BE2B5;
        padding: 13px 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 13px;
    }

    @media(max-width: 700px) {
        .materials-list {
            grid-template-columns: 1fr;
        }

        .materials-header h1 {
            font-size: 26px;
        }

        .materials-search {
            max-width: 100%;
        }
    }
</style>

<div class="materials-header">
    <div>
        <h1>Study Materials</h1>
        <p>Explore and manage learning resources available in StudySpace.</p>
    </div>

    @if(Auth::user()->role === 'admin')
        <a href="/materials/create" class="add-material-btn">
            + Add New Material
        </a>
    @endif
</div>

@if(session('success'))
    <div class="success-message">
        {{ session('success') }}
    </div>
@endif

<form action="/materials" method="GET" class="materials-search">

    <input
        type="text"
        name="search"
        value="{{ $search ?? '' }}"
        placeholder="Search by material title, course or type..."
    >

    <button type="submit" class="search-btn">
        Search
    </button>

    @if(!empty($search))
        <a href="/materials" class="clear-search">
            Clear
        </a>
    @endif

</form>

<div class="materials-list">

    @forelse($materials as $material)

        <div class="material-card">

            <span class="material-type">
                {{ $material->material_type }}
            </span>

            <h3>{{ $material->title }}</h3>

            <p class="material-course">
                Course: {{ $material->course->course_name ?? 'Unknown Course' }}
            </p>

            <p class="material-file">
                File: {{ $material->file_path }}
            </p>

            @if(Auth::user()->role === 'admin')
                <div class="material-actions">

                    <a
                        href="/materials/{{ $material->id }}/edit"
                        class="edit-btn"
                    >
                        Edit
                    </a>

                    <form
                        action="/materials/{{ $material->id }}"
                        method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this material?')"
                    >
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="delete-btn">
                            Delete
                        </button>
                    </form>

                </div>
            @endif

        </div>

    @empty

        <div class="empty-state">

            <h3>
                {{ !empty($search) ? 'No Results Found' : 'No Study Materials Yet' }}
            </h3>

            <p>
                {{ !empty($search)
                    ? 'Try another keyword or clear your search.'
                    : 'Study materials will appear here once they are added.' }}
            </p>

            @if(!empty($search))
                <a href="/materials" class="add-material-btn">
                    Clear Search
                </a>
            @elseif(Auth::user()->role === 'admin')
                <a href="/materials/create" class="add-material-btn">
                    Add First Material
                </a>
            @endif

        </div>

    @endforelse

</div>

@endsection
