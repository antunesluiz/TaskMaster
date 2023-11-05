<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Support\Collection;

class TaskRepository
{
    /**
     * @var TaskRepository|null
     */
    private static ?TaskRepository $instance = null;

    /**
     * TaskRepository constructor
     */
    private function __construct() {

    }

    /**
     * Create a new instance of TaskRepository
     *
     * @return TaskRepository
     */
    private static function createInstance() : TaskRepository {
        return new TaskRepository();
    }

    /**
     * Get the instance of TaskRepository
     *
     * @return TaskRepository
     */
    public static function getInstance() : TaskRepository {
        if (self::$instance == null) {
            self::$instance = self::createInstance();
        }

        return self::$instance;
    }

    /**
     * Get all tasks
     *
     * @return Collection
     */
    public function getTasks() : Collection {
        return Task::all();
    }

    /**
     * Create a new task
     *
     * @param array $data
     * @return Task
     */
    public function createTask(array $data) : Task {
        return Task::create($data);
    }
    
    /**
     * Get a task
     *
     * @param Task $task
     * @return Task
     */
    public function getTask(Task $task) : Task {
        return $task;
    }

    /**
     * Update a task
     *
     * @param Task $task
     * @param array $data
     * @return Task
     */
    public function updateTask(Task $task, array $data) : Task {
        $task->update($data);

        return $task;
    }

    /**
     * Delete a task
     *
     * @param Task $task
     * @return bool
     */
    public function deleteTask(Task $task) : bool {
        return $task->delete();
    }
}