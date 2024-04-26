<?php

use Illuminate\Support\Facades\Route;

Route::get('uploads/', [UploadController::class, 'index'])->name('uploads.index');
Route::post('uploads/create', [UploadController::class, 'create'])->name('uploads.create');
Route::post('uploads/store', [UploadController::class, 'store'])->name('uploads.store');