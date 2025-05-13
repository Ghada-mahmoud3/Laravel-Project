<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\CandidateProfile;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $candidate = $user->candidateProfile;

        return view('profile.show', compact('user', 'candidate'));
    }

    // public function edit()
    // {
    //     $user = auth()->user();
    //     $candidate = $user->candidate;

    //     return view('profile.edit', compact('user', 'candidate'));
    // }

    public function update(Request $request)
{
    $user = auth()->user();
    $candidate = $user->candidateProfile;

    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'nullable|string|max:20',
        'skills' => 'nullable|string|max:1000',
        'bio' => 'nullable|string|max:1000',
        'location' => 'nullable|string|max:255',
        'experience' => 'nullable|string|max:1000',
        'education' => 'nullable|string|max:1000',
        'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
    ]);

    // Update user name
    $user->update([
        'name' => $request->name,
    ]);

    // Create a new profile if one doesn't exist
    if (!$candidate) {
        $candidate = new \App\Models\CandidateProfile(); // Make sure to use the correct model
        $candidate->user_id = $user->id;
    }

    // Update candidate profile fields
    $candidate->phone = $request->phone;
    $candidate->skills = $request->skills;
    $candidate->bio = $request->bio;
    $candidate->location = $request->location;
    $candidate->experience = $request->experience;
    $candidate->education = $request->education;

    // Handle resume upload
    if ($request->hasFile('resume')) {
        $path = $request->file('resume')->store('resumes', 'public');
        $candidate->resume = $path; // ✅ Use correct column name
    }

    $candidate->save();

    return back()->with('success', 'Profile updated successfully.');
}



    public function edit(Request $request): View
    {
        $user = $request->user();
        $candidate = $user->candidateProfile;
    
        return view('profile.edit', [
            'user' => $user,
            'candidate' => $candidate,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    // public function update(ProfileUpdateRequest $request): RedirectResponse
    // {
    //     $request->user()->fill($request->validated());

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }

    //     $request->user()->save();

    //     return Redirect::route('profile.edit')->with('status', 'profile-updated');
    // }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

