<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagCheck;

// Dashboard utama
Route::get('/', [TagCheck::class, 'dashboard'])->name('dashboard');

// Halaman event (layout berbeda per event)
Route::get('/event/{slug}', [TagCheck::class, 'event'])->name('event.page');

// API / scanner lama
Route::get('/tagcheck', [TagCheck::class, 'index'])->name('tagcheck.index');
