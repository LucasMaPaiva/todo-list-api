<?php

namespace App\Services\Task;

use App\Repository\Contracts\TaskRepositoryContract;
use App\Services\Task\Contracts\GetTaskByIdServiceContract;
use Exception;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class DeleteTaskService implements Contracts\DeleteTaskServiceContract
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
        $this->repositories();
        $this->services();
    }

    /**
     * @return void
     */
    public function repositories() :void
    {
        $this->taskRepository = app(TaskRepositoryContract::class);
    }

    /**
     * @return void
     */
    public function services() :void
    {
        $this->getTaskByIdService = app(GetTaskByIdServiceContract::class);
    }

    /**
     * @param $id
     * @return void
     * @throws Exception
     */
    public function execute($id) : void
    {

        try {
            $this->getTaskByIdService->execute($id);

            DB::beginTransaction();
                $this->taskRepository->delete($id);
            DB::commit();

        } catch (InvalidArgumentException $invalidArgumentException) {
            DB::rollBack();
            throw $invalidArgumentException;
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

    }
}
