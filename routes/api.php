<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhilcoderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AddCourseController;
use App\Http\Controllers\UploadController;




//authentication
Route::post("/register",[AuthController::class, "register"]);
Route::post("/login",[AuthController::class, "login"]);




//Courses routes
Route::group(["middleware"=> ["auth:sanctum"]], function(){

    //courses
    Route::get("/courses", [PhilcoderController::class, "getCourses"]);
    Route::get("/course/{id}", [PhilcoderController::class, "getCourse"]);
    Route::post("/create/course", [AddCourseController::class, "AddCourse"]);
    Route::put("/update/course/{id}", [PhilcoderController::class, "updateCourse"]);
    Route::delete("/delete/course/{id}", [PhilcoderController::class, "deleteCourse"]);
  
    


    Route::get("/user-info", [AuthController::class, "getLoggedUser"]);
    Route::post("/logout", [AuthController::class, "logoutUser"]);
    Route::get("/categories", [CategoriesController::class, "getCategories"]);

    Route::get("/instructor", [UsersController::class, "getInstructor"]);
    Route::get("/categories", [CategoriesController::class, "getCategories"]);

    Route::get('uploads/', [UploadController::class, 'index'])->name('uploads.index');
    Route::post('uploads/create', [UploadController::class, 'create'])->name('uploads.create');
    Route::post('uploads/store', [UploadController::class, 'store'])->name('uploads.store');

});
