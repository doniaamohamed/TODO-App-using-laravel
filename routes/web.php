<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
Route::get('/', function () {
    return view('welcome');
});

Route::get("/task", [TaskController::class, "index"])->name("tasks.index");
Route::get("/tasks/create", [TaskController::class, "create"])->name("tasks.create"); 
Route::post("/tasks", [TaskController::class, "store"])->name("tasks.store");
Route::get("/tasks/{task}", [TaskController::class, "show"] )->name("tasks.show");
Route::get("tasks/{task}/edit", [TaskController::class, "edit"])->name("tasks.edit");
Route::put("tasks/{task}", [TaskController::class, "update"])->name("tasks.update");
Route::delete("/tasks/{task}", [TaskController::class, "destroy"] )->name("tasks.destroy");
//name 3la kol route 3shan a3ml redirect l route da b esmoh w msh b url bta3o f controller w view w ay mkan 