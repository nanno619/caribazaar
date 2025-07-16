<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/simple-map', [App\Http\Controllers\HomeController::class, 'simpleMap'])->name('simple_map');
Route::get('/markers', [App\Http\Controllers\HomeController::class, 'marker'])->name('marker');
Route::get('/circles', [App\Http\Controllers\HomeController::class, 'circle'])->name('circle');
Route::get('/polygon', [App\Http\Controllers\HomeController::class, 'polygon'])->name('polygon');
Route::get('/polyline', [App\Http\Controllers\HomeController::class, 'polyline'])->name('polyline');
Route::get('/rectangle', [App\Http\Controllers\HomeController::class, 'rectangle'])->name('rectangle');
Route::get('/layer', [App\Http\Controllers\HomeController::class, 'layer'])->name('layer');
