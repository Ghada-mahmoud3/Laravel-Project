<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ProfileController;

// الصفحة الرئيسية لعرض جميع الوظائف
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');

// صفحة إنشاء وظيفة جديدة
Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create')->middleware('auth') ;
Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store')->middleware('auth');

// صفحة تعديل وظيفة موجودة
Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit')->middleware('auth');
Route::put('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update')->middleware('auth');

// صفحة تأكيد الحذف
Route::get('/jobs/{job}/delete', [JobController::class, 'delete'])->name('jobs.delete')->middleware('auth');
Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy')->middleware('auth');

Route::get('/jobs/search', [JobController::class, 'search'])->name('jobs.search');
Route::get('/jobs/show/{id}', [JobController::class, 'show'])->name('jobs.show');

Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
Route::post('/applications', [ApplicationController::class, 'store'])->name('applications.store');
Route::delete('/applications/{id}', [ApplicationController::class, 'destroy'])->name('applications.destroy');

// صفحات البروفايل
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

// صفحة الإشعارات
Route::get('/notifications', function () { return view('notifications.index');})->middleware('auth');


Route::get('job/{jobId}/applications', [JobController::class, 'showApplications'])->name('job.applications');

Route::put('application/{applicationId}/status/{status}', [ApplicationController::class, 'updateStatus'])->name('applications.updateStatus');


Route::get('application/{applicationId}/download-resume', [ApplicationController::class, 'downloadResume'])->name('applications.download');


Route::prefix('employer')->middleware('auth')->group(function () {
    Route::get('applications/{jobId}', [ApplicationController::class, 'showApplications'])->name('applications.show');
    Route::post('applications/{id}/accept', [ApplicationController::class, 'accept'])->name('applications.accept');
    Route::post('applications/{id}/reject', [ApplicationController::class, 'reject'])->name('applications.reject');
});



Route::get('/login', function () {
    return 'Login page placeholder';
})->name('login');
