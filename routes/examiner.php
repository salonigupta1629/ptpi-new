<?php

use App\Livewire\Examiner\AddQuestion;
use App\Livewire\Examiner\ExaminerDashboard;
use App\Livewire\Examiner\ManageQuestionSet;
use Illuminate\Support\Facades\Route;

// Route::get("/dashboard", "DashboardController@index")->name("examiner.dashboard");


Route::get('/', ExaminerDashboard::class)->name('dashboard');
Route::get('/manage-question/{examSetId}', ManageQuestionSet::class)->name('manage-question');
Route::get('/manage-question/{examSetId}/add', AddQuestion::class)->name('add-question');
