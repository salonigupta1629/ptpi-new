<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::name('admin')->prefix('admin')->group(function () {
    require __DIR__ . '/admin.php';
}); 

Route::name("teacher")->prefix("teacher")->group(function() {
    require __DIR__ . "/teacher.php";
});

Route::name("recruiter")->prefix("recruiter")->group(function() {
    require __DIR__ . "/recruiter.php";
});

Route::name("examiner")->prefix("examiner")->group(function() {
    require __DIR__ . "/examiner.php";
});

Route::name("interviewer")->prefix("interviewer")->group(function() {
    require __DIR__ . "/interviewer.php";
}); 

