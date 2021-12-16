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
Route::post('/ajustes/centro-justicia/nuevo', [App\Http\Controllers\CentroJusticiaController::class, 'store'])->name('post-centro');
Route::get('/ajustes/centro-justicia/editar/{id}', [App\Http\Controllers\CentroJusticiaController::class, 'edit'])->name('edit-centro');
Route::put('/ajustes/centro-justicia/editar/{id}', [App\Http\Controllers\CentroJusticiaController::class, 'update'])->name('update-centro');
Route::delete('/ajustes/centro-justicia/{id}', [App\Http\Controllers\CentroJusticiaController::class, 'destroy'])->name('delete-centro');

// Roles
Route::get('/ajustes/roles', [App\Http\Controllers\RolController::class, 'index'])->name('roles');
Route::get('/ajustes/rol/nuevo', [App\Http\Controllers\RolController::class, 'create'])->name('create-rol');
Route::post('/ajustes/rol/nuevo', [App\Http\Controllers\RolController::class, 'store'])->name('post-rol');
Route::get('/ajustes/rol/editar/{id}', [App\Http\Controllers\RolController::class, 'edit'])->name('edit-rol');
Route::put('/ajustes/rol/editar/{id}', [App\Http\Controllers\RolController::class, 'update'])->name('update-rol');
Route::delete('/ajustes/rol/{id}', [App\Http\Controllers\RolController::class, 'destroy'])->name('delete-rol');


// Sala
Route::get('/ajustes/salas', [App\Http\Controllers\SalaController::class, 'index'])->name('salas');
Route::get('/ajustes/sala/nuevo', [App\Http\Controllers\SalaController::class, 'create'])->name('create-sala');
Route::post('/ajustes/sala/nuevo', [App\Http\Controllers\SalaController::class, 'store'])->name('post-sala');
Route::get('/ajustes/sala/editar/{id}', [App\Http\Controllers\SalaController::class, 'edit'])->name('edit-sala');
Route::put('/ajustes/sala/editar/{id}', [App\Http\Controllers\SalaController::class, 'update'])->name('update-sala');
Route::delete('/ajustes/sala/{id}', [App\Http\Controllers\SalaController::class, 'destroy'])->name('delete-sala');

// Tipo de Audiencia
Route::get('/ajustes/audiencias', [App\Http\Controllers\TipoAudienciaController::class, 'index'])->name('audiencias');
Route::get('/ajustes/audiencia/nuevo', [App\Http\Controllers\TipoAudienciaController::class, 'create'])->name('create-audiencia');
Route::post('/ajustes/audiencia/nuevo', [App\Http\Controllers\TipoAudienciaController::class, 'store'])->name('post-audiencia');
Route::get('/ajustes/audiencia/editar/{id}', [App\Http\Controllers\TipoAudienciaController::class, 'edit'])->name('edit-audiencia');
Route::put('/ajustes/audiencia/editar/{id}', [App\Http\Controllers\TipoAudienciaController::class, 'update'])->name('update-audiencia');
Route::delete('/ajustes/audiencia/{id}', [App\Http\Controllers\TipoAudienciaController::class, 'destroy'])->name('delete-audiencia');


// Tipo juicio
Route::get('/ajustes/juicios', [App\Http\Controllers\JuiciosController::class, 'index'])->name('juicios');
Route::get('/ajustes/juicio/nuevo', [App\Http\Controllers\JuiciosController::class, 'create'])->name('create-juicio');
Route::post('/ajustes/juicio/nuevo', [App\Http\Controllers\JuiciosController::class, 'store'])->name('post-juicio');
Route::get('/ajustes/juicio/editar/{id}', [App\Http\Controllers\JuiciosController::class, 'edit'])->name('edit-juicio');
Route::put('/ajustes/juicio/editar/{id}', [App\Http\Controllers\JuiciosController::class, 'update'])->name('update-juicio');
Route::delete('/ajustes/juicio/{id}', [App\Http\Controllers\JuiciosController::class, 'destroy'])->name('delete-juicio');
