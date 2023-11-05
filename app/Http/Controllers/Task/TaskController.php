<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\TaskRequest;
use App\Http\Resources\Task\TaskResource;
use App\Models\Task;
use App\Services\Task\TaskService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the tasks.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = TaskService::getInstance()->getTasks();

        return TaskResource::collection($tasks);
    }

    /**
     * Store a newly created task in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        $task = TaskService::getInstance()->createTask($request->validated());

        return response()->json($task, Response::HTTP_CREATED);
    }

    /**
     * Display the specified task.
     *
     * @param  Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $task = TaskService::getInstance()->getTask($task);
        
        return new TaskResource($task);
    }

    /**
     * Update the specified task in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, Task $task)
    {
        $task = TaskService::getInstance()->updateTask($task, $request->validated());
        
        return response()->json([
            'message' => 'Task updated successfully',
            'task' => $task,
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified task from storage.
     *
     * @param  Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        TaskService::getInstance()->deleteTask($task);

        return response()->json([
            'message' => 'Task deleted successfully',
        ], Response::HTTP_OK);
    }
}
