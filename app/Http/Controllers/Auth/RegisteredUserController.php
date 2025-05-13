<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\EmployerProfile;
use App\Models\CandidateProfile;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function roleSelection(): View
    {
        return view('auth.role-selection');
    }

    public function createEmployer(): View
    {
        return view('auth.register');
    }

    public function storeEmployer(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'company_name' => ['required', 'string', 'max:255'],
            'company_logo' => ['nullable', 'image', 'max:2048'], // Max 2MB
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'employer',
        ]);

        // Create employer profile
        $employerProfile = EmployerProfile::create([
            'user_id' => $user->id,
            'company_name' => $request->company_name,
        ]);

        // Handle company logo upload
        if ($request->hasFile('company_logo')) {
            $path = $request->file('company_logo')->store('logos', 'public');
            $employerProfile->update(['company_logo' => $path]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    public function createCandidate(): View
    {
        return view('auth.register-candidate');
    }

    public function storeCandidate(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['nullable', 'string', 'max:20'],
            'skills' => ['nullable', 'string', 'max:1000'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'location' => ['nullable', 'string', 'max:255'],
            'experience' => ['nullable', 'string', 'max:1000'],
            'education' => ['nullable', 'string', 'max:1000'],
            'resume' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:2048'],
        ]);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'candidate',
        ]);

        // Prepare profile data
        $profileData = [
            'user_id' => $user->id,
            'phone' => $request->phone,
            'skills' => $request->skills,
            'bio' => $request->bio,
            'location' => $request->location,
            'experience' => $request->experience,
            'education' => $request->education,
        ];


        if ($request->hasFile('resume')) {
            $path = $request->file('resume')->store('resumes', 'public');
            $profileData['resume'] = $path;
        }


        CandidateProfile::create($profileData);

        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('dashboard');
    }

}