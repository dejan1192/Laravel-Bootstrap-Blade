<?php

use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostTagController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
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

Route::get('/',[ BlogPostController::class, 'index'])->name('index');



Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class , 'update'])->name('users.update');
Route::post('/users/follow', [UserController::class , 'follow'])->name('users.follow');

Route::get('posts/create', [BlogPostController::class , 'create'])->name('posts.create');
Route::get('posts/{id}', [BlogPostController::class, 'show'])->name('posts.show');

Route::post('/comments', [CommentController::class , 'store'])->name('comments.store');
Route::post('/posts', [BlogPostController::class , 'store'])->name('posts.store');


Route::delete('/posts/{postId}', [BlogPostController::class , 'destroy'])->name('posts.delete');

Route::resource('tags' , TagController::class)->only(['create', 'store','index']);
Route::get('posts/tag/{tag}', [PostTagController::class, 'index']);