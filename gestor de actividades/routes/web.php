<?php

use App\Http\Controllers\Auth\CalendarController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerEvent;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\BuzonController;
use App\Models\Event;
use App\Models\Tarea;
use App\Models\Home;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('auth.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::resource('tareas', TareaController::class);
Route::get('/tareas/eliminar/{id}', [TareaController::class, 'eliminar_tarea'])->name('eliminar_tarea');


Route::resource('actividades', HomeController::class)->middleware('auth');
Route::resource('buzon', BuzonController::class)->middleware('auth');
Route::apiResource("actividades", HomeController::class);
Route::apiResource("actividades", Controller::class);
Route::apiResource("/actividades", HomeController::class);


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('calendar', [CalendarController::class, 'openCalendar'])->name('calendar');

    // Route::resource('calendar', CalendarController::class);
    Route::get('/google/login', [SocialController::class, 'redirectOnGoogle'])->name('google.login');

    Route::get('/google/redirect', [SocialController::class, 'OpenGoogleAccountDetails'])->name('google.callback');
    Route::post('/events', [CalendarController::class, 'storeEvent'])->name('events.store');



});

// Route model binding example for 'tareas'
Route::get('tareas/{tarea}', function (Tarea $tarea) {
    return view('tareas.show', compact('tarea'));
})->middleware('auth');

// Route model binding example for 'home'
Route::get('actividades/{actividad}', function (Event $home) {
    return view('actividades.show', compact('home'));
})->middleware('auth');


Route::get('test', function(){
    return view('auth.calendar.index');
});


require __DIR__.'/auth.php';

