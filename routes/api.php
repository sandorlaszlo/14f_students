<?php

use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get("/student", [StudentController::class,"index"]);
Route::get("/student/{id}", [StudentController::class,"show"]);
Route::post("/student", [StudentController::class,"store"]);
Route::delete("/student/{id}", [StudentController::class,"destroy"]);
Route::patch("/student/{id}", [StudentController::class,"update"]);
Route::put("/student/{id}", [StudentController::class,"update"]);