<?php

namespace App\Services\Task;

use App\DataTransferObjects\Task\CreateTaskDTO;
use App\Repository\Contracts\TaskRepositoryContract;
use Exception;
use Illuminate\Support\Facades\DB;

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

    /**
     * @param CreateTaskDTO $createTaskDTO
     * @return mixed
     * @throws Exception
     */
    public function execute(CreateTaskDTO $createTaskDTO): mixed
    {
        try{
            DB::beginTransaction();
            $task = $this->taskRepository->create([
                'title' => $createTaskDTO->title,
                'description' => $createTaskDTO->description,
                'task_situation_id' => $createTaskDTO->task_situation_id,
            ]);
            DB::commit();
            return $task;
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

    }
}
