<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ProfileController;

Route::get('/jobs/search', [JobController::class, 'search'])->name('jobs.search');

Route::post('/applications', [ApplicationController::class, 'store'])->name('applications.store');
Route::delete('/applications/{id}', [ApplicationController::class, 'destroy'])->name('applications.destroy');


Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');


Route::get('/notifications', function () { return view('notifications.index');})->middleware('auth');
