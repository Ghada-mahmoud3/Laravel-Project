<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile.show');
    }

    public function edit()
    {
        return view('profile.edit');
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'skills' => 'nullable|string|max:1000',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Update basic info
        $user->update($request->only(['name', 'phone', 'skills']));

        // Update resume
        if ($request->hasFile('resume')) {
            $path = $request->file('resume')->store('resumes');
            $user->resume_path = $path;
            $user->save();
        }

        return back()->with('success', 'Profile updated.');
    }
}
