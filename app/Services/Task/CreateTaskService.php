<?php

namespace App\Services\Task;

use App\Repository\TaskRepository;
use App\Services\Task\Contracts\CreateTaskServiceContract;
use Illuminate\Http\Request;
use App\Repository\Contracts\TaskRepositoryContract;

class CreateTaskService implements Contracts\CreateTaskServiceContract
{

    private TaskRepositoryContract $taskRepository;

    public function __construct()
    {
        $this->services();
    }

    public function services(): void
    {
        $this->taskRepository = app(TaskRepositoryContract::class);
    }

    public function execute(Request $request)
    {
        return $this->taskRepository->create([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'task_situation_id' => $request->get('task_situation_id')
        ]);
    }
}
