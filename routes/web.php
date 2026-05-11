<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CommentController;
Route::get('/', function () {
    return view('welcome');
});
Route::get("/taskk", [TaskController::class, "index"])->name("tasks.index")->middleware('auth');
Route::get("/tasks/create", [TaskController::class, "create"])->name("tasks.create")->middleware('auth'); 
Route::post("/tasks", [TaskController::class, "store"])->name("tasks.store")->middleware('auth');
Route::get("/tasks/{task}", [TaskController::class, "show"] )->name("tasks.show")->middleware('auth');
Route::get("tasks/{task}/edit", [TaskController::class, "edit"])->name("tasks.edit")->middleware('auth');
Route::put("tasks/{task}", [TaskController::class, "update"])->name("tasks.update")->middleware('auth');
Route::delete("/tasks/{task}", [TaskController::class, "destroy"] )->name("tasks.destroy")->middleware('auth');
Route::post("tasks/{task}/comments", [CommentController::class, "store"])->name("comments.store")->middleware('auth');
Route::patch('/tasks/{id}/restore', [TaskController::class, 'restore'])->name('tasks.restore')->middleware('auth');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
