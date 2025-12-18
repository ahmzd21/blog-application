<?php

use App\Http\Controllers\FollowerController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicProfileController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/', [PostController::class, 'index'])->name('dashboard');
Route::get('/category/{category:slug}', [PostController::class, 'category'])->name('post.category');
Route::get('/post/@{username}/{post:slug}', [PostController::class, 'show'])->name('post.show');
Route::get('/@{user:username}', [PublicProfileController::class, 'show'])->name('profile.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post/create', [PostController::class, 'store'])->name('post.store');
    Route::get('/post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/post/{post}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('post.destroy');
    Route::post('/follow/{user}', [FollowerController::class, 'follow'])->name('follow');
    Route::post('/like/{post}', [LikeController::class, 'like'])->name('like');
    Route::post('/posts/{post}/comments', [\App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/users', [\App\Http\Controllers\AdminController::class, 'users'])->name('admin.users.index');
    Route::delete('/admin/users/{user}', [\App\Http\Controllers\AdminController::class, 'destroyUser'])->name('admin.users.destroy');
    Route::get('/admin/posts', [\App\Http\Controllers\AdminController::class, 'posts'])->name('admin.posts.index');
    Route::delete('/admin/posts/{post}', [\App\Http\Controllers\AdminController::class, 'destroyPost'])->name('admin.posts.destroy');
});
