<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'homePage'])->name('home');

Route::get('login', [LoginController::class, 'login'])->name('author.login');
Route::post('do-login', [LoginController::class, 'doLogin'])->name('author.do.login');
Route::get('signup', [LoginController::class, 'signup'])->name('author.signup');
Route::post('do-signup', [LoginController::class, 'doSignup'])->name('author.do.signup');


 Route::group(['middleware' => 'author_auth'], function(){
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('categories', [DashboardController::class, 'categories'])->name('categories');
    Route::get('tags', [DashboardController::class, 'tags'])->name('tags');
    Route::post('create-category', [DashboardController::class, 'createCategory'])->name('create.category');
    Route::get('delete-category/{category_id}', [DashboardController::class, 'deleteCategory'])->name('delete.category');

    Route::post('create-tag', [DashboardController::class, 'createTag'])->name('create.tag');
    Route::get('delete-tag/{tag_id}', [DashboardController::class, 'deleteTag'])->name('delete.tag');

    Route::post('add-blog', [DashboardController::class, 'addBlog'])->name('add.blog');
    Route::get('delete-blog/{tag_id}', [DashboardController::class, 'deleteBlog'])->name('delete.blog');
    Route::post('edit-blog', [DashboardController::class, 'editBlog'])->name('edit.blog');

    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
 });



