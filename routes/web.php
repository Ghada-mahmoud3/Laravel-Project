<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});




   Route::get('/', function () {
       return view('welcome');
   });

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

       Route::get('/admin/dashboard', function () {
           return view('admin.dashboard');
       })->name('admin.dashboard');

       Route::get('/employer/dashboard', function () {
           return view('employer.dashboard');
       })->name('employer.dashboard');

       Route::get('/candidate/dashboard', function () {
           return view('candidate.dashboard');
       })->name('candidate.dashboard');
   });

   require __DIR__.'/auth.php';

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


