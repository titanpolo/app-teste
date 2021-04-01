<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\PostController;
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

// Search
Route::any('/posts/search', [PostController::class, 'search'])->name('posts.search');

// Index to menu
Route::get('/home', [Controller::class, 'menu'])->name('menu');

// Index to welcome
Route::get('/', [Controller::class, 'welcome'])->name('welcome');

// Index to read all registers
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// Index to create
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');

// Create
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

// Index to read one register
Route::get('/posts/show/{id}', [PostController::class, 'show'])->name('posts.show');

// Delete
Route::delete('/posts/destroy/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

// Index to update
Route::get('/posts/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');

// Update
Route::put('/posts/edit/{id}', [PostController::class, 'update'])->name('posts.update');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
