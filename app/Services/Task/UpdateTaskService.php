<?php

namespace App\Services\Task;

use App\DataTransferObjects\Task\UpdateTaskDTO;
use App\Repository\Contracts\TaskRepositoryContract;
use App\Repository\TaskRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use App\Services\Task\Contracts\UpdateTaskServiceContract;
use App\Services\Task\Contracts\GetTaskByIdServiceContract;

class UpdateTaskService implements UpdateTaskServiceContract
{

    /**
     * @var TaskRepositoryContract
     */
    private TaskRepositoryContract $taskRepository;

    /**
     * @var GetTaskByIdServiceContract
     */
    private GetTaskByIdServiceContract $getTaskByIdService;

    public function __construct()
    {
        $this->services();
        $this->repository();
    }

    /**
     * @return void
     */
    public function services() :void
    {
        $this->getTaskByIdService = app(GetTaskByIdServiceContract::class);
    }

    /**
     * @return void
     */
    public function repository() :void
    {
        $this->taskRepository = app(TaskRepositoryContract::class);
    }

    /**
     * @param $id
     * @param UpdateTaskDTO $updateTaskDTO
     * @return object
     * @throws Exception
     */
     public function execute($id, UpdateTaskDTO $updateTaskDTO): object
     {
         try{

            $this->getTaskByIdService->execute($id);

             DB::beginTransaction();
             $task = $this->taskRepository->update($id, [
                 'title' => $updateTaskDTO->title,
                 'description' => $updateTaskDTO->description,
                 'task_situation_id' => $updateTaskDTO->task_situation_id
             ]);
             DB::commit();
             return $task;
         } catch (ModelNotFoundException $modelNotFoundException) {
             DB::rollBack();
             throw $modelNotFoundException;
         } catch (Exception $exception) {
             DB::rollBack();
             throw $exception;
         }
    }
}
