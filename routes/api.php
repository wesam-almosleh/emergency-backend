<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmergencyReportController; // ⬅️ تأكدي من وجود هذا السطر في الأعلى
use App\Http\Controllers\LoginController;

Route::post('/login', [LoginController::class, 'login']);


Route::get('/reports', [EmergencyReportController::class, 'index']);

// ⬅️ أضيفي مسار البلاغ الخاص بكِ هنا في الأسفل:
Route::post('/emergency', [EmergencyReportController::class, 'store'])->middleware('auth:sanctum');