<?php

use App\Livewire\Admin\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Subjects;
use App\Livewire\Admin\ClassCategories;
use App\Livewire\Admin\Skills;
use App\Livewire\Admin\Levels;
use App\Livewire\Admin\Qualification;
use App\Livewire\Admin\JobTypes;
use App\Livewire\Admin\ManageExam;
use App\Livewire\Admin\ManageQuestions;
use App\Livewire\Admin\ManageQuestionManager;

Route::get("/", Dashboard::class)->name("dashboard");
  Route::get('subjects', Subjects::class)->name('subjects');
  Route::get('class-categories', ClassCategories::class)->name('class_categories');
  Route::get('skills', Skills::class)->name('skills');
  Route::get('levels', Levels::class)->name('levels');
  Route::get('qualifications', Qualification::class)->name('qualifications');
  Route::get('teacher-job-types', JobTypes::class)->name('job_types');
  Route::get('manage-exam',ManageExam::class)->name('manage-exam');
  Route::get('exam/{examId}/questions',ManageQuestions::class)->name('exam-questions');
  Route::get('question-managers',ManageQuestionManager::class)->name('question-managers');


routes/web.php
Route::get('/test-translation-api', function () {
    $response = Http::post('https://api.ptpinstitute.com/api/translator/', [
        'source' => 'en',
        'dest' => 'hi',
        'text' => 'Hello world'
    ]);

    return response()->json([
        'status' => $response->status(),
        'headers' => $response->headers(),
        'body' => $response->body(),
        'json' => $response->json()
    ]);
});