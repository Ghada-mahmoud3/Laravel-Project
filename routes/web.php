<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Models\User;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ProfileController;


Route::middleware('auth')->group(function () {
    Route::get('/jobs/search', [JobController::class, 'search'])->name('jobs.search');
    Route::get('/jobs/show/{id}', [JobController::class, 'show'])->name('jobs.show');

    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::post('/applications', [ApplicationController::class, 'store'])->name('applications.store');
    // Route::delete('/applications/{id}', [ApplicationController::class, 'destroy'])->name('applications.destroy');


    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
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

require __DIR__ . '/auth.php';

// Route::get('/', function () {
//     return view('welcome');
// });




//    Route::get('/', function () {
//        return view('welcome');
//    });

//    Route::middleware(['auth'])->group(function () {
//        Route::get('/dashboard', function () {
//            $user = auth()->user();
//            if ($user->isAdmin()) {
//                return redirect()->route('admin.dashboard');
//            } elseif ($user->isEmployer()) {
//                return redirect()->route('employer.dashboard');
//            } else {
//                return redirect()->route('candidate.dashboard');
//            }
//        })->name('dashboard');

//        Route::get('/admin/dashboard', function () {
//            return view('admin.dashboard');
//        })->name('admin.dashboard');

//        Route::get('/employer/dashboard', function () {
//            return view('employer.dashboard');
//        })->name('employer.dashboard');

//        Route::get('/candidate/dashboard', function () {
//            return view('candidate.dashboard');
//        })->name('candidate.dashboard');
//    });

//    require __DIR__.'/auth.php';

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


