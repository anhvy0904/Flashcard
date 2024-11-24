<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminCheck;
use App\Http\Controllers\SetCardController;
use App\Http\Middleware\UserCheck;
Route::get('/login',[UserController::class , 'login'])->name('login');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'post_register']);
Route::post('/login', [UserController::class, 'post_login']);
Route::middleware([UserCheck::class])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    //Route::get('/detail/{id}', [SetCardController::class, 'detail'])->name('detail');
    Route::get('/detail', [UserController::class, 'detail'])->name('detail');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::resource('/setcard', SetCardController::class);
    
    // Route:get('/login/',[UserController::class , 'login'])->name('login');
    // Route::get('/', 'FlashCardController@index')->name('flashcard.index');
    // Route::get('/login','AuthController@login')->name('user.login');
    // Route::post('/login','AuthController@postLogin');
    // Route::get('/register','AuthController@register')->name('user.re gister');
    // Route::post('/register','AuthController@postRegister');

});



Route::get('/admin/login',[AdminController::class , 'login'])->name('admin.login');
Route::post('/admin/login',[AdminController::class , 'post_login']);
Route::prefix('admin')->middleware([AdminCheck::class])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('/customer', CustomerController::class);
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
});
// Route::group(['prefix' => 'flashcard','middleware' => 'AdminCheck' ], function () {
//     Route::get('/create', 'FlashCardController@create');
//     Route::post('/store', 'FlashCardController@store');
//     Route::get('/{id}/edit', 'FlashCardController@edit');
//     Route::post('/{id}/update', 'FlashCardController@update');
//     Route::get('/{id}/delete', 'FlashCardController@delete');
//     Route::get('/{id}/show', 'FlashCardController@show');
// })->middleware(AdminCheck::class);