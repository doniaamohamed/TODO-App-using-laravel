<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Support\Facades\Storage;
use function Laravel\Prompts\select;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $tasks = Task::with(['user', 'comments.user'])->paginate(10);
         return TaskResource::collection($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
         $validated = $request->validated();

        $task = Task::create($validated);

        return response()->json(
            [
                "data" => new taskResource($task),
                "message" => "task created Successfully"
            ]
            , 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $task = Task::where("id", $id)->with("comments")->firstorfail();

//         return response()->json($task);
        return new taskResource($task->load("comments.user", "user"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, string $id)
    {
        $validated = $request->validated();

        $task = Task::findorfail($id);
        $task->update($validated);

        return response()->json(
            [
                "data" => new taskResource($task),
                "message" => "task updated Successfully"
            ]
            , 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $task = Task::findorfail($id);

        if($task->image){
            Storage::disk("public")->delete($task->image);
        }

        $task->delete();

        return response()->json(
            [
                "message" => "task deleted successfully"
            ] , 200);
    }
    
}
