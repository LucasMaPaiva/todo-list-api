<?php

namespace App\Services\Task;

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
     * @param $request
     * @return mixed
     * @throws Exception
     */
    public function execute($request): mixed
    {
        try{
            DB::beginTransaction();
            $task = $this->taskRepository->create([
                'title' => $request->title,
                'description' => $request->description,
                'task_situation_id' => $request->task_situation_id,
            ]);
            DB::commit();
            return $task;
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

    }
}
