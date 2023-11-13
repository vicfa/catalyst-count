<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CsvUploadController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/csvupload', [CsvUploadController::class, 'showForm'])->name('upload.form');
Route::post('/csvupload', [CsvUploadController::class, 'store'])->name('upload.store');

Route::post('/filter-records', [CsvUploadController::class, 'processFilter']);
