<?php

namespace App\Services\Task;

use App\Repository\Contracts\TaskRepositoryContract;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Services\Task\Contracts\UpdateTaskServiceContract;

class UpdateTaskService implements UpdateTaskServiceContract
{

    private TaskRepositoryContract $taskRepository;

    public function __construct()
    {
        $this->repository();
    }

    public function repository() :void
    {
        $this->taskRepository = app(TaskRepositoryContract::class);
    }

    /**
     * @param $id
     * @param  $request
     * @return object
     * @throws Exception
     */
     public function execute($id, $request): object
     {
         try{
             DB::beginTransaction();
             $task = $this->taskRepository->update($id, [
                 'title' => $request->title,
                 'description' => $request->description,
                 'task_situation_id' => $request->task_situation_id
             ]);
             DB::commit();
             return $task;
         } catch (Exception $exception) {
             DB::rollBack();
             throw $exception;
         }
    }
}
