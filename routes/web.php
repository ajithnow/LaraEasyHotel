<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;

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
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->get('/rooms', function () {
    return Inertia::render('Rooms');
})->name('rooms');

Route::middleware(['auth:sanctum', 'verified'])->post('/addroom', [RoomController::class,'create'])->name('addroom');
Route::middleware(['auth:sanctum', 'verified'])->get('/getrooms', [RoomController::class,'index'])->name('getrooms');
Route::middleware(['auth:sanctum', 'verified'])->delete('/room/delete/{id}', [RoomController::class,'destroy'])->name('deleteroom');
Route::middleware(['auth:sanctum', 'verified'])->get('/roomtypes/list/', [RoomTypeController::class,'index'])->name('getroomtypes');

