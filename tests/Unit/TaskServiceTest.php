<?php

use App\Models\Task;
use App\Models\User;
use App\Services\Task\TaskService;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->task = Task::factory()->for($this->user)->create();
});

it('get all tasks', function () {
    $tasks = TaskService::getInstance()->getTasks();

    expect($tasks)->toHaveCount(1);
});

it('can create a task', function() {
    $task = Task::factory()->for($this->user)->make()->toArray();

    $createdTask = TaskService::getInstance()->createTask($task);

    expect($createdTask)->toBeInstanceOf(Task::class);
    expect($createdTask->title)->toEqual($task['title']);
});

it('can show a task', function () {
    $task = Task::factory()->for($this->user)->create();

    $foundTask = TaskService::getInstance()->getTask($task);

    expect($foundTask)->toBeInstanceOf(Task::class);
    expect($foundTask->id)->toEqual($task->id);
});

it('can update a task', function () {
    $task = Task::factory()->for($this->user)->create();
    $taskData = ['title' => 'Updated title', 'description' => 'Updated description'];

    $updatedTask = TaskService::getInstance()->updateTask($task, $taskData);

    expect($updatedTask)->toBeInstanceOf(Task::class);
    expect($updatedTask->title)->toEqual('Updated title');
    expect($updatedTask->description)->toEqual('Updated description');
});

it('can delete a task', function () {
    $task = Task::factory()->for($this->user)->create();

    TaskService::getInstance()->deleteTask($task);

    $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
});