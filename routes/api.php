<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MasterApiController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post("login", [AuthController::class, 'login'])->name("api.login");
Route::get("logout", [AuthController::class, 'logout'])->middleware('auth:sanctum')->name("api.logout");

Route::get("dashboard", [MasterApiController::class, 'dashboard'])->middleware('auth:sanctum')->name("api.dashboard");

Route::get("datatables", [MasterApiController::class, 'datatables'])->middleware('auth:sanctum')->name("api.master.datatables");
Route::get("index", [MasterApiController::class, 'index'])->middleware('auth:sanctum')->name("api.master.index");
Route::get("show/{id}", [MasterApiController::class, 'show'])->middleware('auth:sanctum')->name("api.master.show");
Route::post("store", [MasterApiController::class, 'store'])->middleware('auth:sanctum')->name("api.master.store");
Route::put("update/{id}", [MasterApiController::class, 'update'])->middleware('auth:sanctum')->name("api.master.update");
Route::get("destroy/{id}", [MasterApiController::class, 'destroy'])->middleware('auth:sanctum')->name("api.master.destroy");

