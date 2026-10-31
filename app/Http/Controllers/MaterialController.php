<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Course;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    // Paparkan bahan pembelajaran dan fungsi Search
    public function index(Request $request)
    {
        $search = trim($request->input('search', ''));

        $materials = Material::with('course')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('title', 'LIKE', "%{$search}%")
                        ->orWhere('material_type', 'LIKE', "%{$search}%")
                        ->orWhereHas('course', function ($courseQuery) use ($search) {
                            $courseQuery->where('course_name', 'LIKE', "%{$search}%");
                        });
                });
            })
            ->latest()
            ->get();

        return view('materials.index', compact('materials', 'search'));
    }

    // Paparkan borang tambah bahan
    public function create()
    {
        $courses = Course::all();

        return view('materials.create', compact('courses'));
    }

    // Simpan bahan baharu
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'file_path' => 'required|string|max:255',
            'material_type' => 'required|string|max:255',
        ]);

        Material::create($validated);

        return redirect('/materials')
            ->with('success', 'Study material added successfully!');
    }

    // Paparkan borang edit bahan
    public function edit(Material $material)
    {
        $courses = Course::all();

        return view('materials.edit', compact('material', 'courses'));
    }

    // Kemaskini bahan
    public function update(Request $request, Material $material)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'file_path' => 'required|string|max:255',
            'material_type' => 'required|string|max:255',
        ]);

        $material->update($validated);

        return redirect('/materials')
            ->with('success', 'Study material updated successfully!');
    }

    // Padam bahan
    public function destroy(Material $material)
    {
        $material->delete();

        return redirect('/materials')
            ->with('success', 'Study material deleted successfully!');
    }
}
