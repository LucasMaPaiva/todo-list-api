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
}
