<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PreviewController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/prezentacije/{slug}', [PreviewController::class, 'show']);


// --- SPA auth routes (dodato skriptom) ---

Route::post('/login',    [\App\Http\Controllers\Auth\SpaAuthController::class, 'login'])->name('login');

Route::post('/register', [\App\Http\Controllers\Auth\SpaAuthController::class, 'register']);

Route::post('/logout',   [\App\Http\Controllers\Auth\SpaAuthController::class, 'logout']);

Route::get('/', function () {
    return response()->file(public_path('index.html'));
});
