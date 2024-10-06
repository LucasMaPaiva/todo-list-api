<?php

namespace App\Services\Task;

use App\Repository\Contracts\TaskRepositoryContract;
use App\Services\Auth\Contracts\GetUserByIdServiceContract;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ListTaskByUserService implements Contracts\ListTaskByUserServiceContract
{

    private GetUserByIdServiceContract $getUserByIdService;

    private TaskRepositoryContract $taskRepository;

    public function __construct()
    {
        $this->services();
        $this->repositories();
    }

    public function services()
    {
        $this->getUserByIdService = app(GetUserByIdServiceContract::class);
    }

    public function repositories()
    {
        $this->taskRepository = app(TaskRepositoryContract::class);
    }


    public function execute($user_id)
    {
        try {

            $user = $this->getUserByIdService->execute($user_id);

            return $this->taskRepository->getTaskByUserId($user_id);



        } catch (ModelNotFoundException $modelNotFoundException) {
            throw $modelNotFoundException;
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
