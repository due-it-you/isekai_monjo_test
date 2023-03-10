<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', [PostController::class, 'index'])->middleware(['auth'])->name('home');

Route::get('/post', [PostController::class, 'create'])->name('post.create');
Route::post('/posts/store', [PostController::class, 'store'])->name('post.store');
Route::post('/destroy/{id}', [PostController::class, 'destroy'])->name('post.destroy');
Route::get('/posts/index', [PostController::class, 'index'])->name('post.index');
Route::get('/posts/search', [PostController::class, 'search'])->name('posts.search');
Route::post('/posts/update', [PostController::class, 'update'])->name('post.update');
Route::post('/posts/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
Route::post('/posts/show/{id}', [PostController::class, 'show'])->name('post.show');

Route::post('/tags', [TagController::class, 'store']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
