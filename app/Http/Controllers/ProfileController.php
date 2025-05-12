<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
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
        $candidate = $user->candidate;

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

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

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

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
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

