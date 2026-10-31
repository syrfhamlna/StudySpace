<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Paparkan senarai kursus dan fungsi Search
    public function index(Request $request)
    {
        $search = trim($request->input('search', ''));

        $courses = Course::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('course_name', 'LIKE', "%{$search}%")
                        ->orWhere('course_code', 'LIKE', "%{$search}%");
                });
            })
            ->latest()
            ->get();

        return view('courses.index', compact('courses', 'search'));
    }

    // Paparkan borang tambah kursus
    public function create()
    {
        return view('courses.create');
    }

    // Simpan kursus baharu
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_code' => 'required|string|max:255|unique:courses,course_code',
            'course_name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'level' => 'nullable|string|max:255',
            'instructor' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Course::create($validated);

        return redirect('/courses')
            ->with('success', 'Course added successfully!');
    }

    // Paparkan borang edit kursus
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    // Kemaskini kursus
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'course_code' => 'required|string|max:255|unique:courses,course_code,' . $course->id,
            'course_name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'level' => 'nullable|string|max:255',
            'instructor' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $course->update($validated);

        return redirect('/courses')
            ->with('success', 'Course updated successfully!');
    }

    // Padam kursus
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect('/courses')
            ->with('success', 'Course deleted successfully!');
    }
}
