<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// общие роуты
Route::get('/', [\App\Http\Controllers\SiteController::class, 'index']);

// админка
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// пользовательские роуты
Route::resource('/dashboard/user/pets', \App\Http\Controllers\User\PetController::class)
    ->middleware('auth')->names('pets');

Route::resource('/dashboard/user/appointments', \App\Http\Controllers\User\AppointmentController::class)
    ->middleware('auth')->names('appointments');

Route::get('/dashboard/user/pet/{id}', [\App\Http\Controllers\User\PetController::class, 'appointments'])
    ->name('pet-appointments');

// административные роуты
Route::resource('/dashboard/admin/pets', \App\Http\Controllers\Admin\PetController::class)
    ->middleware('auth')->names('admin-pets');
Route::post('/dashboard/admin/appointment_status', [\App\Http\Controllers\Admin\AppointmentController::class, 'appointmentStatus'])
    ->name('appointments.status');

Route::resource('/dashboard/admin/appointments', \App\Http\Controllers\Admin\AppointmentController::class)
    ->middleware('auth')->names('admin-appointments');
