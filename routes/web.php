<?php

use Illuminate\Support\Facades\Route;

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
/*
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
*/

Auth::routes();
Route::group(['middleware' => 'auth'], function()
{
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('/');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/lista/{space}/etiquetas/', [App\Http\Controllers\GeneralController::class, 'etiquetas'])->name('general.etiquetas');
    Route::get('/lista/{space}/s/{search}', [App\Http\Controllers\ListasController::class, 'index'])->name('lista.search');
    Route::post('/lista/{space}/savefile/', [App\Http\Controllers\ListasController::class, 'savefile'])->name('lista.savefile');
    Route::get('/lista/{space}/printer/', [App\Http\Controllers\ListasController::class, 'printerall'])->name('lista.printerall');
    Route::get('/lista/{space}/printer/{id}', [App\Http\Controllers\ListasController::class, 'printer'])->name('lista.printer');
    Route::resource('/lista', 'App\Http\Controllers\ListasController');
    Route::get('/coded/{code}', [App\Http\Controllers\GeneralController::class, 'code2d'])->name('general.code2d');
    Route::match(['put', 'post'],'/lista/{space}/xls/', [App\Http\Controllers\GeneralController::class, 'fileup'])->name('lista.fileup');
});