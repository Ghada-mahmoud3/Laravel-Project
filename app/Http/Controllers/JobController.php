<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Application;

class JobController extends Controller
{
    public function search(Request $request)
    {
        $locations = Job::distinct()->pluck('location');
        $categories = Job::distinct()->pluck('category');
        $experienceLevels = Job::distinct()->pluck('experience_level');

        $jobs = Job::query()
            ->when($request->keyword, function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->keyword . '%')
                    ->orWhere('description', 'like', '%' . $request->keyword . '%');
            })
            ->when($request->location, fn($q) => $q->where('location', 'like', '%' . $request->location . '%'))
            ->when($request->category, fn($q) => $q->where('category', 'like', '%' . $request->category . '%'))
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


        return view('jobs.index', compact('jobs', 'locations', 'categories', 'experienceLevels'));
    }


    function show($id){
        $job = Job::with('employer')->findOrFail($id);
        return view("jobs.show",["job"=>$job]);                 
    }


}
