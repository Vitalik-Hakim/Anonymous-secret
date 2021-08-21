<?php

use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index'])
                ->name('index');

Route::get('viral', [HomeController::class, 'viral'])
                ->name('viral');

Route::get('random', [HomeController::class, 'random'])
                ->name('random');

Route::get('search', [HomeController::class, 'search'])
                ->name('search');

Route::get('view/{id}/{slug}', [HomeController::class, 'show'])
                ->name('show');

Route::group(['middleware' => ['auth']], function () {
    
    Route::post('write', [HomeController::class, 'store'])
                ->name('store');
    
    Route::post('save_like', [HomeController::class, 'save_like'])
                ->name('save_like');
    
    Route::post('save_favorite', [HomeController::class, 'save_favorite'])
                ->name('save_favorite');
    
    Route::get('post/delete/{id}', [HomeController::class, 'delete_user_post'])
                ->name('delete_user_post');
    
    // report
    Route::get('report/{id}', [HomeController::class, 'report'])
                ->name('report');
    
});

require __DIR__.'/points.php';
require __DIR__.'/comments.php';
require __DIR__.'/categories.php';
require __DIR__.'/pages.php';
require __DIR__.'/tags.php';
require __DIR__.'/admin.php';
require __DIR__.'/auth.php';