<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Storage;
class TaskController extends Controller
{
   private $tasks = [
    [
        "id"          => 1,
        "title"       => "Design Database Schema",
        "description" => "Create the ERD and migrate tables for the Todo application.",
        "creator"     => "Ahmed Ali",
        "priority"    => "High",
        "status"      => "In Progress",
        "due_date"    => "2026-05-10"
    ],
    [
        "id"          => 2,
        "title"       => "Implement Authentication",
        "description" => "Setup Laravel Sanctum for API token-based authentication.",
        "creator"     => "Sara Hassan",
        "priority"    => "Medium",
        "status"      => "Pending",
        "due_date"    => "2026-05-15"
    ],
    [
        "id"          => 3,
        "title"       => "Refactor Controller Logic",
        "description" => "Apply Clean Code principles and use Service Classes.",
        "creator"     => "User",
        "priority"    => "Low",
        "status"      => "Completed",
        "due_date"    => "2026-05-05"
    ]
];
public function index(){
    $tasks= Task::withTrashed()->paginate(15);
    return view("tasks.index",["tasks" =>$tasks]);
}
public function show(Task $task){
    $task->load([ 'assignee', 'comments.user','creator']);
    return view('tasks.show', compact('task'));
    
}

public function edit($id){
    $task = Task::findOrFail($id);
    $users = User::all();
    return view("tasks.edit", compact("task", "users"));
    
}
public function create(){
    $users = User::all();
    return view("tasks.create", compact("users"));
}
public function store(StorePostRequest $request){
$request->validate([
        'images.*' => 'image|mimes:jpg,png|max:2048', 
    ]);

    $task = Task::create($request->all());

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $file) {
            $path = $file->store('tasks', 'public');
            $task->images()->create(['path' => $path]);
        }
    }
    return redirect()->route("tasks.index");
}

public function update(Request $request, Task $task)
{
    $request->validate([
        'images.*' => 'image|mimes:jpg,png|max:2048', 
    ]);

    $task->update($request->only('title', 'description', 'status'));

    if ($request->hasFile('images')) {
        foreach ($task->images as $image) {
            Storage::disk('public')->delete($image->path);
        }
        $task->images()->delete();

        foreach ($request->file('images') as $file) {
            $path = $file->store('tasks', 'public');
            $task->images()->create(['path' => $path]);
        }
    }

    return redirect()->route('tasks.index');
}
public function destroy($id){
    $task=Task::findOrFail($id); 
    foreach ($task->images as $image) {
        Storage::disk('public')->delete($image->path);
    }
    $task->delete();
    return redirect()->route("tasks.index");
}   
public function restore($id)
{
    $task = Task::withTrashed()->findOrFail($id);
    $task->restore(); 

    return redirect()->route('tasks.index')->with('success', 'Task restored successfully!');
}
}

