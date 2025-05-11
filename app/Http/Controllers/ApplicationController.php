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
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'job_id' => 'required|exists:jobs,id',
        ]);

        $path = $request->file('resume')->store('resumes');

        Application::create([
            'user_id' => auth()->id(),
            'job_id' => $request->job_id,
            'resume_path' => $path,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Application submitted.');
    }

    public function destroy($id)
    {
        $application = Application::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        // $application->delete();
        $application->update(['status' => 'canceled']);

        return redirect()->back()->with('success', 'Application canceled.');
    }
}
