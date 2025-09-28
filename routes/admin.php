<?php

use App\Livewire\Admin\CenterExamRequest;
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
use App\Livewire\Admin\ManageRole;
use App\Livewire\Admin\ExamCenters;
use App\Livewire\Admin\ManageTeachers;
use App\Livewire\Admin\RecruiterEnquiry;
use App\Livewire\Admin\TeacherHiring;
use App\Livewire\Admin\TeacherHiyer;
use App\Livewire\Admin\ViewTeacher;
use App\Livewire\Admin\Interview;
use App\Livewire\Admin\ManageRecruiter;


Route::get("/", Dashboard::class)->name("dashboard");
Route::get('subjects', Subjects::class)->name('subjects');
Route::get('class-categories', ClassCategories::class)->name('class_categories');
Route::get('skills', Skills::class)->name('skills');
Route::get('levels', Levels::class)->name('levels');
Route::get('qualifications', Qualification::class)->name('qualifications');
Route::get('teacher-job-types', JobTypes::class)->name('job_types');
Route::get('manage-exam', ManageExam::class)->name('manage-exam');
Route::get('exam/{examId}/questions', ManageQuestions::class)->name('exam-questions');
Route::get('manage-role', ManageRole::class)->name('manage-role');
Route::get('question-managers', ManageQuestionManager::class)->name('question-managers');
Route::get('exam-centers', ExamCenters::class)->name('exam-centers');
Route::get('exam-center-requests', CenterExamRequest::class)->name('exam-center-requests');
Route::get('teachers', ManageTeachers::class)->name('teachers-list');
Route::get('view/teachers/{teacherId}', ViewTeacher::class)->name('teacher.view');
Route::get('interview-management', Interview::class)->name('interview');