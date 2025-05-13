<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;

class ApplicationController extends Controller
{
    public function index()
{
    $applications = auth()->user()->applications()->with('job')->latest()->get();
    return view('applications.index', compact('applications'));
}

public function store(Request $request)
{
    $request->validate([
        'job_id' => 'required|exists:jobs_listing,id',
        'resume' => 'required|mimes:pdf,doc,docx|max:2048',
        'email' => 'required|email:rfc,dns|max:255',
        'phone' => 'required|regex:/^\+?[0-9]{8,15}$/',
        'message' => 'nullable|string|max:1000',
    ]);

    
    $resumePath = $request->file('resume')->store('resumes','public');

    Application::create([
        'user_id' => auth()->id(),
        'job_id' => $request->job_id,
        'resume_path' => $resumePath,
        'email' => $request->email,
        'phone' => $request->phone,
        'message' => $request->message,
        'status' => 'pending',
    ]);

    return redirect()->back()->with('success', 'Application submitted successfully.');
}

    public function destroy($id)
    {
        $application = Application::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        // $application->delete();
        $application->update(['status' => 'canceled']);

        return redirect()->back()->with('success', 'Application canceled.');
    }
}
