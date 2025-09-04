<?php

use App\Livewire\Recruiter\RecruiterDashboard;
use App\Livewire\Recruiter\TeacherProfile;
use Illuminate\Support\Facades\Route;

// Route::get("/dashboard", "DashboardController@index")->name("recruiter.dashboard");

Route::get('/',RecruiterDashboard::class)->name('recruiter.dashboard');
Route::get('/teacher', TeacherProfile::class)->name('teacher.profile');

