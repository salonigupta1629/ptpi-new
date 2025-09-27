<?php

use App\Livewire\CenterManager\Dashboard;
use App\Livewire\CenterManager\ManagePasskey;
use App\Livewire\CenterManager\Setting;
use Illuminate\Support\Facades\Route;

Route::get('/',Dashboard::class)->name('dashboard');
Route::get('/manage-passkey',ManagePasskey::class)->name('manage-passkey');
Route::get('/setting',Setting::class)->name('setting');