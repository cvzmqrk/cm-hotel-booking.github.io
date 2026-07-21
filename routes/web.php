<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MarkyBookingController;
use App\Http\Controllers\MarkyRoomController;

// 1. Root Landing Address - Forces entry through Auth login gateway forms
Route::get('/', function () {
    return redirect()->route('login');
});

// 2. Automatic Core Authentication Engine (Login & Register Entry Handles)
Auth::routes();

// 3. SECURED SYSTEM INTERNET ROUTING CONTAINER (Requires system authentication clearance)
Route::middleware(['auth'])->group(function () {
    
    // Live Statistics Analytical Dashboard Panel Row
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Inside Route::middleware(['auth'])->group(function () { ... })

    // Admin Specific Booking Editing Operations
    Route::get('/marky_bookings/{markyBooking}/edit', [MarkyBookingController::class, 'edit'])->name('marky_bookings.edit');
    Route::put('/marky_bookings/{markyBooking}', [MarkyBookingController::class, 'update'])->name('marky_bookings.update');

    // Wizard Multi-step Booking Allocation Sequence Paths
    Route::get('/marky_bookings/wizard/step_one', [MarkyBookingController::class, 'createWizardStepOne'])->name('marky_bookings.wizard.step_one');
    Route::post('/marky_bookings/wizard/step_one', [MarkyBookingController::class, 'postWizardStepOne'])->name('marky_bookings.wizard.step_one.post');
    Route::get('/marky_bookings/wizard/step_two', [MarkyBookingController::class, 'createWizardStepTwo'])->name('marky_bookings.wizard.step_two');
    Route::post('/marky_bookings/wizard/step_two', [MarkyBookingController::class, 'postWizardStepTwo'])->name('marky_bookings.wizard.step_two.post');
    Route::get('/marky_bookings/wizard/summary', [MarkyBookingController::class, 'wizardSummary'])->name('marky_bookings.wizard.summary');
    Route::post('/marky_bookings/wizard/finalize', [MarkyBookingController::class, 'finalizeWizard'])->name('marky_bookings.wizard.finalize');

    // Calendar JSON Data Stream Feed Endpoint for UI Rendering
    Route::get('/api/marky_bookings/booked-dates', [MarkyBookingController::class, 'getBookedDatesJson'])->name('api.marky_bookings.dates');

    // Active Core Log Record Matrices
    Route::get('/marky_bookings', [MarkyBookingController::class, 'index'])->name('marky_bookings.index');
    Route::delete('/marky_bookings/{id}', [MarkyBookingController::class, 'destroy'])->name('marky_bookings.destroy');

    // Resource Controller mapping path for Room Allocations
    Route::resource('marky_rooms', MarkyRoomController::class);
});

// 4. FALLBACK REDIRECTION RULES (Handles Laravel internal framework auth routing overrides)
Route::redirect('/home', '/dashboard');