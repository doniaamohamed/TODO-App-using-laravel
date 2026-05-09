<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CommentController;
Route::get('/', function () {
    return view('welcome');
});

Route::get("/taskk", [TaskController::class, "index"])->name("tasks.index");
Route::get("/tasks/create", [TaskController::class, "create"])->name("tasks.create"); 
Route::post("/tasks", [TaskController::class, "store"])->name("tasks.store");
Route::get("/tasks/{task}", [TaskController::class, "show"] )->name("tasks.show");
Route::get("tasks/{task}/edit", [TaskController::class, "edit"])->name("tasks.edit");
Route::put("tasks/{task}", [TaskController::class, "update"])->name("tasks.update");
Route::delete("/tasks/{task}", [TaskController::class, "destroy"] )->name("tasks.destroy");
Route::post("tasks/{task}/comments", [CommentController::class, "store"])->name("comments.store");
Route::patch('/tasks/{id}/restore', [TaskController::class, 'restore'])->name('tasks.restore');
//name 3la kol route 3shan a3ml redirect l route da b esmoh w msh b url bta3o f controller w view w ay mkan 