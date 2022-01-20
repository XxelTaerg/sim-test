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

use \App\Http\Controllers\QuestionController;
Route::get('/questions/{uuid}', [QuestionController::class, 'show'])->name('questions.show');
Route::post('/questions/{uuid}/next', [QuestionController::class, 'next'])->name('questions.next');
Route::get('/questions/{uuid}/prev', [QuestionController::class, 'prev'])->name('questions.prev');
Route::get('/start', [QuestionController::class, 'start'])->name('start');
Route::get('/end', [QuestionController::class, 'end'])->name('end');

