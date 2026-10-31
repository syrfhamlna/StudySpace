<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    // Paparkan borang feedback
    public function create()
    {
        return view('feedback.create');
    }

    // Simpan feedback daripada pengguna
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        Feedback::create([
            'user_id' => Auth::id(),
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'status' => 'new',
        ]);

        return redirect('/feedback/create')
            ->with('success', 'Your feedback has been submitted successfully!');
    }

    // Paparkan semua feedback kepada Admin
    public function index()
    {
        $feedbacks = Feedback::with('user')->latest()->get();

        return view('feedback.index', compact('feedbacks'));
    }

    // Kemas kini status feedback
    public function updateStatus(Request $request, Feedback $feedback)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,reviewed',
        ]);

        $feedback->update([
            'status' => $validated['status'],
        ]);

        return redirect('/feedback')
            ->with('success', 'Feedback status updated successfully!');
    }

    // Padam feedback
    public function destroy(Feedback $feedback)
    {
        $feedback->delete();

        return redirect('/feedback')
            ->with('success', 'Feedback deleted successfully!');
    }
}