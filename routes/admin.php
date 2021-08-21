<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('admin', [AdminController::class, 'index'])
                ->middleware('role:admin')
                ->name('index');

// Users
Route::get('admin/users', [AdminController::class, 'users'])
                ->middleware('role:admin')
                ->name('users');

Route::get('admin/users/edit/{id}', [AdminController::class, 'edit_user'])
                ->middleware('role:admin')
                ->name('edit_user');

Route::post('admin/users/edit/{id}', [AdminController::class, 'update_edit_user'])
                ->middleware('role:admin')
                ->name('update_edit_user');

Route::get('admin/users/delete/{id}', [AdminController::class, 'delete_user'])
                ->middleware('role:admin')
                ->name('delete_user');

// Posts
Route::get('admin/posts', [AdminController::class, 'posts'])
                ->middleware('role:admin|moderator')
                ->name('posts');

Route::get('admin/post/edit/{id}', [AdminController::class, 'edit_post'])
                ->middleware('role:admin|moderator')
                ->name('edit_post');

Route::post('admin/post/edit/{id}', [AdminController::class, 'update_edit_post'])
                ->middleware('role:admin|moderator')
                ->name('update_edit_post');

Route::post('admin/post/update/status', [AdminController::class, 'update_status_post'])
                ->middleware('role:admin|moderator')
                ->name('update_status_post');

Route::post('admin/post/update/featured', [AdminController::class, 'make_featured'])
                ->middleware('role:admin')
                ->name('make_featured');

Route::get('admin/post/{id}/tag/delete/{tag}', [AdminController::class, 'delete_tag'])
                ->middleware('role:admin|moderator')
                ->name('delete_tag');

Route::get('admin/post/delete/{id}', [AdminController::class, 'delete_post'])
                ->middleware('role:admin|moderator')
                ->name('delete_post');

// Genders
Route::get('admin/genders', [AdminController::class, 'genders'])
                ->middleware('role:admin')
                ->name('genders');

Route::get('admin/gender/create', [AdminController::class, 'create_gender'])
                ->middleware('role:admin')
                ->name('create_gender');

Route::post('admin/gender/create', [AdminController::class, 'store_new_gender'])
                ->middleware('role:admin')
                ->name('store_new_gender');

Route::get('admin/gender/{id}/edit', [AdminController::class, 'edit_gender'])
                ->middleware('role:admin')
                ->name('edit_gender');

Route::post('admin/gender/{id}/edit', [AdminController::class, 'update_edit_gender'])
                ->middleware('role:admin')
                ->name('update_edit_gender');

Route::get('admin/gender/delete/{id}', [AdminController::class, 'delete_gender'])
                ->middleware('role:admin')
                ->name('delete_gender');

// Categories
Route::get('admin/categories', [AdminController::class, 'categories'])
                ->middleware('role:admin')
                ->name('categories');

Route::get('admin/categories/create', [AdminController::class, 'create_category'])
                ->middleware('role:admin')
                ->name('create_category');

Route::post('admin/categories/create', [AdminController::class, 'store_new_category'])
                ->middleware('role:admin')
                ->name('store_new_category');

Route::get('admin/category/{id}/edit', [AdminController::class, 'edit_category'])
                ->middleware('role:admin')
                ->name('edit_category');

Route::post('admin/cateogry/{id}/edit', [AdminController::class, 'update_edit_category'])
                ->middleware('role:admin')
                ->name('update_edit_category');

Route::get('admin/category/delete/{id}', [AdminController::class, 'delete_category'])
                ->middleware('role:admin')
                ->name('delete_category');

// Comments
Route::get('admin/comments', [AdminController::class, 'comments'])
                ->middleware('role:admin')
                ->name('comments');

Route::get('admin/comment/edit/{id}', [AdminController::class, 'edit_comment'])
                ->middleware('role:admin')
                ->name('edit_comment');

Route::post('admin/comment/edit/{id}', [AdminController::class, 'update_edit_comment'])
                ->middleware('role:admin')
                ->name('update_edit_comment');

Route::get('admin/comment/delete/{id}', [AdminController::class, 'delete_comment'])
                ->middleware('role:admin')
                ->name('delete_comment');

// Pages
Route::get('admin/pages', [AdminController::class, 'pages'])
                ->middleware('role:admin')
                ->name('pages');

Route::get('admin/page/edit/{id}', [AdminController::class, 'edit_page'])
                ->middleware('role:admin')
                ->name('edit_page');

Route::post('admin/page/edit/{id}', [AdminController::class, 'update_edit_page'])
                ->middleware('role:admin')
                ->name('update_edit_page');

Route::get('admin/page/create', [AdminController::class, 'create_page'])
                ->middleware('role:admin')
                ->name('create_page');

Route::post('admin/page/create', [AdminController::class, 'store_new_page'])
                ->middleware('role:admin')
                ->name('store_new_page');

Route::get('admin/page/delete/{id}', [AdminController::class, 'delete_page'])
                ->middleware('role:admin')
                ->name('delete_page');

// Advertising
Route::get('admin/advertising', [AdminController::class, 'advertising'])
                ->middleware('role:admin')
                ->name('advertising');

Route::get('admin/advertising/create', [AdminController::class, 'create_advertising'])
                ->middleware('role:admin')
                ->name('create_advertising');

Route::post('admin/advertising/create', [AdminController::class, 'store_new_advertising'])
                ->middleware('role:admin')
                ->name('store_new_advertising');

Route::get('admin/advertising/edit/{id}', [AdminController::class, 'edit_advertising'])
                ->middleware('role:admin')
                ->name('edit_advertising');

Route::post('admin/advertising/edit/{id}', [AdminController::class, 'update_edit_advertising'])
                ->middleware('role:admin')
                ->name('update_edit_advertising');

Route::get('admin/advertising/delete/{id}', [AdminController::class, 'delete_advertising'])
                ->middleware('role:admin')
                ->name('delete_advertising');

// Settings
Route::get('admin/settings', [AdminController::class, 'settings'])
                ->middleware('role:admin')
                ->name('settings');

Route::post('admin/settings', [AdminController::class, 'update_settings'])
                ->middleware('role:admin')
                ->name('update_settings');

Route::get('admin/reports', [AdminController::class, 'reports'])
                ->middleware('role:admin')
                ->name('reports');

Route::get('admin/report/delete/{id}', [AdminController::class, 'delete_report'])
                ->middleware('role:admin')
                ->name('delete_report');

Route::get('admin/delete/logo', [AdminController::class, 'delete_logo'])
                ->middleware('role:admin')
                ->name('delete_logo');

Route::get('admin/delete/favicon', [AdminController::class, 'delete_favicon'])
                ->middleware('role:admin')
                ->name('delete_favicon');

// points
Route::get('admin/points', [AdminController::class, 'points'])
                ->middleware('role:admin')
                ->name('points');

Route::post('admin/points', [AdminController::class, 'update_points'])
                ->middleware('role:admin')
                ->name('update_points');

// badges
Route::get('admin/badges', [AdminController::class, 'badges'])
                ->middleware('role:admin')
                ->name('badges');

Route::get('admin/badges/create', [AdminController::class, 'create_badge'])
                ->middleware('role:admin')
                ->name('create_badge');

Route::post('admin/badges/create', [AdminController::class, 'store_new_badge'])
                ->middleware('role:admin')
                ->name('store_new_badge');

Route::get('admin/badges/delete/{id}', [AdminController::class, 'delete_badge'])
                ->middleware('role:admin')
                ->name('delete_badge');

Route::get('admin/badges/edit/{id}', [AdminController::class, 'edit_badge'])
                ->middleware('role:admin')
                ->name('edit_badge');

Route::post('admin/badges/edit/{id}', [AdminController::class, 'update_edit_badge'])
                ->middleware('role:admin')
                ->name('update_edit_badge');