<?php

namespace App\Repository;

use App\Base\Repository\BaseRepository;
use App\Models\Task;

class TaskRepository extends BaseRepository implements Contracts\TaskRepositoryContract
{
    public function __construct(
        private Task $task
    ) {
        parent::__construct($task);
        $this->model = $task;
    }

    public function getTaskByUserId($user_id)
    {
        return $this->model
            ->selectRaw('tasks.id, tasks.title, tasks.description, task_situation.name')
            ->join('users', 'users.id', '=', 'tasks.user_id')
            ->join('task_situation', 'tasks.task_situation_id', '=', 'task_situation.id')
            ->where('users.id', '=', $user_id)
            ->get();
    }
}
