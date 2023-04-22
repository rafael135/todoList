<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/", [HomeController::class, "dashboard"])->name("home");

Route::middleware(["auth"])->group(function () {
    Route::get("/dashboard", [HomeController::class, "dashboard"])->name("user.dashboard");


    Route::get("/logout", [AuthController::class, "logout"])->name("user.logout");

    Route::post("/task/create", [TaskController::class, "create"])->name("task.create");
    Route::post("/task/edit", [TaskController::class, "edit"])->name("task.edit");
    Route::post("/task/update", [TaskController::class, "updateStatus"])->name("task.update");
    Route::delete("/task/delete", [TaskController::class, "delete"])->name("task.delete");
    Route::post("/task", [TaskController::class, "getById"])->name("task.get");

    Route::post("/category", [CategoryController::class, "getById"])->name("category.get");
    Route::post("/category/create", [CategoryController::class, "create"])->name("category.create");
    Route::post("/category/edit", [CategoryController::class, "edit"])->name("category.edit");
    Route::delete("/category/delete", [CategoryController::class, "delete"])->name("category.delete");

    Route::get("/tasks", [UserController::class, "showTasks"])->name("user.tasks");
    Route::get("/categories", [UserController::class, "showCategories"])->name("user.categories");
    

    
});


Route::get("/login", [AuthController::class, "loginView"])->name("user.login");
Route::post("/login", [AuthController::class, "loginAction"])->name("user.loginAction");
Route::get("/register", [AuthController::class, "registerView"])->name("user.register");
Route::post("/register", [AuthController::class, "registerAction"])->name("user.registerAction");




