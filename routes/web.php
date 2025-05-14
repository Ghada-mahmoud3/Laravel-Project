<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Models\User;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApplicationReviewController;

use App\Http\Controllers\AdminController;

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'showUsers'])->name('admin.users');
    Route::get('/admin/jobs', [AdminController::class, 'jobs'])->name('admin.jobs');
    Route::post('/admin/jobs/{id}/approve', [AdminController::class, 'approveJob'])->name('admin.jobs.approve');
    Route::post('/admin/jobs/{id}/reject', [AdminController::class, 'rejectJob'])->name('admin.jobs.reject');
});


// طرق مراجعة الطلبات
Route::prefix('employer')->middleware(['auth'])->group(function () {
    Route::get('/applications', [ApplicationReviewController::class, 'index'])->name('employer.applications.index');
    Route::get('/applications/job/{id}', [ApplicationReviewController::class, 'showJobApplications'])->name('employer.applications.job');
    Route::get('/applications/{id}/download', [ApplicationReviewController::class, 'downloadResume'])->name('employer.applications.download');
    Route::post('/applications/{id}/accept', [ApplicationReviewController::class, 'acceptApplication'])->name('employer.applications.accept');
    Route::post('/applications/{id}/reject', [ApplicationReviewController::class, 'rejectApplication'])->name('employer.applications.reject');
});

// Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
// Route::post('jobs', [JobController::class, 'store'])->name('jobs.store');
// Route::get('/jobs/{id}', [JobController::class, 'show'])->name('jobs.show');

// تأكد من أن هذه الطرق موجودة ومرتبة بشكل صحيح
Route::middleware('auth')->group(function () {
    Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/search', [JobController::class, 'search'])->name('jobs.search');
    Route::get('/jobs/{id}', [JobController::class, 'show'])->name('jobs.show');
    Route::get('/jobs/{id}/edit', [JobController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{id}', [JobController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{id}', [JobController::class, 'destroy'])->name('jobs.destroy');

    // باقي الطرق...




// Route::middleware('auth')->group(function () {
// Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
//     Route::get('/jobs/search', [JobController::class, 'search'])->name('jobs.search');
//     Route::get('/jobs/show/{id}', [JobController::class, 'show'])->name('jobs.show');
//     // Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
//     Route::get('/jobs/{id}/edit', [JobController::class, 'edit'])->name('jobs.edit');
//     Route::put('/jobs/{id}', [JobController::class, 'update'])->name('jobs.update');
//     Route::delete('/jobs/{id}', [JobController::class, 'destroy'])->name('jobs.destroy');

    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::post('/applications', [ApplicationController::class, 'store'])->name('applications.store');
    // Route::delete('/applications/{id}', [ApplicationController::class, 'destroy'])->name('applications.destroy');


    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/{id}', [ProfileController::class, 'showOther'])->name('profile.show.other');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

});


Route::get('/notifications', function () {
    return view('notifications.index');
})->middleware('auth');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisteredUserController::class, 'roleSelection'])->name('register');
Route::get('/register/employer', [RegisteredUserController::class, 'createEmployer'])->name('register.employer');
Route::post('/register/employer', [RegisteredUserController::class, 'storeEmployer'])->name('register.employer.store');
Route::get('/register/candidate', [RegisteredUserController::class, 'createCandidate'])->name('register.candidate');
Route::post('/register/candidate', [RegisteredUserController::class, 'storeCandidate'])->name('register.candidate.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isEmployer()) {
            return redirect()->route('employer.dashboard');
        } else {
            return redirect()->route('candidate.dashboard');
        }
    })->name('dashboard');

    // Route::get('/admin/dashboard', function () {
    //     return view('admin.dashboard');
    // })->name('admin.dashboard');
    // Route::get('/admin/dashboard', function () {
    //     return view('admin.dashboard');
    // })->name('admin.dashboard');

    Route::get('/employer/dashboard', function () {
        return view('employer.dashboard');
    })->name('employer.dashboard');

    Route::get('/candidate/dashboard', function () {
        return view('candidate.dashboard');
    })->name('candidate.dashboard');

    //////////////////////////////////////////////////////////

});

require __DIR__ . '/auth.php';

Route::get('/test-storage', [App\Http\Controllers\JobController::class, 'testStorage']);
