<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\showController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/', [showController::class, 'showAll'])->name('showAll');

Route::get('/dashboard', function () {
    return view('books-view');
});



Route::get('/register-form', [UserController::class, 'index'])->name('register-form');
Route::post('/register', [UserController::class, 'create'])->name('register');
Route::get('/edit/{user}/users', [UserController::class, 'edit'])->name('register-edit');
Route::put('/register/{user}', [UserController::class, 'update'])->name('register-update');
Route::get('/users', [UserController::class, 'usershow'])->name('users-index');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users-destroy');




Route::get('/books', [BooksController::class, 'create'])->name('books-create');
Route::post('/books', [BooksController::class, 'store'])->name('books-store');
Route::get('/books-index', [BooksController::class, 'index'])->name('books-index');
Route::delete('books/{id}', [BooksController::class, 'destroy'])->name('books-destroy');
Route::get('/books/{book}/edit', [BooksController::class, 'edit'])->name('books-edit');
Route::put('/books/{book}', [BooksController::class, 'update'])->name('books-update');
Route::delete('/books/{book}/delete', [BooksController::class, 'destroy'])->name('books-delete');
Route::post('/books/{book}/loan', [BooksController::class, 'loan'])->name('books-loan');
Route::patch('/books/{book}/reset', [BooksController::class, 'resetLoan'])->name('books-reset');





Route::post('/categories', [CategoriesController::class, 'store'])->name('category-store');
Route::get('/categories-index', [CategoriesController::class, 'index'])->name('categories-index');
Route::get('/categories-create', [CategoriesController::class, 'create'])->name('categories-create');
Route::get('/categories/{categories}/edit', [CategoriesController::class, 'edit'])->name('categories-edit');
Route::put('/categories/{categories}', [CategoriesController::class, 'update'])->name('categories-update');
Route::delete('/categories/{categories}/delete', [CategoriesController::class, 'destroy'])->name('categories-delete');



