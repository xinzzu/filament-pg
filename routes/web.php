<?php


use App\Http\Controllers\Web\PatientController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/patients/{patient}', [PatientController::class, 'show'])->name('patient.show');
