<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;

//for authentication
Route::redirect('/',"login-page");
Route::get("signup-page",[AuthController::class,"signupPage"])->name("Auth-SignupPage");
Route::get("login-page",[AuthController::class,"loginPage"])->name("Auth-LoginPage");

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
    //home
    Route::redirect("/dashboard","home-page");
    Route::get('home-page',[PostController::class,'homePage'])->name("Auth-HomePage");
    //post
    Route::prefix("post")->group(function(){
        Route::post("upload",[PostController::class,"upload"])->name("Post-Upload");
        Route::get("details/{id}",[PostController::class,"postDetails"])->name("Post-Details");
        Route::get("edit/{id}",[PostController::class,"editPost"])->name("Post-Edit");
        Route::post("update",[PostController::class,"updatePost"])->name("Post-Update");
        Route::get("delete/{id}",[PostController::class,"deletePost"])->name("Post-Delete");
    });
    //comment
    Route::prefix("comment")->group(function(){
        Route::post("upload",[CommentController::class,"uploadComment"])->name("Comment-Upload");
        Route::get("edit/{id}",[CommentController::class,"editComment"])->name("Comment-Edit");
        Route::post("update",[CommentController::class,"updateComment"])->name("Comment-Update");
        Route::get("delete/{id}",[CommentController::class,"deleteComment"])->name("Comment-Delete");
    });
});
