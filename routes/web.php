<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::controller(App\Http\Controllers\Midwife\DashboardController::class)
            ->prefix('/midwife/dashboard')
            ->middleware(['auth', 'role:midwife'])
            ->group(function () {
                Route::get('/', 'index')->name('midwife.dashboard');
            });

Route::controller(App\Http\Controllers\Midwife\PatientController::class)
            ->prefix('/midwife/patients')
            ->middleware(['auth', 'role:midwife'])
            ->group(function () {
                Route::get('/', 'index')->name('midwife.patients');
                Route::get('/create', 'create')->name('midwife.patients.create');
                Route::post('/store', 'store')->name('midwife.patients.store');
                Route::get('/{id}/edit', 'edit')->name('midwife.patients.edit');
                Route::patch('/{id}/update', 'update')->name('midwife.patients.update');
                Route::delete('/{id}', 'destroy')->name('midwife.patients.destroy');
            });
Route::controller(App\Http\Controllers\Midwife\PatientsPregnancyController::class)
            ->prefix('/midwife/patients/pregnancy')
            ->middleware(['auth', 'role:midwife'])
            ->group(function () {
                Route::get('/{id}', 'index')->name('midwife.patients.pregnancy');
            });

Route::controller(App\Http\Controllers\Midwife\InfantController::class)
            ->prefix('/midwife/infants')
            ->middleware(['auth', 'role:midwife'])
            ->group(function () {
                Route::get('/', 'index')->name('midwife.infants');
            });

Route::controller(App\Http\Controllers\Midwife\ScheduleController::class)
            ->prefix('/midwife/schedules')
            ->middleware(['auth', 'role:midwife'])
            ->group(function () {
                Route::get('/', 'index')->name('midwife.schedules');
            });

Route::controller(App\Http\Controllers\Midwife\ReportController::class)
            ->prefix('/midwife/reports')
            ->middleware(['auth', 'role:midwife'])
            ->group(function () {
                Route::get('/', 'index')->name('midwife.reports');
            });
