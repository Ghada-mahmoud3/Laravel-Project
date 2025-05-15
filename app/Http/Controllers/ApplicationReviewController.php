<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Notifications\ApplicationStatusNotification;

class ApplicationReviewController extends Controller
{


    // عرض جميع الطلبات المقدمة لوظائف المستخدم الحالي
    public function index()
    {
        $jobs = Job::where('employer_id', Auth::id())->with('applications')->get();

        return view('applications.employer-index', compact('jobs'));
    }

    // عرض الطلبات المقدمة لوظيفة محددة
    public function showJobApplications($jobId)
    {
        $job = Job::where('id', $jobId)
            ->where('employer_id', Auth::id())
            ->firstOrFail();

        $applications = Application::where('job_id', $jobId)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('applications.job-applications', compact('job', 'applications'));
    }

    // تنزيل السيرة الذاتية
    public function downloadResume($id)
    {
        $application = Application::findOrFail($id);

        // التحقق من أن المستخدم هو صاحب الوظيفة
        $job = Job::findOrFail($application->job_id);
        if ($job->employer_id !== Auth::id()) {
            return redirect()->back()->with('error', 'You are not authorized to change the status of this application.');
        }

        if (Storage::disk('public')->exists($application->resume_path)) {
            return response()->download(Storage::disk('public')->path($application->resume_path));
        }

        return redirect()->back()->with('error', 'File not found.');
    }

    // قبول الطلب
    public function acceptApplication($id)
    {
        $application = Application::findOrFail($id);

        // التحقق من أن المستخدم هو صاحب الوظيفة
        $job = Job::findOrFail($application->job_id);
        if ($job->employer_id !== Auth::id()) {
            return redirect()->back()->with('error', 'You are not authorized to change the status of this application.');
        }

        $application->status = 'accepted';
        $application->save();

        $application->user->notify(new ApplicationStatusNotification($job, 'accepted'));


        return redirect()->back()->with('success', 'Application accepted successfully.');
    }

    // رفض الطلب
    public function rejectApplication($id)
    {
        $application = Application::findOrFail($id);

        // التحقق من أن المستخدم هو صاحب الوظيفة
        $job = Job::findOrFail($application->job_id);
        if ($job->employer_id !== Auth::id()) {
            return redirect()->back()->with('error', 'You are not authorized to change the status of this application.');
        }

        $application->status = 'rejected';
        $application->save();

        $application->user->notify(new ApplicationStatusNotification($job, 'rejected'));

        return redirect()->back()->with('success', 'Application rejected successfully.');
    }
}
