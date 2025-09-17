<?php

use App\Livewire\VerifyOtp;
use Illuminate\Support\Facades\Route;

use App\Livewire\Landing\Homepage;
use App\Livewire\Landing\Login;

require __DIR__ . '/auth.php';

Route::get('/', Homepage::class)->name('homepage');
// Route::get('/login', Login::class)->name('login');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::name('admin.')->prefix('admin')->group(function () {
        require __DIR__ . '/admin.php';
    });
});

Route::middleware(['auth', 'teacher'])->group(function () {
    Route::name("teacher.")->prefix("teacher")->group(function () {
        require __DIR__ . "/teacher.php";
    });
});

Route::middleware(['auth', 'recruiter'])->group(function () {
    Route::name("recruiter.")->prefix("recruiter")->group(function () {
        require __DIR__ . "/recruiter.php";
    });
});


Route::name("examiner.")->prefix("examiner")->group(function () {
    require __DIR__ . "/examiner.php";
});

Route::name("interviewer.")->prefix("interviewer")->group(function () {
    require __DIR__ . "/interviewer.php";
});
Route::get('/verify-otp/{email}', VerifyOtp::class)->name('otp.verify');

// Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

