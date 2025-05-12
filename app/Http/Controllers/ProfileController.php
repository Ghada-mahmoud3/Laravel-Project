<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $candidate = $user->candidate;

        return view('profile.show', compact('user', 'candidate'));
    }

    public function edit()
    {
        $user = auth()->user();
        $candidate = $user->candidate;

        return view('profile.edit', compact('user', 'candidate'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $candidate = $user->candidate;

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'skills' => 'nullable|string|max:1000',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'bio' => 'nullable|string|max:1000',
        ]);

        $user->update([
            'name' => $request->name,
        ]);

        if (!$candidate) {
            $candidate = new Candidate(['user_id' => $user->id]);
        }

        $candidate->phone = $request->phone;
        $candidate->skills = $request->skills;
        $candidate->bio = $request->bio;

        if ($request->hasFile('resume')) {
            $path = $request->file('resume')->store('resumes');
            $candidate->resume_path = $path;
        }

        $candidate->save();

        return back()->with('success', 'Profile updated successfully.');
    }
}

