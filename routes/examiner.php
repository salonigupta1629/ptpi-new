<?php

use App\Livewire\Examiner\ExaminerDashboard;
use Illuminate\Support\Facades\Route;

// Route::get("/dashboard", "DashboardController@index")->name("examiner.dashboard");


Route::get('/', ExaminerDashboard::class)->name('dashboard');
