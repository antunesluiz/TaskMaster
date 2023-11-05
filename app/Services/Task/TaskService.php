<?php

namespace App\Services\Task;

use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Support\Collection;

class TaskService
{
    /**
     * @var TaskRepository
     */
    private TaskRepository $taskRepository;

    /**
     * @var TaskService|null
     */
    private static ?TaskService $instance = null;

    /**
     * TaskService constructor
     */
    private function __construct()
    {
        $this->taskRepository = TaskRepository::getInstance();
    }

    /**
     * Create a new instance of TaskService
     *
     * @return TaskService
     */
    private static function createInstance() : TaskService {
        return new TaskService();
    }

    /**
     * Get the instance of TaskService
     *
     * @return TaskService
     */
    public static function getInstance() : TaskService {
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
        return $this->taskRepository->getTasks();
    }

    /**
     * Create a new task
     *
     * @param array $data
     * @return Task
     */
    public function createTask(array $data) : Task {
        return $this->taskRepository->createTask($data);
    }

    /**
     * Get a task
     * 
     * @param Task $task
     * @return Task
     */
    public function getTask(Task $task) : Task {
        return $this->taskRepository->getTask($task);
    }

    /**
     * Update a task
     * 
     * @param Task $task
     * @param array $data
     * @return Task
     */
    public function updateTask(Task $task, array $data) : Task {
        return $this->taskRepository->updateTask($task, $data);
    }

    /**
     * Delete a task
     * 
     * @param Task $task
     * @return void
     */
    public function deleteTask(Task $task) : void {
        $this->taskRepository->deleteTask($task);
    }
}