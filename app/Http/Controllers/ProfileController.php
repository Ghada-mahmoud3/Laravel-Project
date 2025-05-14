<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function showOther($id)
    {
        if (!auth()->user() || !auth()->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }
        $user = \App\Models\User::findOrFail($id);
        $candidate = $user->candidateProfile;

        return view('profile.show', compact('user', 'candidate'));
    }

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

        $user->update([
            'name' => $request->name,
        ]);

        if (!$candidate) {
            $candidate = new \App\Models\CandidateProfile();
            $candidate->user_id = $user->id;
        }

        $candidate->phone = $request->phone;
        $candidate->skills = $request->skills;
        $candidate->bio = $request->bio;
        $candidate->location = $request->location;
        $candidate->experience = $request->experience;
        $candidate->education = $request->education;

        if ($request->hasFile('resume')) {
            $path = $request->file('resume')->store('resumes', 'public');
            $candidate->resume = $path;
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

