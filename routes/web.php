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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Audiences
Route::get('/audiencia', [App\Http\Controllers\AudienceController::class, 'index'])->name('audience');
Route::get('/audiencia/nueva-audiencia', [App\Http\Controllers\AudienceController::class, 'create'])->name('crate-audience');

// Centro de justicia
Route::get('/ajustes/centro-justicia', [App\Http\Controllers\CentroJusticiaController::class, 'index'])->name('centro-justicia');
Route::get('/ajustes/centro-justicia/nuevo', [App\Http\Controllers\CentroJusticiaController::class, 'create'])->name('create-centro');
Route::post('/ajustes/centro-justicia/nuevo', [App\Http\Controllers\CentroJusticiaController::class, 'store'])->name('centro-post');