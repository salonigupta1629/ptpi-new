<?php

use App\Livewire\Recruiter\RecruiterDashboard;
use App\Livewire\Recruiter\TeacherProfile;
use Illuminate\Support\Facades\Route;

// Route::get("/dashboard", "DashboardController@index")->name("recruiter.dashboard");

Route::get('/',RecruiterDashboard::class)->name('dashboard');
Route::get('/teacher/{id}',TeacherProfile::class)->name('teacher.profile');

