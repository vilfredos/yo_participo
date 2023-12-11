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

Route::get('/informacion', function () {
    return view('informacion');
});
Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/votante', [App\Http\Controllers\Participo::class, 'buscar'])->name('votante');
Route::get('/', [App\Http\Controllers\Participo::class, 'index'])->name('index');
Route::get('/convocatoria/{id}', [App\Http\Controllers\Participo::class, 'convocatoria'])->name('convocatoria');

