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
route::get('posts', [PostsController::class, 'index'])->name('posts.index');
route::post('posts', [PostsController::class, 'create'])->name('posts.create');
route::get('posts/{id}', [PostsController::class, 'show'])->name('posts.show');
route::put('posts/{id}', [PostsController::class, 'update'])->name('posts.update');
route::delete('posts/{id}', [PostsController::class, 'destroy'])->name('posts.destroy');
Route::post('search', '\App\Http\Controllers\PostsController@search');



Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);
