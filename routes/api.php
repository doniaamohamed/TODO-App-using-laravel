<?php
use App\Http\Controllers\Apis\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apis\TaskController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/tasks", [TaskController::class, 'index'])->middleware('auth:sanctum');
Route::get("/tasks/{task}", [TaskController::class, 'show'])->middleware('auth:sanctum');
Route::post("/tasks", [TaskController::class, 'store'])->middleware('auth:sanctum');;
Route::put("/tasks/{task}", [TaskController::class, 'update'])->middleware('auth:sanctum');;
Route::delete("/tasks/{task}", [TaskController::class, 'destroy'])->middleware('auth:sanctum');

// Route::middleware('auth:sanctum')->group(function () {
//     Route::apiResource('tasks', TaskController::class);
// });
Route::post('/login', [AuthController::class, 'login']);
