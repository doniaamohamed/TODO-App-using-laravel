<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Task;
class CommentController extends Controller
{
    public function store(Request $request, $task_id)
    {
        
       $task = Task::findOrFail($task_id);
       $task->comments()->create([
        'body'    => $request->body,
        'user_id' => auth()->id() ?? 1, 
    ]);
        return redirect()->route("tasks.show", $task_id);
    }
}
