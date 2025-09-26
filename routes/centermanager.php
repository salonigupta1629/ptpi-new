<?php

use App\Livewire\CenterManager\Dashboard;
use App\Livewire\CenterManager\ManagePasskey;
use Illuminate\Support\Facades\Route;

Route::get('/',Dashboard::class)->name('dashboard');
Route::get('/manage-passkey',ManagePasskey::class)->name('manage-passkey');