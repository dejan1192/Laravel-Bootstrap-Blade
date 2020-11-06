<?php

use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Models\BlogPost;
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
Route::post('/profile/follow', [ProfileController::class , 'follow'])->name('profile.follow');

Route::post('/profile/image', [ProfileController::class , 'uploadImage'])->name('profile.upload');
Route::get('/profile/{userId}', [ProfileController::class , 'index'])->name('profile.index');
Route::get('posts/create', [BlogPostController::class , 'create'])->name('posts.create');
Route::get('posts/{id}', [BlogPostController::class, 'show'])->name('posts.show');

Route::post('/comments', [CommentController::class , 'store'])->name('comments.store');
Route::post('/posts', [BlogPostController::class , 'store'])->name('posts.store');


Route::delete('/posts/{postId}', [BlogPostController::class , 'destroy'])->name('posts.delete');