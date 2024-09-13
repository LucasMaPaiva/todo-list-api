<?php

namespace App\Services\Task;

use App\Repository\TaskRepository;
use Exception;
use App\Repository\Contracts\TaskRepositoryContract;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GetTaskByIdService implements Contracts\GetTaskByIdServiceContract
{

    /**
     * @var TaskRepositoryContract
     */
    private TaskRepositoryContract $taskRepository;

    /**
     *
     */
    public function __construct
    (
    )
    {
        $this->repository();
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
     * @return mixed
     * @throws Exception
     */
    public function execute($id): mixed
    {
        try {

            $task = $this->taskRepository->find($id);

            if (empty($task)) {
                throw new ModelNotFoundException(
                    __('messages.error.not_found',
                        [
                            'scope' => ('Tarefa')
                        ])
                );
            }
            return $task;

        } catch (ModelNotFoundException $modelNotFoundException) {
            throw $modelNotFoundException;
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
