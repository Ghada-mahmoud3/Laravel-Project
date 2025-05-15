<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Job;
use App\Notifications\JobStatusNotification;

class AdminController extends Controller
{
    public function dashboard()
    {
        // $users = User::all(); // Fetch all users
        return view('admin.dashboard');
    }

    public function showUsers()
    {
        $users = User::paginate(10); // Paginate users (10 per page)
        return view('admin.users', compact('users'));
    }

    public function viewUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user-details', compact('user'));
    }

    public function changeRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $newRole = $request->input('role');

        $user->update(['role' => $newRole]);

        return redirect()->back()->with('success', 'User role updated successfully.');
    }

    public function toggleBan($id)
    {
        $user = User::findOrFail($id);

        $user->update(['is_banned' => !$user->is_banned]);

        return redirect()->back()->with('success', $user->is_banned ? 'User banned successfully.' : 'User unbanned successfully.');
    }


    public function jobs(Request $request)
    {
        // Filter jobs based on approval status
        $status = $request->input('status'); // 'approved', 'rejected', or null (show all)

        $query = Job::query();

        if ($status === 'approved') {
            $query->where('is_approved', true);
        } elseif ($status === 'rejected') {
            $query->where('is_approved', false);
        }

        $jobs = $query->paginate(10);

        return view('admin.jobs', compact('jobs', 'status'));
    }

    public function approveJob($id)
    {
        $job = Job::findOrFail($id);
        $job->update(['is_approved' => true]);
        $job->save();

        $job->employer->notify(new JobStatusNotification($job, 'approved'));

        return redirect()->back()->with('success', 'Job approved successfully.');
    }

    public function rejectJob($id)
    {
        $job = Job::findOrFail($id);
        $job->update(['is_approved' => false]);
        $job->save();

        $job->employer->notify(new JobStatusNotification($job, 'rejected'));

        return redirect()->back()->with('success', 'Job rejected successfully.');
    }
}