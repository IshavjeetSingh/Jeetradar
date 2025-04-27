<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'welcome'])->name('home');
Route::get('/recommend', [HomeController::class, 'recommend'])->name('recommend');
Route::match(['get', 'post'], '/recommend/results', [HomeController::class, 'showRecommendations'])->name('recommend.results');
Route::post('/recommend/pdf', [HomeController::class, 'generatePdf'])->name('recommend.pdf');
Route::post('/recommend/email', [HomeController::class, 'sendEmail'])->name('recommend.email');
Route::post('/contact', [HomeController::class, 'contact'])->name('contact'); 