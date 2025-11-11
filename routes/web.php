<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Comment;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/Information', function () {
    return view('Information');
})->middleware(['auth', 'verified'])->name('Information');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // Categories ->
    // GET
    Route::get('/categories', [CategoryController::class, 'index'])
        ->name('categories.index');
    Route::get('/categories/create', function () {
        return view('categories.create');
    })->name('categories.create');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])
        ->name('categories.edit');
    Route::get('/categories/products', [CategoryController::class, 'indexProductToCategory'])->name('categories.indexProducts');


    // POST
    Route::post('/categories', [CategoryController::class, 'store'])
        ->name('categories.store');

    // PUT
    Route::put('/categories/{category}', [CategoryController::class, 'update'])
        ->name('categories.update');

    // Delete
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
        ->name('categories.destroy');


    // Product ->
    // GET
    Route::get('/dashboard', [ProductController::class, 'index'])->name('dashboard');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
        ->name('products.edit');
    // POST
    Route::post('/products', [ProductController::class, 'store'])
        ->name('products.store');
    // PUT
    Route::put('/products/{product}', [ProductController::class, 'update'])
        ->name('products.update');
    // DELETE
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])
        ->name('products.destroy');



    // Comment -> 
    //DELETE
    Route::delete('/dashboard/{comment}/delete', [CommentController::class, 'destroy'])->name('comment.delete');

    //POST 
    Route::post('/dashboard/{product}/createcomment', [CommentController::class, 'store'])->name('comment.create');
    

});

require __DIR__ . '/auth.php';
