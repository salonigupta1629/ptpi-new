<?php

use App\Livewire\CenterManager\Dashboard;
use Illuminate\Support\Facades\Route;

Route::get('/',Dashboard::class)->name('dashboard');