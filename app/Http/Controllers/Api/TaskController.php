<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;

class TaskController extends Controller
{

    public function index()
    {
        return TaskResource::collection(Task::all());
        // return TaskResource::collection(Task::paginate(5));
    }


    public function store(TaskStoreRequest $request)
    {
        return new TaskResource(Task::create($request->validated()));
    }


    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    public function update(TaskUpdateRequest $request, Task $task)
    {
        return new TaskResource(tap($task)->update($request->validated()));
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(
            [
                'message' => 'Eh kehapus'
            ],
        );
    }
}
