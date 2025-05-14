<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            return redirect()->back()->with('error', 'غير مصرح لك بتنزيل هذا الملف');
        }

        if (Storage::disk('public')->exists($application->resume_path)) {
            return response()->download(Storage::disk('public')->path($application->resume_path));
        }

        return redirect()->back()->with('error', 'الملف غير موجود');
    }

    // قبول الطلب
    public function acceptApplication($id)
    {
        $application = Application::findOrFail($id);

        // التحقق من أن المستخدم هو صاحب الوظيفة
        $job = Job::findOrFail($application->job_id);
        if ($job->employer_id !== Auth::id()) {
            return redirect()->back()->with('error', 'غير مصرح لك بتغيير حالة هذا الطلب');
        }

        $application->status = 'accepted';
        $application->save();

        return redirect()->back()->with('success', 'تم قبول الطلب بنجاح');
    }

    // رفض الطلب
    public function rejectApplication($id)
    {
        $application = Application::findOrFail($id);

        // التحقق من أن المستخدم هو صاحب الوظيفة
        $job = Job::findOrFail($application->job_id);
        if ($job->employer_id !== Auth::id()) {
            return redirect()->back()->with('error', 'غير مصرح لك بتغيير حالة هذا الطلب');
        }

        $application->status = 'rejected';
        $application->save();

        return redirect()->back()->with('success', 'تم رفض الطلب بنجاح');
    }
}
