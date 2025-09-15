<?php

use App\Livewire\Teacher\Dashboard;
use App\Livewire\Teacher\Exam\ExamPortal;
// use App\Livewire\Teacher\Exam\Instruction;
use App\Livewire\Teacher\Exam\ExamResult;
use App\Livewire\Teacher\JobApply;
use App\Livewire\Teacher\JobDetails;
use App\Livewire\Teacher\PersonalDetails;
use App\Livewire\Teacher\Setting;
use App\Livewire\Teacher\ViewAttempts;
use Illuminate\Support\Facades\Route;

Route::get("/", Dashboard::class)->name("dashboard");
Route::get('personal-details', PersonalDetails::class)->name('personal-details');
Route::get('job-details', JobDetails::class)->name('job-details');
Route::get('view-attempts', ViewAttempts::class)->name('view-attempts');
Route::get('job-apply', JobApply::class)->name('job-apply');
Route::get('setting', Setting::class)->name('setting');
Route::get('/exam/results', ExamResult::class)->name('exam.results'); 
// Route::get('exam/{category}/{subject?}/{level?}', Instruction::class)->name('exam-instruction');
ROute::get('exam-portal/{category}/{subject?}/{level?}', ExamPortal::class)->name('exam-portal');

