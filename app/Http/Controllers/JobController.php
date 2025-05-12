<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Application;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    // تأكد من المصادقة قبل تنفيذ العمليات
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function search(Request $request)
    {
        $locations = Job::distinct()->pluck('location');
        $categories = Job::distinct()->pluck('category');
        $experienceLevels = Job::distinct()->pluck('experience_level');

        $jobs = Job::query()
            ->when($request->keyword, fn($q) => $q->where('title', 'like', "%{$request->keyword}%")
                ->orWhere('description', 'like', "%{$request->keyword}%"))
            ->when($request->location, fn($q) => $q->where('location', 'like', "%{$request->location}%"))
            ->when($request->category, fn($q) => $q->where('category', 'like', "%{$request->category}%"))
            ->when($request->experienceLevel, fn($q) => $q->where('experience_level', 'like', "%{$request->experienceLevel}%"))
            ->when($request->salaryRange, function ($q) use ($request) {
                if (strpos($request->salaryRange, '-') !== false) {
                    [$min, $max] = explode('-', $request->salaryRange);
                    $q->whereBetween('salary_min', [(float) $min, (float) $max]);
                }
            })
            ->when($request->date, fn($q) => $q->whereDate('created_at', '>=', $request->date))
            ->paginate(10);

        return view('jobs.index', compact('jobs', 'locations', 'categories', 'experienceLevels'));
    }

    public function index(Request $request)
    {
        $query = Job::query();

        if ($request->filled('keyword')) {
            $query->where('title', 'like', '%' . $request->keyword . '%');
        }

        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('experienceLevel')) {
            $query->where('experience_level', $request->experienceLevel);
        }

        if ($request->filled('salaryRange')) {
            [$min, $max] = explode('-', $request->salaryRange);
            $query->whereBetween('salary_min', [(int)$min, (int)$max]);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', '>=', $request->date);
        }

        $jobs = $query->paginate(9);
        $locations = Job::distinct()->pluck('location');
        $categories = Job::distinct()->pluck('category');
        $experienceLevels = Job::distinct()->pluck('experience_level');

        return view('jobs.index', compact('jobs', 'locations', 'categories', 'experienceLevels'));
    }

    public function show($id)
    {
        $job = Job::with('employer')->findOrFail($id);
        return view('jobs.show', compact('job'));
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'category' => 'required|string',
            'experience_level' => 'nullable|string',
            'salary_min' => 'nullable|numeric',
            'salary_max' => 'nullable|numeric',
            'work_type' => 'nullable|string',
            'application_deadline' => 'nullable|date',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        $job = new Job();
        $job->employer_id = Auth::user()->id;
        $job->title = $request->title;
        $job->description = $request->description;
        $job->location = $request->location;
        $job->category = $request->category;
        $job->experience_level = $request->experience_level;
        $job->salary_min = $request->salary_min;
        $job->salary_max = $request->salary_max;
        $job->work_type = $request->work_type;
        $job->application_deadline = $request->application_deadline;
        $job->logo_path = $logoPath;

        $job->save();

        return redirect()->route('jobs.index')->with('success', 'Job posted successfully.');
    }

    public function edit($id)
    {
        $job = Job::where('employer_id', Auth::user()->id)->findOrFail($id);
        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, $id)
    {
        $job = Job::where('employer_id', Auth::id())->findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'category' => 'required|string',
            'experience_level' => 'nullable|string',
            'salary_min' => 'nullable|numeric',
            'salary_max' => 'nullable|numeric',
            'work_type' => 'nullable|string',
            'application_deadline' => 'nullable|date',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $job->logo_path = $logoPath;
        }

        $job->update($request->except('logo'));

        return redirect()->route('jobs.index')->with('success', 'Job updated successfully.');
    }

    public function destroy($id)
    {
        $job = Job::where('employer_id', Auth::user()->id)->findOrFail($id);
        $job->delete();

        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully.');
    }

    public function myJobs()
    {
        $jobs = Job::where('employer_id', Auth::user()->id)->latest()->paginate(10);
        return view('jobs.my_jobs', compact('jobs'));
    }

    public function showApplications($jobId)
    {
        // استرجاع الوظيفة بناءً على الـ ID
        $job = Job::findOrFail($jobId);

        // استرجاع جميع التطبيقات المرتبطة بالوظيفة
        $applications = $job->applications;

        // عرض صفحة التطبيقات مع تمريها للـ view
        return view('applications.index', compact('applications'));
    }
}
