<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    if (!session()->has('tasks')) {
        session()->put('tasks', $this->tasks);
    }

   $tasksFromSession= session()->get('tasks');
    return view("tasks.index",["tasks" =>$tasksFromSession]);
}
public function show($id){
    $tasks = session()->get('tasks', []);
    foreach($this->tasks as $task){
      if($task["id"] == $id){
        return view("tasks.show",["task" =>$task]);
      }
    }   
}

public function edit($id){
    $tasks = session()->get('tasks', []);
    foreach($tasks as $task){
      if($task["id"] == $id){
        return view("tasks.edit",["task" =>$task]);
      }
    }   
}
public function create(){

    return view("tasks.create");
}
public function store(Request $request){
$tasks = session()->get('tasks', []);
$request->validate([
     'title'=>'required',
]);

    $newTask = [
            "id" => count($tasks) + 1,
            "title" => $request["title"],
            "description" => $request["description"],
            "creator" => $request["creator"],
           "priority" => $request["priority"],
           "status" => $request["status"],
           "due_date"  => $request["due_date"]
        ];
         $tasks[] = $newTask;
         session()->put('tasks', $tasks);
        return redirect()->route("tasks.index");
}
public function update(Request $request,$id){
    $tasks = session()->get('tasks', []);
   foreach($tasks as &$task){
      if($task["id"] == $id){
           $task[ "title"] = $request["title"];
            $task["description"]= $request["description"];
            $task["creator"] = $request["creator"];
           $task["priority"] = $request["priority"];
           $task["status"] = $request["status"];
           $task["due_date"]  = $request["due_date"];
           break;
        
      }
   }
     session()->put('tasks', $tasks);
     return redirect()->route("tasks.index");
}
public function destroy($id){
    $tasks = session()->get('tasks', []);
    $tasks = array_filter($tasks, function($task) use ($id) {
        return $task['id'] != $id;
    });

    session()->put('tasks', $tasks);
    return redirect()->route("tasks.index");
}   
}

