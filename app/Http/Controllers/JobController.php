<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class JobController extends Controller
{
    public function search(Request $request)
    {
        $locations = Job::where('is_approved', true)
            ->distinct()
            ->pluck('location');

        $categories = Job::where('is_approved', true)
            ->distinct()
            ->pluck('category');

        $experienceLevels = Job::where('is_approved', true)
            ->distinct()
            ->pluck('experience_level');

        $work_types = Job::where('is_approved', true)
            ->distinct()
            ->pluck('work_type');


        $jobs = Job::query()
            ->where('is_approved', true)
            ->when($request->keyword, function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->keyword . '%')
                    ->orWhere('description', 'like', '%' . $request->keyword . '%');
            })
            ->when($request->location, fn($q) => $q->where('location', 'like', '%' . $request->location . '%'))
            ->when($request->category, fn($q) => $q->where('category', 'like', '%' . $request->category . '%'))
            ->when($request->work_type, fn($q) => $q->where('work_type', 'like', '%' . $request->work_type . '%')) // <-- Added
            ->when($request->experienceLevel, fn($q) => $q->where('experience_level', 'like', '%' . $request->experienceLevel . '%'))
            ->when($request->salaryRange, function ($q) use ($request) {
                if (strpos($request->salaryRange, '-') !== false) {
                    [$min, $max] = explode('-', $request->salaryRange);
                    $q->whereBetween('salary_min', [(float) $min, (float) $max]);
                }
            })
            ->when($request->date, function ($q) use ($request) {
                $q->whereDate('created_at', '>=', $request->date);
            })
            ->paginate(10);


        return view('jobs.index', compact('jobs', 'locations', 'categories', 'experienceLevels', 'work_types'));

    }

    public function index()
    {
        $jobs = Job::latest()->paginate(10);

        // جلب القيم الفريدة للفلاتر
        $locations = Job::distinct()->pluck('location');
        $categories = Job::distinct()->pluck('category');
        $experienceLevels = Job::distinct()->pluck('experience_level');

        return view('jobs.index', compact('jobs', 'locations', 'categories', 'experienceLevels'));
    }




    function show($id)
    {
        $job = Job::with('employer')->findOrFail($id);
        return view("jobs.show", ["job" => $job]);
    }
    public function create()
    {
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'experience_level' => 'nullable|string|max:255',
            'salary_min' => 'nullable|numeric',
            'salary_max' => 'nullable|numeric',
            'work_type' => 'nullable|string|max:255',
            'application_deadline' => 'nullable|date',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        try {
            $logoPath = null;

            // معالجة رفع اللوجو إذا تم تقديمه
            if ($request->hasFile('logo')) {
                // طباعة معلومات تشخيصية بدون استخدام getAdapter()
                Log::info('Storage path: ' . storage_path());
                Log::info('Public path: ' . public_path());
                // تجنب استخدام getAdapter() لأنها غير موجودة في Laravel 12
                Log::info('Storage disk public root: ' . storage_path('app/public'));

                // تأكد من وجود المجلد
                if (!Storage::disk('public')->exists('job-logos')) {
                    Storage::disk('public')->makeDirectory('job-logos');
                    Log::info('Created directory job-logos');
                }

                // استخدام طريقة بديلة لتخزين الملف
                $file = $request->file('logo');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(storage_path('app/public/job-logos'), $fileName);
                $logoPath = 'job-logos/' . $fileName;

                Log::info('Logo stored at path: ' . $logoPath);
                Log::info('Full path: ' . storage_path('app/public/' . $logoPath));

                // التحقق من وجود الملف
                if (file_exists(storage_path('app/public/' . $logoPath))) {
                    Log::info('File exists at the expected location');
                } else {
                    Log::error('File does not exist at the expected location');
                }
            }

            $job = Job::create([
                'employer_id' => Auth::id(),
                'title' => $request->title,
                'description' => $request->description,
                'location' => $request->location,
                'category' => $request->category,
                'experience_level' => $request->experience_level,
                'salary_min' => $request->salary_min,
                'salary_max' => $request->salary_max,
                'work_type' => $request->work_type,
                'application_deadline' => $request->application_deadline,
                'logo_path' => $logoPath,
            ]);

            return redirect()->route('employer.applications.index')->with('success', 'Job created successfully.');
        } catch (\Exception $e) {
            Log::error('Exception in job creation: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            if (isset($logoPath) && Storage::disk('public')->exists($logoPath)) {
                Storage::disk('public')->delete($logoPath);
            }

            return redirect()->back()->withInput()->with('error', 'Error creating job: ' . $e->getMessage());
        }
    }


    // عرض فورم تعديل وظيفة
    public function edit($id)
    {
        $job = Job::findOrFail($id);

        // التحقق من أن المستخدم هو صاحب الوظيفة
        if ($job->employer_id != Auth::id()) {
            return redirect()->route('jobs.index')->with('error', 'You are not authorized to edit this job.');
        }

        return view('jobs.edit', compact('job'));
    }

    // تحديث وظيفة
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'experience_level' => 'nullable|string|max:255',
            'salary_min' => 'nullable|numeric',
            'salary_max' => 'nullable|numeric',
            'work_type' => 'nullable|string|max:255',
            'application_deadline' => 'nullable|date',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $job = Job::findOrFail($id);

            // التحقق من أن المستخدم هو صاحب الوظيفة
            if ($job->employer_id != Auth::id()) {
                return redirect()->route('jobs.index')->with('error', 'You are not authorized to update this job.');
            }

            // معالجة رفع اللوجو الجديد إذا تم تقديمه
            if ($request->hasFile('logo')) {
                // حذف اللوجو القديم إذا كان موجودًا
                if ($job->logo_path && Storage::disk('public')->exists($job->logo_path)) {
                    Storage::disk('public')->delete($job->logo_path);
                }

                // تأكد من وجود المجلد
                Storage::disk('public')->makeDirectory('job-logos');

                // تخزين اللوجو الجديد
                $logoPath = $request->file('logo')->store('job-logos', 'public');

                // التحقق من نجاح رفع الصورة
                if (!Storage::disk('public')->exists($logoPath)) {
                    return redirect()->back()->withInput()->with('error', 'Failed to upload logo. Please try again.');
                }

                $job->logo_path = $logoPath;
            }

            // تحديث باقي البيانات
            $job->title = $request->title;
            $job->description = $request->description;
            $job->location = $request->location;
            $job->category = $request->category;
            $job->experience_level = $request->experience_level;
            $job->salary_min = $request->salary_min;
            $job->salary_max = $request->salary_max;
            $job->work_type = $request->work_type;
            $job->application_deadline = $request->application_deadline;

            $job->save();

            return redirect()->route('jobs.index')->with('success', 'Job updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Error updating job: ' . $e->getMessage());
        }
    }

    // حذف وظيفة
    public function destroy($id)
    {
        try {
            $job = Job::findOrFail($id);

            // التحقق من أن المستخدم هو صاحب الوظيفة
            if ($job->employer_id != Auth::id()) {
                return redirect()->route('jobs.index')->with('error', 'You are not authorized to delete this job.');
            }

            // حذف الصورة إذا كانت موجودة
            if ($job->logo_path && Storage::disk('public')->exists($job->logo_path)) {
                Storage::disk('public')->delete($job->logo_path);
            }

            // حذف الوظيفة
            $job->delete();

            return redirect()->route('jobs.index')->with('success', 'Job deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('jobs.index')->with('error', 'Error deleting job: ' . $e->getMessage());
        }
    }

    // عرض الوظائف الخاصة بالمستخدم الحالي
    public function myJobs()
    {
        $jobs = Job::where('employer_id', Auth::id())->latest()->paginate(10);
        return view('jobs.my-jobs', compact('jobs'));
    }

    public function testStorage()
    {
        try {
            // اختبار إنشاء مجلد
            if (!Storage::disk('public')->exists('test-folder')) {
                Storage::disk('public')->makeDirectory('test-folder');
            }

            // اختبار إنشاء ملف
            $content = 'Test file content: ' . date('Y-m-d H:i:s');
            Storage::disk('public')->put('test-folder/test.txt', $content);

            // التحقق من وجود الملف
            $exists = Storage::disk('public')->exists('test-folder/test.txt');
            $fileContent = $exists ? Storage::disk('public')->get('test-folder/test.txt') : 'File not found';

            // معلومات المسارات بدون استخدام getAdapter()
            $info = [
                'storage_path' => storage_path(),
                'public_path' => public_path(),
                'app_public_path' => storage_path('app/public'),
                'disk_root' => storage_path('app/public'), // بدلاً من استخدام getAdapter()
                'file_exists' => $exists,
                'file_content' => $fileContent,
                'symbolic_link_exists' => file_exists(public_path('storage')),
                'symbolic_link_target' => file_exists(public_path('storage')) ? readlink(public_path('storage')) : 'N/A',
            ];

            return response()->json($info);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }
}
