<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OilChangeController;

Route::get('/', function () {
    return view('oil_changes.create');
})->name('oil_changes.create');
Route::post('/check', [OilChangeController::class, 'store'])->name('oil_changes.store');
Route::get('/results/{id}', [OilChangeController::class, 'show'])->name('oil_changes.show');