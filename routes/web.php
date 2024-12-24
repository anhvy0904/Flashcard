<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminCheck;
use App\Http\Controllers\SetCardController;
use App\Http\Middleware\UserCheck;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotificationController;
Route::get('/login',[UserController::class , 'login'])->name('login');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'post_register']);
Route::post('/login', [UserController::class, 'post_login']);
Route::get('/forgotPassword', [UserController::class, 'ForgotPassword'])->name('user.forgotPassword');
Route::post('/sendMail', [UserController::class, 'sendMail'])->name('user.sendMail');
Route::get('/resetPassword', [UserController::class, 'resetPassword'])->name('user.resetPassword');
Route::post('/updatePassword', [UserController::class, 'updatePassword'])->name('user.updatePassword');
Route::middleware([UserCheck::class])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    //Route::get('/detail/{id}', [SetCardController::class, 'detail'])->name('detail');
    Route::get('/detail', [UserController::class, 'detail'])->name('detail');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::resource('/setcard', SetCardController::class);
    Route::post('/setcard/{id}/comment', [SetCardController::class, 'comment'])->name('post_comment');
    Route::post('/test/{setcard}/submit', [SetCardController::class, 'submitTest'])->name('submit.test');
// Route để hiển thị kết quả bài kiểm tra
    Route::get('/test/result/{test}', [SetCardController::class, 'showResultTest'])->name('result.test');
    Route::get('/history', [SetCardController::class, 'history'])->name('history.test');
    Route::get('/notifications', [NotificationController::class, 'userIndex'])->name('notifications');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('user.notifications.read');

});



Route::get('/admin/login',[AdminController::class , 'login'])->name('admin.login');
Route::post('/admin/login',[AdminController::class , 'post_login']);
Route::prefix('admin')->middleware([AdminCheck::class])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('/customer', CustomerController::class);
    Route::get('/customer/{user}/setcards', [CustomerController::class, 'userListSetCard'])->name('customer.setcards');
    Route::get('/customer/{user}/setcards/{setcard}/detail', [CustomerController::class, 'userListSetCardDetail'])->name('customer.setCardDetail');
    Route::resource('/comment', CommentController::class);
    Route::resource('/notifications', NotificationController::class);
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