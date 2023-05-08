<?php

use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', '\App\Http\Controllers\PagesController@index');

/* go to about page */
Route::get('/about', '\App\Http\Controllers\PagesController@about');

/* go to services page */
Route::get('/services', '\App\Http\Controllers\PagesController@services');

// Crete post table routes
Route::resource('posts', '\App\Http\Controllers\PostsController');
Route::get('/posts/search', [PostsController::class, 'search'])->name('posts.search');
Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);
