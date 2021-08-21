<?php

use App\Http\Controllers\CommentController;
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

Route::post('store', [CommentController::class, 'store'])
    ->name('store')->middleware('auth');

Route::post('delete/comment', [CommentController::class, 'delete_comment'])
    ->name('delete_comment')->middleware('auth');