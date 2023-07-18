<?php


use App\Http\Controllers\FormController;


Route::get('/form', [FormController::class, 'index'])->name('form');
Route::post('/save', [FormController::class, 'save'])->name('save');
